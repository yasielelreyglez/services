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

        $data['content'] = '/client/index';
        $data["tab"] = "home";
        $this->load->view('/client/_layouts/index', $data);
    }

    public function myfavorites()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('authw/login', 'refresh');
        }
        $this->load->helper('html');
        $em = $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\Service');
        $data['services'] = $servicesRepo->findAll();
        $data['content'] = 'client/services/index';
        $data["tab"] = "myfavorites";

        $this->load->view('/client/_layouts/listpage', $data);
    }
    public function createservice()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
        $this->load->helper('html');
        $em = $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\City');
        $categoRepo = $em->getRepository('Entities\Category');
        $subcategoRepo = $em->getRepository('Entities\Subcategory');


        $data["object"] = new \Entities\Service();
        $data['ciudades'] = $servicesRepo->findAll();
        $data['categorias'] = $categoRepo->findAll();
        $data['subcategorias'] = $subcategoRepo->findAll();

        $subcategory = [];
        $morevisits = $em->getRepository('Entities\Service');
        $data['similar'] = $morevisits->findBy(array(), array('visits' => 'DESC' ), 4);
        $data['services'] = $servicesRepo->findAll();
        $data['content'] = 'client/services/create';
        $data["tab"] = "myservices";
        $this->load->view('/client/_layouts/singlepage', $data);
    }


    public function myservices()
    {
        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
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
            redirect('admin/auth/login', 'refresh');
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
        $data['similar'] = $morevisits->findBy(array(), array('visits' => 'DESC' ), 4);

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