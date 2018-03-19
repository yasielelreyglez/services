	<h2>Positions</h2>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Latitude</th>
			<th>Longitude</th>
			<th>Service</th>
			<th colspan="2"></th>
		</tr>
		<?php foreach ($positions as $object) { ?>
		<tr>
			<td><?=$object->id ?></td>
			<td><?= $object->title ?></td>
			<td><?= $object->latitude ?></td>
			<td><?= $object->longitude ?></td>
			<td><?= $object->getService()->getTitle(); ?></td>
			<td width="80"><?= anchor('admin/positions/edit/'.$object->id, 'Edit','class="btn btn-warning"'); ?></td>
			<td width="80"><?= anchor('admin/positions/destroy/'.$object->id, 'Destroy','class="btn btn-danger"'); ?></td>
		</tr><?php } ?>
	</table>
	
	<?= anchor('admin/positions/create','Create','class="btn btn-primary"'); ?>
