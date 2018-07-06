	<h2>Categories</h2>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Icon</th>
			<th colspan="2"></th>
		</tr>
		<?php foreach ($pagos as $object) {
		    ?>
		<tr class="element">
			<td><?=$object->id ?></td>
            <td class="element-title"><?= $object->nombre ?></td>
            <td><?= $object->cedula ?></td>
            <td><?= $object->direccion ?></td>
            <td><?= $object->telefono ?></td>
            <td><?= $object->email ?></td>
			<td width="80"><?= anchor('admin/pagos/editfactura/'.$object->id, 'Editar','class="btn btn-warning"'); ?></td>
			<td width="80"><?= anchor('admin/pagos/destroyfactura/'.$object->id, 'Eliminar','class="btn btn-danger destroy"'); ?></td>
		</tr><?php } ?>
	</table>
	
	<?= anchor('admin/categories/create','Crear','class="btn btn-primary"'); ?>
