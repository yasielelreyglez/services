<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="col-md-9 offset-1">
	<h1>Administrando membresias</h1>

	<div id="body">

	<table class="table table-striped table-bordered">
        <thead>
            <th>Tipo</th>
            <th>Dias</th>
            <th>Precio</th>
            <th>Creado</th>
        </thead>
        <tbody>
        <?php
        foreach ($memberships as $membership) {
            echo "<tr>
                        <td>{$membership->getTitle()}</td>
                        <td>{$membership->getDays()}</td>
                        <td>{$membership->getPrice()}</td>
                    
                     <td width=\"80\">".anchor('admin/pagos/editarmembresia/'.$membership->id, 'Editar','class=\"btn btn-info\" method=\"get\"')."</td>
                     <td width=\"80\">".anchor('admin/pagos/elminarmembresia/'.$membership->id, 'Eliminar','class=\"btn btn-info\" method=\"get\"')."</td>
                ";
        }
        ?>
        </tbody>
    </table>
    </div>
    <?= anchor('admin/pagos/crearmembresia','Crear','class="btn btn-primary"'); ?>

</div>