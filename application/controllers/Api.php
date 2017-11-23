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
    }
//LISTADO DE LAS SUBCATEGORIAS (TODAS LAS SUBCATEGORIAS ?)
    public function allsubcateogries_get(){
        $em= $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategories = $subcategoriesRepo->findAll();
        $response["data"]=$subcategories;
        $response["count"]=count($subcategories);
        $this->set_response($response,REST_Controller::HTTP_OK);

    }
//LISTADO DE LAS CIUDADES
    public function cities_get(){
        $em= $this->doctrine->em;
        $citiesRepo = $em->getRepository('Entities\City');
        $cities = $citiesRepo->findAll();
        $response["data"]=$cities;
        $response["count"]=count($cities);
        $this->set_response($response,REST_Controller::HTTP_OK);

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
            $user = $this->getCurrentUser();
            if($user){
                foreach ($services as $service) {
                    $service->loadRelatedUserData($user);
                }
            }
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
        $service->setVisits($service->getVisits() + 1);
        $em->persist($service);
        $em->flush();
        $service->loadRelatedUserData($user);
        $data["data"]=$service;
        $data["cities"]=$service->getCities()->toArray();
        $data["positions"]=$service->getPositions()->toArray();
        $data["images"]=$service->getImages()->toArray();
        $data["comments"]=$service->getServicecomments()->toArray();
        $data["subcategories"]=$service->getSubcategories()->toArray();
        $this->set_response($data, REST_Controller::HTTP_OK);
    }
    //LISTADO DE SERVICIOS POR FILTROS
    public function filter_get(){
        //obteniendo parametros filtro
        $ciudades = $this->input->get("cities",true);
        $categorias = $this->input->get("categories",true);
        $distance = $this->input->get("distance",true);
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
    //denunciar un servicio
    public function contactservice_get($id){
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
            $obj->setContacted(1);
            $em->persist($obj);
            $em->flush();
            $this->set_response($obj, REST_Controller::HTTP_OK);
        }
    }
   //marcar como favorito
    public function markfavorite_get($id){
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        $user= $this->getCurrentUser();
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
        $result["desc"]= "Marcado como favorito el servicio {$service->getTitle()}";
        $result["data"]=$service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
   //desmarcar como favorito
    public function dismarkfavorite_get($id){
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        $user= $this->getCurrentUser();
        $relacion = $service->loadRelatedUserData($user);
        if($relacion){
            $obj = $relacion;
        }else{
            $obj = new \Entities\UserService();
            $obj->setService($service);
            $obj->setUser($user);
        }
        $obj->setFavorite(0);
        $em->persist($obj);
        $em->flush();
        $result["desc"]= "Desmarcado como favorito el servicio {$service->getTitle()}";
        $result["data"]=$service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
   //listar servicios favoritos del usuario
    public function myfavorites_get(){
        $user= $this->getCurrentUser();
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
  //listado de servicios creados por el usuario
    public function myservices_get(){

        $em= $this->doctrine->em;

        $user = $this->getCurrentUser();
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
  //calificar un servicio
    public function rateservice_get($id,$rate){
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);

        if($service) {
           $user = $this->getCurrentUser();
           if(!$user){
               $result["desc"] = "El usuario no esta autenticado";
               $result["error"] = "El usuario no esta autenticado";
               $this->set_response($result, REST_Controller::HTTP_UNAUTHORIZED);
               return;
           }
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

            $service->setGlobalRate($this->getGlobalRate($id));
            $em->persist($obj);
            $em->flush();
            $result["desc"] = "Evaluando al anuncio $id con $rate puntos";
        }else{
            $result["desc"] = "El servicio no existe";
            $result["error"] = "No existe ningun servicio con id:$id";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
   //obtener servicios visitados
    public function myvisits_get()
    {
        $user = $this->getCurrentUser();
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("visited", \Doctrine\Common\Collections\Expr\Comparison::EQ, 1);
        $criteria->where($expresion);
        $relacion = $user->getUserservices()->matching($criteria)->toArray();
        $result["desc"] = "Listado de los servicios marcados como favoritos por el usuario";
        $result["data"] = array();
        foreach ($relacion as $servicerel) {
            $service_obj = $servicerel->getService();
            $service_obj->loadRelatedUserData($user);
            $result["data"][] = $service_obj;
        }

        $this->set_response($result, REST_Controller::HTTP_OK);

    }
    //COMENTAR UN SERVICIO
    public function addcomment_get($id){
        $comment = $this->input->get("comment",true);
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        $user = $this->getCurrentUser();

        if($user&&$service){
            $result["desc"]= "COMENTANDO EL SERVICIO $service->getTitle()";
            $comment = new \Entities\Comments();
            $comment->setUser($user);
            $comment->setService($service);
            $comment->setComment($comment);
            $em->persist($comment);
            $em->flush();
        }else{
            $result["desc"]= "ERROR COMENTANDO EL SERVICIO $service->getTitle()";
            $result["error"]= "No esta autenticado o no existe el servicio";
        }
        $result["data"] = $service->getServicecomments();
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    public function testimg_post(){
        echo "FALSE";
        $result=  $this->input->post();
        $filename = $this->input->post("filename");
        $string = $this->input->post("data");
        $img = imagecreatefromstring(base64_decode($string));
        $img2 = imagecreatefromstring(base64_decode($result));
        if($img != false)
        {
            imagejpeg($img, "/resources/image/prueba1.jpg");
            echo "prueba1";
        }
        if($img2 != false)
        {
            echo "prueba2";
            imagejpeg($img2, "/resources/image/prueba2.jpg");
        }
        $config['upload_path']          = './resources/image/service';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $config['max_width']            = 9024;
        $config['max_height']           = 2768;
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
            print_r($error);
        }else{
            $data["upload_data"] =$this->upload->data();
        }
//        $img = $this->input->post("image");
//        $imgarr = explode(',', $this->image_string);
//        $image = base64_decode($imgarr[1]);
//        $results["data"] = $result;
//        $results["parsed"]= $result;
//        $temp_file_path = tempnam(sys_get_temp_dir(), 'androidtempimage'); // might not work on some systems, specify your temp path if system temp dir is not writeable
//        file_put_contents($temp_file_path, base64_decode($_POST['imageString']));
        $this->set_response($result, REST_Controller::HTTP_OK);
    }


    function createservicestep1_post(){
        $em = $this->doctrine->em;
        $service = new \Entities\Service();
        $service->setAthor($this->getCurrentUser());


        $service->title = $this->post('title', TRUE);
        $service->subtitle = $this->post('subtitle', TRUE);
        $service->phone = $this->post('phone', TRUE);
        $service->address = $this->post('address', TRUE);
//        $service->addSubCategories($this->post('categories', TRUE),$em);
//        $service->addCities($this->post('cities', TRUE),$em);
//        $icon = $this->post('icon');
//        $path= "./resources/".$icon['filename'];
//        file_put_contents($path, base64_decode($icon['value']));
//        $service->setIcon($path);
//        $em->persist($service);
//        $em->flush();
        $this->set_response($service, REST_Controller::HTTP_OK);
    }

    function createservicestep2_post(){
        $em = $this->doctrine->em;
        $service = $em->find("\Entities\Service",$this->post('id', TRUE));
        $fotos =  $this->post('galery', TRUE);
        $service->addFotos($fotos);
        $em->persist($service);
        $em->flush();
//        $service->addSubCategories($this->post('categories', TRUE),$em);
//        $service->addCities($this->post('cities', TRUE),$em);
//        $icon = $this->post('icon');
//        $path= "./resources/".$icon['filename'];
//        file_put_contents($path, base64_decode($icon['value']));
//        $service->setIcon($path);
//        $em->persist($service);
//        $em->flush();
        $this->set_response($service, REST_Controller::HTTP_OK);
    }

    function createservice_post(){
            $id =  $this->input->post('id', TRUE);
            $em = $this->doctrine->em;
            if(!$id) {
                $service = new \Entities\Service();
            }else{
                $userRepo = $em->getRepository('Entities\Service');
                $services = $userRepo->findBy(array("id"=>$id));
                if(count($services)>0){
                    $service= $services[0];
                }else{
                    $service = new \Entities\Service();
                }
            }
            $config['upload_path']          = './resources/image/service';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 9024;
            $config['max_height']           = 2768;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_form', $error);
                print_r($error);
            }
            else
            {
                $service = new \Entities\Service();
                $data["upload_data"] =$this->upload->data();
                $service->title = $this->input->post('title', TRUE);
                $service->subtitle = $this->input->post('subtitle', TRUE);
                $service->phone = $this->input->post('phone', TRUE);
                $service->address = $this->input->post('address', TRUE);
                $service->other_phone = $this->input->post('other_phone', TRUE);
                $service->email = $this->input->post('email', TRUE);
                $service->url = $this->input->post('url', TRUE);
                $service->start_time = $this->input->post('start_time', TRUE);
                $service->end_time = $this->input->post('end_time', TRUE);
                $subcategories = $this->input->post('subcategories',TRUE);
                if (is_array($subcategories)){
                    foreach ( $subcategories as $subcategory  ){
                        $subcategory_obj = $em->find('\Entities\Subcategory',$subcategory);
                        if($subcategory_obj){
                            $service->addSubCategory($subcategory_obj);
                        }
                    }
                }else{
                    $subcategory_obj = $em->find('\Entities\Subcategory',$subcategories);
                    if($subcategory_obj){
                        $service->addSubCategory($subcategory_obj);
                    }
                }
                $service->visits = 0;
                $service->setWeekDays($this->input->post('end_time', TRUE));
                $service->setIcon('resources/image/service/'.$data["upload_data"]["file_name"]);
                $em->persist($service);
                $em->flush();
//                $this->load->view('upload_success', $data);
            }
        $this->set_response($service, REST_Controller::HTTP_OK);
//            redirect('admin/categories/index', 'refresh');
        }




        //FUNCIONES DE AYUDA
    function getGlobalRate($id){
        $em= $this->doctrine->em;
        $service = $em->find("Entities\Service",$id);
        $globalRate = 0;
        $sum = 0;
        $countRates = 0;
        $rates = $service->getServiceusers();
        foreach ($rates as $rel){
            $rel = new UserService();
            if($rel->getRate()){
                $sum+=$rel->getRate();
                $countRates+=1;
            }
        }
        $globalRate = $sum/$countRates;
        return $globalRate;
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

//    public function forgotpassword_post()
//    {
//        $email = $this->post()[0];
//        $output["result"] = true;
//        if ($email != 'admin@uci.cu')
//            $output["result"] = 'Error en el servidor';
//        $this->set_response($output, REST_Controller::HTTP_OK);
//        return;
//    }
//
//    public function report_post()
//    {
//        $report = $this->post()[0];
//        $output["result"] = true;
//        if ($report != 'report')
//            $output["result"] = 'Error en el servidor';
//        $this->set_response($output, REST_Controller::HTTP_OK);
//        return;
//    }


}