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
                    $attributes = array('id' => 'login', 'class' => 'form-signin');
                    echo form_open('/login', $attributes);
                    ?>
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="form-group has-feedback
                        <?php
                        if (form_error('username') or isset($exist)) {
                            echo 'has-error';
                        }
                        ?>">
                                 <?php echo form_label('Username : ', 'usernamel', array("class" => "control-label")); ?>
                                 <?php
                                 $data = array(
                                     'name' => 'username',
                                     'id' => 'username',
                                     'placeholder' => "Enter username",
                                     'value' => isset($results->username) ? $results->username : '',
                                     'maxlength' => '100',
                                     'size' => '50',
                                     'class' => 'form-control'
                                 );
                                 echo form_input($data);
                                 echo form_error('username');
                                 ?>
                            <span class="fa fa-user form-control-feedback text-muted tm10"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="form-group has-feedback
                        <?php
                        if (form_error('password') or isset($exist)) {
                            echo 'has-error';
                        }
                        ?>">
                                 <?php echo form_label('Password : ', 'passwordl', array("class" => "control-label")); ?>

                            <?php
                            $data = array(
                                'name' => 'password',
                                'id' => 'password',
                                'placeholder' => "Password",
                                'value' => isset($results->username) ? $results->username : '',
                                'maxlength' => '100',
                                'size' => '50',
                                'class' => 'form-control'
                            );
                            echo form_password($data);
                            echo form_error('password');
                            ?>
                            <span class="fa fa-lock form-control-feedback text-muted tm10"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                            <?php echo form_submit(array('value' => 'Login'), '', 'class="btn btn-lg btn-blue btn-block"'); ?>
                        </div>
                    </div>
                    <?php
                    if (isset($exist)) {
                        echo '<p class = "text-center">' . $exist . '</p>';
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                            <div class="col-md-6 col-lg-6 col-xs-6 pull-left">
                                <h2 class="text-center login-title tm10"><strong>Don't have an account?</strong></h2>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6 pull-right">
                                <h2 class="text-center login-title tm20"><strong>Forgot Password?</strong></h2>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xs-6 pull-left">
                            <a href="<?php echo site_url() ?>/registration"><?php echo form_button(array('value' => 'Sign Up', 'content' => 'Sign Up'), '', 'class="btn btn-lg btn-orange btn-block"'); ?></a>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-6 pull-right">
                            <a href="<?php echo site_url() ?>/frontend/forgot_password"><?php echo form_button(array('value' => 'Recover', 'content' => 'Recover'), '', 'class="btn btn-lg btn-orange btn-block"'); ?></a>
                        </div>
                    </div>
                    <!--                <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                                            <p class="text-center login-title"><strong><a href="<?php echo site_url() ?>/user/forgot_password">Forgot Password</a></strong></o>
                                        </div>
                                    </div>-->
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>