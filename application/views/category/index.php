<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div class="col-md-9 offset-1">
	<h1>Administrando Categorias</h1>

	<div id="body">

	<table class="table table-striped table-bordered">
        <thead>
        <th>Titulo</th>
        <th>icono</th>
        </thead>
        <tbody>
        <?php

        foreach ($categories as $category) {
            echo "<tr>
                        <td>".$category->getTitle()."</td>
                        <td><img src='".base_url().$category->getIcon()."' height='50px' width='50px'></td>
                        <td width=\"80\">".anchor('/categoryc/destroy/'.$category->id, 'Destroy','class=\"btn btn-danger\" method=\"delete\"')."</td>
                        </tr>";
        }
        ?>
        </tbody>
    </table>
    </div>

  <div class="btn btn-default"><a href="<?php echo site_url('categoryc/create'); ?>">Nueva categoria </a></div>

</div>