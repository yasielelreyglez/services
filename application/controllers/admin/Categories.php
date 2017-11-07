<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Categories Controller.
 */
class Categories extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Categories_model');
        $this->load->helper('html');
	}

	# GET /categories
	function index() {
		$data['categories'] = $this->Categories_model->find();
		$data['content'] = '/categories/index';
        $data["tab"]="category";
		$this->load->view('/includes/template', $data);
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
		$this->form_validation->set_rules('icon', 'Icon', 'required');

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

            $category->setTitle($this->input->post('title', TRUE));
			$category->setIcon($this->input->post('icon', TRUE));
            $em->persist($category);
            $em->flush();
			redirect('admin/categories/index', 'refresh');
		}
		$data['categories'] =	$this->rebuild();
		$data['content'] = '/categories/create';
        $data["tab"]="category";
		$this->load->view('admin/includes/template', $data);
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
