<?php use Doctrine\Common\Collections\Criteria;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Services Controller.
 */
class Services extends CI_Controller {
    private $days_of_weak = array(
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado',
        'Domingo',
    );
    function __construct() {
        parent::__construct();
        $this->load->model('Services_model');
        $this->load->helper('html');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
    }

    # GET /services
    function index() {
        $em= $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\Service');
        $data['services'] = $servicesRepo->findAll();
        $data['content'] = '/services/index';
        $data["tab"]="services";
        $data["tabTitle"]="servicios";

        $this->load->view('/includes/contentpage', $data);
    }

    # GET /services/create
    function create() {
        $em= $this->doctrine->em;
        $subcategories = $em->getRepository('Entities\Subcategory');
        $cities = $em->getRepository('Entities\City');
        $images = $em->getRepository('Entities\Image');
        $positions = $em->getRepository('Entities\Position');
        $data['subcategories'] = $subcategories->findAll();
        $data['cities'] = $cities->findAll();
        $data['images'] = $images->findAll();
        $data['positions'] = $positions->findAll();
        $data['days_of_weak'] = $this->days_of_weak;
        $data['content'] = '/services/create';
        $data["tab"]="services";
        $data["tabTitle"]="crear servicios";
        $this->load->view('/includes/contentpage', $data);
    }

    # GET /services/edit/1
    function edit($id) {
        $em= $this->doctrine->em;
        $service = $em->getRepository('Entities\Service')->find($id);
        $currenSubCategories = $service->getSubcategories();
        $currenCities = $service->getCities();
        $currenImages = $service->getImages();
        $subcategories = $em->getRepository('Entities\Subcategory');
        $cities = $em->getRepository('Entities\City');
        $images = $em->getRepository('Entities\Image');
        $positions = $em->getRepository('Entities\Position');
        $data['subcategories'] = $subcategories->findAll();
        $data['currenSubCategories'] = $currenSubCategories;
        $data['currenCities'] = $currenCities;
        $data['currenImages'] = $currenImages;
        $data['cities'] = $cities->findAll();
        $data['images'] = $images->findAll();
        $data['positions'] = $positions->findAll();
        $data['days_of_weak'] = $this->days_of_weak;
		$data['services'] = $service;
		$data['content'] = '/services/create';
        $data["tab"]="services";
        $data["tabTitle"]="editar servicios";

        $this->load->view('/includes/contentpage', $data);
    }
    function show($id) {
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\Subcategory');
        $data['subcategories'] = $relacion->findAll();
        $times = $em->getRepository('Entities\Times');
        $data['times'] = $times->findBy(array('service' => $id));;

        $data['services'] = $em->find('Entities\Service',$id);
//        $data['times'] = $result;
        $data['content'] = '/services/show';
        $data["tab"]="services";
        $data["tabTitle"]="servicio";
//        print_r($data['categories']);die;
        $this->load->view('/includes/contentpage', $data);
    }

    /**
     *
     */
    function denunciados(){
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\UserService');

        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->neq('complaint', null));
        $criteria->orderBy(array("complaint_created"=>"DESC"));
        $result =  $relacion->matching($criteria);
        foreach ($result as $item) {
            $item->getService()->getTitle();
            $item->getUser()->getUsername();
        }
        $data["complaints"]=$result;
        $data['content'] = '/services/denunciados';
        $data["tab"]="services";
        $data["tabTitle"]="servicios denunciados";
        $this->load->view('/includes/contentpage', $data);
    }

    # GET /services/destroy/1
    function destroy($id) {
        $this->load->helper("file");
        $em = $this->doctrine->em;
        $service = $em->find("\Entities\Service", $id);

        $service->getServicecomments()->toArray();
        $service->getPositions()->toArray();
        $fotos = $service->getImages()->toArray();//TODO VER SI SE BORRAN LOS FICHEROS
        foreach ($fotos as $foto) {
            try{
                if(is_file($foto->getTitle())) {
                    echo $foto->getTitle();
                    delete_files($foto->getTitle());
                }
            }catch (Exception $e){
                echo $foto->getTitle();
                print_r($e);
            }
        }
        $service->getServiceusers()->toArray();
        $service->getPayments()->toArray();

        //CARGADA LA RELACION PARA DESPUES ELIMINARLAS CON EL SERVICIO
        $em->remove($service);
        $em->flush();
        redirect('admin/services/index', 'refresh');
    }

    # POST /services/save
    function save() {
        $em = $this->doctrine->em;
        $this->form_validation->set_rules('title', 'Title', 'required');
//        $this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
//        $this->form_validation->set_rules('phone', 'Phone', 'required');

		if ($this->form_validation->run()) {
            $this->load->helper("file");
//            echo '<pre>';
//            print_r($this->input->post('thumbs', TRUE));
//            echo '<br>';
//            print_r($this->input->post());
//            echo '</pre>';

            $id =  $this->input->post('id', TRUE);
            $em = $this->doctrine->em;
            if(!$id) {
                $service = new \Entities\Service();
            }else{
                $userRepo = $em->getRepository('Entities\Service');
                $service= $userRepo->findOneBy(array("id"=>$id));
                if(count($service)<=0){
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
            //si estoy editando, verificar k no de palo
//            if($id) {
//                $icon_old = $this->input->post('icon_old');
//            }

////            /salvando icon
//            $config['upload_path']          = './resources/services';
//            $config['allowed_types']        = 'gif|jpg|png';
//            $config['max_size']             = 1000;
//            $config['max_width']            = 9024;
//            $config['max_height']           = 2768;
//            $this->load->library('upload', $config);
//            echo $icon = $this->input->post('icon');
//            if ($this->upload->do_upload('icon')) {
//                $data["upload_data"] = $this->upload->data();
//                $service->setIcon(site_url('resources/services/'.$data["upload_data"]["file_name"]));
//                $service->setThumb($data["upload_data"]["file_name"]);
//            }

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

            $em->flush();

            $service->addPositions(json_decode($positions),true);
            $service->addTimes(json_decode($this->input->post("times")),true);
            $em->persist($service);
            $em->flush();

            //GALERIA DE FOTOS
            //si estoy editando borro fotos anteriores
            if(isset($service->id)) {
                $images_deleted = $this->input->post('images_deleted', TRUE);
//                print_r(json_decode($images_deleted));
//                die;
                if (isset($images_deleted)){
                    $images_deletedArr = json_decode($images_deleted);
                    foreach ($images_deletedArr as $fotoold) {
                        $image = $em->find("\Entities\Image", $fotoold);
                        $imageName = explode('/', $image->title);
                        $path = "./resources/services/" . $id . "/" . $imageName[count($imageName)-1];
//                        echo $path;
//                        @unlink($path);
                        try {
                            if (@unlink($path)) {
                                $service->removeImage($image);
                                $em->persist($image);
                                $em->remove($image);
                                $em->flush();
                            }
                        } catch (Exception $e) {
                            echo $path;
                            print_r($e);
                        }
                    }
                }
            }
//            print_r($_FILES['userfile']);
            $fotos = $_FILES['userfile'];
            if (count($_FILES["userfile"]["tmp_name"]) > 0 && $_FILES["userfile"]["tmp_name"][0]!=null) {
//                print_r($_FILES["userfile"]["tmp_name"]);
//                die;
//                echo "ENTRA A VER QUE SON MAS FOTOS";
                $fotoSubir = array();
                for($i=0; $i < count($_FILES["userfile"]["tmp_name"]); $i++){
                    $fotoSubir[$i]['filename'] = $fotos['name'][$i];
                    $fotoSubir[$i]['value'] = $fotos['tmp_name'][$i];
                }
                if(count($fotoSubir)> 0){
                    $service->addFotos($fotoSubir, site_url(), true);
                    //guardo la primera foto
                    $service->setIcon('resources/services/'.$fotoSubir[0]["filename"]);
                    $service->setThumb($fotoSubir[0]['filename']);
                }
            }else{
//                echo"NO VE LAS FOTOS";
            }

            $em->persist($service);
            $em->flush();
            $service->loadRelatedData($this->getCurrentUser(), null, site_url());
            $service->loadRelatedUserData($this->getCurrentUser());

//            print_r($service);
//            die;
            redirect('admin/services/index', 'refresh');



        }
//        $data['services'] =	$this->rebuild();
//        $data['content'] = '/services/create';
//        $data["tab"]="services";
//
//        $this->load->view('/includes/contentpage', $data);
    }

    function rebuild() {
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
}

?>
