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
        $tokenData['id'] = 1; //TODO: Replace fith data for token

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
        $em = $this->doctrine->em;
        $userRepo = $em->getRepository('Entities\User');

        $users = $userRepo->findBy(array("email" => $email));
        if (count($users) > 0) {
            $user = $users[0];
            if ($this->ion_auth->login($email, $password, $remember)) {
                $tokenData = array(
                    'userid' => $user->getId(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRole()
                );
                $token = AUTHORIZATION::generateToken($tokenData);
                $output["token"] = $token;
                $output["email"] = $email;
                $output["role"] = $user->getRole();
				$output["name"] = $user->getName();
				if($user->getisFacebook())
					$output["loginProvider"] = "FACEBOOK";
				else
					$output["loginProvider"] = "EMAIL";
                echo json_encode($output);
                return;
            } else {
                $output["error"] = "La contraseña no es valida";
                echo json_encode($output);
                return;
            }
        } else {
            $output["error"] = "Usuario no encontrado";
            echo json_encode($output);
            return;
        }
    }

    public function register_post()
    {
        $em = $this->doctrine->em;
        $values = json_decode($this->post()[0]);
        $userRepo = $em->getRepository('Entities\User');
        $email = $values->email;
        $users = $userRepo->findBy(array("email" => $email));
        if (count($users) > 0) {
            $output["error"] = "Ya existe un usuario con este correo";
            echo json_encode($output);
        } else {
            $email = strtolower($email);
            $identity = $email;
            $password = $values->password;

            $additional_data = array(
                'name' => $values->name

            );
            if(isset($values->phoneid)){
                $additional_data["phone_id"]=$values->phoneid;
            }
            if(isset($values->phoneso)){
                $additional_data["phone_so"]=$values->phoneso;
            }
            $result = $this->ion_auth->register($identity, $password, $email, $additional_data);
            if ($result) {
                $tokenData = array(
                    'userid' => $result,
                    'email' => $email,
                    'role' => 1
                );
                $token = AUTHORIZATION::generateToken($tokenData);
                $output["token"] = $token;
                $output["email"] = $email;
				$output["role"] = 1;
				if($user->getisFacebook())
					$output["loginProvider"] = "FACEBOOK";
				else
					$output["loginProvider"] = "EMAIL";
                echo json_encode($output);
            } else {
                $output["error"] = "El usuario no pudo ser creado";
                echo json_encode($output);
            }
        }
    }

    /**
     * Forgot password
     */
    public function forgot_password_post()
    {
            $result = array();
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->post('identity'))->users()->row();

            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $result["error"] =$this->ion_auth->errors();
            }
            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten){
                // if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->set_response($forgotten, REST_Controller::HTTP_OK);
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $result = array();
                $result["error"]=$this->ion_auth->errors();
                $this->set_response($result, REST_Controller::HTTP_OK);
            }
    }

    /**
     * Reset password - final step for forgotten password
     *
     * @param string|null $code The reset code
     */
    public function reset_password_get($code = NULL)
    {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() === FALSE) {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                // render
                $this->_render_page('auth/reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));

                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
    }

    /**
     * Change password
     */
    public function change_password_post()
    {
            $identity = $this->session->userdata('identity');
            if(!$identity){
                $user = $this->getCurrentUser();
                $identity = $user->getEmail();
            }
            $change = $this->ion_auth->change_password($identity, $this->post('old_password'), $this->post('new_password'));

            if ($change)
            {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->set_response($this->ion_auth->messages(), REST_Controller::HTTP_OK);
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                $data["error"]=$this->ion_auth->errors();
                $this->set_response($data, REST_Controller::HTTP_OK);
            }
    }

    /**
     * @return Entities\User
     */
    function getCurrentUser()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $em = $this->doctrine->em;
                $usuario = $decodedToken->userid;
                $user = $em->find("Entities\User", $usuario);
                return $user;
            }
        }
        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $em = $this->doctrine->em;
                $usuario = $decodedToken->userid;
                $user = $em->find("Entities\User", $usuario);
                return $user;
            }
        }
    }
}
