	<h1>Create</h1>
	<?= form_open('admin/cities/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($cities)?$cities->id:''?>"/>
		
		<div class="form-group">
			<label for="title">Title:</label><br/>
			<input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= isset($cities)?$cities->title:''?>"/>
			
		</div>
		<input type="submit" value="Save" class="btn btn-primary"/>
		<?= anchor('admin/cities/index','Back','class="btn btn-link"'); ?>
	</form>

