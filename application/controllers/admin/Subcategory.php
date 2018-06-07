<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Subcategory Controller.
 */
class Subcategory extends CI_Controller {

	function __construct() {
		parent::__construct();
        $this->load->helper('html');
        $this->load->model('Subcategory_model');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
    }

	# GET /subcategory
	function index() {
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\Subcategory');
		$data['subcategory'] = $relacion->findAll();
		$data['content'] = '/subcategory/index';
        $data["tab"]="subcategory";
        $data["tabTitle"]="subcategor&iacute;as";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'subcategoriesStarBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0]->getBanner();
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /subcategory/create
	function create() {
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\Category');
        $data['categories'] = $relacion->findAll();
		$data['content'] = '/subcategory/create';
        $data["tab"]="subcategory";
        $data["tabTitle"]="crear subcategor&iacute;a";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'subcategoriesAddBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0]->getBanner();
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /subcategory/edit/1
	function edit($id) {
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\Category');
		$data['categories'] = $relacion->findAll();
		$data['subcategory'] = $em->find('Entities\Subcategory',$id);
		$data['content'] = '/subcategory/create';
        $data["tab"]="subcategory";
        $data["tabTitle"]="editar subcategor&iacute;a";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'subcategoriesEditBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0]->getBanner();
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /subcategory/destroy/1
	function destroy($id) {
//		$id = $this->uri->segment(3);
        $em= $this->doctrine->em;
        $subcategory = $em->find('Entities\Subcategory',$id);

        if ($subcategory) {
            try {

                $imageName = explode('/', $subcategory->getIcon());
                $pathImage = "./resources/image/subcategories/" . $imageName[count($imageName) - 1];

                if (is_file($pathImage)) {
                    unlink($pathImage);
                }

                $em->remove($subcategory);
                $em->flush();
            } catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception) {
                $this->session->set_flashdata('item', array('message'=>"No se puede eliminar esta subcategoria", 'class'=>'danger', 'icon'=>'fa fa-warning', 'title'=>"<strong>Alerta!:</strong>"));
                redirect('admin/categories/index', 'refresh');
            }
        }
//        $data['subcategory'] = $this->Subcategory_model->destroy($id);
        $this->session->set_flashdata('item', array('message'=>'El elemento ha sido eliminado correctamente.', 'class'=>'success', 'icon'=>'fa fa-warning', 'title'=>"<strong>Bien!:</strong>"));
        redirect('admin/subcategory/index', 'refresh');
	}

	# POST /subcategory/save
	function save() {
		$this->form_validation->set_rules('title', 'Title', 'required');
		if ($this->form_validation->run()) {
            $id = $this->input->post('id', TRUE);
            $em = $this->doctrine->em;
            if($id){
                $subcategory = $em->find("\Entities\Subcategory",$id);
            }else{
                $subcategory = new \Entities\Subcategory();

            }
            $guardar_icon = true;

            $config['upload_path']          = './resources/image/subcategories';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 9024;
            $config['max_height']           = 2768;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile')) {
                $data["upload_data"] = $this->upload->data();
                $subcategory->setIcon('resources/image/subcategories/',$data["upload_data"]["file_name"]);
            }
			$subcategory->setTitle($this->input->post('title', TRUE));
			$subcategory->setCategory($em->find("\Entities\Category",$this->input->post('category_id', TRUE)));
			$em->persist($subcategory);
			$em->flush();
            $this->session->set_flashdata('item', array('message'=>'Se han guardado sus cambios correctamente.', 'class'=>'success', 'icon'=>'fa fa-thumbs-up', 'title'=>"<strong>Bien!:</strong>"));
            redirect('admin/subcategory/index', 'refresh');
		}
        $data['categories'] = $this->Category_model->find();
		$data['subcategory'] =	$this->rebuild();
		$data['content'] = '/subcategory/create';
        $this->load->view('/includes/contentpage', $data);
	}

	function category($id){
        $em= $this->doctrine->em;
        $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
        $subcategories = $subcategoriesRepo->findBy(array('category'=>$id));
        $data["subcategory"]= $subcategories;
//        $this->load->view('templates/header',$data);
        $data['content'] = '/subcategory/index';
        $this->load->view('/includes/contentpage', $data);
//        $this->load->view('templates/footer');
	}
	function rebuild() {
		$object = new Subcategory_model();
		$object->id = $this->input->post('id', TRUE);
		$object->title = $this->input->post('title', TRUE);
		$object->icon = $this->input->post('icon', TRUE);
		return $object;
	}
}

?>
