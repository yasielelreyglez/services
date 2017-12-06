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
        $payments = $paymentsRepo->findAll(array('state' => 'ASC'));
        $data["pagos"]=$payments;
        $data['content'] = '/pagos/index';
        $data["tab"]="pagos";
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