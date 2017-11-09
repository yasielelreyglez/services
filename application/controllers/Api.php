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
    public function topSubcategories_get(){

        $em= $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategories = $subcategoriesRepo->findBy(array(),array('visits' => 'DESC'),10);
        $response["desc"]="Subcategorias mas visitadas ";
        $response["count"]=count($subcategories);
        $response["data"]=$subcategories;

        $this->set_response($response, REST_Controller::HTTP_OK);

    }
    //LISTADO DE LAS CATEGORIAS (TODAS LAS CATEGORIAS ?)
    public function categories_get(){
        $em= $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findAll();
        $response["data"]=$categories;
        $response["count"]=count($categories);
        $this->set_response($response,REST_Controller::HTTP_OK);
//        $this->set_response($categories, REST_Controller::HTTP_UNAUTHORIZED);
    }
    //LISTADO DE LAS SUBCATEGORIAS DADA UNA CATEGORIA <params category:string>
    public function subcategories_get($category_id){

        $em= $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategories = $subcategoriesRepo->findBy(array('category'=>$category_id));
        $category = $em->find('Entities\Category',$category_id);
        if ($category){
        $response["desc"]='Subcategorias de la categoria:'.$category->getTitle();
        $response["parent"]=$category;
        $response["count"]=count($subcategories);
        $response["data"]=$subcategories;
        }else{
            $response["desc"]='Categoria no encontrada:';
            $response["parent"]=null;
            $response["count"]=0;
            $response["data"]=array();

        }
        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
    }
//LISTADO DE LOS SERVICIOS DADA UNA subCATEGORIA <params subcategory:string>
    public function servicescat_get($id){
        $services[]=array("title"=>"pepe","id"=>1,"icon"=>"pepe.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
            array("id"=>1,"title"=>"hogar"),
            array("id"=>2,"title"=>"Trabajos Manuales")
        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
          "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
            ));
        $services[]=array("title"=>"servicio 2","id"=>2,"icon"=>"pepe1.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
            array("id"=>1,"title"=>"hogar"),
            array("id"=>2,"title"=>"Trabajos Manuales")
        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
            "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
            ));
        $services[]=array("title"=>"servicio 3","id"=>3,"icon"=>"pepe2.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
            array("id"=>1,"title"=>"hogar"),
            array("id"=>2,"title"=>"Trabajos Manuales")
        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
            "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
            ));
        $services[]=array("title"=>"pepe4","id"=>4,"icon"=>"pepe.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
            array("id"=>1,"title"=>"hogar"),
            array("id"=>2,"title"=>"Trabajos Manuales")
        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
            "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
            ));

        $this->set_response($services, REST_Controller::HTTP_UNAUTHORIZED);
    }
    //LISTADO DE LOS SERVICIOS  DADA UNA SUBCATEGORIA <params subcategory:string>
    public function servicessub_get($id){
//
        $em= $this->doctrine->em;
//        $subcategory = $em->find('Entities\Sub',$id);
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategory = $subcategoriesRepo->find($id);
//        $subcategory->services->doInitialize();
        if($subcategory){
            $response["desc"]="Servicios pertenecientes a la subcategoria:$subcategory->title";
            $services = $subcategory->getServices()->toArray();
            $response["data"]= $services;

        }else{
            $response["desc"]="Subcategoria no encontrada";
        }
        $this->set_response($response, REST_Controller::HTTP_UNAUTHORIZED);
    }
//$services[]=array("title"=>"pepe","id"=>1,"icon"=>"pepe.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
//            array("id"=>1,"title"=>"hogar"),
//            array("id"=>2,"title"=>"Trabajos Manuales")
//        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
//            "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
//                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
//                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
//            ));
//        $services[]=array("title"=>"servicio 2","id"=>2,"icon"=>"pepe1.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
//            array("id"=>1,"title"=>"hogar"),
//            array("id"=>2,"title"=>"Trabajos Manuales")
//        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
//            "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
//                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
//                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
//            ));
//        $services[]=array("title"=>"servicio 3","id"=>3,"icon"=>"pepe2.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
//            array("id"=>1,"title"=>"hogar"),
//            array("id"=>2,"title"=>"Trabajos Manuales")
//        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
//            "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
//                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
//                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
//            ));
//        $services[]=array("title"=>"pepe4","id"=>4,"icon"=>"pepe.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","categories"=>array(
//            array("id"=>1,"title"=>"hogar"),
//            array("id"=>2,"title"=>"Trabajos Manuales")
//        ),"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
//            "start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
//                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
//                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
//            ));
    //DATOS DE UN SERVICIO DADO EL ID DEL MISMO <params serviceid:string>
    public function service_get($id){
        $em= $this->doctrine->em;
        $service = $em->find('Entities\Service',$id);
        $service->getAuthor()->getUsername();
        $service->getPositions()->toArray();
        $data["data"]=$service;
        $data["cities"]=$service->getCities()->toArray();
        $data["positions"]=$service->getPositions()->toArray();
        $data["subcategories"]=$service->getSubcategories()->toArray();

//        $service=array("title"=>"nombre del servicio","id"=>1,"icon"=>"pepe.png","subtitle"=>"rodriguez","phone"=>784789,"address"=>"Street 45th","cities"=>array(
//            array("id"=>1,"title"=>"quito"),
//            array("id"=>2,"title"=>"guayaquil"),
//            array("id"=>3,"title"=>"cuenca")
//        ),"categories"=>array(
//            array("id"=>1,"title"=>"hogar"),
//            array("id"=>2,"title"=>"Trabajos Manuales")
//        ),"photos"=>array(
//            array("id"=>1,"title"=>"hogar.png"),
//            array("id"=>2,"title"=>"trabajos.png")
//        ),"otherphone"=>87457896,"email"=>"tuservicio@gmail.com","url"=>"http://tuservicio.com",
//            "days"=>array(1,2,3,4,5),"start_time"=>"08:00","end_time"=>"18:00","positions"=>array(
//                array("title"=>"posicion1","latitude"=>23.4329193,"longitude"=>-84.323432),
//                array("title"=>"posicion2","latitude"=>23.0329193,"longitude"=>-84.323432),
//            ));
        $this->set_response($data, REST_Controller::HTTP_UNAUTHORIZED);
    }
    public function users_get(){
        $output["result"]="ejemplo de respuesta";
        $headers = $this->input->request_headers();
        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $users[]=array("username"=>"pepe","usuario");
                $users[]=array("username"=>"pablo","usuario");
                $users[]=array("username"=>"carlo","admin");
                $this->set_response($users, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
    public function validando_get(){
        $output["result"]="ejemplo de respuesta";
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
    public function peticion_get(){
        $output["result"]="ejemplo de respuesta";
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
    public function validando_post(){
        $output["result"]="ejemplo de respuesta";
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
    public function doctrine_get(){

        $em= $this->doctrine->em;

        $categoriesRepo = $em->getRepository('Entities\Subcategory');
        $categories = $categoriesRepo->findBy(array(),array('visits' => 'DESC'),10);
//
        $this->set_response($categories,REST_Controller::HTTP_OK);
    }

}