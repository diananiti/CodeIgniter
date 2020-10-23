<div class="light-wrapper">
    <div class="container inner">
        <?php
        $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
        echo form_open('/search/', $attributes);
        ?>
        <div class="col-md-10
        <?php
        if (form_error('search')) {
            echo 'has-error';
        }
        ?>">
                 <?php
                 $data = array(
                     'name' => 'artist',
                     'id' => 'artist',
                     'value' => isset($search) ? $search : '',
                     'placeholder' => 'Search for artist or artwork',
                     'maxlength' => '100',
                     'class' => 'form-control'
                 );

                 echo form_input($data);
                 ?>
        </div>
        <div class="col-md-2">
            <?php echo form_submit(array('value' => 'Search'), '', 'class="btn btn-lg btn-success"'); ?>
        </div>
        <?php if (isset($error)) { ?>
            <div class="text-center col-md-12">
                <h1><?php echo $error; ?></h1>
            </div>
        <?php } ?>
    </div>
</div>