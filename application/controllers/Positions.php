<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Positions Controller.
 */
class Positions extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Positions_model');
	}

	# GET /positions
	function index() {
		$data['positions'] = $this->Positions_model->find();
		$data['content'] = '/positions/index';
		$this->load->view('/includes/template', $data);
	}

	# GET /positions/create
	function create() {
		$data['content'] = '/positions/create';
		$this->load->view('/includes/template', $data);
	}

	# GET /positions/edit/1
	function edit() {
		$id = $this->uri->segment(3);
		$data['positions'] = $this->Positions_model->find($id);
		$data['content'] = '/positions/create';
		$this->load->view('/includes/template', $data);
	}

	# GET /positions/destroy/1
	function destroy() {
		$id = $this->uri->segment(3);
		$data['positions'] = $this->Positions_model->destroy($id);
		redirect('/positions/index', 'refresh');
	}

	# POST /positions/save
	function save() {
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('latitude', 'Latitude', 'required');
		$this->form_validation->set_rules('longitude', 'Longitude', 'required');

		if ($this->form_validation->run()) {

			$data[] = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['title'] = $this->input->post('title', TRUE);
			$data['latitude'] = $this->input->post('latitude', TRUE);
			$data['longitude'] = $this->input->post('longitude', TRUE);
			$this->Positions_model->save($data);
			redirect('/positions/index', 'refresh');
		}
		$data['positions'] =	$this->rebuild();
		$data['content'] = '/positions/create';
		$this->load->view('/includes/template', $data);
	}

	function rebuild() {
		$object = new Positions_model();
		$object->id = $this->input->post('id', TRUE);
		$object->title = $this->input->post('title', TRUE);
		$object->latitude = $this->input->post('latitude', TRUE);
		$object->longitude = $this->input->post('longitude', TRUE);
		return $object;
	}
}

?>
