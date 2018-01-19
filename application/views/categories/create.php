	<h1>Create</h1>
	<?= form_open_multipart('admin/categories/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($categories)?$categories->id:''?>"/>
		<div class="form-group">
			<label for="title">Title:</label><br/>
			<input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= isset($categories)?$categories->title:''?>"/>
		</div>
		<div class="form-group">
			<label for="icon">Icon:</label><br/>
            <?php if(isset($categories)){ ?>
            <img src="<?=$categories->icon?>" width="80px" height="70px"/>
            <?php } ?>
            <input type="file" name="userfile" size="20" />
        </div>
		<input type="submit" value="Save" class="btn btn-primary"/>
		<?= anchor('admin/categories/index','Back','class="btn btn-link"'); ?>
	</form>




    <br /><br />


