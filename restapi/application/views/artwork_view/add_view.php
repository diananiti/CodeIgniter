<script src="<?php echo base_url() ?>resources/app/js/multiselect.min.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#artists_multiselect').multiselect();
    });
</script>

<section class="main-content">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Artwork</div>
        <div class="panel-body">
            <?php
            $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
            echo form_open_multipart('artwork/' . $op, $attributes);
            ?>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('slug')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Slug : ', 'slug', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            $data = array(
                                'name' => 'slug',
                                'id' => 'slug',
                                'value' => isset($results->slug) ? $results->slug : set_value('slug'),
                                'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            echo form_input($data);
                            if (!is_null(form_error('slug'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('slug') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('title')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Title : ', 'title', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            $data = array(
                                'name' => 'title',
                                'id' => 'title',
                                'value' => isset($results->title) ? $results->title : set_value('title'),
                                'maxlength' => '100',
                                'class' => 'form-control'
                            );
                            echo form_input($data);
                            if (!is_null(form_error('title'))) {
                                echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('title') . '</li></ul>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('content')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Content : ', 'content', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <div class="ewrapper">
                                <div class="toolbar">
                                    <ul class="wysihtml5-toolbar"><li class="dropdown">
                                            <a class="btn btn-default dropdown-toggle " data-toggle="dropdown">

                                                <span class="fa fa-font"></span>

                                                <span class="current-font">Normal text</span>
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p" tabindex="-1" href="javascript:;" unselectable="on">Normal text</a></li>
                                                <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:;" unselectable="on">Heading 1</a></li>
                                                <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:;" unselectable="on">Heading 2</a></li>
                                                <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:;" unselectable="on">Heading 3</a></li>
                                                <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" tabindex="-1" href="javascript:;" unselectable="on">Heading 4</a></li>
                                                <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" tabindex="-1" href="javascript:;" unselectable="on">Heading 5</a></li>
                                                <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" tabindex="-1" href="javascript:;" unselectable="on">Heading 6</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <div class="btn-group">
                                                <a class="btn  btn-default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:;" unselectable="on">Bold</a>
                                                <a class="btn  btn-default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a>
                                                <a class="btn  btn-default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="btn  btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false" tabindex="-1" href="javascript:;" unselectable="on">
                                                <span class="fa fa-quote-left"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="btn-group">
                                                <a class="btn  btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:;" unselectable="on">
                                                    <span class="fa fa-list-ul"></span>
                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:;" unselectable="on">
                                                    <span class="fa fa-list-ol"></span>
                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:;" unselectable="on">
                                                    <span class="fa fa-outdent"></span>
                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:;" unselectable="on">
                                                    <span class="fa fa-indent"></span>
                                                </a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="btn-group">
                                                <a class="btn  btn-default" data-wysihtml5-command="undo" title="Undo" tabindex="-1" href="javascript:;" unselectable="on">

                                                    <span class="fa fa-undo" style="color:red"></span>

                                                </a>
                                                <a class="btn  btn-default" data-wysihtml5-command="redo" title="Redo" tabindex="-1" href="javascript:;" unselectable="on">

                                                    <span class="fa fa-repeat" style="color:blue"></span>

                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <?php
                                $data = array(
                                    'name' => 'content',
                                    'id' => 'content',
                                    'value' => isset($results->content) ? $results->content : set_value('content'),
                                    'maxlength' => '250',
                                    'class' => 'editable',
                                    'placeholder' => 'Enter text ...'
                                );
                                echo form_textarea($data);
                                echo '<div class="pull-right">';
                                echo form_reset(array('value' => 'Reset', 'class' => 'btn btn-primary'));
                                echo '</div>';
                                if (!is_null(form_error('content'))) {
                                    echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('content') . '</li></ul>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            </fieldset>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('artists_to')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Artists : ', 'artists', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <div class="col-xs-6">
                                <?php
                                $data = array(
                                    'name' => 'artists_from',
                                    'class' => 'form-control',
                                    'value' => '',
                                    'id' => 'artists_multiselect',
                                    'multiple' => 'multiple',
                                    'options' => $artists_combo,
                                    'size' => '10'
                                );
                                echo form_multiselect($data);
                                ?>
                            </div>
                            <div class="col-xs-6">
                                <?php
                                $data = array(
                                    'name' => 'artists_to[]',
                                    'class' => 'form-control',
                                    'value' => '',
                                    'id' => 'artists_multiselect_to',
                                    'multiple' => 'multiple',
//                                    'options' => $artists_combo,
//                                    'options' => array('56' => 'Liviu'),
                                    'size' => '10'
                                );
                                echo form_multiselect($data);
                                ?>
                            </div>
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