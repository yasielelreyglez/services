	<h1>Create</h1>
	<?= form_open_multipart('api/createservice','role="form"'); ?><?php if(validation_errors() != NULL && validation_errors() != '') { ?>
		<div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
		<input type="hidden" name="id" value="<?= isset($payment)?$payment->id:''?>"/>
		
		<div class="form-group">
			<label for="type">Type:</label><br/>
			<input disabled type="text" class="form-control" name="type" placeholder="Enter Type" value="<?= isset($payment)?$payment->getTypeString():''?>"/>
			
            <label for="type">Name:</label><br/>
			<input disabled type="text" class="form-control" name="nombre" placeholder="Enter Name" value="<?= isset($payment)?$payment->nombre:''?>"/>

            <label for="type">Number:</label><br/>
			<input disabled type="text" class="form-control" name="numero" placeholder="Enter Number" value="<?= isset($payment)?$payment->numero:''?>"/>

            <label for="type">Membership:</label><br/>
            <input disabled type="text" class="form-control" name="membership_id" placeholder="Enter Membership" value="<?= isset($payment)?$payment->getMembership()->getTitle():''?>"/>

            <label for="type">Service:</label><br/>
            <input disabled type="text" class="form-control" name="service_id" placeholder="Enter Service" value="<?= isset($payment)?$payment->getService()->getTitle():''?>"/>

            <label for="state">State:</label><br/>
            <input disabled type="text" class="form-control" name="state" placeholder="Enter State" value="<?= isset($payment)?$payment->getStateString():''?>"/>

            <?php if(!is_null($payment->getEvidence())):?>
                <label for="type">Evidence:</label><br/>
                <img src=" <?php echo $payment->getEvidence();?>" height='50px' width='50px'><br/>
            <?php endif;?>

            <label for="country">Country:</label><br/>
            <input disabled type="text" class="form-control" name="country" placeholder="Enter Country" value="<?= isset($payment)?$payment->country:''?>"/>

            <label for="phone">Phone:</label><br/>
            <input disabled type="text" class="form-control" name="phone" placeholder="Enter Phone" value="<?= isset($payment)?$payment->phone:''?>"/>

            <label for="payed_at">Payed at:</label><br/>
            <input disabled type="text" class="form-control" name="payed_at" placeholder="Enter Pay Date" value="<?= isset($payment)? date('Y-m-d', strtotime( $payment->getPayedAt()->format('Y-m-d'))):''?>"/>
            <label for="expiration_date">Expiration date at:</label><br/>
            <input disabled type="text" class="form-control" name="expiration_date" placeholder="Enter Pay Date" value="<?= isset($payment)? $payment->getExpirationDate()->format('Y-m-d'):''?>"/>



        </div>
		<!--div class="form-group">
			<label for="start_time">Start_time:</label><br/>
			<input disabled type="text" class="form-control" name="start_time" placeholder="Enter Start_time" value="<?= isset($services)?$services->start_time:''?>"/>
			
		</div-->

    <div class="form-group">
        <label for="icon">Icon:</label><br/>
        <input type="file" name="userfile" size="20" />
    </div>

		<?= anchor('admin/services/index','Back','class="btn btn-link"'); ?>
	</form>

