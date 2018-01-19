<?php
/**
 * Created by PhpStorm.
 * User: Yoidel Martinez Baquero
 * Date: 10/25/2017
 * Time: 3:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('html');

    }

    public function index()
    {
        $em = $this->doctrine->em;
        $morevisits = $em->getRepository('Entities\Service');
        $data['services'] = $morevisits->findBy(array(), array('visits' => 'DESC'), 4);
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }
        $data['content'] = '/client/index';
        $data["tab"] = "home";
        $this->load->view('/client/_layouts/index', $data);
    }

    public function login()
    {
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }
        $this->data['title'] = 'Iniciar sesion';
        $data["tab"] = "";

        // validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

        if ($this->form_validation->run() === TRUE) {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect('index', 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());

                redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );
            $data["data"] = $this->data;
            $data['content'] = '/client/auth/login';
            $this->load->view('client/_layouts/login', $data);
        }

//        $data['content'] = '/client/auth/login';
//        $data["tab"] = "";
//        $this->load->view('/client/_layouts/login', $data);
    }

    public function logout()
    {
        // log the user out
        $logout = $this->ion_auth->logout();

        // redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/index', 'refresh');
    }

    public function register()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->data["showlogin"] = true;
        }

        $this->data['title'] = $this->lang->line('create_user_heading');

//		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
//		{
//			redirect('auth', 'refresh');
//		}

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'trim');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() === TRUE) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['company'] = array(
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $this->data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $this->data['content'] = 'client/auth/register';
            $this->data["tab"] = "";
            $this->load->view('client/_layouts/login', $this->data);
        }
    }

    public function myfavorites()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('client/login', 'refresh');
        }
        $this->load->helper('html');
        $em = $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\Service');
        $data['services'] = $servicesRepo->findAll();
        $data['content'] = 'client/services/index';
        $data["tab"] = "myfavorites";

        $this->load->view('/client/_layouts/listpage', $data);
    }

    public function myservices()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('client/login', 'refresh');
        }
        $user = $this->getCurrentUser();
        $data['services'] = $user->getServices()->toArray();
        $data['content'] = 'client/services/index';
        $data["tab"] = "myservices";
        $this->load->view('/client/_layouts/listpage', $data);
    }

    public function mysearchs()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('client/login', 'refresh');
        }

        $user = $this->getCurrentUser();
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("visited", \Doctrine\Common\Collections\Expr\Comparison::EQ, 1);
        $criteria->where($expresion);
        $relacion = $user->getUserservices()->matching($criteria)->toArray();
        $data["services"] = array();
        foreach ($relacion as $servicerel) {
            $service_obj = $servicerel->getService();
            $service_obj->loadRelatedUserData($user);
            $service_obj->loadRelatedData();
            $data["services"][] = $service_obj;
        }

        $data['content'] = 'client/services/index';
        $data["tab"] = "myserchs";
        $this->load->view('/client/_layouts/listpage', $data);
    }

    public function service($id = 3)
    {
        $em = $this->doctrine->em;
        $service = $em->find('Entities\Service', $id);
        $data["object"] = $service;

        $subcategory = $service->getSubcategories();
        $morevisits = $em->getRepository('Entities\Service');
        $data['similar'] = $morevisits->findBy(array(), array('visits' => 'DESC'), 4);

        $data['content'] = 'client/services/show';
        $data["tab"] = "service";
        $this->load->view('/client/_layouts/singlepage', $data);
    }

    private function getCurrentUser()
    {
        $clientid = $this->ion_auth->get_user_id();
        $em = $this->doctrine->em;
        $user = $em->find("Entities\User", $clientid);
        return $user;
    }


}