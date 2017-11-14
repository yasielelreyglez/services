<!--<div class="col-md-9">-->
<!--    <div class="content">-->
<!---->
<!---->
<!--        --><?php //echo form_open("admin/auth/login");?>
<!---->
<!--        <p>-->
<!--            --><?php //echo lang('login_identity_label', 'identity');?>
<!--            --><?php //echo form_input($data["identity"]);?>
<!--        </p>-->
<!---->
<!--        <p>-->
<!--            --><?php //echo lang('login_password_label', 'password');?>
<!--            --><?php //echo form_input($data["password"]);?>
<!--        </p>-->
<!---->
<!--        <p>-->
<!--            --><?php //echo lang('login_remember_label', 'remember');?>
<!--            --><?php //echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
<!--        </p>-->
<!---->
<!---->
<!---->
<!---->
<!--        --><?php //echo form_close();?>
<!---->
<!--       -->
<!---->
<!---->
<!--    </div>-->
<!--</div>-->

<div id="infoMessage"><?php echo $data["message"];?></div>


          <div class="container">

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h3><?php echo lang('login_heading');?></h3>
                        <p><?php echo lang('login_subheading');?></p>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo form_open("admin/auth/login");?>

<!--                            <div class="map-toggleButton">-->
<!--                                <i class="fa fa-bars"></i>-->
<!--                            </div>-->

                                <div class="field">
<!--                                    --><?php //echo form_input($data["identity"],"",array("placeholder"=>"Filter by keyword"));?>
<!--                                    <input type="text" placeholder="Filter by keyword">-->
                                    <?php echo form_input($data["identity"],'',array("placeholder"=>'email'));?>
                                </div>
                                <div class="field">
<!--                                    <i class="fa fa-map-marker"></i>-->
<!--                                    <input type="text" placeholder="Location" class="location">-->
                                    <?php echo form_input($data["password"],'',array("placeholder"=>'password'));?>
                                </div>
                                <div class="field">
                                    <?php echo form_submit('submit', lang('login_submit_btn'),array("class"=>"btn btn-medium btn-primary"));?>
                                </div>

                        </div>
                        <div class="field custom-select-box">
                            <?php echo lang('login_remember_label', 'remember');?>
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>

                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>

            </div>
        </div>