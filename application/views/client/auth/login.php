<div class="main-content content-business single-business has-bg-image" data-bg-color="f5f5f5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div id="infoMessage"><?php echo $data["message"]; ?></div>

                <div class="container">
                    <h1 class="text-center">Iniciar sesión</h1>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3><?php echo lang('login_heading'); ?></h3>
                            <p><?php echo lang('login_subheading'); ?></p>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <?php echo form_open("client/login"); ?>

                            <div class="field">
                                <?php echo form_input($data["identity"], '', array("placeholder" => 'Correo electrónico')); ?>
                            </div>
                            <div class="field">
                                <?php echo form_input($data["password"], '', array("placeholder" => 'Contraseña')); ?>
                            </div>
                            <div class="field">
                                <?php echo form_submit('submit', 'Login', array("class" => "btn btn-medium btn-primary")); ?>
                            </div>

                        </div>
                        <!--                        <div class="field custom-select-box">-->
                        <!--                            --><?php //echo lang('login_remember_label', 'remember'); ?>
                        <!--                            --><?php //echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
                        <!--                        </div>-->
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

