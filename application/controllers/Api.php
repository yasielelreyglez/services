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
        $em = $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');

        $subcategories = $subcategoriesRepo->findBy(array(), array('visits' => 'DESC'), 10);

        if($subcategories){
            $response["desc"] = "Subcategorias mas visitadas ";
            $response["count"] = count($subcategories);
            $response["data"] = $subcategories;
        }
        else{
            $response["desc"] = 'No existen subcategorias mas visitadas';
            $response["count"] = 0;
            $response["data"] = array();
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function moreVisits_get()
    {
        $em = $this->doctrine->em;
        $morevisitsRepo = $em->getRepository('Entities\Service');
        $morevisits = $morevisitsRepo->findBy(array(), array('visits' => 'DESC'), 3 );

        foreach ($morevisits as $service) {
            $service->loadRelatedData();
        }

        if($morevisits){
            $response["desc"] = "Servicios mas visitados";
            $response["count"] = count($morevisits);
            $response["data"] = $morevisits;
        }
        else{
            $response["desc"] = 'No existen servicios mas visitados';
            $response["count"] = 0;
            $response["data"] = array();
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }

    public function recentVisits_get()
    {
        $em = $this->doctrine->em;
        $morevisitsRepo = $em->getRepository('Entities\Service');
        $morevisits = $morevisitsRepo->findBy(array(), array('visit_at' => 'DESC'), 4);

        foreach ($morevisits as $service) {
            $service->loadRelatedData();
        }

        if($morevisits){
            $response["desc"] = "Servicios mas visitados";
            $response["count"] = count($morevisits);
            $response["data"] = $morevisits;
        }
        else{
            $response["desc"] = 'No existen servicios mas visitados';
            $response["count"] = 0;
            $response["data"] = array();
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }




    //LISTADO DE LAS CATEGORIAS (TODAS LAS CATEGORIAS ?)
    public function categories_get()
    {
        $em = $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findAll();

        foreach ($categories as $category) {
            $services= 0;
            $subcats = $category->getSubcategories();
            foreach ($subcats as $subcat) {
                $services+=$subcat->getServices()->count();
            }
            $category->servicesCount = $services;
        }
        $response["data"] = $categories;
        $response["count"] = count($categories);
        $this->set_response($response, REST_Controller::HTTP_OK);

    }

    public function categoriesLoaded_get(){
        $em = $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findAll();

        foreach ($categories as $category) {
            $services= 0;
            $subcats = $category->getSubcategories();
            $subcats_array = array();
            foreach ($subcats as $subcat) {
                $objSubcat = new stdClass();
                $objSubcat->id = $subcat->getId();
                $objSubcat->title = $subcat->getTitle();
                $objSubcat->count = $subcat->getServices()->count();
                $services+= $objSubcat->count;
                $subcats_array[] =$objSubcat;
            }
            $category->subcategoriesLists = $subcats_array;
            $category->servicesCount = $services;
        }
        $response["data"] = $categories;
        $response["count"] = count($categories);
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
//LISTADO DE LAS SUBCATEGORIAS (TODAS LAS SUBCATEGORIAS ?)
    public function allsubcategories_get()
    {
        $em = $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategories = $subcategoriesRepo->findAll();
        foreach ($subcategories as $subcategory){
            $subcategory->servicesCount = $subcategory->getServices()->count();
        }
        $response["data"] = $subcategories;
        $response["count"] = count($subcategories);
        $this->set_response($response, REST_Controller::HTTP_OK);

    }

//LISTADO DE LAS CIUDADES
    public function cities_get()
    {
        $em = $this->doctrine->em;
        $citiesRepo = $em->getRepository('Entities\City');
        $cities = $citiesRepo->findAll();
        foreach ($cities as $city) {
            $city->servicesCount = $city->getServices()->count();
        }
        $response["data"] = $cities;
        $response["count"] = count($cities);
        $this->set_response($response, REST_Controller::HTTP_OK);

    }

    //LISTADO DE LAS SUBCATEGORIAS DADA UNA CATEGORIA <params category:string>
    public function subcategories_get($category_id)
    {
        $em = $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategories = $subcategoriesRepo->findBy(array('category' => $category_id));
        $category = $em->find('Entities\Category', $category_id);
        if ($category) {
            $response["desc"] = 'Subcategorias de la categoria: ' . $category->getTitle();
            $response["parent"] = $category;
            $response["count"] = count($subcategories);
            $response["data"] = $subcategories;
        } else {
            $response["desc"] = 'Categoria no encontrada';
            $response["parent"] = null;
            $response["count"] = 0;
            $response["data"] = array();

        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }

//LISTADO DE LOS SERVICIOS DADA UNA subCATEGORIA <params category:string>
    public function servicescat_get($id)
    {
        $em = $this->doctrine->em;
        $category = $em->find('Entities\Category', $id);
        if ($category) {
            $subcategories = $category->getSubcategories()->toArray();
            $result["desc"] = "Listado de servicios por la categoria: $id";
            $result["parent"] = $category;
            $result["count"] = 0;
            $result["data"] = array();
            foreach ($subcategories as $subcategory) {
                $services = $subcategory->getServices()->toArray();
                $result["data"] = array_merge($result["data"], $services);
            }
            $result["count"] = count($result["data"]);
        } else {
            $result["desc"] = "Listado de servicios por la categoria: $id";
            $result["parent"] = array();
            $result["count"] = 0;
            $result["data"] = array();
        }
        $this->set_response($result, REST_Controller::HTTP_UNAUTHORIZED);
    }

//LISTADO DE SERVICIOS QUE COINCIDEN CON LA BUSQUEDA POR TEXTO
    public function searchService_get($query)
    {
        $em = $this->doctrine->em;
        $serviceRepo = $em->getRepository('Entities\Service');
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("title", \Doctrine\Common\Collections\Expr\Comparison::CONTAINS, $query);
        $expresion2 = new \Doctrine\Common\Collections\Expr\Comparison("subtitle", \Doctrine\Common\Collections\Expr\Comparison::CONTAINS, $query);
        $criteria->where($expresion);
        $criteria->orWhere($expresion2);

        $respuesta = $serviceRepo->matching($criteria);
        foreach ($respuesta as $service) {
            $service->loadRelatedData();
        }
        $response["desc"] = "Resultados de la busqueda";
        $response["query"] = $query;
        $response["count"] = 0;
        $response["data"] = $respuesta->toArray();
        $response["count"] = count($response["data"]);
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
    //LISTADO DE LOS SERVICIOS  DADA UNA SUBCATEGORIA <params subcategory:string>
    public function servicessub_get($id)
    {
        $em = $this->doctrine->em;
//        $subcategory = $em->find('Entities\Sub',$id);
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategory = $subcategoriesRepo->find($id);
//        $subcategory->services->doInitialize();
        if ($subcategory) {
            $response["desc"] = "Servicios pertenecientes a la subcategoria: $subcategory->title";
            $services = $subcategory->getServices()->toArray();
            $user = $this->getCurrentUser();

            foreach ($services as $service) {
                $service->loadRelatedData();
                if ($user) {
                    $service->loadRelatedUserData($user);
                }
            }
            $response["data"] = $services;
        } else {
            $response["desc"] = "Subcategoria no encontrada";
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
    //DATOS DE UN SERVICIO DADO EL ID DEL MISMO <params serviceid:string>
    public function service_get($id)
    {
        $em = $this->doctrine->em;
        $service = $em->find('Entities\Service', $id);
        $user = $this->getCurrentUser();
        if($service) {
            $service->getAuthor()->getUsername();
            $service->getPositions()->toArray();
            $service->setVisits($service->getVisits() + 1);
            $service->visit_at = new DateTime("now");
            $em->persist($service);
            $em->flush();
            if ($user) {
                $service->relateUserData($user, $em);
                $service->loadRelatedUserData($user);
            }
            $service->subcategoriesList = $service->getSubcategories()->toArray();
            $service->loadRelatedData($user);
        }
        $result["data"] = $service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    //LISTADO DE SERVICIOS POR FILTROS
    public function filter_get()
    {
        //obteniendo parametros filtro
        $ciudades = $this->input->get("cities", true);
        $categorias = $this->input->get("categories", true);
        $distance = $this->input->get("distance", true);
        $current_position = $this->input->get("current", true);

        $services = [];
        $filtered = false;
        if($categorias){
            $filtered = true;
            $services = $this->filterBySubcategories($categorias);
            $services = $this->filterByCitiesFiltered($ciudades,$filtered,$services);
        }else{
            if($ciudades){
                $services = $this->filterByCitiesFiltered($ciudades,false,null);
                $filtered = true;
            }
        }
        if($current_position && $distance){
            $services = $this->filterByDistance($distance, $current_position, $filtered, $services);
        }
        $result["services"] = $services;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function filter_post()
    {
        //obteniendo parametros filtro
        $ciudades = $this->post("cities", true);
        $categorias = $this->post("categories", true);
        if($categorias&&count($categorias)==0){ $categorias = false;}
        $distance = $this->post("distance", true);
        $current_position = $this->post("current", true);
        $services = [];
        $filtered = false;
        if($categorias){
            $filtered = true;
            $services = $this->filterBySubcategories($categorias);
            if($ciudades) {
                $services = $this->filterByCitiesFiltered($ciudades, $filtered, $services);
            }
        }else{
            if($ciudades){
                $services = $this->filterByCitiesFiltered($ciudades,false,null);
                $filtered = true;
            }
        }
        if($current_position && $distance){
            $services = $this->filterByDistance($distance, $current_position, $filtered, $services);
            $filtered = true;
        }
        $user=$this->getCurrentUser();
        if(!$filtered){
            $em = $this->doctrine->em;
            $services_repo = $em->getRepository('Entities\Service');
            $services = $services_repo->findAll();
        }
		foreach ($services as $service) {
		    $service->loadRelatedData();
		    if($user) {
                $service->loadRelatedUserData($user);
            }
        }
		
        $result["services"] = array_values($services);
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    //denunciar un servicio
    public function complaint_get($id)
    {
        $queja = $this->input->get("complaint", true);
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        $user = $this->getCurrentUser();
        if ($user) {
            $criteria = new \Doctrine\Common\Collections\Criteria();
            //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
            $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user", \Doctrine\Common\Collections\Expr\Comparison::EQ, $user);
            $criteria->where($expresion);
            $relacion = $service->getServiceusers()->matching($criteria)->toArray();
            if (count($relacion) > 0) {
                $obj = $relacion[0];
            } else {
                $obj = new \Entities\UserService();
                $obj->setService($service);
                $obj->setUser($user);
            }
            $obj->setComplaint($queja);
            $obj->setComplaintCreated(new DateTime("now"));
            $em->persist($obj);
            $em->flush();
            $service->loadRelatedData();
            $result["data"] = $service;
        }
        else{
            $result["error"] = 'Debe estar autenticado para realizar esta acción';
        }

        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    //denunciar un servicio
    public function contactservice_get($id)
    {
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        $user = $this->getCurrentUser();
        if ($user) {
            $criteria = new \Doctrine\Common\Collections\Criteria();
            //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
            $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user", \Doctrine\Common\Collections\Expr\Comparison::EQ, $user);
            $criteria->where($expresion);
            $relacion = $service->getServiceusers()->matching($criteria)->toArray();
            if (count($relacion) > 0) {
                $obj = $relacion[0];
            } else {
                $obj = new \Entities\UserService();
                $obj->setService($service);
                $obj->setUser($user);
            }
            $obj->setContacted(1);
            $obj->loadRelatedData();
            $em->persist($obj);
            $em->flush();
            $this->set_response($obj, REST_Controller::HTTP_OK);
        }
    }

    //marcar como favorito
    public function markfavorite_get($id)
    {
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        $user = $this->getCurrentUser();
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user", \Doctrine\Common\Collections\Expr\Comparison::EQ, $user);
        $criteria->where($expresion);
        $relacion = $service->getServiceusers()->matching($criteria)->toArray();
        if (count($relacion) > 0) {
            $obj = $relacion[0];
        } else {
            $obj = new \Entities\UserService();
            $obj->setService($service);
            $obj->setUser($user);
        }
        $obj->setFavorite(1);
        $em->persist($obj);
        $em->flush();
        $result["desc"] = "Marcado como favorito el servicio {$service->getTitle()}";
        $service->loadRelatedData();
        $result["data"] = $service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    //desmarcar como favorito
    public function dismarkfavorite_get($id)
    {
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        $user = $this->getCurrentUser();
        $relacion = $service->loadRelatedUserData($user);
        if ($relacion) {
            $obj = $relacion;
        } else {
            $obj = new \Entities\UserService();
            $obj->setService($service);
            $obj->setUser($user);
        }
        $obj->setFavorite(0);
        $em->persist($obj);
        $em->flush();
        $result["desc"] = "Desmarcado como favorito el servicio {$service->getTitle()}";
        $service->loadRelatedData();
        $result["data"] = $service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    //listar servicios favoritos del usuario
    public function myfavorites_get()
    {
        $user = $this->getCurrentUser();
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("favorite", \Doctrine\Common\Collections\Expr\Comparison::EQ, 1);
        $criteria->where($expresion);
        $relacion = $user->getUserservices()->matching($criteria)->toArray();
        $result["desc"] = "Listado de los servicios marcados como favoritos por el usuario";
        $result["data"] = array();
        foreach ($relacion as $servicerel) {
            $service_obj = $servicerel->getService();
            $service_obj->loadRelatedData();
            $result["test"] = $service_obj->loadRelatedUserData($user);
            $result["data"][] = $service_obj;
        }
        $this->set_response($result, REST_Controller::HTTP_OK);

    }

    //listado de servicios creados por el usuario
    public function myservices_get()
    {

        $em = $this->doctrine->em;

        $user = $this->getCurrentUser();
        $relacion = $user->getServices()->toArray();
        $result["desc"] = "Listado de los servicios creados por el usuario";
        $result["data"] = array();
        foreach ($relacion as $service) {
            $service->loadRelatedData();
            $service->loadRelatedUserData($user);
            $result["data"][] = $service;
        }
        $result["data"] = $relacion;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    //calificar un servicio
    public function rateservice_get($id, $rate)
    {
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);

        if ($service) {
            $user = $this->getCurrentUser();
            if (!$user) {
                $result["desc"] = "El usuario no esta autenticado";
                $result["error"] = "El usuario no esta autenticado";
                $this->set_response($result, REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
            $relacion = $service->loadRelatedUserData($user);
            if (count($relacion) > 0) {
                $obj = $relacion;
            } else {
                $obj = new \Entities\UserService();
                $obj->setService($service);
                $obj->setUser($user);
            }
            $obj->setRate($rate);
            $em->persist($obj);
            $em->flush();
            $service = $service->calculateGlobalRate();
            $em->persist($obj);
            $em->flush();
            $service->loadRelatedUserData($user);
            $service->loadRelatedData();
            $result["desc"] = "Evaluando al anuncio $id con $rate puntos";
            $service->loadRelatedData();
            $result["data"] = $service;
        } else {
            $result["desc"] = "El servicio no existe";
            $result["error"] = "No existe ningun servicio con id: $id";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function rateservice_post($id, $rate)
    {
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);

        if ($service) {
            $user = $this->getCurrentUser();
            if (!$user) {
                $result["desc"] = "El usuario no esta autenticado";
                $result["error"] = "El usuario no esta autenticado";
                $this->set_response($result, REST_Controller::HTTP_UNAUTHORIZED);
                return;
            }
            $relacion = $service->loadRelatedUserData($user);
            if (count($relacion) > 0) {
                $obj = $relacion;
            } else {
                $obj = new \Entities\UserService();
                $obj->setService($service);
                $obj->setUser($user);
            }
            $obj->setRate($rate);
            $comment_param = $this->post("comment", true);
            $obj->setRatecomment($comment_param);
            $em->persist($obj);
            $em->flush();
            $service = $service->calculateGlobalRate();
            $em->persist($obj);
            $em->flush();
            $service->loadRelatedUserData($user);
            $service->loadRelatedData();
            $result["desc"] = "Evaluando al anuncio $id con $rate puntos";
            $service->loadRelatedData();
            $result["data"] = $service;
        } else {
            $result["desc"] = "El servicio no existe";
            $result["error"] = "No existe ningun servicio con id: $id";
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
            $service_obj->loadRelatedData();
            $result["data"][] = $service_obj;
        }

        $this->set_response($result, REST_Controller::HTTP_OK);

    }

    //obtener las posiciones de un servicio
    public function positions($id){
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        if($service){
            $result["data"] = $service->getPositions();
            $result["desc"] = "Posiciones del servicio $id";
        }else{
            $result["error"]="Servicio no encontrado";
        }

        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    //obtener las imagenes  de un servicio
    public function imagelist($id){
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        if($service){
            $result["data"] = $service->getImages();
            $result["desc"] = "Posiciones del servicio $id";
        }else{
            $result["error"]="Servicio no encontrado";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    //COMENTARIOS DE UN SERVICIO
    public function comments($id){
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        if($service){
            $result["data"] = $service->getServicecomments();
            $result["desc"] = "Posiciones del servicio $id";
        }else{
            $result["error"]="Servicio no encontrado";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    public function addcomment_get($id)
    {
        $comment = $this->input->get("comment", true);
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        $user = $this->getCurrentUser();

        if ($user && $service) {
            $result["desc"] = "COMENTANDO EL SERVICIO $service->getTitle()";
            $comment = new \Entities\Comments();
            $comment->setUser($user);
            $comment->setService($service);
            $comment->setComment($comment);
            $em->persist($comment);
            $em->flush();
        } else {
            $result["desc"] = "ERROR COMENTANDO EL SERVICIO $service->getTitle()";
            $result["error"] = "No esta autenticado o no existe el servicio";
        }
        $service->loadRelatedData();
        $result["data"] = $service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    public function addcomment_post($id)
    {
        $comment_param = $this->post("comment", true);
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        $user = $this->getCurrentUser();

        if ($user && $service){
            $result["desc"] = "COMENTANDO EL SERVICIO {$service->getTitle()}";
            $comment = new \Entities\Comments();
            $comment->setUser($user);
            $comment->setService($service);
            $comment->setComment($comment_param);
            $em->persist($comment);
            $em->flush();
        } else {
            $result["desc"] = "ERROR COMENTANDO EL SERVICIO {$service->getTitle()}";
            $result["error"] = "No esta autenticado o no existe el servicio";
        }
        $service->loadRelatedData($user);
        $result["data"] = $service;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    public function reportcomment_get($id){
        $em = $this->doctrine->em;
        $comment = $em->find("Entities\Comments", $id);
        $user = $this->getCurrentUser();
        if($user){
            if($comment){
                $comment->setReportuser($user);
                $em->persist($comment);
                $service = $comment->getService();
                $em->flush();
                $service->loadRelatedData($user);
                $result["data"]=$service;
            }else{
                $result["error"]="No existe el comentario";
            }
        }else{
            $result["error"]="Debe estar autenticado";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    public function hidecomment_get($id){
        $em = $this->doctrine->em;
        $comment = $em->find("Entities\Comments", $id);
        $user = $this->getCurrentUser();
        if($user){
            if($comment){
                $service = $comment->getService();
                $service->getTitle();#llenando datos del servicio
                if($service->professional&&$service->author==$user){
                    $comment->hided = 1;
                    $em->persist($comment);
                    $em->flush($comment);
                    $service->loadRelatedData($user);
                    $result["data"]=$service;
                    $result["desc"]="Comentario ocultado con exito";
                }else{
                    $result["error"]="El servicio no es profesional o el usuario no es el dueño del servicio";
                }
            }else{
                $result["error"]="No existe el comentario";
            }
        }else{
            $result["error"]="Debe estar autenticado";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    public function showcomment_get($id){
        $em = $this->doctrine->em;
        $comment = $em->find("Entities\Comments", $id);
        $user = $this->getCurrentUser();
        if($user){
            if($comment){
                $service = $comment->getService();
                if($service->getProfessional()&&$service->author==$user){
                    $comment->hided = 0;
                    $em->persist($comment);
                    $em->flush();
                    $service->loadRelatedData($user);
                    $result["data"]=$service;
                    $result["desc"]="Comentario mostrado con exito";
                }else{
                    $result["error"]="El servicio no es profesional o el usuario no es el dueño del servicio";
                }
            }else{
                $result["error"]="No existe el comentario";
            }
        }else{
            $result["error"]="Debe estar autenticado";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    //FIN DE LAS FUNCIONES DE COMENTARIOS

    public function testimg_post()
    {
        echo "FALSE";
        $result = $this->input->post();
        $filename = $this->input->post("filename");
        $string = $this->input->post("data");
        $img = imagecreatefromstring(base64_decode($string));
        $img2 = imagecreatefromstring(base64_decode($result));
        if ($img != false) {
            imagejpeg($img, "/resources/image/prueba1.jpg");
            echo "prueba1";
        }
        if ($img2 != false) {
            echo "prueba2";
            imagejpeg($img2, "/resources/image/prueba2.jpg");
        }
        $config['upload_path'] = './resources/image/service';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        $config['max_width'] = 9024;
        $config['max_height'] = 2768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
            print_r($error);
        } else {
            $data["upload_data"] = $this->upload->data();
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
//FUNCIONES DE PAGOS DEL SERVICIO
    public function memberships_get(){

        $em= $this->doctrine->em;

        $maembershipRepo = $em->getRepository('Entities\Membership');
        $memberships = $maembershipRepo->findAll();
         $result["desc"] = "Listado de membresias";
        $result["data"] = $memberships;
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function payservice_post($id){

        $em = $this->doctrine->em;
        $user = $this->getCurrentUser();
        $service = $em->find("\Entities\Service", $id);
        if($service->getAuthor()->getUsername()==$user->getUsername()) {
            $membership_id = $this->post('membership', TRUE);
            $membership = $em->find("\Entities\Membership", $membership_id);
            $payment = new \Entities\Payments();
            $payment->setService($service);
            $payment->setMembership($membership);
            $type = $this->post('type', TRUE);
            $payment->setType($type);
            $payment->setState(0);
            if ($type == 1) {
                $evidence = $this->post('evidence');
                if ($evidence) {
                    $path = "./resources/evidences/" . $evidence['filename'];
                    $save ="resources/evidences/" . $evidence['filename'];
                    file_put_contents($path, base64_decode($evidence['value']));
                    $payment->setEvidence(site_url($save));
                }
            } else {
//                $payment->setCountry($this->post('country', TRUE));
//                $payment->setPhone($this->post('phone', TRUE));
                $payment->setNombre($this->post('name', TRUE));
                $payment->setNumero($this->post('number', TRUE));
                $payment->setCaducidad($this->post('expire', TRUE));
                $payment->setCvv($this->post('cvv', TRUE));

            }
            $em->persist($payment);
            $em->flush();
            $service->getPayments()->toArray();
            $service->loadRelatedData($user);
            $data["data"] = $service;
        }else{
            $data["error"] = "El usuario actual no tiene permiso para pagar este servicio";
        }
        $this->set_response($data, REST_Controller::HTTP_OK);
    }
//FIN DE FUNCIONES DE PAGOS DEL SERVICIO

    //FUNCTIONES PARA CREAR UN SERVICIO
    function createservicestep1_post()
    {
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

    function createservicestep2_post()
    {
        $em = $this->doctrine->em;
        $service = $em->find("\Entities\Service", $this->post('id', TRUE));
        $fotos = $this->post('galery', TRUE);
        $service->addFotos($fotos);
//        $em->persist($service);
//        $em->flush();
        $this->set_response($service, REST_Controller::HTTP_OK);
    }

    function createservicestep3_post()
    {
        $em = $this->doctrine->em;
        $service = $em->find("\Entities\Service", $this->post('id', TRUE));
        $service->setOtherPhone($this->post('other_phone', TRUE));
        $service->setEmail($this->post('email', TRUE));
        $service->setUrl($this->post('url', TRUE));
        $service->setWeekDays($this->post('week_days', TRUE));
        $service->setStartTime($this->post('start_time', TRUE));
        $service->setEndTime($this->post('end_time', TRUE));
//        $em->persist($service);
//        $em->flush();
        $this->set_response($service, REST_Controller::HTTP_OK);
    }

    function createservicestep4_post()
    {
        $em = $this->doctrine->em;
        $service = $em->find("\Entities\Service", $this->post('id', TRUE));
        $positions = $this->post('positions', TRUE);
        $service->addPositions($positions);
        $em->persist($service);
        $em->flush();
        $this->set_response($service, REST_Controller::HTTP_OK);
    }
//CREANDO EL SERVICIO
    function createservicefull_post()
    {
        $em = $this->doctrine->em;
        $id =  $this->post('id', TRUE);

        if($id){
            $service = $em->find("\Entities\Service",$id);
            $eliminadas = $this->post('dropsImages', TRUE);
            $this->load->helper("file");
            foreach ($eliminadas as $eliminada) {
                $image = $em->find("\Entities\Image",$eliminada);
                $path = "./resources/services/" . $id. "/" . $image->getTitle();
                delete_files($path);
                $em->remove($image);
                $em->flush();
            }
        }else {
            $service = new \Entities\Service();
        }
        //DATOS BASICOS
        $service->setAthor($this->getCurrentUser());
        $service->title = $this->post('title', TRUE);
        $service->subtitle = $this->post('subtitle', TRUE);
        $service->phone = $this->post('phone', TRUE);
        $service->address = $this->post('address', TRUE);
        $service->addSubCategories($this->post('categories', TRUE), $em);
        $service->addCities($this->post('cities', TRUE), $em);
        $icon = $this->post('icon');
        if ($icon){
            if( isset($icon['filename'])) {
                $path = "./resources/services/" . $icon['filename'];
                $save = "/resources/services/" . $icon['filename'];
                file_put_contents($path, base64_decode($icon['value']));
                $service->setIcon(site_url($save));
                $service->setThumb($icon['filename']);
            }
        }
        //OTROS DATOS
        $service->setOtherPhone($this->post('other_phone', TRUE));
        $service->setEmail($this->post('email', TRUE));
        $service->setUrl($this->post('url', TRUE));
        $times = $this->post('times', TRUE);
        $service->addTimes($times);
        $service->setDescription($this->post('description', TRUE));
//        $service->setWeekDays(substr($string_week, 1, strlen($string_week) - 1));
//        $service->setStartTime($this->post('start_time', TRUE));
//        $service->setEndTime($this->post('end_time', TRUE));
        //UBICACIONES
        $positions = $this->post('positions', TRUE);
        $old_positions = $service->getPositions()->toArray();
        foreach ($old_positions as $old_position) {
            $em->remove($old_position);
        }
        $em->flush();
        $service->addPositions($positions);
        $em->persist($service);
        $em->flush();
        //GALERIA DE FOTOS
        $fotos = $this->post('gallery', TRUE);

        $service->addFotos($fotos, base_url());
        $em->persist($service);
        $em->flush();
        $this->set_response($service, REST_Controller::HTTP_OK);
    }

    function createservice_post()
    {
        $id = $this->input->post('id', TRUE);
        $em = $this->doctrine->em;
        if (!$id) {
            $service = new \Entities\Service();
        } else {
            $userRepo = $em->getRepository('Entities\Service');
            $services = $userRepo->findBy(array("id" => $id));
            if (count($services) > 0) {
                $service = $services[0];
            } else {
                $service = new \Entities\Service();
            }
        }
        $config['upload_path'] = './resources/image/service';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        $config['max_width'] = 9024;
        $config['max_height'] = 2768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload_form', $error);
            print_r($error);
        } else {
            $service = new \Entities\Service();
            $data["upload_data"] = $this->upload->data();
            $service->title = $this->input->post('title', TRUE);
            $service->subtitle = $this->input->post('subtitle', TRUE);
            $service->phone = $this->input->post('phone', TRUE);
            $service->address = $this->input->post('address', TRUE);
            $service->other_phone = $this->input->post('other_phone', TRUE);
            $service->email = $this->input->post('email', TRUE);
            $service->url = $this->input->post('url', TRUE);
            $service->start_time = $this->input->post('start_time', TRUE);
            $service->end_time = $this->input->post('end_time', TRUE);
            $subcategories = $this->input->post('subcategories', TRUE);
            if (is_array($subcategories)) {
                foreach ($subcategories as $subcategory) {
                    $subcategory_obj = $em->find('\Entities\Subcategory', $subcategory);
                    if ($subcategory_obj) {
                        $service->addSubCategory($subcategory_obj);
                    }
                }
            } else {
                $subcategory_obj = $em->find('\Entities\Subcategory', $subcategories);
                if ($subcategory_obj) {
                    $service->addSubCategory($subcategory_obj);
                }
            }
            $service->visits = 0;
            $service->setWeekDays($this->input->post('end_time', TRUE));
            $service->setIcon('resources/image/service/' . $data["upload_data"]["file_name"]);
            $em->persist($service);
            $em->flush();
//                $this->load->view('upload_success', $data);
        }
        $this->set_response($service, REST_Controller::HTTP_OK);
//            redirect('admin/categories/index', 'refresh');
    }

    function deleteservice_get($id){
        $user = $this->getCurrentUser();
        $em = $this->doctrine->em;
        $service = $em->find("\Entities\Service", $id);
        if($user==$service->author){
            $service->getServicecomments()->toArray();
            $service->getPositions()->toArray();
           $fotos =  $service->getImages()->toArray();//TODO VER SI SE BORRAN LOS FICHEROS
            $this->load->helper("file");
            foreach ($fotos as $foto) {
                delete_files($foto->getTitle());
            }

           $service->getServiceusers()->toArray();
            $service->getPayments()->toArray();

            //CARGADA LA RELACION PARA DESPUES ELIMINARLAS CON EL SERVICIO
           $em->remove($service);
           $em->flush();
           $this->set_response("OK", REST_Controller::HTTP_OK);
        }
    }

    //FUNCIONES DE AYUDA
    function getGlobalRate($id)
    {
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id);
        $globalRate = 0;
        $sum = 0;
        $countRates = 0;
        $rates = $service->getServiceusers();
        foreach ($rates as $rel) {
//            $rel = new UserService();
            if ($rel->getRate()) {
                $sum += $rel->getRate();
                $countRates += 1;
            }
        }
        $globalRate = $sum / $countRates;
        return $globalRate;
    }

    /**
     * @return Entities/User
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
 // FUNCIONES CAMBIOS
    function mensajesNoleidos_get(){
        $user = $this->getCurrentUser();
        if($user) {
            $em = $this->doctrine->em;
            $result_cities = [];
            $criteria = new \Doctrine\Common\Collections\Criteria();
            $expresion = new \Doctrine\Common\Collections\Expr\Comparison("estado", \Doctrine\Common\Collections\Expr\Comparison::EQ, 0);
            $criteria->where($expresion);
            $mensajes = $user->getMensajes()->matching($criteria)->toArray();
            $result["data"] = $mensajes;
        }else{
            $result["error"] = "El usuario debe estar autenticado";
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }

    function facturarequest_post(){
        $em = $this->doctrine->em;
        $factura = new \Entities\Facturacion();
        $factura->nombre = $this->post('nombre', TRUE);
        $factura->cedula = $this->post('cedula', TRUE);
        $factura->direccion = $this->post('direccion', TRUE);
        $factura->telefono = $this->post('telefono', TRUE);
        $factura->email = $this->post('email', TRUE);
        $em->persist($factura);
        $em->flush();
    }


    //METODOS DE PRUEBA
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

    private function filterByCitiesFiltered($cities,$filtered,$services_filtered)
    {
        $em = $this->doctrine->em;
        $citiesRepo = $em->getRepository('Entities\City');
        $result_cities = [];
        $criteria = new \Doctrine\Common\Collections\Criteria();
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("id", \Doctrine\Common\Collections\Expr\Comparison::IN, $cities);
        $criteria->where($expresion);
        $citiesObj = $citiesRepo->matching($criteria)->toArray();
        foreach ($citiesObj as $city) {
            $services = $city->getServices()->toArray();
            $result_cities = array_merge($result_cities,$services);
        }
        if($filtered){
            $result = [];
            foreach ($services_filtered as $filt) {
                if (in_array($filt,$result_cities)){
                    $result[]=$filt;
                }
            }
//            $result = array_intersect($services_filtered,$result_cities);
        }else{
            $result = $result_cities;
        }
        return $result;
    }

    private function filterBySubcategories($subcategories){
        $em = $this->doctrine->em;
        $sub_repo = $em->getRepository('Entities\Subcategory');
        $result_subcategories = [];
        $criteria = new \Doctrine\Common\Collections\Criteria();
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("id", \Doctrine\Common\Collections\Expr\Comparison::IN, $subcategories);
        $criteria->where($expresion);
        $subcategoriesObj = $sub_repo->matching($criteria)->toArray();
        foreach ($subcategoriesObj as $subcategory) {
            $services = $subcategory->getServices()->toArray();
             $result_subcategories = array_merge($result_subcategories,$services);
        }
        return $result_subcategories;
    }

    private function filterByDistance($distance,$current_position,$filtered,$services_filtered){
        $em = $this->doctrine->em;
        $positionRepo = $em->getRepository('Entities\Position');
        $result_position = [];
        if($filtered){
            foreach ($services_filtered as $service) {
                $posiciones = $service->getPositions();
                foreach ($posiciones as $posicion){
                    $posicion = new \Entities\Position();
                    if($posicion->isInRange($distance,$current_position)){
                        $result_position[]=$service;
                        break;
                    }
                }
            }
        }else{
            $posiciones = $positionRepo->findAll();
            foreach ($posiciones as $posicion){
                if($posicion->isInRange($distance,$current_position)){
                    $result_position[$posicion->getService()->getId()]=$posicion->getService();
                }
            }
        }

        return array_values($result_position);

    }

    private function Distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $radius = 6378.137; // earth mean radius defined by WGS84
    $dlon = $lon1 - $lon2;
    $distance = acos( sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($dlon))) * $radius;

        if ($unit == "K") {
            return ($distance);
        } else if ($unit == "M") {
            return ($distance * 0.621371192);
        } else if ($unit == "N") {
            return ($distance * 0.539956803);
        } else {
            return 0;
        }
//        $lat1 = 41.3879169;
//        $lon1 = 2.1699187;
//        $lat2 = 40.4167413;
//        $lon2 = -3.7032498;
//
//        echo Distance($lat1, $lon1, $lat2, $lon2, "K") . " kilometers<br>";
//        echo Distance($lat1, $lon1, $lat2, $lon2, "M") . " miles<br>";
//        echo Distance($lat1, $lon1, $lat2, $lon2, "N") . " nautical miles<br>";
    }


}