<?php use Doctrine\Common\Collections\Criteria;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users Controller.
 */
class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->helper('html');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
    }

    # GET /users
    function index()
    {
        $em = $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\User');
        $data['users'] = $servicesRepo->findAll();
        $data['content'] = '/users/index';
        $data["tab"] = "user";
        $data["tabTitle"] = "usuarios";
        $data['users'] = $this->ion_auth->users()->result();
        foreach ($data['users'] as $k => $user) {
            $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
        $this->load->view('/includes/contentpage', $data);

    }

    # GET /users/create
    function create()
    {
        $data['content'] = '/users/create';
        $data["tab"] = "user";
        $data["tabTitle"] = "usuarios";
        $groups = $this->ion_auth->groups()->result_array();
        $data['groups'] = $groups;
//        //print_r($groups);die;
        $this->load->view('/includes/contentpage', $data);
    }

    # GET /users/edit/1
    function edit($id)
    {
        $data['users'] = $this->Users_model->find($id);
        $data['content'] = '/users/create';
        $data["tab"] = "user";
        $data["tabTitle"] = "usuarios";

        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        $data['groups'] = $groups;
        $data['currentGroups'] = $currentGroups;
        $this->load->view('/includes/contentpage', $data);
    }

    # GET /users/destroy/1
    function destroy($id)
    {
        $em = $this->doctrine->em;
        $user = $em->getRepository('Entities\User')->find($id);
        //verificando que el usuario este limpio
        $userService = $user->getUserservices();
        $userComments = $user->getUsercomments();
        $services = $user->getServices();
        $reportComments = $user->getReportcomments();
        $mensajes = $user->getMensajes();
//        print_r($userComments[0]);
//        die;

        if(( array_key_exists(0,$userService) || array_key_exists(0,$userComments) || array_key_exists(0,$services) || array_key_exists(0,$reportComments) || array_key_exists(0,$mensajes))){
            $this->session->set_flashdata('item', array('message'=>'El elemento no ha podido ser eliminado, debe tener asociado algun servicio, comentario o queja, estos deberán ser eliminados primero.', 'class'=>'error', 'icon'=>'fa fa-warning', 'title'=>"<strong>Bien!:</strong>"));

        }
        else{
            $data['users'] = $this->ion_auth->delete_user($id);
//        $data['users'] = $this->Users_model->destroy($id);
            $data['tab'] = "user";
            $this->session->set_flashdata('item', array('message'=>'El elemento ha sido eliminado correctamente.', 'class'=>'success', 'icon'=>'fa fa-warning', 'title'=>"<strong>Bien!:</strong>"));

        }

         redirect('admin/users/index', 'refresh');
    }

    # POST /users/save
    function save()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
//		$this->form_validation->set_rules('password', 'Password', 'required');
//		$this->form_validation->set_rules('created', 'Created', 'required');
//		$this->form_validation->set_rules('role', 'Role', 'required');
//		$this->form_validation->set_rules('group', 'Group', 'required');

        if ($this->form_validation->run()) {
            $id = $this->input->post('id', TRUE);
            $em = $this->doctrine->em;
            if (!$id) {
                $user = new \Entities\User();
            } else {
                $userRepo = $em->getRepository('Entities\User');
                $users = $userRepo->findBy(array("id" => $id));
                if (count($users) > 0) {
                    $user = $users[0];
                } else {
                    $user = new \Entities\User();
                }
            }
            $user->setUsername($this->input->post('username', TRUE));
            $user->setEmail($this->input->post('email', TRUE));
            $groupData = $this->input->post('groups');

            if (null !== ($this->input->post('password', TRUE))) {
                $user->setPassword(md5($this->input->post('password', TRUE)));
            }
            $user->setIp($this->input->post('ip_address', TRUE));

			$user->setRole($this->input->post('role', TRUE));
            //si estoy editando
            if (!empty($id)) {
//            Only allow updating groups if user is admin
            if ($this->ion_auth->is_admin() && !empty($id)) {
                // Update the groups user belongs to
                $groupData = $this->input->post('groups');
                if (isset($groupData) && !empty($groupData)) {
                    $this->ion_auth->remove_from_group('', $id);
                    foreach ($groupData as $grp) {
                        $this->ion_auth->add_to_group($grp, $id);
                    }
                }
            }
                $em->persist($user);
                $em->flush();
            }else{
                $additional_data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                );
                $this->ion_auth->register(
                    $user->getUsername(),
                    $user->getPassword(),
                    $user->getEmail(),
                    $additional_data,
                    $groupData
                );
            }

            $this->session->set_flashdata('item', array('message'=>'Se han guardado sus cambios correctamente.', 'class'=>'success', 'icon'=>'fa fa-thumbs-up', 'title'=>"<strong>Bien!:</strong>"));
            redirect('admin/users/index', 'refresh');
        }
        $data['users'] = $this->rebuild();
        $data['content'] = '/users/create';
        $data['tab'] = "user";
        $this->load->view('/includes/contentpage', $data);
    }

    function rebuild()
    {
        $object = new Users_model();
        $object->id = $this->input->post('id', TRUE);
        $object->username = $this->input->post('username', TRUE);
        $object->email = $this->input->post('email', TRUE);
        $object->password = $this->input->post('password', TRUE);
        $object->created = $this->input->post('created', TRUE);
        $object->role = $this->input->post('role', TRUE);
        return $object;
    }

}

?>
