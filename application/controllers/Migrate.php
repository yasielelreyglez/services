<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/7/2017
 * Time: 1:58 PM
 */
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
class Migrate extends CI_Controller{

    public function index($version){
        $this->load->library("migration");
        if(!$this->migration->version($version)){
            show_error($this->migration->error_string());
        }
    }

    public function seed(){
        $commands = array();
        $doctrine = new Doctrine();
        $helperSet = ConsoleRunner::createHelperSet($doctrine->em);

        $cli = \Doctrine\ORM\Tools\Console\ConsoleRunner::createApplication($helperSet, $commands);
        $input = new ArgvInput();
        $output = new ConsoleOutput();
        $argvs = $_SERVER['argv']; //aqui se guardan los comandos de la consola
        $args2 = array(
            "doctrine",
            "orm:schema-tool:update",
            "force"

        );
        $input = new ArgvInput($args2);
        $cli->run($input,$output);
        echo "ESTO ES UN CHOYO";
    }
}