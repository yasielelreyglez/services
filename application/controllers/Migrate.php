<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/7/2017
 * Time: 1:58 PM
 */

class Migrate extends CI_Controller{

    public function index($version){
        $this->load->library("migration");
        if(!$this->migration->version($version)){
            show_error($this->migration->error_string());
        }
    }
}