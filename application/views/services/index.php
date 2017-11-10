	<h2>Services</h2>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Subtitle</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Other_phone</th>
			<th>Email</th>
			<th>Url</th>
			<th>Week_days</th>
			<th>Start_time</th>
			<th>End_time</th>
			<th>Visits</th>

			<th colspan="2"></th>
		</tr>
		<?php foreach ($services as $object) { ?>
		<tr>
			<td><?=$object->id ?></td>
			<td><?= $object->title ?></td>
			<td><?= $object->subtitle ?></td>
			<td><?= $object->phone ?></td>
			<td><?= $object->address ?></td>
			<td><?= $object->other_phone ?></td>
			<td><?= $object->email ?></td>
			<td><?= $object->url ?></td>
			<td><?= $object->week_days ?></td>
			<td><?= $object->start_time ?></td>
			<td><?= $object->end_time ?></td>
			<td><?= $object->visits ?></td>

			<td width="80"><?= anchor('admin/services/edit/'.$object->id, 'Edit','class="btn btn-warning"'); ?></td>
			<td width="80"><?= anchor('admin/services/destroy/'.$object->id, 'Destroy','class="btn btn-danger"'); ?></td>
		</tr><?php } ?>
	</table>
	
	<?= anchor('admin/services/create','Create','class="btn btn-primary"'); ?>
