<?php
/**
 * Created by PhpStorm.
 * User: yoidel86
 * Date: 14/05/2018
 * Time: 8:39
 */

class Pagesc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        }
    }

    public function index()
    {
        $em = $this->doctrine->em;
        $data["title"] = "Paginas";
        $pagesRepo = $em->getRepository('Entities\Pages');
        $pages = $pagesRepo->findAll();
        $data["pages"] = $pages;
        $data['content'] = '/pages/index';
        $data["tab"] = "pages";
        $data["tabTitle"] = "pages";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }

        $bannersRepo = $em->getRepository('Entities\Banner');
        $banner = $bannersRepo->findBy(array('name' => 'páginas'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);

    }

    public function create()
    {
        $data["title"] = "Paginas";
        $data['content'] = '/pages/create';
        $data["tab"] = "pages";
        $data["tabTitle"] = "pages";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }
        $em = $this->doctrine->em;

        $bannersRepo = $em->getRepository('Entities\Banner');
        $banner = $bannersRepo->findBy(array('name' => 'crear página'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function editar($id)
    {
        $em = $this->doctrine->em;
        /** @var \Entities\Service $service */
        $pages = $em->find("\Entities\Pages", $id);

        $data["title"] = "Paginas";
        $data["page"] = $pages;
        $data['content'] = '/pages/create';
        $data["tab"] = "pages";
        $data["tabTitle"] = "pages";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }

        $bannersRepo = $em->getRepository('Entities\Banner');
        $banner = $bannersRepo->findBy(array('name' => 'editar página'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function show($id)
    {
        $em = $this->doctrine->em;
        /** @var \Entities\Service $service */
        $pages = $em->find("\Entities\Pages", $id);

        $data["title"] = $pages->getTitle();
        $data["page"] = $pages;
        $data['content'] = '/pages/show';
        $data["tab"] = "pages";
        $data["tabTitle"] = "pages";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }

        $bannersRepo = $em->getRepository('Entities\Banner');
        $banner = $bannersRepo->findBy(array('name' => 'página'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function personalize()
    {
        $em = $this->doctrine->em;
        $bannersRepo = $em->getRepository('Entities\Banner');
        $banners = $bannersRepo->findAll();
        $data["banners"] = $banners;
        $pagesRepo = $em->getRepository('Entities\Pages');
        $pages = $pagesRepo->findAll();
        $data["pages"] = $pages;
        $data['content'] = '/pages/personalize';
        $data["tab"] = "pages";
        $data["tabTitle"] = "Personalizar";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }

        $bannersRepo = $em->getRepository('Entities\Banner');
        $banner = $bannersRepo->findBy(array('name' => 'personalizar'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function createBanner()
    {
        $data["title"] = "Crear banner";
        $data['content'] = '/pages/createbanner';
        $data["tab"] = "pages";
        $data["tabTitle"] = "Crear banner";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }

        $em = $this->doctrine->em;
        $bannersRepo = $em->getRepository('Entities\Banner');
        $banner = $bannersRepo->findBy(array('name' => 'crear banner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }
    public function editBanner($id)
    {
        $data["title"] = "Crear banner";
        $data['content'] = '/pages/createbanner';
        $data["tab"] = "pages";
        $data["tabTitle"] = "Crear banner";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }
        $em = $this->doctrine->em;
        $banner = $em->find('Entities\Banner', $id);
//        $banner = $bannersRepo->findBy(array('name' => 'crear banner'), array(), 1);
//        if (count($banner))
//            $data['banner'] = $banner[0];
        $data['banner'] = $banner;
        $this->load->view('/includes/contentpage', $data);
    }

    public function images()
    {
        $data['content'] = '/pages/images';
        $data["tab"] = "pages";
        $data["tabTitle"] = "Imágenes";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }

        $dirContent = scandir('./resources/img/');
        $data['dirContent'] = $dirContent;

        $em = $this->doctrine->em;

        $bannersRepo = $em->getRepository('Entities\Banner');
        $banner = $bannersRepo->findBy(array('name' => 'imágenes'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function addImages()
    {
        $fotos = $_FILES['userfile'];
        $fotoSubir = array();
        for ($i = 0; $i < count($_FILES["userfile"]["tmp_name"]); $i++) {
            $fotoSubir[$i]['filename'] = $fotos['name'][$i];
            $fotoSubir[$i]['value'] = $fotos['tmp_name'][$i];
        }

        $this->addFotos($fotoSubir, true);

        $this->session->set_flashdata('item', array('message' => 'Se han guardado sus cambios correctamente.', 'class' => 'success', 'icon' => 'fa fa-thumbs-up', 'title' => "<strong>Bien!:</strong>"));
        redirect('admin/pagesc/images', 'refresh');
    }

    public function addFotos(Array $fotos)
    {
        if (!is_dir("./resources/imga")) {
            mkdir("./resources/imga/");
        }
        foreach ($fotos as $icon) {
            $path = "./resources/img/" . $icon['filename'];

            move_uploaded_file($icon['value'], $path);
        }
    }

    public function save()
    {
        $em = $this->doctrine->em;
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('content', 'Subtitle', 'required');
        $id = $this->input->post('id', TRUE);

        if ($this->form_validation->run()) {
            if (!$id) {
                $page = new \Entities\Pages();
            } else {
                $page = $em->find('Entities\Pages', $id);
            }
            $page->setTitle($this->input->post('title', TRUE));
            $page->setContent($this->input->post('content', TRUE));
            $em->persist($page);
            $em->flush();
            redirect('admin/pagesc/index', 'refresh');
        }
        redirect('admin/pagesc/index', 'refresh');

    }

    public function saveBanner()
    {
        $em = $this->doctrine->em;
        $this->form_validation->set_rules('title', 'Title', 'required');
        $id = $this->input->post('id', TRUE);

        try {
            if ($this->form_validation->run()) {
                if (!$id) {
                    $banner = new \Entities\Banner();
                } else {
                    $banner = $em->find('Entities\Banner', $id);
                }
                $banner->setName($this->input->post('name', TRUE) ? $this->input->post('name', TRUE) : $this->input->post('title', TRUE));
                $banner->setTitle($this->input->post('title', TRUE));
                $banner->setSubtitle($this->input->post('subtitle', TRUE));
                $banner->setImage($this->input->post('urlimagen', TRUE));
                $em->persist($banner);
                $em->flush();
                $this->session->set_flashdata('item', array('message' => 'Se han guardado sus cambios correctamente.', 'class' => 'success', 'icon' => 'fa fa-thumbs-up', 'title' => "<strong>Bien!:</strong>"));
                redirect('admin/pagesc/personalize', 'refresh');
            }
            redirect('admin/pagesc/personalize', 'refresh');
        } catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException $exception) {
            echo '<pre>';
            print_r($exception);
            echo '</pre>';
        }
    }

    public function destroyBanner($id){
        $em = $this->doctrine->em;
        $banner = $em->find("\Entities\Banner", $id);
        $em->remove($banner);
        $em->flush();
        $this->session->set_flashdata('item', array('message'=>'El elemento ha sido eliminado correctamente.', 'class'=>'success', 'icon'=>'fa fa-warning', 'title'=>"<strong>Bien!:</strong>"));
        redirect('admin/pagesc/personalize', 'refresh');
    }
}