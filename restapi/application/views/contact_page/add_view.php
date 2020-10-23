<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="light-wrapper">
    <div class="container inner">
        <div class="row">
            <div class="col-sm-8">

                <h3 class="section-title"><strong>Contact Page</strong></h3>

                <fieldset>
                    <?php
                    $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
                    echo form_open('contact/' . $op, $attributes);
                    ?>
                    <fieldset>

                        <div class="form-group
                        <?php
                        if (form_error('contact')) {
                            echo 'has-error';
                        } else {
                            echo 'control-label';
                        }
                        ?>">
                            <div class="col-md-12">
                                <?php echo form_label('Name : ', 'name', array("class" => "col-sm-2 control-label")); ?>
                                <div class="col-sm-10">
                                    <?php
                                    $data = array(
                                        'name' => 'name',
                                        'id' => 'name',
                                        'placeholder' => "Name (Required)",
                                        'value' => isset($results->name) ? $results->name : set_value('name'),
                                        'maxlength' => '100',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($data);
                                    if (!is_null(form_error('name'))) {
                                        // echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('name') . '</li></ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group 
                        <?php
                        if (form_error('email')) {
                            echo 'has-error';
                        } else {
                            echo 'control-label';
                        }
                        ?>">
                            <div class="col-md-12">
                                <?php echo form_label('Email: ', 'email', array("class" => "col-sm-2 control-label")); ?>
                                <div class="col-sm-10">
                                    <?php
                                    $data = array(
                                        'name' => 'email',
                                        'id' => 'email',
                                        'placeholder' => "Email (Required)",
                                        'value' => isset($results->email) ? $results->email : set_value('email'),
                                        'maxlength' => '100',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($data);
                                    if (!is_null(form_error('email'))) {
                                        // echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('email') . '</li></ul>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group 
                        <?php
                        if (form_error('message')) {
                            echo 'has-error';
                        } else {
                            echo 'control-label';
                        }
                        ?>">
                            <div class="col-md-12">
                                <?php echo form_label('Message: ', 'message', array("class" => "col-sm-2 control-label")); ?>
                                <div class="col-sm-10">
                                    <?php
                                    $data = array(
                                        'name' => 'message',
                                        'id' => 'message',
                                        'placeholder' => "Message (Required)",
                                        'value' => isset($results->message) ? $results->message : set_value('message'),
                                        'maxlength' => '100',
                                        'class' => 'form-control'
                                    );
                                    echo form_textarea($data);
                                    if (!is_null(form_error('message'))) {
                                        //   echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('message') . '</li></ul>';
                                    }
                                    ?>   
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcLoAsTAAAAADltr0gvE7S4eq8NkmMJmiVVgCZ3"></div>
                    </div>

                    <?php echo form_error('recaptcha'); ?>


                    <fieldset>
                        <div class="col-md-4">

                            <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-lg btn-success"'); ?>
                        </div>
                    </fieldset>
                    <?php echo form_close(); ?>

                </fieldset>


                <!-- /.form-container --> 
            </div>
            <!-- /.span8 -->

        </div>
        <!-- /.widget --> 
        </aside>
        <!-- /.span4 --> 
    </div>
    <!-- /.row --> 
</div>


</div>
<!-- /.light-wrapper --> 
<!-- /.body-wrapper --> 









