<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Icono</th>
        <th>Icono Mapa</th>
        <th>Categoría</th>
        <th colspan="2">Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($subcategory as $key=>$object): ?>
        <tr class="element">
        <td><?= $key+1 ?></td>
        <td class="element-title"><?= $object->title ?></td>
        <td><img src="<?= $object->icon ?>" height="40px" width="45px" title="<?= $object->icon ?>"
                 alt="<?= $object->icon ?>">
        </td>
            <td><img src="<?= $object->thumb ?>" height="25px" width="25px" title="<?= $object->thumb ?>"
                     alt="<?= $object->thumb ?>">
            </td>
        <td><?= $object->category ?></td>
        <td width="80"><?= anchor('admin/subcategory/edit/' . $object->id, 'Editar', 'class="btn btn-warning"'); ?></td>
        <td width="80"><?= anchor('admin/subcategory/destroy/' . $object->id, 'Eliminar', 'class="btn btn-danger destroy" method="delete"'); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?= anchor('admin/subcategory/create', 'Crear', 'class="btn btn-primary"'); ?>
