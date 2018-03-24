<h1>Create</h1>
<?= form_open_multipart('admin/services/save', 'role="form"'); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
    <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
<input type="hidden" name="id" value="<?= isset($services) ? $services->id : '' ?>"/>

<div class="form-group">
    <label for="title">Title:</label><br/>
    <input type="text" required class="form-control" name="title" placeholder="Enter Title"
           value="<?= isset($services) ? $services->title : '' ?>"/>

</div>
<div class="form-group">
    <label for="subtitle">Subtitle:</label><br/>
    <input type="text" required class="form-control" name="subtitle" placeholder="Enter Subtitle"
           value="<?= isset($services) ? $services->subtitle : '' ?>"/>

</div>
<div class="form-group">
    <label for="phone">Phone:</label><br/>
    <input type="text" class="form-control" name="phone" placeholder="Enter Phone"
           value="<?= isset($services) ? $services->phone : '' ?>"/>

</div>
<div class="form-group">
    <label for="address">Address:</label><br/>
    <input type="text" class="form-control" name="address" placeholder="Enter Address"
           value="<?= isset($services) ? $services->address : '' ?>"/>

</div>
<div class="form-group">
    <label for="other_phone">Other_phone:</label><br/>
    <input type="text" class="form-control" name="other_phone" placeholder="Enter Other_phone"
           value="<?= isset($services) ? $services->other_phone : '' ?>"/>

</div>
<div class="form-group">
    <label for="email">Email:</label><br/>
    <input type="text" required class="form-control" name="email" placeholder="Enter Email"
           value="<?= isset($services) ? $services->email : '' ?>"/>

</div>
<div class="form-group">
    <label for="url">Url:</label><br/>
    <input type="text" class="form-control" name="url" placeholder="Enter Url"
           value="<?= isset($services) ? $services->url : '' ?>"/>

</div>
<div class="form-group">
    <label for="category_id">Category:</label><br/>
    <select multiple="true" class="custom-selects" name="subcategory_id" placeholder="Escoja la categoria">
        <?php
        foreach ($subcategories as $subcategory) {
//                $is_selected = ($subcategory->category_id==$category->id)?"selected":"";
//            echo "<option value='$subcategory->id' $is_selected>$subcategory->title </option>";
            echo "<option value='$subcategory->id'>$subcategory->title </option>";
        }
        ?>
    </select>
</div>
<div class="form-group">
    <label for="week_days">Week_days:</label><br/>
    <input type="text" class="form-control" name="week_days" placeholder="Enter Week_days"
           value="<?= isset($services) ? $services->week_days : '' ?>"/>

</div>
<div class="form-group">
    <label for="start_time">Start_time:</label><br/>
    <input type="text" class="form-control" name="start_time" placeholder="Enter Start_time"
           value="<?= isset($services) ? $services->start_time : '' ?>"/>

</div>
<div class="form-group">
    <label for="end_time">End_time:</label><br/>
    <input type="text" class="form-control" name="end_time" placeholder="Enter End_time"
           value="<?= isset($services) ? $services->end_time : '' ?>"/>

</div>


<div class="form-group">
    <label for="icon">Icon:</label><br/>
    <input type="file" name="userfile" size="20"/>
</div>
<input type="submit" value="Save" class="btn btn-primary"/>
<?= anchor('admin/services/index', 'Back', 'class="btn btn-link"'); ?>
</form>

