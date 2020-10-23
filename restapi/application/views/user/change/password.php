<div class="light-wrapper">
    <div class="container inner panel panel-default panel-flat tm20">
        <fieldset>
            <h1 class="text-center">Change Password</h1>
        </fieldset>
        <fieldset>
            <?php
            $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
            echo form_open('/profile/password', $attributes);
            ?>
            <div class="col-md-12">
                <div class="col-md-4">
                    <?php echo form_label('Current password : ', 'password_old', array("class" => "control-label pull-right")); ?>
                </div>
                <div class="col-md-4
                <?php
                if (form_error('password_old')) {
                    echo 'has-error';
                }
                ?>">
                         <?php
                         $data = array(
                             'name' => 'password_old',
                             'id' => 'password_old',
                             'value' => isset($input['password_old']) ? $input['password_old'] : '',
                             'placeholder' => 'Enter current password',
                             'maxlength' => '100',
                             'class' => 'form-control'
                         );


                         echo form_password($data);
                         ?>
                </div>
                <div class="col-md-4">
                    <?php echo form_error('password_old')?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <?php echo form_label('New password : ', 'password_new', array("class" => "control-label pull-right")); ?>
                </div>
                <div class="col-md-4
                <?php
                if (form_error('password_new')) {
                    echo 'has-error';
                }
                ?>">
                         <?php
                         $data = array(
                             'name' => 'password_new',
                             'id' => 'password_new',
                             'value' => isset($input['password_new']) ? $input['password_new'] : '',
                             'placeholder' => 'Enter new password',
                             'maxlength' => '100',
                             'class' => 'form-control'
                         );


                         echo form_password($data);
                         ?>
                </div>
                <div class="col-md-4">
                    <?php echo form_error('password_new')?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <?php echo form_label('Confirm password : ', 'password_confirm', array("class" => "control-label pull-right")); ?>
                </div>
                <div class="col-md-4
                <?php
                if (form_error('password_confirm')) {
                    echo 'has-error';
                }
                ?>">
                         <?php
                         $data = array(
                             'name' => 'password_confirm',
                             'id' => 'password_confirm',
                             'value' => isset($input['password_confirm']) ? $input['password_confirm'] : '',
                             'placeholder' => 'Retype new password',
                             'maxlength' => '100',
                             'class' => 'form-control'
                         );


                         echo form_password($data);
                         ?>
                </div>
                <div class="col-md-4">
                    <?php echo form_error('password_confirm')?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php echo form_submit(array('value' => 'Submit'), '', 'class="btn btn-lg btn-success"'); ?>
            </div>
            <?php if (isset($error)) { ?>
                <div class="text-center col-md-12">
                    <h1><?php echo $error; ?></h1>
                </div>
            <?php } ?>
        </fieldset>

    </div>
</div>