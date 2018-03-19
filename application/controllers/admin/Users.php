<?php use Doctrine\Common\Collections\Criteria;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Users Controller.
 */
class Users extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Users_model');
        $this->load->helper('html');
	}

	# GET /users
	function index() {
        $em= $this->doctrine->em;
        $servicesRepo = $em->getRepository('Entities\User');
        $data['users'] = $servicesRepo->findAll();
        $data['content'] = '/users/index';
        $data["tab"]="user";
        $data["tabTitle"]="usuarios";
        $this->load->view('/includes/contentpage', $data);

	}

	# GET /users/create
	function create() {
		$data['content'] = '/users/create';
        $data["tab"]="user";
        $data["tabTitle"]="usuarios";
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /users/edit/1
	function edit($id) {
		$data['users'] = $this->Users_model->find($id);
		$data['content'] = '/users/create';
        $data["tab"]="user";
        $data["tabTitle"]="usuarios";
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /users/destroy/1
	function destroy($id) {
		$data['users'] = $this->Users_model->destroy($id);
        $data['tab'] = "user";
		redirect('admin/users/index', 'refresh');
	}

	# POST /users/save
	function save() {
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
//		$this->form_validation->set_rules('created', 'Created', 'required');
//		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run()) {
			$id =  $this->input->post('id', TRUE);
            $em = $this->doctrine->em;
			if(!$id) {
                $user = new \Entities\User();
            }else{
                $userRepo = $em->getRepository('Entities\User');
                $users = $userRepo->findBy(array("id"=>$id));
                if(count($users)>0){
                	$user= $users[0];
				}else{
                    $user = new \Entities\User();
				}
			}
			$user->setUsername($this->input->post('username', TRUE));
			$user->setEmail($this->input->post('email', TRUE));
			$user->setPassword(md5($this->input->post('password', TRUE)));
			$user->setRole($this->input->post('role', TRUE));
            $em->persist($user);
            $em->flush();
			redirect('admin/users/index', 'refresh');
		}
		$data['users'] =	$this->rebuild();
		$data['content'] = '/users/create';
        $data['tab'] = "user";
		$this->load->view('/includes/template', $data);
	}

	function rebuild() {
		$object = new Users_model();
		$object->id = $this->input->post('id', TRUE);
		$object->username = $this->input->post('username', TRUE);
		$object->email = $this->input->post('email', TRUE);
		$object->password = $this->input->post('password', TRUE);
		$object->created = $this->input->post('created', TRUE);
		$object->role = $this->input->post('role', TRUE);
		return $object;
	}
}

?>
