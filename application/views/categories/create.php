	<?= form_open_multipart('admin/categories/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($categories)?$categories->id:''?>"/>
		<div class="form-group">
			<label for="title">Título:</label><br/>
			<input type="text" required class="form-control" name="title" placeholder="Escriba el título" value="<?= isset($categories)?$categories->title:''?>"/>
		</div>
		<div class="form-group">
			<label for="icon">Icono:</label><br/>
            <?php if(isset($categories)){ ?>
            <img src="<?=$categories->icon?>" width="80px" height="70px"/>
            <?php } ?>
            <input type="file" <?php if(!isset($categories)){ ?>required<?php } ?> name="userfile" id="userfile" size="20" />
        </div>
    <div id="image_preview" style="height: 80px;width:70px;" >

    </div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<?= anchor('admin/categories/index','Atras','class="btn btn-link"'); ?>
	</form>




    <br /><br />


