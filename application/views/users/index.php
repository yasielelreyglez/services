	<h2>Users</h2>
	<table class="table">
		<thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
<!--            <th>Created</th>-->
            <th>Role</th>
            <th colspan="2"></th>
        </tr>
        </thead>
       <tbody>
       <?php foreach ($users as $object): ?>
           <tr>
           <td><?=$object->id ?></td>
           <td><?= $object->username ?></td>
           <td><?= $object->email ?></td>
           <?php /*<td><?= $object->created ?></td>*/?>
           <td><?= $object->getRole() ?></td>
           <td width="80"><?= anchor('admin/users/edit/'.$object->id, 'Edit','class="btn btn-warning"'); ?></td>
           <td width="80"><?= anchor('admin/users/destroy/'.$object->id, 'Destroy','class="btn btn-danger"'); ?></td>
           </tr>
       <?php endforeach; ?>
       </tbody>

	</table>

	<?= anchor('admin/users/create','Create','class="btn btn-primary"'); ?>
