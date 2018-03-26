	<?= form_open('admin/cities/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($cities)?$cities->id:''?>"/>
		<div class="form-group">
			<label for="title">Título:</label><br/>
			<input type="text" required class="form-control" name="title" placeholder="Escriba el título" value="<?= isset($cities)?$cities->title:''?>"/>
		</div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<?= anchor('admin/cities/index','Atras','class="btn btn-link"'); ?>
	</form>

