	<h1>Create</h1>
	<?= form_open('admin/positions/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($positions)?$positions->id:''?>"/>
		
		<div class="form-group">
			<label for="title">Title:</label><br/>
			<input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= isset($positions)?$positions->title:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="latitude">Latitude:</label><br/>
			<input type="text" class="form-control" name="latitude" placeholder="Enter Latitude" value="<?= isset($positions)?$positions->latitude:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="longitude">Longitude:</label><br/>
			<input type="text" class="form-control" name="longitude" placeholder="Enter Longitude" value="<?= isset($positions)?$positions->longitude:''?>"/>
			
		</div>
		<input type="submit" value="Save" class="btn btn-primary"/>
		<?= anchor('admin/positions/index','Back','class="btn btn-link"'); ?>
	</form>

