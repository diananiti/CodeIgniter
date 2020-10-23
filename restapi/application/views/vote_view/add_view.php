<section class="main-content">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Vote</div>
        <div class="panel-body">
            <?php
            $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
            echo form_open('vote/' . $op, $attributes);
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
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('vote')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Artist : ', 'artist_id', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            $data = array(
                                'name' => 'artist_id',
                                'id' => 'artist_id',
                                'value' => isset($results->artist_id) ? $results->artist_id : set_value('artist_id'),
                                'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            echo form_dropdown($data, $artist_combo);

                            echo form_error('country');
                            if (!is_null(form_error('country'))) {
                                echo
                                    '<ul class="parsley-errors-list filled">'
                                    . '<li class="parsley-required">' . form_error('artist_id') . ''
                                    . '</li>'
                                    . '</ul>'
                                    . ' </div>';
                            }
                            ?>

                        </div>
                    </div>
            </fieldset>
            <fieldset>
                <div class="form-group
                <?php
                if (form_error('vote')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">

                    <div class="col-md-12 text-left">
                        <?php echo form_label('Vote : ', 'vote', array("class" => "col-sm-2 control-label mrg20T")); ?>

                        <?php
                        $data = array(
                            'name' => 'vote',
                            'class' => 'rating',
                            'min' => "0",
                            'max' => "5",
                            'step' => "0.5",
                            'data-size' => "md",
                            'data-glyphicon' => "false",
                            'data-stars' => "5",
                            'data-show-clear' => "false",
                            'data-show-caption' => "true",
                            'value' => isset($results->vote) ? $results->vote : set_value('vote'),
                        );
                        echo form_input($data);
                        if (!is_null(form_error('vote'))) {
                            echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('vote') . '</li></ul>';
                        }
                        ?>
                    </div>
                </div>

            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('vote')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Comment : ', 'comment', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">

                            <?php
                            $data = array(
                                'name' => 'comment',
                                'id' => 'comment',
                                'value' => isset($results->comment) ? $results->comment : set_value('comment'),
                                'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            echo form_textarea($data);
                            if (!is_null(form_error('comment'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('comment') . '</li></ul>';
                            }
                            ?>
                        </div>

            </fieldset>
            <?php if ($op = 'add') { ?>

            <fieldset>
                <div class="form-group
                                <?php
                if (form_error('vote')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Flag : ', 'flag', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            $data = array(
                                'name' => 'flag',
                                'id' => 'flag',
                                'value' => isset($results->flag) ? $results->flag : set_value('flag'),
                                'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            $options = array(
                                'new' => 'new',
                                'approved' => 'approved',
                                'rejected' => 'rejected',
                            );

                            echo form_dropdown($data, $options);
                            if (!is_null(form_error('flag'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('flag') . '</li></ul>';
                            }
                            ?>

                        </div>
                    </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-lg btn-success"'); ?>

                </div>
        </div>
        </fieldset>
        <?php } ?>
    </div>
</section>