<center>
    <section class="main-content">
        <div class="panel panel-default">
            <div class="panel-heading">Genre</div>
            <div class="panel-body">    
                <?php
                $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
                echo form_open('genre/' . $op, $attributes);
                ?>
                <fieldset> 
                    <div class="form-group 
                    <?php
                    if ((form_error('genre'))) {
                        echo 'has-error';
                    }else {echo 'control-label';}
                    ?>">

                        <div class="col-md-12">
                            <?php echo form_label('Genre: ', 'name', array("class" => "col-sm-2 control-label")); ?>
                            <div class="col-sm-10">


                                <?php
                                $data = array(
                                    'name' => 'name',
                                    'id' => 'name',
                                    'value' => isset($results->name) ? $results->name : set_value('name'),
                                    'maxlength' => '255',
                                    'class' => 'form-control'
                                );
                                echo form_input($data);
                                if (!is_null(form_error('name'))) {
                                    echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('genre') . '</li></ul>';
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
                </form>
            </div>
        </div>
    </section>
</center>



