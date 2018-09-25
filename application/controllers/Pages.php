<?php use Doctrine\Common\Collections\Criteria;
/**
 * Created by PhpStorm.
 * User: yoidel86
 * Date: 24/09/2018
 * Time: 13:51
 */

class Pages extends CI_Controller {
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
    public function show($id)
    {
        $em = $this->doctrine->em;
        /** @var \Entities\Service $service */
        $pages = $em->find("\Entities\Page", $id);

        $data["title"] = $pages->getTitle();
        $data["page"] = $pages;
        $data['content'] = '/pages/show';
        $data["tab"] = "pages";
        $data["tabTitle"] = "pages";
        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('groupRegion'=> 'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region' => 'pageShowBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0]->getBanner();
        $this->load->view('/includes/contentpage', $data);
    }

}