<center>   
    <section class="main-content">
        <div class="panel panel-default">
            <div class="panel-heading">Roles</div>
            <div class="panel-body">
                <?php
                $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
                echo form_open('roles/' . $op, $attributes);
                ?>
                <fieldset>
                    <div class="form-group
                    <?php
                    if (form_error('role')) {
                        echo 'has-error';
                    } else {
                        echo 'control-label';
                    }
                    ?>">
                        <div class="col-md-12">
                            <?php echo form_label('Role : ', 'role', array("class" => "col-sm-2 control-label")); ?>
                            <div class="col-sm-10">
                                <?php
                                $data = array(
                                    'name' => 'role',
                                    'id' => 'role',
                                    'value' => isset($results->role) ? $results->role : set_value('role'),
                                    'maxlength' => '100',
                                    'class' => 'form-control'
                                );
                                echo form_input($data);
                                if (!is_null(form_error('role'))) {
                                    echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('role') . '</li></ul>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group 
                    <?php
                    if (form_error('role')) {
                        echo 'has-error';
                    } else {
                        echo 'control-label';
                    }
                    ?>">
                        <div class="col-md-12">
                            <?php echo form_label('Ratio : ', 'ratio', array("class" => "col-sm-2 control-label")); ?>
                            <div class="col-sm-10">
                                <?php
                                $data = array(
                                    'name' => 'ratio',
                                    'id' => 'ratio',
                                    'value' => isset($results->ratio) ? $results->ratio : set_value('ratio'),
                                    'maxlength' => '100',
                                    'class' => 'form-control'
                                );
                                echo form_input($data);
                                if (!is_null(form_error('ratio'))) {
                                    echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('ratio') . '</li></ul>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">

                        <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-lg btn-success"'); ?>
                    </div>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</center>
