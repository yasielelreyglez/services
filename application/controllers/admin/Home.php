<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Categories Controller.
 */
class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Categories_model');
        $this->load->helper(array('url', 'language','html'));
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
	}

	# GET /categories
	function index() {
		$data['categories'] = $this->Categories_model->find();
		$data['content'] = '/categories/index';
        $data["tab"]="home";
        if (!$this->ion_auth->logged_in()){
            $data["showlogin"]=true;
        }
        $em = $this->doctrine->em;
        $morevisitsRepo = $em->getRepository('Entities\Service');
        $lastvisited = $morevisitsRepo->findBy(array(), array('visit_at' => 'DESC'), 4);
        $mostvisited = $morevisitsRepo->findBy(array(), array('visits' => 'DESC'), 3);

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('groupRegion'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $configRegionHome = $configRegionRepo->findBy(array('groupRegion'=>'home'), array());
        if (count($configRegionHome))
            $data['configRegionHome'] = $configRegionHome;

        /** @var \Entities\Service $service */
        foreach ($lastvisited as $service) {
            $service->loadRelatedData();
        }
        foreach ($mostvisited as $service) {
            $service->loadRelatedData();
        }
        $data['lastvisited'] = $lastvisited;
        $data['mostvisited'] = $mostvisited;
		$this->load->view('/includes/backend', $data);
	}

	# GET /categories/create
	function create() {
		$data['content'] = '/categories/create';
        $data["tab"]="category";
		$this->load->view('/includes/template', $data);
	}

	# GET /categories/edit/1
	function edit($id) {
		$data['categories'] = $this->Categories_model->find($id);
		$data['content'] = '/categories/create';
        $data["tab"]="category";
		$this->load->view('/includes/template', $data);
	}

	# GET /categories/destroy/1
	function destroy($id) {
//		$data['categories'] = $this->Categories_model->destroy($id);
        $em= $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findBy(array("id"=>$id));
        if(count($categories)>0) {
            try{
                $em->remove($categories[0]);
                $em->flush();
                redirect('admin/categories/index', 'refresh');
            }catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception){
                $segments = array('admin','subcategory', 'category', $id);
                $url_subs =  site_url($segments);
                $data["errors"]= array("Subcategorias asociadas"=>"No se puede eliminar esta categoria porque existen categorias asociadas <a href='".$url_subs."' class=\"alert-link\">ver</a>");
                $data['categories'] = $this->Categories_model->find();
                $data['content'] = '/categories/index';
                $this->load->view('/includes/template', $data);
            }

        }else{
            $data["errors"]= array("Error eliminando el elemento"=>"No se encontro la categoria a eliminar");
            $data['categories'] = $this->Categories_model->find();
            $data['content'] = '/categories/index';
            $this->load->view('/includes/template', $data);
        }

	}

	# POST /categories/save
	function save() {
		$this->form_validation->set_rules('title', 'Title', 'required');
		if ($this->form_validation->run()) {
            $id =  $this->input->post('id', TRUE);
            $em = $this->doctrine->em;
            if(!$id) {
                $category = new \Entities\Category();
            }else{
                $userRepo = $em->getRepository('Entities\Category');
                $categories = $userRepo->findBy(array("id"=>$id));
                if(count($categories)>0){
                    $category= $categories[0];
                }else{
                    $category = new \Entities\Category();
                }
            }
            $config['upload_path']          = './resources/image/categories';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 9024;
            $config['max_height']           = 2768;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_form', $error);
                //print_r($error);
            }
            else
            {

                $data["upload_data"] =$this->upload->data();
                $category->setTitle($this->input->post('title', TRUE));
                $category->setIcon('resources/image/categories/'.$data["upload_data"]["file_name"]);
                $em->persist($category);
                $em->flush();
//                $this->load->view('upload_success', $data);
            }
            redirect('admin/categories/index', 'refresh');
		}else{
            $data['categories'] =	$this->rebuild();
            $data['content'] = '/categories/create';
            $data["tab"]="category";
            $this->load->view('includes/template', $data);
        }

	}

	function rebuild() {
		$object = new Categories_model();
		$object->id = $this->input->post('id', TRUE);
		$object->title = $this->input->post('title', TRUE);
		$object->icon = $this->input->post('icon', TRUE);
		return $object;
	}
	function servicesbycategories($category_id, $subcategories_id){
        $em = $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategory = $subcategoriesRepo->find($subcategories_id);
        if ($subcategory) {
            $response["desc"] = "Servicios pertenecientes a la subcategoria: $subcategory->title";
            $services = $subcategory->getServices()->toArray();
            foreach ($services as $service) {
                $service->loadRelatedData();
            }
            $category = $subcategory->getCategory();
            $response["category"]=array();
            $response["category"][]=$category->getTitle();
            $response["subcategory"]=array();
            $response["subcategory"][]=$subcategory->getTitle();
            $response["services"] = $services;
        } else {
            $response["desc"] = "Subcategoria no encontrada";
        }

        $data['services'] = $services;
        $data['content'] = '/services/index';
        $data["tab"]="services";
        $data["tabTitle"]="servicios de ".$subcategory->title;
        $this->load->view('/includes/contentpage', $data);
    }

    /**
     * @param $citi_id
     * @param $subcategories_id
     */
    function servicesbycity($citi_id){
        $em = $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\City');
        /** @var \Entities\City $city */
        $city = $subcategoriesRepo->find($citi_id);
        if ($city) {
            $response["desc"] = "Servicios pertenecientes a la ciudad: $city->title";
            $services = $city->getServices()->toArray();
            foreach ($services as $service) {
                $service->loadRelatedData();
            }
            $response["city"]=$city->getTitle();
            $response["services"] = $services;
        } else {
            $response["desc"] = "Subcategoria no encontrada";
        }

        $data['services'] = $services;
        $data['content'] = '/services/index';
        $data["tab"]="services";
        $data["tabTitle"]="servicios de ".$city->title;
        $this->load->view('/includes/contentpage', $data);
    }

    function servicesbyfilter($filter){
        $em = $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\Service');

        switch ($filter){
            case 'moreVisits':{
                $services = $servicesRepo->findBy(array(), array('visits' => 'DESC'));
                break;
            }
            case 'mostRecent':{
                $services = $servicesRepo->findBy(array(), array('created' => 'DESC'));
                break;
            }
            case 'bestRated':{
                $services = $servicesRepo->findBy(array(), array('globalrate' => 'DESC'));
                break;
            }
            default:{
                $services = $servicesRepo->findBy(array(), array('visits' => 'DESC'));
            }
        }
        foreach ($services as $service) {
            $service->loadRelatedData();
        }
        $data['services'] = $services;
        $data['content'] = '/services/index';
        $data["tab"]="services";
        $data["tabTitle"]="filtro ".$filter;
        $this->load->view('/includes/contentpage', $data);
    }

    public function help()
    {
        $data['content'] = '/home/help';
        $data["tab"]="ayuda";
        $data["tabTitle"]="ayuda";
        $em = $this->doctrine->em;

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('groupRegion'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $bannersRepo = $em->getRepository('Entities\ConfigRegion');
        $banner = $bannersRepo->findBy(array('region'=>'helpBanner'), array(), 1);
        if (count($banner)) {
            $data['banner'] = $banner[0]->getBanner();
        }
        $this->load->view('/includes/contentpage', $data);
    }

    public function termsconditions()
    {
        $data['content'] = '/home/termsconditions';
        $data["tab"]="términos y condiciones";
        $data["tabTitle"]="términos y condiciones";
        $em = $this->doctrine->em;

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('groupRegion'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $bannersRepo = $em->getRepository('Entities\ConfigRegion');
        $banner = $bannersRepo->findBy(array('region'=>'termsConditionsBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0]->getBanner();
        $this->load->view('/includes/contentpage', $data);
    }
}

?>
