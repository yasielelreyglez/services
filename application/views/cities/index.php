	<table class="table">
		<thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th colspan="2">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cities as $key=>$object):?>
            <tr class="element">
            <td><?=$key+1 ?></td>
            <td class="element-title"><?= $object->title ?></td>
            <td width="80"><?= anchor('admin/cities/edit/'.$object->id, 'Editar','class="btn btn-warning"'); ?></td>
            <td width="80"><?= anchor('admin/cities/destroy/'.$object->id, 'Eliminar','class="btn btn-danger destroy"'); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

	</table>
	
	<?= anchor('admin/cities/create','Crear','class="btn btn-primary"'); ?>
