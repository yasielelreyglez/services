<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<table class="table">
    <thead>
    <th>#</th>
    <th>Título</th>
    <th>Días</th>
    <th>Precio</th>
    <th>Creado</th>
    <th colspan="2">Acciones</th>
    </thead>
    <tbody>
    <?php foreach ($memberships as $key=>$membership): ?>
        <tr class="element">
            <td><?= $key+1; ?></td>
            <td class="element-title"><?= $membership->getTitle(); ?></td>
            <td><?= $membership->getDays(); ?></td>
            <td><?= $membership->getPrice(); ?></td>
            <td><?= $membership->created_at->format('Y-m-d H:i:s'); ?></td>
            <td width="80"><?= anchor('admin/pagos/editarmembresia/' . $membership->id, 'Editar', 'class="btn btn-warning"'); ?></td>
            <td width="80"><?= anchor('admin/pagos/elminarmembresia/' . $membership->id, 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?= anchor('admin/pagos/crearmembresia', 'Crear', 'class="btn btn-primary"'); ?>

</div>