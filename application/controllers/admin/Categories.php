<?php use Doctrine\Common\Collections\Criteria;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Categories Controller.
 */
class Categories extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Categories_model');
        $this->load->helper('html');
        $this->load->helper('url_helper');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
	}

	# GET /categories
	function index() {
        $em= $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');

        $criteria = new Criteria();
        $criteria->where(Criteria::expr()->neq('id', 1));
        $criteria->orderBy(array("title" => "ASC"));
        $result = $categoriesRepo->matching($criteria);

		$data['categories'] = $result;
		$data['content'] = '/categories/index';
        $data["tab"]="category";
        $data["tabTitle"]="categor&iacute;as";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'categoriesStarBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
		$this->load->view('/includes/contentpage', $data);
	}

	# GET /categories/create
	function create() {
		$data['content'] = '/categories/create';
        $data["tab"]="category";
        $data["tabTitle"]="crear categor&iacute;a";

        $em = $this->doctrine->em;

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'categoriesAddBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
	}

	# GET /categories/edit/1
	function edit($id) {
        $data["tab"] = "category";
        $data["tabTitle"] = "editar categor&iacute;a";
	    if ($id != 1) {
            $em = $this->doctrine->em;
            $data['categories'] = $em->find('Entities\Category', $id);
            $data['content'] = '/categories/create';

            $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
            $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
            if (count($configRegionGlobal))
                $data['configRegionGlobal'] = $configRegionGlobal;

            $banner = $configRegionRepo->findBy(array('region'=>'categoriesEditBanner'), array(), 1);
            if (count($banner))
                $data['banner'] = $banner[0];
        } else {
            $this->session->set_flashdata('item', array('message'=>"No se encontro la categoria a eliminar", 'class'=>'danger'));
            redirect('admin/categories/index', 'refresh');
        }
	}

	# GET /categories/destroy/1
	function destroy($id) {
//		$data['categories'] = $this->Categories_model->destroy($id);
        $em= $this->doctrine->em;
        $categoriesRepo = $em->getRepository('Entities\Category');
        $categories = $categoriesRepo->findBy(array("id"=>$id));
        $categorieDefault = $em->find('Entities\Category',1);
        if(count($categories)>0 && $id != 1) {
            try{
                $subcategoriesRepo = $em->getRepository('Entities\Subcategory');
                $subcategories = $subcategoriesRepo->findAll();

                foreach ($subcategories as $subcategory) {
                    if ($subcategory->getCategory()->getId() == $id) {
                        $subcategory->setCategory($categorieDefault);
                    }
                }

                $imageName = explode('/', $categories[0]->getIcon());
                $pathImage = "./resources/image/categories/" . $imageName[count($imageName) - 1];

                if (is_file($pathImage)) {
                    unlink($pathImage);
                }

                $em->remove($categories[0]);
                $em->flush();

                $this->session->set_flashdata('item', array('message'=>'El elemento ha sido eliminado correctamente.', 'class'=>'success', 'icon'=>'fa fa-warning', 'title'=>"<strong>Bien!:</strong>"));
                redirect('admin/categories/index', 'refresh');
            }catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception){
                $segments = array('admin','subcategory', 'category', $id);
                $url_subs =  site_url($segments);
//                $data["errors"]= array("Subcategorias asociadas"=>"No se puede eliminar esta categoria porque existen categorias asociadas <a href='".$url_subs."' class=\"alert-link\">ver</a>");
                $this->session->set_flashdata('item', array('message'=>"No se puede eliminar esta categoria porque existen categorias asociadas <a href='".$url_subs."' class=\"alert-link\">ver</a>", 'class'=>'danger', 'icon'=>'fa fa-warning', 'title'=>"<strong>Alerta!:</strong>"));
                redirect('admin/categories/index', 'refresh');
            }
        }else{
//            $data["errors"]= array("Error eliminando el elemento"=>"No se encontro la categoria a eliminar");
            $this->session->set_flashdata('item', array('message'=>"No se encontro la categoria a eliminar", 'class'=>'danger'));
            redirect('admin/categories/index', 'refresh');
        }

	}

	# POST /categories/save
	function save() {
		$this->form_validation->set_rules('title', 'Title', 'required');
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
            $config['upload_path']          = './resources/image/categories';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1000;
            $config['max_width']            = 9024;
            $config['max_height']           = 2768;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('userfile')) {
                $data["upload_data"] = $this->upload->data();
                $category->setIcon(site_url('resources/image/categories/'.$data["upload_data"]["file_name"]));
            }
            $data["upload_data"] = $this->upload->data();
            $category->setTitle($this->input->post('title', TRUE));
            $em->persist($category);
            $em->flush();
            $this->session->set_flashdata('item', array('message'=>'Se han guardado sus cambios correctamente.', 'class'=>'success', 'icon'=>'fa fa-thumbs-up', 'title'=>"<strong>Bien!:</strong>"));
            redirect('admin/categories/index', 'refresh');
		}else{
            $data['categories'] =	$this->rebuild();
            $data['content'] = '/categories/create';
            $data["tab"]="category";
            $this->load->view('/includes/contentpage', $data);
        }

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
