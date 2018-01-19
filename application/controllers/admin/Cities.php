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
        $em= $this->doctrine->em;
        $citiesRepo = $em->getRepository('Entities\City');
        $data['cities'] = $citiesRepo->findAll();
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
	function edit($id) {
        $em= $this->doctrine->em;
        $data['cities'] = $em->find('Entities\City',$id);
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
            $id =  $this->input->post('id', TRUE);
            $em = $this->doctrine->em;
            if(!$id) {
                $city = new \Entities\City();
            }else {
                $city = $em->find("\Entities\City",$id);
            }
            $city->setTitle($this->input->post('title', TRUE));
            $em->persist($city);
            $em->flush();
			redirect('admin/cities/index', 'refresh');
		}

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
