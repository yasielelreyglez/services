<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Subcategory Controller.
 */
class Subcategory extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Subcategory_model');
		$this->load->model('Category_model');
        $this->load->helper('html');
	}

	# GET /subcategory
	function index() {
		$data['subcategory'] = $this->Subcategory_model->find();
		$data['content'] = '/subcategory/index';
        $data["tab"]="subcategory";
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /subcategory/create
	function create() {
        $data['categories'] = $this->Category_model->find();
		$data['content'] = '/subcategory/create';
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /subcategory/edit/1
	function edit($id) {
		$data['categories'] = $this->Category_model->find();		$data['subcategory'] = $this->Subcategory_model->find($id);
		$data['content'] = '/subcategory/create';
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /subcategory/destroy/1
	function destroy() {
		$id = $this->uri->segment(3);
		$data['subcategory'] = $this->Subcategory_model->destroy($id);
		redirect('/subcategory/index', 'refresh');
	}

	# POST /subcategory/save
	function save() {
		
		$this->form_validation->set_rules('title', 'Title', 'required');

		if ($this->form_validation->run()) {

            $config['upload_path']          = './resources/image/categories';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 9024;
            $config['max_height']           = 2768;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('upload_form', $error);
                print_r($error);
            }else{


                $data["upload_data"] =$this->upload->data();
				$data[] = array();
				$data['id'] = $this->input->post('id', TRUE);
				$data['title'] = $this->input->post('title', TRUE);
                $data['category_id'] = $this->input->post('category_id', TRUE);
				$data['icon'] =site_url('resources/image/categories/'.$data["upload_data"]["file_name"]);

				$this->Subcategory_model->save($data);
                redirect('admin/subcategory/index', 'refresh');
            }

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
