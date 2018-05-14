<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="header-listing">
    <ul class="listing-views">
        <li><a name="listview" href="#"><i class="fa fa-list"></i></a></li>
        <li class="active"><a name="gridview" href="#"><i class="fa fa-th"></i></a></li>
    </ul>
</div>
<div id="body" class="listing listing-1 ">
    <div class="container">
        <div class="row listview">
            <table class="table">
                <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Contenido</th>
                <th colspan="3"></th>
                </thead>
                <tbody>
                    <?php foreach ($pages as $page): ?>
                        <tr class="element">
                            <td><?php echo $page->id; ?></td>
                            <td><?php echo $page->title; ?></td>
                            <td><?php echo $page->content; ?></td>
                                <td width=\"80\"><?= anchor('admin/pagesc/ver/' . $page->id, 'Ver', 'class="btn btn-info"'); ?></td>
                                <td width=\"80\"><?= anchor('admin/pagesc/editar/' . $page->id, 'Editar', 'class="btn btn-warning"'); ?></td>
                                <td width=\"80\"><?= anchor('admin/pagesc/eliminar/' . $page->id, 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?= anchor('admin/pagesc/create' , 'Crear', 'class="btn btn-info"'); ?>
    </div>

</div>