<section class="main-content">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Artist</div>
        <div class="panel-body">
            <?php
            $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
            echo form_open_multipart('artist/' . $op, $attributes);
            ?>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('fullname')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Full Name : ', 'fullname', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            $data = array(
                                'name' => 'fullname',
                                'id' => 'fullname',
                                'value' => isset($results->fullname) ? $results->fullname : set_value('fullname'),
                                'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            echo form_input($data);
                            if (!is_null(form_error('fullname'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('fullname') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('genre')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Genre : ', 'genre', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            echo form_dropdown('genre_id', $genre_combo, isset($results->genre_id) ? $results->genre_id : '', "class='form-control m-b'");
                            if (!is_null(form_error('genre'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('genre') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('style')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Style : ', 'style', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            echo form_dropdown('style_id', $style_combo, isset($results->style_id) ? $results->style_id : '', "class='form-control m-b'");
                            if (!is_null(form_error('style'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('style') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('style')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Substyle : ', 'substyle', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            echo form_dropdown('substyle_id', $style_combo, isset($results->substyle_id) ? $results->substyle_id : '', "class='form-control m-b'");
                            if (!is_null(form_error('style'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('style') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('country')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Country : ', 'country', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            echo form_dropdown('country_id', $countries_combo, isset($results->country_id) ? $results->country_id : '', "class='form-control m-b'");
                            if (!is_null(form_error('country'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('country') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('date_of_birth')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Date of birth : ', 'date_of_birth1', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <!--input.datepicker.form-control(size='16', type='text', value='12-02-2013', data-date-format='dd-mm-yyyy')-->
                            <div data-pick-time="false" class="input-group date mb-lg" id="dateofbirth">
                                <?php
                                $data = array(
                                    'name' => 'date_of_birth',
                                    'id' => 'date_of_birth',
                                    'value' => isset($date_of_birth) ? $date_of_birth : set_value('date_of_birth'),
                                    'class' => 'form-control',
                                );
                                echo form_input($data);
                                ?>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <?php
                            if (!is_null(form_error('date_of_birth'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('date_of_birth') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
            </fieldset>

            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('bio')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Bio : ', 'bio', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <div class="ewrapper">
                                <div class="toolbar">
                                    <ul class="wysihtml5-toolbar">
                                        <li class="dropdown">
                                            <a class="btn btn-default dropdown-toggle " data-toggle="dropdown">

                                                <span class="fa fa-font"></span>

                                                <span class="current-font">Normal text</span>
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a data-wysihtml5-command="formatBlock"
                                                       data-wysihtml5-command-value="p" tabindex="-1"
                                                       href="javascript:;" unselectable="on">Normal text</a></li>
                                                <li><a data-wysihtml5-command="formatBlock"
                                                       data-wysihtml5-command-value="h1" tabindex="-1"
                                                       href="javascript:;" unselectable="on">Heading 1</a></li>
                                                <li><a data-wysihtml5-command="formatBlock"
                                                       data-wysihtml5-command-value="h2" tabindex="-1"
                                                       href="javascript:;" unselectable="on">Heading 2</a></li>
                                                <li><a data-wysihtml5-command="formatBlock"
                                                       data-wysihtml5-command-value="h3" tabindex="-1"
                                                       href="javascript:;" unselectable="on">Heading 3</a></li>
                                                <li><a data-wysihtml5-command="formatBlock"
                                                       data-wysihtml5-command-value="h4" tabindex="-1"
                                                       href="javascript:;" unselectable="on">Heading 4</a></li>
                                                <li><a data-wysihtml5-command="formatBlock"
                                                       data-wysihtml5-command-value="h5" tabindex="-1"
                                                       href="javascript:;" unselectable="on">Heading 5</a></li>
                                                <li><a data-wysihtml5-command="formatBlock"
                                                       data-wysihtml5-command-value="h6" tabindex="-1"
                                                       href="javascript:;" unselectable="on">Heading 6</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="btn-group">
                                                <a class="btn  btn-default" data-wysihtml5-command="bold" title="CTRL+B"
                                                   tabindex="-1" href="javascript:;" unselectable="on">Bold</a>
                                                <a class="btn  btn-default" data-wysihtml5-command="italic"
                                                   title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a>
                                                <a class="btn  btn-default" data-wysihtml5-command="underline"
                                                   title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="btn  btn-default" data-wysihtml5-command="formatBlock"
                                               data-wysihtml5-command-value="blockquote"
                                               data-wysihtml5-display-format-name="false" tabindex="-1"
                                               href="javascript:;" unselectable="on">
                                                <span class="fa fa-quote-left"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="btn-group">
                                                <a class="btn  btn-default" data-wysihtml5-command="insertUnorderedList"
                                                   title="Unordered list" tabindex="-1" href="javascript:;"
                                                   unselectable="on">
                                                    <span class="fa fa-list-ul"></span>
                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="insertOrderedList"
                                                   title="Ordered list" tabindex="-1" href="javascript:;"
                                                   unselectable="on">
                                                    <span class="fa fa-list-ol"></span>
                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="Outdent"
                                                   title="Outdent" tabindex="-1" href="javascript:;" unselectable="on">
                                                    <span class="fa fa-outdent"></span>
                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="Indent"
                                                   title="Indent" tabindex="-1" href="javascript:;" unselectable="on">
                                                    <span class="fa fa-indent"></span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="btn-group">
                                                <a class="btn  btn-default" data-wysihtml5-command="undo" title="Undo"
                                                   tabindex="-1" href="javascript:;" unselectable="on">

                                                    <span class="fa fa-undo" style="color:red"></span>

                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="redo" title="Redo"
                                                   tabindex="-1" href="javascript:;" unselectable="on">

                                                    <span class="fa fa-repeat" style="color:blue"></span>

                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <?php
                                $data = array(
                                    'name' => 'bio',
                                    'id' => 'bio',
                                    'value' => isset($results->bio) ? $results->bio : set_value('bio'),
                                    'maxlength' => '250',
                                    'class' => 'editable',
                                    'placeholder' => 'Enter text ...'
                                );
                                echo form_textarea($data);
                                echo form_reset(array('value' => 'Reset form!'));
                                ?>
                            </div>
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
                        <?php echo form_label('Vote : ', 'vote', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            $data = array(
                                'name' => 'vote',
                                'id' => 'vote',
                                'value' => isset($results->vote) ? $results->vote : set_value('vote'),
                                'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            echo form_input($data);
                            if (!is_null(form_error('vote'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('vote') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('artworks')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Artworks : ', 'artworks', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            $data = array(
                                'name' => 'artworks',
                                'id' => 'artworks',
                                'value' => isset($results->artworks) ? $results->artworks : set_value('artworks'), 'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            echo form_input($data);
                            if (!is_null(form_error('artworks'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('artworks') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (isset($error)) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Avatar : ', 'avatar1', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            echo form_upload(
                                array(
                                    'name' => 'avatar',
                                    'id' => 'avatar')
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('users')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Users : ', 'users', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            echo form_dropdown('users_id', $users_combo, isset($results->users_id) ? $results->users_id : '', "class='form-control m-b'");
                            if (!is_null(form_error('users'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('users') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group text-center">

                    <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-lg btn-success"'); ?>

                </div>
            </fieldset>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>

