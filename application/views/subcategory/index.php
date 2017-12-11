	<h2>Subcategory</h2>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Icon</th>
			<th colspan="2"></th>
		</tr>
		<?php foreach ($subcategory as $object) { ?>
		<tr>
			<td><?=$object->id ?></td>
			<td><?= $object->title ?></td>
            <td><img src="<?= $object->icon ?>" height="40px" width="45px" title="<?= $object->icon ?>" alt="<?= $object->icon ?>"></td>

            <td width="80"><?= anchor('admin/subcategory/edit/'.$object->id, 'Edit','class="btn btn-warning"'); ?></td>
			<td width="80"><?= anchor('admin/subcategory/destroy/'.$object->id, 'Destroy','class="btn btn-danger" method="delete"'); ?></td>
		</tr><?php } ?>
	</table>
	
	<?= anchor('admin/subcategory/create','Create','class="btn btn-primary"'); ?>
