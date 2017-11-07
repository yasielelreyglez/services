	<h1>Create</h1>
	<?= form_open('admin/subcategory/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($subcategory)?$subcategory->id:''?>"/>
		
		<div class="form-group">
			<label for="title">Title:</label><br/>
			<input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= isset($subcategory)?$subcategory->title:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="icon">Icon:</label><br/>
			<input type="text" class="form-control" name="icon" placeholder="Enter Icon" value="<?= isset($subcategory)?$subcategory->icon:''?>"/>
			
		</div>
    <div class="form-group">
        <label for="icon">Icon:</label><br/>
        <select type="text" class="form-control" name="icon" placeholder="Enter Icon" value="<?= isset($subcategory)?$subcategory->category_id:''?>">
            <?php
            foreach ($categories as $category) {
                $is_selected = ($subcategory->category_id==$category->category_id)?"selected":"";
                echo "<option value'$category->category_id' $is_selected>$category->title </option>";
            }
            ?>
        </select>
    </div>
		<input type="submit" value="Save" class="btn btn-primary"/>
		<?= anchor('admin/subcategory/index','Back','class="btn btn-link"'); ?>
	</form>

