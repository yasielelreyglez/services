<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Grupos</th>
        <th colspan="2">Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $key=>$object): ?>
        <tr class="element">
            <td><?= $key+1 ?></td>
            <td class="element-title"><?= $object->username ?></td>
            <td><?= $object->email ?></td>
            <?php /*<td><?= $object->created ?></td>*/ ?>
            <td>
                <?php foreach ($object->groups as $group): ?>
                    <?= $group->name; ?><br/>
                <?php endforeach ?>
            </td>
            <!-- width="80"><?= ($object->active) ? anchor('admin/users/desactive/' . $object->id, 'Active', 'class="btn btn-info"'):''; ?></td-->
            <td width="80"><?= anchor('admin/users/edit/' . $object->id, 'Editar', 'class="btn btn-warning"'); ?></td>
            <td width="80"><?= anchor('admin/users/destroy/' . $object->id, 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<?= anchor('admin/users/create', 'Crear', 'class="btn btn-primary"'); ?>
