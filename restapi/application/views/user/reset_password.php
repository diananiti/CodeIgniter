<?php ?>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue</h1>

            <div class="account-wall">
                <img alt="" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" class="profile-img">
                <?php
                    $attributes = array('id' => 'frontend_reset_password', 'class' => 'form-signin');
                        echo form_open('/frontend/reset_password', $attributes);
                        ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="col-md-4 col-lg-4 col-xs-4">
<?php echo form_label('Password : ', 'passwordl', array("class" => "control-label")); ?>
                        </div>
                        <div class="col-md-8 col-lg-8 col-xs-8">
<?php
$data = array(
    'name' => 'password',
    'id' => 'password',
    'value' => '',
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
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <div class="col-md-4 col-lg-4 col-xs-4">
<?php echo form_label('Confirmed Password : ', 'passwordl', array("class" => "control-label")); ?>
                        </div>
                        <div class="col-md-8 col-lg-8 col-xs-8">
<?php
$data = array(
    'name' => 'confirmed_password',
    'id' => 'confirmed_password',
    'value' => '',
    'maxlength' => '100',
    'size' => '50',
    'class' => 'form-control'
);
echo form_password($data);
?>
                            <span class="fa fa-lock form-control-feedback text-muted mrg15T mrg10R"></span>
                        </div>
<?php echo form_error('confirmed_password'); ?>
                    </div>
                </div>
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

            </div>
<?php echo form_close(); ?>
        </div>
    </div>
</div>