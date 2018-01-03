<?php
/**
 * Created by PhpStorm.
 * User: Yoidel Martinez Baquero
 * Date: 10/25/2017
 * Time: 3:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('html');

    }

    public function favorites(){
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
        $this->load->helper('html');
        $em= $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\Service');
        $data['services'] = $servicesRepo->findAll();
        $data['content'] = '/services/index';
        $data["tab"]="services";

        $this->load->view('/includes/contentpage', $data);
    }
    public function myservices(){
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
        $user = $this->getCurrentUser();
        $data['services'] = $user->getServices()->toArray();
        $data['content'] = '/services/index';
        $data["tab"]="services";
        $this->load->view('/includes/contentpage', $data);


    }

    private function getCurrentUser(){
        $clientid = $this->ion_auth->get_user_id();
        $em= $this->doctrine->em;
        $user = $em->find("Entities\User", $clientid);
        return $user;
    }


}