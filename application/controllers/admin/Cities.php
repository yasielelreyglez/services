<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cities Controller.
 */
class Cities extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Cities_model');
        $this->load->helper('html');
    }

	# GET /cities
	function index() {
		$data['cities'] = $this->Cities_model->find();
		$data['content'] = '/cities/index';
        $data["tab"]="cities";
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /cities/create
	function create() {
		$data['content'] = '/cities/create';
        $data["tab"]="cities";
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /cities/edit/1
	function edit() {
		$id = $this->uri->segment(3);
		$data['cities'] = $this->Cities_model->find($id);
		$data['content'] = '/cities/create';
        $data["tab"]="cities";

        $this->load->view('/includes/contentpage', $data);
	}

	# GET /cities/destroy/1
	function destroy() {
		$id = $this->uri->segment(3);
		$data['cities'] = $this->Cities_model->destroy($id);
		redirect('admin/cities/index', 'refresh');
	}

	# POST /cities/save
	function save() {
		
		$this->form_validation->set_rules('title', 'Title', 'required');

		if ($this->form_validation->run()) {

			$data[] = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['title'] = $this->input->post('title', TRUE);
			$this->Cities_model->save($data);
			redirect('admin/cities/index', 'refresh');
		}
		$data['cities'] =	$this->rebuild();
		$data['content'] = '/cities/create';
        $data["tab"]="cities";

        $this->load->view('/includes/contentpage', $data);
	}

	function rebuild() {
		$object = new Cities_model();
		$object->id = $this->input->post('id', TRUE);
		$object->title = $this->input->post('title', TRUE);
		return $object;
	}
}

?>
