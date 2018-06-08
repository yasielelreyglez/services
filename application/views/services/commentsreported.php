<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 6/8/2018
 * Time: 10:15 AM
 */
?>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Comentario</th>
        <th>Servicio</th>
        <th>Usuario</th>
        <th colspan="2">Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($commentsReported as $key=>$object): ?>
        <tr class="element">
            <td><?= $key+1 ?></td>
            <td class="element-title"><?= $object->getComment() ?></td>
            <td><?= anchor('admin/services/show/' . $object->getService()->getId(), $object->getService()->getTitle()); ?></td>
            <td><?= $object->getReportuser()->getUsername() ?></td>
            <td width="80"><?= anchor('admin/services/removeComentReport/' . $object->id, 'Eliminar reporte', 'class="btn btn-warning destroy"'); ?></td>
            <td width="80"><?= anchor('admin/services/destroyComment/' . $object->id, 'Eliminar comentario', 'class="btn btn-danger destroy" method="delete"'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

