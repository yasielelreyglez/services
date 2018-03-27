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
        $subcategories = $em->getRepository('Entities\Subcategory');
        $cities = $em->getRepository('Entities\City');
        $images = $em->getRepository('Entities\Image');
        $positions = $em->getRepository('Entities\Position');
        $data['subcategories'] = $subcategories->findAll();
        $data['currenSubCategories '] = $subcategories->findAll();
        $data['cities'] = $cities->findAll();
        $data['images'] = $images->findAll();
        $data['positions'] = $positions->findAll();
        $data['days_of_weak'] = $this->days_of_weak;
		$data['services'] = $this->Services_model->find($id);
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
		$this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if ($this->form_validation->run()) {
//		    echo '<pre>';
//            print_r($this->input->post());
//
//            echo '</pre>';
//		    die;
            $id =  $this->input->post('id', TRUE);

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
            $icon = $this->input->post('icon');
            if ($icon) {
                if (isset($icon['filename'])) {
                    $path = "./resources/services/" . $icon['filename'];
                    $save = "/resources/services/" . $icon['filename'];
                    file_put_contents($path, base64_decode($icon['value']));
                    $service->setIcon(site_url($save));
                    $service->setThumb($icon['filename']);
                }
            }
            //OTROS DATOS
            $service->setOtherPhone($this->input->post('other_phone', TRUE));
            $service->setEmail($this->input->post('email', TRUE));
            $service->setUrl($this->input->post('url', TRUE));
            //arreglar los times
//            $times_old = $service->getTimes()->toArray();
//            if($times_old){
//                if (is_array($times_old)){
//                    foreach ($times_old as $old_time) {
//                        $em->remove($old_time);
//                    }
//                }}
//            $em->flush();
//            $times = $this->post('times', TRUE);
//            if(is_array($times)) {
//                $service->addTimes($times);
//            }
//            $em->flush();
            $service->setDescription($this->input->post('description', TRUE));
//        $service->setWeekDays(substr($string_week, 1, strlen($string_week) - 1));
//        $service->setStartTime($this->post('start_time', TRUE));
//        $service->setEndTime($this->post('end_time', TRUE));
            //UBICACIONES
            $positions = $this->input->post('positions', TRUE);
            $old_positions = $service->getPositions()->toArray();
            foreach ($old_positions as $old_position) {
                $em->remove($old_position);
            }

            $em->flush();
            if(is_array($positions)) {
                $service->addPositions($positions);
            }
            $service->addTimes(json_decode($this->input->post("times")),true);
            $em->persist($service);
            $em->flush();
            //GALERIA DE FOTOS
            $fotos = $this->input->post('thumbs', TRUE);
            if (count($fotos) > 0) {
                $service->addFotos($fotos, base_url());

                $path = "./resources/services/" . $fotos[0]['filename'];
                $save = "/resources/services/" . $fotos[0]['filename'];
                file_put_contents($path, base64_decode($fotos[0]['value']));
                $service->setIcon(site_url($save));
                $service->setThumb($fotos[0]['filename']);

            }
            $em->persist($service);
            $em->flush();
            $service->loadRelatedData($this->getCurrentUser());
            $service->loadRelatedUserData($this->getCurrentUser());

//            print_r($service);
//            die;
//            redirect('admin/services/index', 'refresh');


        //viejo

//			$data[] = array();
//			$data['id'] = $this->input->post('id', TRUE);
//			$data['title'] = $this->input->post('title', TRUE);
//			$data['subtitle'] = $this->input->post('subtitle', TRUE);
//			$data['phone'] = $this->input->post('phone', TRUE);
//			$data['address'] = $this->input->post('address', TRUE);
//			$data['other_phone'] = $this->input->post('other_phone', TRUE);
//			$data['email'] = $this->input->post('email', TRUE);
//			$data['url'] = $this->input->post('url', TRUE);
//			$data['week_days'] = $this->input->post('week_days', TRUE);
//			$data['start_time'] = $this->input->post('start_time', TRUE);
//			$data['end_time'] = $this->input->post('end_time', TRUE);
////			$data['visits'] = $this->input->post('visits', TRUE);
//
//			$this->Services_model->save($data);
//			redirect('/services/index', 'refresh');
		}
		$data['services'] =	$this->rebuild();
		$data['content'] = '/services/create';
        $data["tab"]="services";

        $this->load->view('/includes/contentpage', $data);
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
