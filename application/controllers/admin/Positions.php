<?php use Doctrine\Common\Collections\Criteria;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Positions Controller.
 */
class Positions extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Positions_model');
        $this->load->helper('html');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
	}

	# GET /positions
	function index() {
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\Position');
        $data['positions'] = $relacion->findAll();
		$data['content'] = '/positions/index';
        $data["tab"]="position";
        $data["tabTitle"]="positions";
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /positions/create
	function create() {
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\Service');
        $data['services'] = $relacion->findAll();
		$data['content'] = '/positions/create';
        $data["tab"]="position";
        $data["tabTitle"]="positions";
        $this->load->view('/includes/contentpage', $data);		}

	# GET /positions/edit/1
	function edit($id) {
        $em= $this->doctrine->em;
        $relacion = $em->getRepository('Entities\Service');
        $data['services'] = $relacion->findAll();
        $data['positions'] = $em->find('Entities\Position', $id);
//		$data['positions'] = $this->Positions_model->find($id);
        $data["tab"]="position";
        $data['content'] = '/positions/create';
        $data["tabTitle"]="positions";
        $this->load->view('/includes/contentpage', $data);		}

	# GET /positions/destroy/1
	function destroy() {
		$id = $this->uri->segment(3);
		$data['positions'] = $this->Positions_model->destroy($id);
		redirect('admin/positions/index', 'refresh');
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
			redirect('admin/positions/index', 'refresh');
		}
		$data['positions'] =	$this->rebuild();
		$data['content'] = '/positions/create';
        $data["tab"]="position";

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
