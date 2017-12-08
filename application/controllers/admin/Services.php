<?php use Doctrine\Common\Collections\Criteria;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Services Controller.
 */
class Services extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Services_model');
        $this->load->helper('html');
	}

	# GET /services
	function index() {
		$data['services'] = $this->Services_model->find();
		$data['content'] = '/services/index';
        $data["tab"]="services";

        $this->load->view('/includes/contentpage', $data);
	}

	# GET /services/create
	function create() {
		$data['content'] = '/services/create';
        $data["tab"]="services";

        $this->load->view('/includes/contentpage', $data);
	}

	# GET /services/edit/1
	function edit($id) {
		$data['services'] = $this->Services_model->find($id);
		$data['content'] = '/services/create';
        $data["tab"]="services";

        $this->load->view('/includes/contentpage', $data);
	}
    function show($id) {
        $data['services'] = $this->Services_model->find($id);
        $data['content'] = '/services/show';
        $data["tab"]="services";

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
        $denunciados = [];
        foreach ($result as $item) {
            $item->getService()->getTitle();
            $item->getUser()->getUsername();
        }
        $data["complaints"]=$result;
        $data['content'] = '/services/denunciados';
        $data["tab"]="services";
        $this->load->view('/includes/contentpage', $data);


        $this->load->view('/includes/contentpage', $data);
	}

	# GET /services/destroy/1
	function destroy() {
		$id = $this->uri->segment(3);
		$data['services'] = $this->Services_model->destroy($id);
		redirect('/services/index', 'refresh');
	}

	# POST /services/save
	function save() {
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('subtitle', 'Subtitle', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');

		if ($this->form_validation->run()) {

			$data[] = array();
			$data['id'] = $this->input->post('id', TRUE);
			$data['title'] = $this->input->post('title', TRUE);
			$data['subtitle'] = $this->input->post('subtitle', TRUE);
			$data['phone'] = $this->input->post('phone', TRUE);
			$data['address'] = $this->input->post('address', TRUE);
			$data['other_phone'] = $this->input->post('other_phone', TRUE);
			$data['email'] = $this->input->post('email', TRUE);
			$data['url'] = $this->input->post('url', TRUE);
			$data['week_days'] = $this->input->post('week_days', TRUE);
			$data['start_time'] = $this->input->post('start_time', TRUE);
			$data['end_time'] = $this->input->post('end_time', TRUE);
			$data['visits'] = $this->input->post('visits', TRUE);

			$this->Services_model->save($data);
			redirect('/services/index', 'refresh');
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
}

?>
