	<h1>Create</h1>
	<?= form_open('admin/categories/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($categories)?$categories->id:''?>"/>
		
		<div class="form-group">
			<label for="title">Title:</label><br/>
			<input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= isset($categories)?$categories->title:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="icon">Icon:</label><br/>
			<input type="text" class="form-control" name="icon" placeholder="Enter Icon" value="<?= isset($categories)?$categories->icon:''?>"/>
			
		</div>
		<input type="submit" value="Save" class="btn btn-primary"/>
		<?= anchor('admin/categories/index','Back','class="btn btn-link"'); ?>
	</form>

