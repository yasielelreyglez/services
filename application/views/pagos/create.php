
	<?= form_open('admin/pagos/salvarmembresia','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($memberships)?$memberships->id:''?>"/>
		
		<div class="form-group">
			<label for="title">Título:</label><br/>
			<input type="text" required class="form-control" name="title" placeholder="Escriba el título" value="<?= isset($memberships)?$memberships->title:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="days">Días:</label><br/>
			<input type="text" required class="form-control" name="days" placeholder="Cantidad de días" value="<?= isset($memberships)?$memberships->days:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="price">Precio:</label><br/>
			<input type="text" required class="form-control" name="price" placeholder="Precio de la membresia" value="<?= isset($memberships)?$memberships->price:''?>"/>
			
		</div>

		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<?= anchor('admin/pagos/membresias','Atras','class="btn btn-link"'); ?>
	</form>


