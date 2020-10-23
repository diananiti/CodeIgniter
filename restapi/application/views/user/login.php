<?php
/**
 * Created by .
 * User: Liviu Iacob
 * Date: 8/8/2015
 * Time: 07:30
 */
?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue</h1>

            <div class="account-wall">
                <img alt="" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" class="profile-img">
                <?php
                $attributes = array('id' => 'login', 'class' => 'form-signin');
                echo form_open('/admin/login', $attributes);
                ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <?php echo form_label('Username : ', 'usernamel', array("class" => "control-label")); ?>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <?php
                            $data = array(
                                'name' => 'username',
                                'id' => 'username',
                                'value' => isset($results->username) ? $results->username : '',
                                'maxlength' => '100',
                                'size' => '50',
                                'class' => 'form-control'
                            );
                            echo form_input($data);
                            ?>
                           <span class="fa fa-user form-control-feedback text-muted mrg15T mrg10R"></span>
                        </div>
                         
                        <?php echo form_error('username'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <?php echo form_label('Password : ', 'passwordl', array("class" => "control-label")); ?>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <?php
                            $data = array(
                                'name' => 'password',
                                'id' => 'password',
                                'value' => isset($results->username) ? $results->username : '',
                                'maxlength' => '100',
                                'size' => '50',
                                'class' => 'form-control'
                            );
                            echo form_password($data);
                            ?>
                            <span class="fa fa-lock form-control-feedback text-muted mrg15T mrg10R"></span>
                        </div>
                        <?php echo form_error('password'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                        <?php echo form_submit(array('value' => 'Login'), '', 'class="btn btn-lg btn-primary btn-block"'); ?>
                    </div>
                </div>
                <?php
                if (isset($exist)) {
                    echo '<br><p class = "text-center">' . $exist . '</p>';
                }
                ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                        <h1 class="text-center login-title"><strong>Don't have an account?</strong></h1>
                        <a href="<?php echo site_url() ?>/user/registration"><?php echo form_button(array('value' => 'Sign Up', 'content' => 'Sign Up'), '', 'class="btn btn-lg btn-primary btn-block"'); ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                        <p class="text-center login-title"><strong><br><a href="<?php echo site_url() ?>/user/forgot_password">Forgot Password</a></strong></o>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>