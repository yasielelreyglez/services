<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class Auth extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
    }
    public function token_get()
    {
        $tokenData = array();
        $tokenData['id'] = 1; //TODO: Replace with data for token

        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function validando_get()
    {
        $output["result"] = "ejemplo de respuesta";
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response($headers);
    }

    public function validando_post()
    {
        $output["result"] = "ejemplo de respuesta";
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response($headers);
    }
    public function login_post()
    {
        $values = json_decode($this->post()[0]);
//        $user_agent = $this->input->get_request_header('User-Agent', FALSE);
        $email = $values->email;
        $password = $values->password;
        $remember = true;
        $em= $this->doctrine->em;
        $userRepo = $em->getRepository('Entities\User');

        $users = $userRepo->findBy(array("email"=>$email));
        if(count($users)>0){
            $user = $users[0];
            if ($this->ion_auth->login($email, $password, $remember))
            {
                $tokenData = array(
                    'userid'=>$user->getId(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRole()
                );
                $token = AUTHORIZATION::generateToken($tokenData);
                $output["token"] = $token;
                $output["email"] = $email;
                $output["role"] =  $user->getRole();
                echo json_encode($output);
                return;
            }else{
                $output["error"] = "Error en password";
                echo json_encode($output);
                return;
            }
        }else{
            $output["error"] = "Usuario no encontrado";
            echo json_encode($output);
            return;
        }


    }
    public function login_get()
    {
        $values = json_decode($this->post()[0]);
//        $user_agent = $this->input->get_request_header('User-Agent', FALSE);
        $email = $values->email;
        $password = $values->password;
        $remember = true;
        $em= $this->doctrine->em;
        $userRepo = $em->getRepository('Entities\User');
        $email = $this->input->post('email');
        $users = $userRepo->findBy("email",$email);
        if(count($users)>0){
            $user = $users[0];
            if ($this->ion_auth->login($email, $this->input->post('password'), $remember))
            {
                $tokenData = array(
                    'userid'=>$user->getId(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRol()
                );
                $token = AUTHORIZATION::generateToken($tokenData);
                $output["token"] = $token;
                $output["email"] = $email;
                $output["role"] =  $user->getRol();
                echo json_encode($output);
                return;
            }else{
                $output["error"] = "Error en password";
                echo json_encode($output);
                return;
            }
        }else{
            $output["error"] = "Usuario no encontrado";
            echo json_encode($output);
            return;
        }


    }
}