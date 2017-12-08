<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/5/2017
 * Time: 7:09 PM
 */

class Pagos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Entities\Payments');
        $this->load->helper('url_helper');
        $this->load->helper('html');
    }
    public function index()
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array(),array('state' => 'ASC'));
        $data["pagos"]=$payments;
        $data['content'] = '/pagos/index';
        $data["tab"]="pagos";
        $data["Tipo"]="";
        $this->load->view('/includes/contentpage', $data);

    }

    public function revision()
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '0'),array('state' => 'ASC'));
        $data["pagos"]=$payments;
        $data['content'] = '/pagos/index';
        $data["tab"]="pagos";
        $data["Tipo"]="revisión";
        $this->load->view('/includes/contentpage', $data);

    }

    public function solicitados()
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '0'),array('state' => 'ASC'));
        $data["pagos"]=$payments;
        $data['content'] = '/pagos/index';
        $data["tab"]="pagos";
        $data["Tipo"]="solicitados";
        $this->load->view('/includes/contentpage', $data);

    }
    public function activos()
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '1'),array('state' => 'ASC'));
        $data["pagos"]=$payments;
        $data['content'] = '/pagos/index';
        $data["tab"]="pagos";
        $data["Tipo"]="activos";
        $this->load->view('/includes/contentpage', $data);

    }
    public function expirados()
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '2'),array('state' => 'ASC'));
        $data["pagos"]=$payments;
        $data['content'] = '/pagos/index';
        $data["tab"]="pagos";
        $data["Tipo"]="expirados";
        $this->load->view('/includes/contentpage', $data);
    }
    public function denegadas()
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '3'),array('state' => 'ASC'));
        $data["pagos"]=$payments;
        $data['content'] = '/pagos/index';
        $data["tab"]="pagos";
        $data["Tipo"]="denegados";
        $this->load->view('/includes/contentpage', $data);
    }


    public function aceptar($id){
        $em = $this->doctrine->em;
        $payment = $em->find("\Entities\Payments", $id);
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $service = $payment->getService();
        $service->setProfessional(1);
        $payment->autorizar();
        $em->persist($service);
        $em->persist($payment);
        $em->flush();
        redirect('admin/pagos', 'refresh');

    }
    public function denegar($id){
        $em = $this->doctrine->em;
        $payment = $em->find("\Entities\Payments", $id);

        $payment->denegar();
        $em->persist($payment);
        $em->flush();
        redirect('admin/pagos', 'refresh');
    }

    public function membresias()
    {
        $em= $this->doctrine->em;
        $membershipsRepo = $em->getRepository('Entities\Membership');
        $memberships = $membershipsRepo->findAll();
        $data["memberships"]=$memberships;
        $data['content'] = '/pagos/membresias';
        $data["tab"]="pagos";
        $this->load->view('/includes/contentpage', $data);
    }
    public function crearmembresia()
    {
        $memberships = new \Entities\Membership();
        $data["memberships"]=$memberships;
        $data['content'] = '/pagos/create';
        $data["tab"]="pagos";
        $this->load->view('/includes/contentpage', $data);
    }
    public function editarmembresia($id)
    {
        $em= $this->doctrine->em;

        $memberships =$em->find('Entities\Membership',$id);
        $data["memberships"]=$memberships;
        $data['content'] = '/pagos/create';
        $data["tab"]="pagos";
        $this->load->view('/includes/contentpage', $data);
    }

    function salvarmembresia() {
        $em= $this->doctrine->em;
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('days', 'Days', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $membership = new \Entities\Membership();
        if ($this->form_validation->run()) {
            $id = $this->input->post('id', TRUE);
            if($id){
                $membership = $em->find('Entities\Membership',$id);
            }
            $membership->setTitle($this->input->post('title', TRUE));
            $membership->setDays($this->input->post('days', TRUE));
            $membership->setPrice($this->input->post('price', TRUE));
            $em->persist($membership);
            $em->flush($membership);
            redirect('admin/pagos/index', 'refresh');
        }
        $data['membership'] =	$membership;
        $data['content'] = '/pagos/create';
        $data["tab"]="services";
        $this->load->view('/includes/contentpage', $data);
    }
    public function eliminarmembresia($id)
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array("id"=>$id));
        if(count($payments)>0) {
            try{
                $em->remove($payments[0]);
                $em->flush();
            }catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception) {
            }
        }else{
            $data["errors"]= array("Error eliminando el elemento"=>"No se encontro el pago a eliminar");
        }


    }
    public function destroy($id)
    {
        $em= $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array("id"=>$id));
        if(count($payments)>0) {
            try{
                $em->remove($payments[0]);
                $em->flush();
            }catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception) {
            }
        }else{
            $data["errors"]= array("Error eliminando el elemento"=>"No se encontro el pago a eliminar");
        }


    }

}