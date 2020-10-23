<center>
    <section class="main-content">
        <div class="panel panel-default">
            <div class="panel-heading">Continents</div>
            <div class="panel-body">
                <?php
                $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
                echo form_open('continents/' . $op, $attributes);
                ?>
                <fieldset>
                    <div class="form-group 
                    <?php
                    if (form_error('continent')) {
                        echo "has-error";
                    } else {
                        echo "control-label";
                    }
                    ?>">
                        <div class="col-md-12">
                            <?php echo form_label('Continents : ', 'continent', array("class" => "col-sm-2 control-label")); ?>
                            <div class="col-sm-10">
                                <?php
                                $data = array(
                                    'name' => 'continent',
                                    'id' => 'continent',
                                    'value' => isset($results->continent) ? $results->continent : set_value('continent'),
                                    'maxlength' => '100',
                                    'class' => 'form-control'
                                );
                                echo form_input($data);
                                if (!is_null(form_error('continent'))) {
                                    echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('continent') . '</li></ul>';
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


