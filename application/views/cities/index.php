	<h2>Cities</h2>
	<table class="table">
		<thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th colspan="2"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cities as $object):?>
            <tr>
            <td><?=$object->id ?></td>
            <td><?= $object->title ?></td>
            <td width="80"><?= anchor('admin/cities/edit/'.$object->id, 'Edit','class="btn btn-warning"'); ?></td>
            <td width="80"><?= anchor('admin/cities/destroy/'.$object->id, 'Destroy','class="btn btn-danger"'); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

	</table>
	
	<?= anchor('admin/cities/create','Create','class="btn btn-primary"'); ?>
