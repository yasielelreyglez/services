	<h2>Services</h2>
	<table class="table">
		<tr>
            <th>Service</th>
            <th>complaint</th>
            <th>date</th>
            <th>user</th>
            <th colspan="2"></th>
		</tr>
		<?php foreach ($complaints as $object) { ?>
		<tr>
            <td><?= $object->getService()->getTitle();?></td>
			<td><?= $object->complaint?></td>
            <td><?= $object->complaint_created->format('Y-m-d H:i:s')?></td>
            <td><?=  $object->getUser()->getUsername();?></td>

			<td width="80"><?= anchor('admin/services/edit/'.$object->getService()->id, 'Edit','class="btn btn-warning"'); ?></td>
			<td width="80"><?= anchor('admin/services/destroy/'.$object->getService()->id, 'Destroy','class="btn btn-danger"'); ?></td>
		</tr><?php } ?>
	</table>
	
	<?= anchor('admin/services/create','Create','class="btn btn-primary"'); ?>
