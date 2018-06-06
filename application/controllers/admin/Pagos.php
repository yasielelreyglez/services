<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/5/2017
 * Time: 7:09 PM
 */

class Pagos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Entities\Payments');
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
        $data["title"] = "Pagos";
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array(), array('state' => 'ASC'));
        $data["pagos"] = $payments;
        $data['content'] = '/pagos/index';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "pagos";
        $data["Tipo"] = "Realizados";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentStarBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];

        if (!$this->ion_auth->logged_in()) {
            $data["showlogin"] = true;
        }
        $this->load->view('/includes/contentpage', $data);

    }

    public function revision()
    {
        $em = $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '0'), array('state' => 'ASC'));
        $data["pagos"] = $payments;
        $data["title"] = "Pagos";
        $data['content'] = '/pagos/index';
        $data["tab"] = "pagos";
        $data["Tipo"] = "revisión";
        $this->load->view('/includes/contentpage', $data);

    }

    public function solicitados()
    {
        $em = $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '0'), array('state' => 'ASC'));
        $data["pagos"] = $payments;
        $data["title"] = "Pagos";
        $data['content'] = '/pagos/index';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "pagos solicitados";
        $data["Tipo"] = "solicitados";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentRequestedBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);

    }

    public function activos()
    {
        $em = $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '1'), array('state' => 'ASC'));
        $data["pagos"] = $payments;
        $data["title"] = "Pagos";
        $data['content'] = '/pagos/index';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "pagos activos";
        $data["Tipo"] = "activos";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentEnabledBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function facturaciones()
    {
        $em = $this->doctrine->em;
        $repoFactura = $em->getRepository('Entities\Facturacion');
        $solicitudes = $repoFactura->findBy(array(), array('state' => 'ASC'));
        $data["pagos"] = $solicitudes;
        $data["title"] = "Pagos";
        $data['content'] = '/pagos/facturaciones';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "pagos facturados";
        $data["Tipo"] = "activos";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentStarBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function expirados()
    {
        $em = $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '2'), array('state' => 'ASC'));
        $data["pagos"] = $payments;
        $data['content'] = '/pagos/index';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "pagos expirados";
        $data["Tipo"] = "expirados";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentExpiredBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function denegadas()
    {
        $em = $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array('state' => '3'), array('state' => 'ASC'));
        $data["pagos"] = $payments;
        $data['content'] = '/pagos/index';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "pagos denegados";
        $data["Tipo"] = "denegados";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentDeniedBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function show($id)
    {
        $em = $this->doctrine->em;
        $data['payment'] = $em->find('Entities\Payments', $id);;
        $data['content'] = '/pagos/show';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "show pagos";
        $this->load->view('/includes/contentpage', $data);
    }

    public function aceptar($id)
    {
        $em = $this->doctrine->em;

        /** @var \Entities\Payments $payment */
        $payment = $em->find("\Entities\Payments", $id);
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $service = $payment->getService();
        $service->setProfessional(1);
        $payment->autorizar();
        $mensaje = $service->notificarPagoAceptado();
        $em->persist($mensaje);
        $em->persist($service);
        $em->persist($payment);
        $em->flush();
        $this->session->set_flashdata('item', array('message' => 'Se han guardado sus cambios correctamente.', 'class' => 'success'));
        redirect('admin/pagos', 'refresh');

    }

    public function denegar($id)
    {
        $em = $this->doctrine->em;
        $payment = $em->find("\Entities\Payments", $id);

        $payment->denegar();
        $em->persist($payment);
        $em->flush();
        redirect('admin/pagos', 'refresh');
    }

    # POST /pagos/deny
    public function deny()
    {
        $this->form_validation->set_rules('reason', 'Reason', 'required');
        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run()) {
            if ($id) {
                $em = $this->doctrine->em;
                $payment = $em->find("\Entities\Payments", $id);

                $payment->denegar($this->input->post('reason', TRUE));
                $em->persist($payment);
                $em->flush();

                $this->session->set_flashdata('item', array('message' => 'Pago denegado.', 'class' => 'success', 'icon' => 'fa fa-thumbs-up', 'title' => "<strong>Bien!:</strong>"));
                redirect('admin/pagos', 'refresh');

            } else {
                $this->session->set_flashdata('item', array('message' => 'No se ha seleccionado pago para denegar.', 'class' => 'warning', 'icon' => 'fa fa-warning', 'title' => "<strong>Alerta!:</strong>"));
                redirect("admin/pagos/solicitados", 'refresh');
            }
        } else {
            $this->session->set_flashdata('item', array('message' => 'Para denegar un pago debe introducir un motivo.', 'class' => 'warning', 'icon' => 'fa fa-warning', 'title' => "<strong>Alerta!:</strong>"));
            redirect("admin/pagos/solicitados", 'refresh');
        }
    }

    public function eliminar($id)
    {
        $em = $this->doctrine->em;
        $payment = $em->find("\Entities\Payments", $id);
        $em->remove($payment);
        $em->flush();
        redirect('admin/pagos', 'refresh');
    }

    public function membresias()
    {
        $em = $this->doctrine->em;
        $membershipsRepo = $em->getRepository('Entities\Membership');
        $memberships = $membershipsRepo->findAll();
        $data["memberships"] = $memberships;
        $data['content'] = '/pagos/membresias';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "pagos membres&iacute;as";

        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentMembresiaBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function crearmembresia()
    {
        $memberships = new \Entities\Membership();
        $data["memberships"] = $memberships;
        $data['content'] = '/pagos/create';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "crear membres&iacute;a";

        $em = $this->doctrine->em;
        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentMembresiaAddBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    public function editarmembresia($id)
    {
        $em = $this->doctrine->em;
        $memberships = $em->find('Entities\Membership', $id);
        $data["memberships"] = $memberships;
        $data['content'] = '/pagos/create';
        $data["tab"] = "pagos";
        $data["tabTitle"] = "editar membres&iacute;a";
        $configRegionRepo = $em->getRepository('Entities\ConfigRegion');
        $configRegionGlobal = $configRegionRepo->findBy(array('group'=>'global'), array());
        if (count($configRegionGlobal))
            $data['configRegionGlobal'] = $configRegionGlobal;

        $banner = $configRegionRepo->findBy(array('region'=>'paymentMembresiaEditBanner'), array(), 1);
        if (count($banner))
            $data['banner'] = $banner[0];
        $this->load->view('/includes/contentpage', $data);
    }

    function salvarmembresia()
    {
        $em = $this->doctrine->em;
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('days', 'Days', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $membership = new \Entities\Membership();
        if ($this->form_validation->run()) {
            $id = $this->input->post('id', TRUE);
            if ($id) {
                $membership = $em->find('Entities\Membership', $id);
            }
            $membership->setTitle($this->input->post('title', TRUE));
            $membership->setDays($this->input->post('days', TRUE));
            $membership->setPrice($this->input->post('price', TRUE));
            $em->persist($membership);
            $em->flush($membership);
            $this->session->set_flashdata('item', array('message' => 'Se han guardado sus cambios correctamente.', 'class' => 'success', 'icon' => 'fa fa-thumbs-up', 'title' => "<strong>Bien!:</strong>"));
            redirect('admin/pagos/membresias', 'refresh');
        }
        $data['membership'] = $membership;
        $data['content'] = '/pagos/create';
        $data["tab"] = "services";
        $this->load->view('/includes/contentpage', $data);
    }

    public function eliminarmembresia($id)
    {
        $em = $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array("id" => $id));
        if (count($payments) > 0) {
            try {
                $em->remove($payments[0]);
                $em->flush();
            } catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception) {
            }
        } else {
            $data["errors"] = array("Error eliminando el elemento" => "No se encontro el pago a eliminar");
        }


    }

    public function destroy($id)
    {
        $em = $this->doctrine->em;
        $paymentsRepo = $em->getRepository('Entities\Payments');
        $payments = $paymentsRepo->findBy(array("id" => $id));
        if (count($payments) > 0) {
            try {
                $em->remove($payments[0]);
                $em->flush();
                $this->session->set_flashdata('item', array('message' => 'El elemento ha sido eliminado correctamente.', 'class' => 'success', 'icon' => 'fa fa-warning', 'title' => "<strong>Bien!:</strong>"));
            } catch (Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException  $exception) {
            }
        } else {
            $this->session->set_flashdata('item', array('message' => "Error eliminando el elemento\"=>\"No se encontro el pago a eliminar", 'class' => 'danger'));
//            $data["errors"]= array("Error eliminando el elemento"=>"No se encontro el pago a eliminar");
        }


    }

}