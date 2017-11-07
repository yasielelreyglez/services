	<h1>Create</h1>
	<?= form_open('admin/users/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($users)?$users->id:''?>"/>
		
		<div class="form-group">
			<label for="username">Username:</label><br/>
			<input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?= isset($users)?$users->username:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="email">Email:</label><br/>
			<input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?= isset($users)?$users->email:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="password">Password:</label><br/>
			<input type="password" class="form-control" name="password" placeholder="Enter Password" value="<?= isset($users)?$users->password:''?>"/>
			
		</div>

		<div class="form-group">
			<label for="role">Role:</label><br/>
			<input type="text" class="form-control" name="role" placeholder="Enter Role" value="<?= isset($users)?$users->role:''?>"/>
			
		</div>
		<input type="submit" value="Save" class="btn btn-primary"/>
		<?= anchor('admin/users/index','Back','class="btn btn-link"'); ?>
	</form>

