	<h1>Create</h1>
	<?= form_open('admin/pagos/salvarmembresia','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($memberships)?$memberships->id:''?>"/>
		
		<div class="form-group">
			<label for="title">Title:</label><br/>
			<input type="text" required class="form-control" name="title" placeholder="Escriba el titulo" value="<?= isset($memberships)?$memberships->title:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="days">Dias:</label><br/>
			<input type="text" required class="form-control" name="days" placeholder="Cantidad de dias" value="<?= isset($memberships)?$memberships->days:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="price">Price:</label><br/>
			<input type="text" required class="form-control" name="price" placeholder="Precio de la membresia" value="<?= isset($memberships)?$memberships->price:''?>"/>
			
		</div>

		<input type="submit" value="Save" class="btn btn-primary"/>
		<?= anchor('admin/pagos/membresias','Back','class="btn btn-link"'); ?>
	</form>


