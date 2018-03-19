	<h1>Create</h1>
	<?= form_open_multipart('api/createservice','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($services)?$services->id:''?>"/>
<!--		--><?php //print_r($services);
//		die;
//		?>
		<div class="form-group">
			<label for="title">Title:</label><br/>
			<input disabled type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= isset($services)?$services->title:''?>"/>
			

			<label for="subtitle">Subtitle:</label><br/>
			<input disabled type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="<?= isset($services)?$services->subtitle:''?>"/>
			

			<label for="phone">Phone:</label><br/>
			<input disabled type="text" class="form-control" name="phone" placeholder="Enter Phone" value="<?= isset($services)?$services->phone:''?>"/>
			

			<label for="address">Address:</label><br/>
			<input disabled type="text" class="form-control" name="address" placeholder="Enter Address" value="<?= isset($services)?$services->address:''?>"/>
			

			<label for="other_phone">Other_phone:</label><br/>
			<input disabled type="text" class="form-control" name="other_phone" placeholder="Enter Other_phone" value="<?= isset($services)?$services->other_phone:''?>"/>
			

			<label for="email">Email:</label><br/>
			<input disabled type="text" class="form-control" name="email" placeholder="Enter Email" value="<?= isset($services)?$services->email:''?>"/>
			

			<label for="url">Url:</label><br/>
			<input disabled type="text" class="form-control" name="url" placeholder="Enter Url" value="<?= isset($services)?$services->url:''?>"/>

            <div class="form-group">
                <label for="week_days">week_days:</label><br/>
                    <?php foreach ($times as $time):?>
                        <input disabled type="text" class="form-control" name="url" placeholder="Enter Url" value="<?= isset($time)?$time->week_days:''?>"/>
                    <?php endforeach;?>
            </div>
			<?php /*<label for="week_days">Week_days:</label><br/>
			<input disabled type="text" class="form-control" name="week_days" placeholder="Enter Week_days" value="<?= isset($services)?$services->week_days:''?>"/>
			*/?>
		</div>
    <?php /*<div class="form-group">
			<label for="start_time">Start_time:</label><br/>
			<input disabled type="text" class="form-control" name="start_time" placeholder="Enter Start_time" value="<?= isset($services)?$services->start_time:''?>"/>

		</div>
		<div class="form-group">
			<label for="end_time">End_time:</label><br/>
			<input disabled type="text" class="form-control" name="end_time" placeholder="Enter End_time" value="<?= isset($services)?$services->end_time:''?>"/>

		</div>
 */?>
		<div class="form-group">
			<label for="visits">Visits:</label><br/>
			<input disabled type="text" class="form-control" name="visits" placeholder="Enter Visits" value="<?= isset($services)?$services->visits:''?>"/>
			
		</div>
    <?php /*
			<div class="form-group">
			<label for="author">Author:</label><br/>
			<input disabled type="text" class="form-control" name="author" placeholder="Enter Author" value="<?= isset($services)?(isset($services->author)?$services->author:''):''?>"/>
			
		</div>
		<div class="form-group">
			<label for="positions">Positions:</label><br/>
			<input disabled type="text" class="form-control" name="positions" placeholder="Enter Positions" value="<?= isset($services)?$services->positions:''?>"/>
			
		</div>
		<div class="form-group">
			<label for="cities">Cities:</label><br/>
			<input disabled type="text" class="form-control" name="cities" placeholder="Enter Cities" value="<?= isset($services)?$services->cities:''?>"/>
			
		</div>
*/?>
    <div class="form-group">
        <label for="category_id">Category:</label><br/>
        <select disabled type="text" class="form-control" name="subcategory_id" placeholder="Escoja la Subcategoria" value="<?= isset($subcategory)?$subcategory->id:''?>" id="Subcategories">
            <?php
            foreach ($subcategories as $subcategory) {
                $is_selected = ($subcategory->category_id==$category->id)?"selected":"";
                echo "<option value='$subcategory->id' $is_selected>$subcategory->title </option>";
            }
            ?>
        </select>
    </div>

<!--    <div class="form-group">-->
<!--        <label for="icon">Icon:</label><br/>-->
<!--        <input type="file" name="userfile" size="20" />-->
<!--    </div>-->
 <div class="form-group">
     <div class="flexslider default-slider">
         <ul class="slides">
             <li class="flex-active-slide"
                 style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;">
                 <img src="<?= $services->icon ?>" alt="" draggable="false"></li>
             <?php
             $images = $services->getImages()->toArray();
             foreach ($images as $image) {
                 echo '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' . $image->getTitle() . '" alt="" draggable="false"></li>';
             }
             ?>
         </ul>
         <ol class="flex-control-nav flex-control-paging">
             <li><a class="">1</a></li>
             <li><a class="flex-active">2</a></li>
             <li><a class="">3</a></li>
             <li><a class="">4</a></li>
         </ol>
         <ul class="flex-direction-nav">
             <li><a class="flex-prev" href="#"></a></li>
             <li><a class="flex-next" href="#"></a></li>
         </ul>
     </div>
 </div>

		<?= anchor('admin/services/index','Back','class="btn btn-link"'); ?>
	</form>

