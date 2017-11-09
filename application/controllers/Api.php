<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 10/26/2017
 * Time: 10:25 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{

    // LISTADO DE LAS SUBCATEGORIAS MAS VISITADAS O RANKIADAS(VISTA DEL HOME)
    public function topSubcategories_get()
    {
        $subcategories[] = array("title" => "pepe", "id" => 1, "icon" => "pepe.png");
        $subcategories[] = array("title" => "pablo", "id" => 2, "icon" => "pepe.png");
        $subcategories[] = array("title" => "carlo", "id" => 3, "icon" => "pepe.png");

        $this->set_response($subcategories, REST_Controller::HTTP_OK);
    }

    //LISTADO DE LAS CATEGORIAS (TODAS LAS CATEGORIAS ?)
    public function categories_get()
    {
//        $categories[]=array("title"=>"pepe","id"=>1,"icon"=>"pepe.png");
//        $categories[]=array("title"=>"pablo","id"=>2,"icon"=>"pepe.png");
//        $categories[]=array("title"=>"carlo","id"=>3,"icon"=>"pepe.png");

        $em = $this->doctrine->em;

        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findAll();
//
        $this->set_response($categories, REST_Controller::HTTP_OK);
//        $this->set_response($categories, REST_Controller::HTTP_UNAUTHORIZED);
    }

    //LISTADO DE LAS SUBCATEGORIAS DADA UNA CATEGORIA <params category:string>
    public function subcategories_get()
    {
        $subcategories[] = array("title" => "pepe", "id" => 1, "icon" => "pepe.png");
        $subcategories[] = array("title" => "pablo", "id" => 2, "icon" => "pepe.png");
        $subcategories[] = array("title" => "carlo", "id" => 3, "icon" => "pepe.png");
        $this->set_response($subcategories, REST_Controller::HTTP_OK);
    }

//LISTADO DE LOS SERVICIOS DADA UNA CATEGORIA <params category:string>
    public function servicesCat_get()
    {
        $services[] = array("title" => "pepe", "id" => 1, "icon" => "pepe.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));
        $services[] = array("title" => "servicio 2", "id" => 2, "icon" => "pepe1.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));
        $services[] = array("title" => "servicio 3", "id" => 3, "icon" => "pepe2.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));
        $services[] = array("title" => "pepe4", "id" => 4, "icon" => "pepe.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));

        $this->set_response($services, REST_Controller::HTTP_OK);
    }

    //LISTADO DE LOS SERVICIOS  DADA UNA SUBCATEGORIA <params subcategory:string>
    public function servicesSub_get()
    {
        $services[] = array("title" => "pepe", "id" => 1, "icon" => "pepe.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));
        $services[] = array("title" => "servicio 2", "id" => 2, "icon" => "pepe1.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));
        $services[] = array("title" => "servicio 3", "id" => 3, "icon" => "pepe2.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));
        $services[] = array("title" => "pepe4", "id" => 4, "icon" => "pepe.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));

        $this->set_response($services, REST_Controller::HTTP_OK);
    }

    //DATOS DE UN SERVICIO DADO EL ID DEL MISMO <params serviceid:string>
    public function service_get()
    {
        $service = array("title" => "nombre del servicio", "id" => 1, "icon" => "pepe.png", "subtitle" => "rodriguez", "phone" => 784789, "address" => "Street 45th", "cities" => array(
            array("id" => 1, "title" => "quito"),
            array("id" => 2, "title" => "guayaquil"),
            array("id" => 3, "title" => "cuenca")
        ), "categories" => array(
            array("id" => 1, "title" => "hogar"),
            array("id" => 2, "title" => "Trabajos Manuales")
        ), "photos" => array(
            array("id" => 1, "title" => "hogar.png"),
            array("id" => 2, "title" => "trabajos.png")
        ), "otherphone" => 87457896, "email" => "tuservicio@gmail.com", "url" => "http://tuservicio.com",
            "days" => array(1, 2, 3, 4, 5), "start_time" => "08:00", "end_time" => "18:00", "positions" => array(
                array("title" => "posicion1", "latitude" => 23.4329193, "longitude" => -84.323432),
                array("title" => "posicion2", "latitude" => 23.0329193, "longitude" => -84.323432),
            ));
        $this->set_response($service, REST_Controller::HTTP_OK);
    }

    public function users_get()
    {
        $output["result"] = "ejemplo de respuesta";
        $headers = $this->input->request_headers();
        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $users[] = array("username" => "pepe", "usuario");
                $users[] = array("username" => "pablo", "usuario");
                $users[] = array("username" => "carlo", "admin");
                $this->set_response($users, REST_Controller::HTTP_OK);
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
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function peticion_get()
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
        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_ACCEPTED);
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

    public function forgotpassword_post()
    {
        $email = $this->post()[0];
        $output["result"] = true;
        if ($email != 'admin@uci.cu')
            $output["result"] = 'Error en el servidor';
        $this->set_response($output, REST_Controller::HTTP_OK);
        return;
    }

    public function report_post()
    {
        $report = $this->post()[0];
        $output["result"] = true;
        if ($report != 'report')
            $output["result"] = 'Error en el servidor';
        $this->set_response($output, REST_Controller::HTTP_OK);
        return;
    }


}