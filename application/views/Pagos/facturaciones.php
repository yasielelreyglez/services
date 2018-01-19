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
		<tr>
			<td><?=$object->id ?></td>
            <td><?= $object->nombre ?></td>
            <td><?= $object->cedula ?></td>
            <td><?= $object->direccion ?></td>
            <td><?= $object->telefono ?></td>
            <td><?= $object->email ?></td>
			<td width="80"><?= anchor('admin/pagos/editfactura/'.$object->id, 'Edit','class="btn btn-warning"'); ?></td>
			<td width="80"><?= anchor('admin/pagos/destroyfactura/'.$object->id, 'Destroy','class="btn btn-danger"'); ?></td>
		</tr><?php } ?>
	</table>
	
	<?= anchor('admin/categories/create','Create','class="btn btn-primary"'); ?>
