<center>
    <section class="main-content">
        <div class="panel panel-default">
            <div class="panel-heading">Countries</div>
            <div class="panel-body">
                <?php
                $attributes = array('data' => 'countries', 'id' => 'myform', 'class' => 'form-horizontal');
                echo form_open('countries/' . $op, $attributes); //form_open(path.operation,the way it takes the data(from the table countries
                //and id from the "my form" specified in the config"
                // it also contains the class used in display for the form
                ?>

                <fieldset>
                    <div class="form-group
                    <?php
                    if ((form_error('countries'))) {
                        echo 'has-error';
                    }else {echo 'control-label';}
                    ?>">
               
                    <div class="col-md-12">
                        <?php echo form_label('Country : ', 'country', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">


                            <?php
                            $data = array(
                                'name' => 'country',
                                'id' => 'country',
                                'value' => isset($results->country) ? $results->country : set_value('country'),
                                'maxlength' => '255',
                                'size' => '50',
                                'style' => 'width:50%',
                                'class' => 'form-control'
                            );
                            echo form_input($data);//The input specifies an  field where the user can enter data.
                            if (!is_null(form_error('country'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('countries') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            </fieldset>
            <div class="form-group">
                <?php echo form_label('Continent:', 'continents_id', array("class" => "control-label")); ?>
                <?php
                $data = array(
                    'name' => 'continents_id',
                    'id' => 'continents_id',
                    'value' => isset($results->id) ? $results->id : set_value('continets_id'),
                    'maxlength' => '255',
                    'size' => '50',
                    'style' => 'width:50%'
                );

                echo form_dropdown('continents_id', $continents_combo, isset($results->continents_id) ? $results->continents_id : '');
                ?>
            </div>
            <br>
            <div class="form-group">
                <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-sm btn-success"'); ?>
            </div>
            </br>
            <?php echo form_close(); ?>
            </form>
        </div>
        </div>
    </section>
</center>


