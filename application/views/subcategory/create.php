	<?= form_open_multipart('admin/subcategory/save','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($subcategory)?$subcategory->id:''?>"/>
		<div class="form-group">
			<label for="title">Título:</label><br/>
			<input type="text" required class="form-control" name="title" placeholder="Escriba el título" value="<?= isset($subcategory)?$subcategory->title:''?>"/>
		</div>
        <div class="form-group">
            <label for="icon">Icono:</label><br/>
            <?php if(isset($subcategory)){ ?>
                <img src="<?=$subcategory->icon?>" width="80px" height="70px"/>
            <?php } ?>
            <div id="image_preview" class="hide" style="height: 80px;width:70px;" >
            </div>
            <input type="file" <?php if(!isset($subcategory)){ ?>required<?php } ?> name="userfile" id="userfile" size="20" value="<?= isset($subcategory)?$subcategory->icon:''?>"/>
        </div>
    <div class="form-group">
        <label for="icon">Icono Mapa:</label><br/>
        <?php if(isset($subcategory)){ ?>
            <img src="<?=$subcategory->thumb?>" width="25px" height="25px"/>
        <?php } ?>
        <div id="image_preview_mapa" class="hide" style="height: 25px;width:25px;" >
        </div>
        <input type="file" <?php if(!isset($subcategory)){ ?>required<?php } ?> name="thumb" id="thumb" size="20" value="<?= isset($subcategory)?$subcategory->thumb:''?>"/>
    </div>


        <div class="form-group">
            <label for="category_id">Categoría:</label><br/>
            <select type="text" class="custom-select" required name="category_id" placeholder="Escoja la categoría" value="<?= isset($subcategory)?$subcategory->category_id:''?>">
                <?php
                if (isset($subcategory)) {
                    $currentcat = $subcategory->getCategory()->getId();
                    foreach ($categories as $category) {
                        $is_selected = ($currentcat == $category->id) ? "selected" : "";
                        echo "<option value='$category->id' $is_selected>$category->title</option>";
                    }
                } else {
                    foreach ($categories as $category) {
                        echo "<option value='$category->id'>$category->title</option>";
                    }
                }
                ?>
            </select>
        </div>
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<?= anchor('admin/subcategory/index','Atras','class="btn btn-link"'); ?>
	</form>

