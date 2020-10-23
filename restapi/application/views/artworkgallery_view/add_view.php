<section class="main-content">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Artworkgallery</div>
        <div class="panel-body">
            <?php
            $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
            echo form_open_multipart('artworkgallery/' . $op, $attributes);
            ?>
            <fieldset>
                <div class="form-group 
                <?php
                if (form_error('image')) {
                    echo 'has-error';
                } else {
                    echo 'control-label';
                }
                ?>">
                    <div class="col-md-12">
                        <?php echo form_label('Image : ', 'image', array("class" => "col-sm-2 control-label")); ?>
                        <div class="col-sm-10">
                            <?php
                            echo form_upload(
                                    array(
                                        'name' => 'image',
                                        'id' => 'image')
                            );
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
