<br><br><br>
<!-- <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle col-md-offset-4">-->
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4 col-md-offset-3 col-sm-offset-3 col-lg-offset-4">
            <!-- START panel-->

            <div data-toggle="play-animation" data-play="zoomIn" data-offset="0" data-duration="300" class="panel panel-default panel-flat anim-running anim-done" style="">
                <br><br>
                <p class="text-center mb-lg">
                    <strong>SIGN UP TO GET INSTANT ACCESS.</strong>
                </p>
                <div class="panel-body">

                    <?php
                    $attributes = array('id' => 'registration');

                    echo form_open('/user/registration', $attributes);
                    ?>

                    <div class="form-group has-feedback
                    <?php
                    if (form_error('fullname')) {
                        echo 'has-error';
                    }
                    ?>">
                             <?php echo form_label('Full Name', 'fullname1', array("class" => "control-label")); ?>
                             <?php
                             $data = array(
                                 'name' => 'fullname',
                                 'id' => 'fullname',
                                 'placeholder' => "Enter full name",
                                 'value' => isset($input['fullname']) ? $input['fullname'] : '',
                                 'maxlength' => '100',
                                 'size' => '50',
                                 'class' => 'form-control'
                             );
                             echo set_value($data['value']);
                             echo form_input($data);
                             ?>
                        <span class = "fa fa-briefcase form-control-feedback text-muted"></span>
                    </div>

                    <?php echo form_error('fullname'); ?>

                    <div class="form-group has-feedback
                    <?php
                    if (form_error('username')) {
                        echo 'has-error';
                    }
                    ?>">
                             <?php echo form_label('Username', 'username1', array("class" => "control-label")); ?>
                             <?php
                             $data = array(
                                 'name' => 'username',
                                 'id' => 'username',
                                 'placeholder' => "Enter username",
                                 'value' => isset($input['username']) ? $input['username'] : '',
                                 'maxlength' => '100',
                                 'size' => '50',
                                 'class' => 'form-control'
                             );
                             echo set_value($data['value']);
                             echo form_input($data);
                             ?>
                        <span class="fa fa-user form-control-feedback text-muted"></span>
                    </div>

                    <?php echo form_error('username'); ?>

                    <div class="form-group has-feedback
                    <?php
                    if (form_error('email')) {
                        echo 'has-error';
                    }
                    ?>">
                             <?php echo form_label('Email address', 'email1', array("class" => "control-label")); ?>
                             <?php
                             $data = array(
                                 'name' => 'email',
                                 'id' => 'email',
                                 'type' => 'email',
                                 'placeholder' => "Enter email",
                                 'value' => isset($input['email']) ? $input['email'] : '',
                                 'maxlength' => '100',
                                 'size' => '50',
                                 'class' => 'form-control'
                             );
                             echo set_value($data['value']);
                             echo form_input($data);
                             ?>
                        <span class="fa fa-envelope form-control-feedback text-muted"></span>
                    </div>

                    <?php echo form_error('email'); ?>

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
                        <span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>

                    <?php echo form_error('password'); ?>

                    <div class="form-group has-feedback
                    <?php
                    if (form_error('password2')) {
                        echo 'has-error';
                    }
                    ?>">
                             <?php echo form_label('Retype Password', 'password3', array("class" => "control-label")); ?>
                             <?php
                             $data = array(
                                 'name' => 'password2',
                                 'id' => 'password2',
                                 'placeholder' => "Retype Password",
                                 'value' => isset($input['password2']) ? $input['password2'] : '',
                                 'maxlength' => '100',
                                 'size' => '50',
                                 'class' => 'form-control'
                             );
                             echo set_value($data['value']);
                             echo form_password($data);
                             ?>
                        <span class="fa fa-lock form-control-feedback text-muted"></span>
                    </div>

                    <?php echo form_error('password2'); ?>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcLoAsTAAAAADltr0gvE7S4eq8NkmMJmiVVgCZ3"></div>
                    </div>

                    <?php echo form_error('recaptcha'); ?>

                    <div class="clearfix">
                        <div class="checkbox c-checkbox pull-left mt0">

                            <?php
                            echo '<label>';
                            $data = array(
                                'name' => 'checkbox',
                                'id' => 'checkbox',
                                'value' => '1',
                            );
                            echo form_checkbox($data);
                            echo '<span class="fa fa-check"></span>I agree with the <a href="#">terms</a>';
                            echo '</label>';
                            ?>


                        </div>
                    </div>
                    <?php echo form_error('checkbox'); ?>
                    <?php
                    $data = array(
                        'value' => 'Register',
                        'class' => 'btn btn-block btn-primary'
                    );
                    echo form_submit($data);
                    ?>

                    <br>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                            <p class="text-center login-title"><strong>Already have an account? <br><a href="<?php echo site_url() ?>/user/login">Sign in!</a></strong></o>
                        </div>
                    </div>

                    <?php
                    echo form_close();
                    ?>

                </div>
            </div>
            <!-- END panel-->
        </div>
    </div>
</div>
<br><br>



