<?php
/**
 * Created by PhpStorm.
 * User: yoidel86
 * Date: 14/05/2018
 * Time: 8:39
 */

class Pagesc extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
    }

    public function index()
    {
        $em= $this->doctrine->em;
        $data["title"] = "Paginas";
        $pagesRepo = $em->getRepository('Entities\Pages');
        $pages = $pagesRepo->findAll();
        $data["pages"]=$pages;
        $data['content'] = '/pages/index';
        $data["tab"]="pages";
        $data["tabTitle"]="pages";
        if (!$this->ion_auth->logged_in()){
            $data["showlogin"]=true;
        }
        $this->load->view('/includes/contentpage', $data);

    }

    public function create(){
        $data["title"] = "Paginas";
           $data['content'] = '/pages/create';
        $data["tab"]="pages";
        $data["tabTitle"]="pages";
        if (!$this->ion_auth->logged_in()){
            $data["showlogin"]=true;
        }
        $this->load->view('/includes/contentpage', $data);
    }

    public function save(){
        $em = $this->doctrine->em;
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Subtitle', 'required');
        $id = $this->input->post('id', TRUE);

        if ($this->form_validation->run()) {
            if (!$id) {
                $page = new \Entities\Pages();
            } else {
                $page = $em->find('Entities\Pages',$id);
            }
            $page->setTitle( $this->input->post('title', TRUE));
            $page->setContent( $this->input->post('content', TRUE));
            $em->persist($page);
            redirect('admin/pagesc/index', 'refresh');
        }
        redirect('admin/pagesc/create', 'refresh');

    }


}