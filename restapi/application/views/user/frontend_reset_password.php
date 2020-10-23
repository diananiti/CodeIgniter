<div class="body-wrapper animsition">
    <div class="container">
        <div class="container inner">
            <h1 class="text-center login-title">SIGN IN TO CONTINUE</h1>
            <div class="col-sm-6 col-md-4 col-md-offset-4 dark-wrapper panel panel-default panel-flat anim-running anim-done ">
                <div class="light-wrapper bm20 tm20">
                    <div class="text-center">
                        <img src="<?php echo base_url() ?>resources/frontend/images/logo.png" alt="" data-src="<?php echo base_url() ?>resources/frontend/images/logo.png" data-ret="<?php echo base_url() ?>resources/frontend/images/logo@2x.png" class="retina" />
                    </div>
                </div>
                <div class="account-wall">
                    <?php
                    $attributes = array('id' => 'frontend_reset_password');

                    echo form_open('/frontend/reset_password', $attributes);
                    ?>
                 

                    <div class="form-group has-feedback
                    <?php
                    if (form_error('password')) {
                        echo 'has-error';
                    }
                    ?>">
                             <?php echo form_label('Password', 'password1', array("class" => "control-label")); ?>
                             <?php
                             $data = array(
                                 'name' => 'password',
                                 'id' => 'password',
                                 'placeholder' => "Password",
                                 'value' => isset($input['password']) ? $input['password'] : '',
                                 'maxlength' => '100',
                                 'size' => '50',
                                 'class' => 'form-control'
                             );
                             echo set_value($data['value']);
                             echo form_password($data);
                             ?>
                        <span class="fa fa-lock form-control-feedback text-muted tm10"></span>
                    </div>

                    <?php echo form_error('password'); ?>

                    <div class="form-group has-feedback
                    <?php
                    if (form_error('confirmed_password')) {
                        echo 'has-error';
                    }
                    ?>">
                             <?php echo form_label('Confirmed_password', 'confirmed_password', array("class" => "control-label")); ?>
                             <?php
                             $data = array(
                                 'name' => 'confirmed_password',
                                 'id' => 'confirmed_password',
                                 'placeholder' => "confirmed_password",
                                 'value' => isset($input['confirmed_password']) ? $input['confirmed_password'] : '',
                                 'maxlength' => '100',
                                 'size' => '50',
                                 'class' => 'form-control'
                             );
                             echo set_value($data['value']);
                             echo form_password($data);
                             ?>
                        <span class="fa fa-lock form-control-feedback text-muted tm10"></span>
                    </div>

                    <?php echo form_error('confirmed_password'); ?>
    <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                        <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-lg btn-primary btn-block"'); ?>
                    </div>
                </div>
                <?php
                if (isset($exist)) {
                    echo '<br><p class = "text-center">' . $exist . '</p>';
                }
                ?>

                
                    <?php
                    echo form_close();
                    ?>

                </div>
            </div>
            <!-- END panel-->
        </div>
    </div>
</div>



