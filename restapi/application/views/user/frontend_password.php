
<div class="body-wrapper animsition">
    <div class="container">
        <div class="container inner">
            <div class="row">
                <h1 class="text-center login-title">Type in the email</h1>
             
                <div class="col-sm-6 col-md-4 col-md-offset-4 dark-wrapper panel panel-default panel-flat anim-running anim-done ">
                    <div class="light-wrapper bm20 tm20">
                        <div class="text-center">
                            <img src="<?php echo base_url() ?>resources/frontend/images/logo.png" alt="" data-src="<?php echo base_url() ?>resources/frontend/images/logo.png" data-ret="<?php echo base_url() ?>resources/frontend/images/logo@2x.png" class="retina" />
                        </div>
                    </div>
                        <div class="account-wall">
                           
                            <?php
                            $attributes = array('id' => 'frontend_password', 'class' => 'form-signin');
                            echo form_open('/frontend/forgot_password', $attributes);
                            ?>

                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xs-12">
                                    <div class="col-md-4 col-lg-4 col-xs-4">
                                        <?php echo form_label('Email : ', 'email1', array("class" => "control-label")); ?>
                                    </div>
                                    <div class="col-md-8 col-lg-8 col-xs-8">
                                        <?php
                                        $data = array(
                                            'name' => 'email',
                                            'id' => 'email',
                                            'type' => 'email',
                                            'maxlength' => '100',
                                            'size' => '50',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        ?> 
                                        <span class="fa fa-envelope form-control-feedback text-muted mrg15T mrg10R"></span>
                                    
                                </div>
                                    </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xs-12 pull-left">
                                    <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-lg btn-primary btn-block"'); ?>

                                </div>
                                <?php
                                echo '<br><div class = "text-center">' . form_error('email') . '</div>';
                                if (isset($exist)) {
                                    echo '<div class = "text-center">' . $exist . '</div>';
                                }
                                ?>
                            </div>


                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

