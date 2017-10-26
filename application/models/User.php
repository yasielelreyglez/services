<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 10/26/2017
 * Time: 10:14 AM
 */

class User
{
    public function is_logged_in()
    {
        return ($this->session->userdata('is_logged_in') );
    }
    public function login( $email , $password )
    {

        return true; //TODO a modo de pruebamientras no tengamos bd para validar el usuario
        $this->db->where( 'email' , $email );
        $q = $this->db->get( 'users' );
        $result = $q->row();

        if ( empty( $result ) || $password != $result->password )
        {
            $output = false;
        }
        else
        {
            $output = $result;
        }

        return $output;

    }
}