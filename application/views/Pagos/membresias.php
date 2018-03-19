<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<table class="table">
    <thead>
    <th>Tipo</th>
    <th>Dias</th>
    <th>Precio</th>
    <th>Creado</th>
    <th>Editar</th>
    <th>Eliminar</th>
    </thead>
    <tbody>
    <?php foreach ($memberships as $membership): ?>
        <tr>
            <td><?= $membership->getTitle(); ?></td>
            <td><?= $membership->getDays(); ?></td>
            <td><?= $membership->getPrice(); ?></td>
            <td><?= $membership->created_at->format('Y-m-d H:i:s'); ?></td>
            <td width="80"><?= anchor('admin/pagos/editarmembresia/' . $membership->id, 'Editar', 'class="btn btn-warning"'); ?></td>
            <td width="80"><?= anchor('admin/pagos/elminarmembresia/' . $membership->id, 'Eliminar', 'class="btn btn-danger"'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?= anchor('admin/pagos/crearmembresia', 'Crear', 'class="btn btn-primary"'); ?>

</div>