<?php
/**
 * Created by PhpStorm.
 * User: Yoidel Martinez Baquero
 * Date: 10/25/2017
 * Time: 3:20 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->helper('html');
        $this->load->view('login');
    }
    public function user() {
        $this->load->view('upload_form');
    }
    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = crypt($password, config_item('encryption_key'));

//        $login = $this->User->login( $email , $password );
//
//        if ( !$login )
//        {
//            $output['error'] = 'Wrong mail or password';
//        }
//        else
//        {
//            $tokenData = array(
//                'userId' => $login->id,
//                'name' => $login->name,
//                'email' => $login->email,
//                'role' => $login->role
//            );
//    }

        $tokenData = array(
                'username' => $email,
                'role' => "admin"
            );
            $token = AUTHORIZATION::generateToken($tokenData);
            $output["token"]=$token;
            $output["username"]=$email;


        echo json_encode( $output );

    }
}