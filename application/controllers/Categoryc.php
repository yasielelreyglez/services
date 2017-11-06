<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/5/2017
 * Time: 7:09 PM
 */

class Categoryc extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Entities\Category');
        $this->load->helper('url_helper');
        $this->load->helper('html');
    }
    public function index()
    {
        $em= $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findAll();
        $data["categories"]=$categories;
        $data['content'] = '/category/index';
        $data["tab"]="category";
        $this->load->view('/includes/template', $data);

    }
    public function destroy($id)
    {
        $em= $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findBy(array("id"=>$id));
        if(count($categories)>0) {
            try{
                $em->remove($categories[0]);
                $em->flush();
            }catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception){
                $segments = array('subcategory', 'category', $id);
                $url_subs =  site_url($segments);
                $data["errors"]= array("Subcategorias asociadas"=>"No se puede eliminar esta categoria porque existen categorias asociadas <a href='".$url_subs."' class=\"alert-link\">ver</a>");
                $this->load->view('templates/header',$data);
                $this->load->view('templates/footer');
            }

        }else{
            $data["errors"]= array("Error eliminando el elemento"=>"No se encontro la categoria a eliminar");
        }


    }
    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('category/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $em= $this->doctrine->em;
            $category =new \Entities\Category();
            $category->setTitle($this->input->post('title'));
            $category->setIcon($this->input->post('icon'));
//            $category->flush();
            $em->persist($category);
            $em->flush();
            $categoriesRepo = $em->getRepository('Entities\Category');
            $categories = $categoriesRepo->findAll();
            $data["categories"]=$categories;
            $this->load->view('category/index',$data);

        }
    }
}