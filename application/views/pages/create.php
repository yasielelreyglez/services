

<?= form_open('admin/pagesc/save','role="form" id="page_form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($page)?$page->id:''?>"/>
		
		<div class="form-group">
			<label for="title">Título:</label><br/>
			<input type="text" required class="form-control" name="title" placeholder="Escriba el título" value="<?= isset($page)?$page->title:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="days">Contenido:</label><br/>
            <textarea name="content" id="content"><?= isset($page)?$page->getContent():''?></textarea>
		</div>
		<div id="save" value="" class="btn btn-primary">Guardar</div>
		<?= anchor('admin/pagesc/personalize','Cancelar','class="btn btn-link"'); ?>
	</form>


