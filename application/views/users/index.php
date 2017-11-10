	<h2>Users</h2>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Username</th>
			<th>Email</th>
			<th>Created</th>
			<th>Role</th>
			<th colspan="2"></th>
		</tr>
		<?php foreach ($users as $object) { ?>
		<tr>
			<td><?=$object->id ?></td>
			<td><?= $object->username ?></td>
			<td><?= $object->email ?></td>
			<td><?= $object->created ?></td>
			<td><?= $object->role ?></td>
			<td width="80"><?= anchor('admin/users/edit/'.$object->id, 'Edit','class="btn btn-warning"'); ?></td>
			<td width="80"><?= anchor('admin/users/destroy/'.$object->id, 'Destroy','class="btn btn-danger"'); ?></td>
		</tr><?php } ?>
	</table>
	
	<?= anchor('admin/users/create','Create','class="btn btn-primary"'); ?>
