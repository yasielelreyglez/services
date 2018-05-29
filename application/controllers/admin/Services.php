<?php use Doctrine\Common\Collections\Criteria;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Services Controller.
 */
class Services extends CI_Controller
{
    private $days_of_weak = array(
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado',
        'Domingo',
    );

    function __construct()
    {
        parent::__construct();
        $this->load->model('Services_model');
        $this->load->helper('html');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
    }

    # GET /services
    function index()
    {
        $em = $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\Service');
        $data['services'] = $servicesRepo->findAll();
        $data['content'] = '/services/index';
        $data["tab"] = "services";
        $data["tabTitle"] = "servicios";

        $this->load->view('/includes/contentpage', $data);
    }

    # GET /services/create
    function create()
    {
        $em = $this->doctrine->em;
        $categories = $em->getRepository('Entities\Category');
        $subcategories = $em->getRepository('Entities\Subcategory');
        $cities = $em->getRepository('Entities\City');
        $images = $em->getRepository('Entities\Image');
        $positions = $em->getRepository('Entities\Position');
        $data['subcategories'] = $subcategories->findAll();
        $data['categories'] = $categories->findAll();
        $data['cities'] = $cities->findAll();
        $data['images'] = $images->findAll();
        $data['currenPositions'] = array();
        $data['currenTimes'] = array();
        $data['positions'] = $positions;
        $data['days_of_weak'] = $this->days_of_weak;
        $data['content'] = '/services/create';
        $data["tab"] = "services";
        $data["tabTitle"] = "crear servicios";
        $this->load->view('/includes/contentpage', $data);
    }

    # GET /services/edit/1
    function edit($id)
    {
        $em = $this->doctrine->em;
        /** @var \Entities\Service $service */
        $service = $em->find("\Entities\Service", $id);
        $categories = $em->getRepository('Entities\Category');
        $currenSubCategories = $service->getSubcategories();
        $currenCities = $service->getCities();
        $currenImages = $service->getImages();
        $currenPositions = $service->getPositions()->toArray();
        $currenTimes = $service->getTimes()->toArray();
        $subcategories = $em->getRepository('Entities\Subcategory');
        $cities = $em->getRepository('Entities\City');
        $images = $em->getRepository('Entities\Image');
        $positions = $em->getRepository('Entities\Position');
        $data['subcategories'] = $subcategories->findAll();
        $data['categories'] = $categories->findAll();
        $data['currenSubCategories'] = $currenSubCategories;
        $data['currenCities'] = $currenCities;
        $data['currenImages'] = $currenImages;
        $data['currenPositions'] = $currenPositions;
        $data['cities'] = $cities->findAll();
        $data['images'] = $images->findAll();
        $data['positions'] = $positions->findAll();
        $data['days_of_weak'] = $this->days_of_weak;
        $data['services'] = $service;
        $data['content'] = '/services/create';
        $data["tab"] = "services";
        $data["currenTimes"] = $currenTimes;
        $data["tabTitle"] = "editar servicios";
        $this->load->view('/includes/contentpage', $data);
    }

    function show($id)
    {
        $em = $this->doctrine->em;
        $service = $em->getRepository('Entities\Service')->find($id);
        $currenPositions = $service->getPositions();
        $currenTimes = $service->getTimes();
        $currenComments = $service->getServicecomments();
        $currenServiscesUsers = $service->getServiceusers();
//        trayendo las quejas
        $criteria = new Criteria();
        $expresion2 = new \Doctrine\Common\Collections\Expr\Comparison("service", \Doctrine\Common\Collections\Expr\Comparison::EQ, $service);
        $criteria->where(Criteria::expr()->neq('complaint', null));
        $criteria->andWhere($expresion2);
        $criteria->orderBy(array("complaint_created" => "DESC"));
        $currentQuejas = $service->getServiceusers()->matching($criteria);

        $data['times'] = $currenTimes;
        $data['services'] = $service;
        $data['positions'] = $currenPositions;
        $data['comments'] = $currenComments;
        $data['serviscesUsers'] = $currenServiscesUsers;
        $data['complaints'] = $currentQuejas;
        $data['content'] = '/services/show';
        $data["tab"] = "services";
        $data["tabTitle"] = "servicio";
        $this->load->view('/includes/contentpage', $data);
    }




    function serviciospro(){
        $em = $this->doctrine->em;
        $relacion = $em->getRepository('Entities\UserService');

        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->neq('complaint', null));
        $criteria->orderBy(array("complaint_created" => "DESC"));
        $result = $relacion->matching($criteria);
        foreach ($result as $item) {
            $item->getService()->getTitle();
            $item->getUser()->getUsername();
        }
        $data["complaints"] = $result;
        $data['content'] = '/services/denunciados';
        $data["tab"] = "services";
        $data["tabTitle"] = "servicios denunciados";
        $this->load->view('/includes/contentpage', $data);
    }
    /**
     *
     */
    function denunciados()
    {
        $em = $this->doctrine->em;
        $relacion = $em->getRepository('Entities\UserService');

        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->neq('complaint', null));
        $criteria->orderBy(array("complaint_created" => "DESC"));
        $result = $relacion->matching($criteria);
        foreach ($result as $item) {
            $item->getService()->getTitle();
            $item->getUser()->getUsername();
        }
        $data["complaints"] = $result;
        $data['content'] = '/services/denunciados';
        $data["tab"] = "services";
        $data["tabTitle"] = "servicios denunciados";
        $this->load->view('/includes/contentpage', $data);
    }

    # GET /services/destroy/1
    function destroy($id)
    {
        $this->load->helper("file");
        $em = $this->doctrine->em;
        $service = $em->find("\Entities\Service", $id);

        $service->getServicecomments()->toArray();
        $service->getPositions()->toArray();
        $fotos = $service->getImages()->toArray();
        $path = "./resources/services/";

        foreach ($fotos as $foto) {
            try {
                $imageName = explode('/', $foto->getTitle());
                $pathImage = $path . $id . "/" . $imageName[count($imageName) - 1];
                $pathThumbsImage = $path . $id . "/thumbs/" . $imageName[count($imageName) - 1];
                if (is_file($foto->getTitle())) {
                    unlink($pathImage);
                    unlink($pathThumbsImage);
                }
            } catch (Exception $e) {
                echo $foto->getTitle();
                //print_r($e);
            }
        }

        //borrar los thumbs y los icons
        if ($service->getThumb())
            unlink('.' . $service->getThumb());
        if ($service->getIcon())
            unlink('.' . $service->getIcon());

        //borrar los directorios
        rmdir($path . $id . "/thumbs");
        rmdir($path . $id);

        $service->getServiceusers()->toArray();
        $service->getPayments()->toArray();

        //CARGADA LA RELACION PARA DESPUES ELIMINARLAS CON EL SERVICIO
        $em->remove($service);
        $em->flush();
        $this->session->set_flashdata('item', array('message' => 'El elemento ha sido eliminado correctamente.', 'class' => 'success', 'icon' => 'fa fa-warning', 'title' => "<strong>Bien!:</strong>"));
        redirect('admin/services/index', 'refresh');
    }

    # POST /services/save
    function save()
    {
        $em = $this->doctrine->em;
        $this->form_validation->set_rules('title', 'Title', 'required');
//        $this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
//        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run()) {
            $this->load->helper("file");
//            echo '<pre>';
//            //print_r($this->input->post('thumbs', TRUE));
//            echo '<br>';
//            //print_r($this->input->post());
//            echo '</pre>';


            $em = $this->doctrine->em;
            if (!$id) {
                $service = new \Entities\Service();
            } else {
                $userRepo = $em->getRepository('Entities\Service');
                $service = $userRepo->findOneBy(array("id" => $id));
                if (count($service) <= 0) {
                    $service = new \Entities\Service();
                }
            }
            //DATOS BASICOS
            $service->setAthor($this->getCurrentUser());
            $service->title = $this->input->post('title', TRUE);
            $service->subtitle = $this->input->post('subtitle', TRUE);
            $service->phone = $this->input->post('phone', TRUE);
            $service->address = $this->input->post('address', TRUE);
            $service->addSubCategories($this->input->post('categories', TRUE), $em);
            $service->addCities($this->input->post('cities', TRUE), $em);

            //OTROS DATOS
            $service->setOtherPhone($this->input->post('other_phone', TRUE));
            $service->setEmail($this->input->post('email', TRUE));
            $service->setUrl($this->input->post('url', TRUE));
            $service->setDescription($this->input->post('description', TRUE));
            $positions = $this->input->post('positions', TRUE);
            $old_positions = $service->getPositions()->toArray();
            foreach ($old_positions as $old_position) {
                $em->remove($old_position);
            }

            if ($service->getTimes()) {

                $old_times = $service->getTimes()->toArray();

                foreach ($old_times as $old_time) {
                    $em->remove($old_time);
                }
            }
            $em->flush();
            $arr = json_decode($positions);
            if(is_array($arr)) {
                $service->addPositions(json_decode($positions), true);
            }
            $service->addTimes(json_decode($this->input->post("times")), true);
            $em->persist($service);
            $em->flush();
            //GALERIA DE FOTOS
            //si estoy editando borro fotos anteriores
            if (isset($service->id)) {
                $images_deleted = $this->input->post('images_deleted', TRUE);
//                //print_r(json_decode($images_deleted));
//                die;
                if (isset($images_deleted)) {
                    $images_deletedArr = json_decode($images_deleted);
                    foreach ($images_deletedArr as $fotoold) {
                        $image = $em->find("\Entities\Image", $fotoold);
                        $imageName = explode('/', $image->title);
                        $path = "./resources/services/" . $id . "/" . $imageName[count($imageName) - 1];
                        $pathThumbs = "./resources/services/" . $id . "/thumbs/" . $imageName[count($imageName) - 1];
//                        echo $path;
//                        @unlink($path);
                        try {
                            if (@unlink($path) && @unlink($pathThumbs)) {
                                $service->removeImage($image);
                                $em->persist($image);
                                $em->remove($image);
                                $em->flush();
                            }
                        } catch (Exception $e) {
                            echo $path;
                            //print_r($e);
                        }
                    }
                }
            }
//            //print_r($_FILES['userfile']);
            $fotos = $_FILES['userfile'];
            if (count($_FILES["userfile"]["tmp_name"]) > 0 && $_FILES["userfile"]["tmp_name"][0] != null) {
//                //print_r($_FILES["userfile"]["tmp_name"]);
//                die;
//                echo "ENTRA A VER QUE SON MAS FOTOS";
                $fotoSubir = array();
                for ($i = 0; $i < count($_FILES["userfile"]["tmp_name"]); $i++) {
                    $fotoSubir[$i]['filename'] = $fotos['name'][$i];
                    $fotoSubir[$i]['value'] = $fotos['tmp_name'][$i];
                }
                if (count($fotoSubir) > 0) {
                    //guardo la primera foto
                    $pathIcon = "./resources/services/" . $fotoSubir[0]['filename'];
                    $saveIcon = "/resources/services/" . $fotoSubir[0]['filename'];
//                    echo move_uploaded_file($fotoSubir[0]['value'], $pathIcon);
                    copy($fotoSubir[0]['value'], $pathIcon);
////                    file_put_contents($pathIcon, $fotoSubir[0]['value']);
//                    //print_r($fotoSubir);
//                    die;
                    $service->setIcon($saveIcon);
                    $service->setThumb($fotoSubir[0]['filename']);
                    $service->addFotos($fotoSubir, site_url(), true);
                }
            } else {
//                echo"NO VE LAS FOTOS";
            }

            $em->persist($service);
            $em->flush();
            $service->loadRelatedData($this->getCurrentUser(), null, site_url());
            $service->loadRelatedUserData($this->getCurrentUser());
            $this->session->set_flashdata('item', array('message' => 'Se han guardado sus cambios correctamente.', 'class' => 'success', 'icon' => 'fa fa-thumbs-up', 'title' => "<strong>Bien!:</strong>"));

//            //print_r($service);
//            die;
            redirect('admin/services/index', 'refresh');
        }
        else{
            redirect("admin/services/edit/$id", 'refresh');
            echo "NO ESTA REDIRECCIONANDO";
        }
    }

    function rebuild()
    {
        $object = new Services_model();
        $object->id = $this->input->post('id', TRUE);
        $object->title = $this->input->post('title', TRUE);
        $object->subtitle = $this->input->post('subtitle', TRUE);
        $object->phone = $this->input->post('phone', TRUE);
        $object->address = $this->input->post('address', TRUE);
        $object->other_phone = $this->input->post('other_phone', TRUE);
        $object->email = $this->input->post('email', TRUE);
        $object->url = $this->input->post('url', TRUE);
        $object->week_days = $this->input->post('week_days', TRUE);
        $object->start_time = $this->input->post('start_time', TRUE);
        $object->end_time = $this->input->post('end_time', TRUE);
        $object->visits = $this->input->post('visits', TRUE);

        return $object;
    }

    /**
     * @return Entities/User
     */
    function getCurrentUser()
    {
        $usuario = $this->session->userdata('user_id');
        $em = $this->doctrine->em;
        $user = $em->find("Entities\User", $usuario);
        return $user;
    }
    function quitarQueja($id_service, $id_user)
    {
        $em = $this->doctrine->em;
        $service = $em->find("Entities\Service", $id_service);
        $user = $em->find("Entities\User", $id_user);
        //cargo la tupla de la queja
        $userServiceRepo = $em->getRepository('Entities\UserService');

        $criteria = new Criteria();
//        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion1 = new \Doctrine\Common\Collections\Expr\Comparison("user", \Doctrine\Common\Collections\Expr\Comparison::EQ, $user);
        $expresion2 = new \Doctrine\Common\Collections\Expr\Comparison("service", \Doctrine\Common\Collections\Expr\Comparison::EQ, $service);
        $criteria->where($expresion1);
        $criteria->andWhere($expresion2);
        $relacion = $service->getServiceusers()->matching($criteria)->toArray();
        if (count($relacion) > 0) {
                $obj = $relacion[0];
            //seteo los campos
            $obj->setComplaint();
            $obj->setComplaintCreated();
            $em->persist($obj);
            $em->flush();
            }
        redirect('admin/services/denunciados', 'refresh');
    }

}

?>
