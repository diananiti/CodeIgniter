<div class="body-wrapper animsition">
    <div class="container">
        <div class="container inner">
            <h1 class="text-center login-title">SIGN UP TO GET INSTANT ACCESS</h1>
            <div class="col-sm-6 col-md-4 col-md-offset-4 dark-wrapper panel panel-default panel-flat anim-running anim-done ">
                <div class="light-wrapper bm20 tm20">
                    <div class="text-center">
                        <img src="<?php echo base_url() ?>resources/frontend/images/logo.png" alt="" data-src="<?php echo base_url() ?>resources/frontend/images/logo.png" data-ret="<?php echo base_url() ?>resources/frontend/images/logo@2x.png" class="retina" />
                    </div>
                </div>
                <div class="account-wall">
                    <?php
                    $attributes = array('id' => 'registration');

                    echo form_open('/registration', $attributes);
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
                        <span class = "fa fa-briefcase form-control-feedback text-muted tm10"></span>
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
                        <span class="fa fa-user form-control-feedback text-muted tm10"></span>
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
                        <span class="fa fa-envelope form-control-feedback text-muted tm10"></span>
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
                        <span class="fa fa-lock form-control-feedback text-muted tm10"></span>
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
                        <span class="fa fa-lock form-control-feedback text-muted tm10"></span>
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
                        'class' => 'btn btn-block btn-blue'
                    );
                    echo form_submit($data);
                    ?>

                    <br>
                    <div class="row">
                        <p class="text-center login-title"><strong>Already have an account? <br><a href="<?php echo site_url() ?>/login">Sign in!</a></strong></o>
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



