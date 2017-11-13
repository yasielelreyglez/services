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
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
//LISTADO DE LOS SERVICIOS DADA UNA subCATEGORIA <params category:string>
    public function servicescat_get($id){
        $em = $this->doctrine->em;
        $category = $em->find('Entities\Category',$id);
        if($category){
            $subcategories = $category->getSubcategories()->toArray();
            $result["desc"] = "Listado de servicios por la categoria:$id";
            $result["parent"] = $category;
            $result["count"] = 0;
            $result["data"] = array();
            foreach ($subcategories as $subcategory) {
                $services = $subcategory->getServices()->toArray();
                $result["data"] = array_merge($result["data"], $services);
            }
            $result["count"] = count($result["data"]);
        }else{
            $result["desc"] = "Listado de servicios por la categoria:$id";
            $result["parent"] = array() ;
            $result["count"] = 0;
            $result["data"] = array();
        }
        $this->set_response($result, REST_Controller::HTTP_UNAUTHORIZED);
    }
//LISTADO DE SERVICIOS QUE COINCIDEN CON LA BUSQUEDA POR TEXTO
    public function searchService_get($query){
        $em= $this->doctrine->em;
        $serviceRepo = $em->getRepository('Entities\Service');
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("title",\Doctrine\Common\Collections\Expr\Comparison::CONTAINS,$query);
        $expresion2 = new \Doctrine\Common\Collections\Expr\Comparison("subtitle",\Doctrine\Common\Collections\Expr\Comparison::CONTAINS,$query);
        $criteria->where($expresion);
        $criteria->orWhere($expresion2);

        $respuesta = $serviceRepo->matching($criteria);
        $response["desc"]="Resultados de la busqueda";
        $response["query"]=$query;
        $response["count"]=0;
        $response["data"]=$respuesta->toArray();
        $response["count"]=count($response["data"]);
        $this->set_response($response, REST_Controller::HTTP_OK);
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
        $this->set_response($response, REST_Controller::HTTP_OK);
    }

    //DATOS DE UN SERVICIO DADO EL ID DEL MISMO <params serviceid:string>
    public function service_get($id){
        $em= $this->doctrine->em;
        $service = $em->find('Entities\Service',$id);
        $user = $this->getCurrentUser();
        $service->getAuthor()->getUsername();
        $service->getPositions()->toArray();
        $relacion = $service->loadRelatedUserData($user);
        $data["data"]=$service;
        $data["cities"]=$service->getCities()->toArray();
        $data["positions"]=$service->getPositions()->toArray();
        $data["subcategories"]=$service->getSubcategories()->toArray();
        $this->set_response($data, REST_Controller::HTTP_OK);
    }

    //LISTADO DE SERVICIOS POR FILTROS
    public function filter_get(){
        //obteniendo parametros filtro
        $ciudades = $this->input->get("cities",true);
        $categorias = $this->input->get("categories",true);
        $distance = $this->input->get("distnace",true);
        $em= $this->doctrine->em;
        $citiesRepo = $em->getRepository('Entities\City');
        $serviceRepo = $em->getRepository('Entities\Service');

        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("title",\Doctrine\Common\Collections\Expr\Comparison::IN,$ciudades);
        $criteria->where($expresion);
        $cities =  $citiesRepo->matching($criteria)->toArray();
        $result["data"] = array();
        foreach($cities as $city){
            $service = $city->getServices();
            $result["data"] = array_merge($result["data"],$service->toArray());

            //TODO AGREGAR EL FILTRO POR LOS OTROS ELEMENTOS
            //TODO CACHEAR LAS BUSQUEDA DE LOS FILTROS
        }


//        $data["services"] = $service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    //denunciar un servicio
    public function complaint_get($id){
        $queja = $this->input->get("complaint",true);
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        $user = $this->getCurrentUser();
        if($user){
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user",\Doctrine\Common\Collections\Expr\Comparison::EQ,$user);
        $criteria->where($expresion);
        $relacion = $service->getServiceusers()->matching($criteria)->toArray();
        if(count($relacion)>0){
            $obj = $relacion[0];
        }else{
            $obj = new \Entities\UserService();
            $obj->setService($service);
            $obj->setUser($user);
        }
        $obj->setComplaint($queja);
        $obj->setComplaintCreated(new DateTime("now"));
        $em->persist($obj);
        $em->flush();
        $this->set_response($obj, REST_Controller::HTTP_OK);
        }
    }

    public function markfavorite_get($id){
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        $usuario = 3 ;
        $user = $em->find("Entities\User",$usuario);
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user",\Doctrine\Common\Collections\Expr\Comparison::EQ,$user);
        $criteria->where($expresion);
        $relacion = $service->getServiceusers()->matching($criteria)->toArray();
        if(count($relacion)>0){
            $obj = $relacion[0];
        }else{
            $obj = new \Entities\UserService();
            $obj->setService($service);
            $obj->setUser($user);
        }
        $obj->setFavorite(1);
        $em->persist($obj);
        $em->flush();
    }

    public function dismarkfavorite_get($id){
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        $usuario = 3 ;
        $user = $em->find("Entities\User",$usuario);
        $relacion = $service->loadRelatedUserData($user);
        if(count($relacion)>0){
            $obj = $relacion[0];
        }else{
            $obj = new \Entities\UserService();
            $obj->setService($service);
            $obj->setUser($user);
        }
        $obj->setFavorite(0);
        $em->persist($obj);
        $em->flush();
    }

    public function myfavorites_get(){
        $usuario = 3 ;//TODO PONER EL ID DEL USUARIO DEL TOKEN
        $em= $this->doctrine->em;
        $user = $em->find("Entities\User",$usuario);
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("favorite",\Doctrine\Common\Collections\Expr\Comparison::EQ,1);
        $criteria->where($expresion);
        $relacion = $user->getUserservices()->matching($criteria)->toArray();
        $result["desc"]="Listado de los servicios marcados como favoritos por el usuario";
        $result["data"] = array();
        foreach ($relacion as $servicerel) {
            $service_obj = $servicerel->getService();
            $result["test"]=$service_obj->loadRelatedUserData($user);
            $result["data"][] = $service_obj;
        }
        $this->set_response($result, REST_Controller::HTTP_OK);

    }
    public function myservices_get(){
        $usuario = 3 ;//TODO PONER EL ID DEL USUARIO DEL TOKEN
        $em= $this->doctrine->em;
        $usuario = 3 ;
        $user = $em->find("Entities\User",$usuario);
        $relacion = $user->getServices()->toArray();
        $result["desc"]="Listado de los servicios creados por el usuario";
        $result["data"]=array();
        foreach ($relacion as $service){
           $service->loadRelatedUserData($user);
            $result["data"][]=$service;
        }
        $result["data"]=$relacion;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function rateservice_get($id,$rate){
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        if($service) {
            $usuario = 3;
            $user = $em->find("Entities\User", $usuario);
            $relacion = $service->loadRelatedUserData($user);
            if (count($relacion) > 0) {
                $obj = $relacion[0];
            } else {
                $obj = new \Entities\UserService();
                $obj->setService($service);
                $obj->setUser($user);
            }
            $obj->setRate($rate);
            $em->persist($obj);
            $em->flush();
            $result["desc"] = "Evaluando al anuncio $id con $rate puntos";
        }else{
            $result["desc"] = "El servicio no existe";
            $result["error"] = "No existe ningun servicio con id:$id";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }


    public function myvisits_get(){
        $usuario = 3 ;//TODO PONER EL ID DEL USUARIO DEL TOKEN
        $em= $this->doctrine->em;
        $usuario = 3 ;
        $user = $em->find("Entities\User",$usuario);
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("visited",\Doctrine\Common\Collections\Expr\Comparison::EQ,1);
        $criteria->where($expresion);
        $relacion = $user->getUserservices()->matching($criteria)->toArray();
        $result["desc"]="Listado de los servicios marcados como favoritos por el usuario";
        $result["data"] = array();
        foreach ($relacion as $servicerel) {
            $service_obj = $servicerel->getService();
            $service_obj->loadRelatedUserData($user);
            $result["data"][] = $service_obj;
        }

        $this->set_response($result, REST_Controller::HTTP_OK);
    }


    function getCurrentUser(){
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $em = $this->doctrine->em;
                $usuario = $decodedToken->userid;
                $user = $em->find("Entities\User",$usuario);
                return $user;
            }
        }
        if (array_key_exists('authorization', $headers) && !empty($headers['authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['authorization']);
            if ($decodedToken != false) {
                $em = $this->doctrine->em;
                $usuario = $decodedToken->userid;
                $user = $em->find("Entities\User",$usuario);
                return $user;
            }
        }
    }



//
//    function createservice_post(){
//            $id =  $this->input->post('id', TRUE);
//            $em = $this->doctrine->em;
//            if(!$id) {
//                $category = new \Entities\Category();
//            }else{
//                $userRepo = $em->getRepository('Entities\Category');
//                $categories = $userRepo->findBy(array("id"=>$id));
//                if(count($categories)>0){
//                    $category= $categories[0];
//                }else{
//                    $category = new \Entities\Category();
//                }
//            }
//            $config['upload_path']          = './resources/image/service';
//            $config['allowed_types']        = 'gif|jpg|png';
//            $config['max_size']             = 1000;
//            $config['max_width']            = 9024;
//            $config['max_height']           = 2768;
//            $this->load->library('upload', $config);
//            if ( ! $this->upload->do_upload('userfile'))
//            {
//                $error = array('error' => $this->upload->display_errors());
//                $this->load->view('upload_form', $error);
//                print_r($error);
//            }
//            else
//            {
//
//                $data["upload_data"] =$this->upload->data();
//                $category->setTitle($this->input->post('title', TRUE));
//                $category->setIcon('resources/image/categories/'.$data["upload_data"]["file_name"]);
//                $em->persist($category);
//                $em->flush();
////                $this->load->view('upload_success', $data);
//            }
//            redirect('admin/categories/index', 'refresh');
//        }else{
//            $data['categories'] =	$this->rebuild();
//            $data['content'] = '/categories/create';
//            $data["tab"]="category";
//            $this->load->view('includes/template', $data);
//        }
//
//    }






    public function users_get(){
        $output["result"]="ejemplo de respuesta";
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