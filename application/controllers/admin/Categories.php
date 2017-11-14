<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Categories Controller.
 */
class Categories extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Categories_model');
        $this->load->helper('html');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
	}

	# GET /categories
	function index() {
		$data['categories'] = $this->Categories_model->find();
		$data['content'] = '/categories/index';
        $data["tab"]="category";
		$this->load->view('/includes/contentpage', $data);
	}

	# GET /categories/create
	function create() {
		$data['content'] = '/categories/create';
        $data["tab"]="category";
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /categories/edit/1
	function edit($id) {
		$data['categories'] = $this->Categories_model->find($id);
		$data['content'] = '/categories/create';
        $data["tab"]="category";
        $this->load->view('/includes/contentpage', $data);
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
                $this->load->view('/includes/contentpage', $data);
            }

        }else{
            $data["errors"]= array("Error eliminando el elemento"=>"No se encontro la categoria a eliminar");
            $data['categories'] = $this->Categories_model->find();
            $data['content'] = '/categories/index';
            $this->load->view('/includes/contentpage', $data);
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
                print_r($error);
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
            $this->load->view('/includes/contentpage', $data);
        }

	}

	function rebuild() {
		$object = new Categories_model();
		$object->id = $this->input->post('id', TRUE);
		$object->title = $this->input->post('title', TRUE);
		$object->icon = $this->input->post('icon', TRUE);
		return $object;
	}
}

?>
