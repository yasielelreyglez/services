<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="col-md-9 offset-1">
	<h1>Administrando pagos <?=$Tipo?></h1>

	<div id="body">

	<table class="table table-striped table-bordered">
        <thead>
            <th>Servicio</th>
            <th>Membresia</th>
            <th>Tipo pago</th>
            <th>Evidencia</th>
            <th>Pais</th>
            <th>Telefono</th>
            <th>Estado</th>
            <th>Aceptar</th>
            <th>Denegar</th>
            <th>Eliminar</th>
        </thead>
        <tbody>
        <?php

        foreach ($pagos as $pago) {
        if($pago->getMembership()){
          $memb ="<td>{$pago->getMembership()->getTitle()}</td>";
                         }else {
            $memb = "  <td></td>";
        }

            echo "<tr>
                        <td><a href='".site_url('admin/services/show/').$pago->getService()->id."'>".$pago->getService()->getTitle()."</a> </td>
                        $memb
                        
                        <td>{$pago->getTypeString()}</td>
                        <td><img src='".base_url().$pago->getEvidence()."' height='50px' width='50px'></td>
                        <td>{$pago->getCountry()}</td>
                        <td>{$pago->getPhone()}</td>
                        <td>{$pago->getStateString()}</td>
                       ";
            if($pago->getState()==0){
                echo " <td width=\"80\">".anchor('admin/pagos/aceptar/'.$pago->id, 'Aceptar pago','class=\"btn btn-info\" method=\"get\"')."</td>
                        <td width=\"80\">".anchor('admin/pagos/denegar/'.$pago->id, 'Denegar pago','class=\"btn btn-info\" method=\"get\"')."</td>
                        <td width=\"80\">".anchor('admin/pagos/eliminar/'.$pago->id, 'Eliminar pago','class=\"btn btn-info\" method=\"get\"')."</td>
                ";
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
</div>