<link href="<?php echo base_url() ?>resources/app/css/star-rating.min.css"  media="screen" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php $this->load->view('artist_search/index'); ?>

<div class="light-wrapper">
    <?php foreach ($data['results'] as $row) { ?>
        <div class="container inner panel panel-default panel-flat">
            <?php if (strlen(trim($row->avatar)) != 0) { ?>
                <div class="col-md-3 text-center">
                    <div>
                        <?php
                        if (file_exists('./avatars/' . $row->avatar)) {
                            echo '<img src="' . base_url() . 'avatars/' . $row->avatar . '" width=auto height="120">';
                        } else {
                            echo '<img src="' . base_url() . '/avatars/noavatar.png" width=auto height="120">';
                        }
                    } else {
                        echo '<img src="' . base_url() . '/avatars/noavatar.png" width=auto height="120">';
                    }
                    ?>
                </div>
                <div class="bm10 tm20">
                    <?php
                    $rating = array(
                        'name' => 'vote',
                        'class' => 'rating',
                        'min' => "0",
                        'max' => "5",
                        'step' => "0.5",
                        'data-size' => "xs",
                        'data-glyphicon' => "false",
                        'data-stars' => "5",
                        'data-show-clear' => "false",
                        'data-show-caption' => "true",
                        'value' => $row->vote,
                        'disabled' => 'true',
                    );
                    echo form_input($rating);
                    ?>
                </div>
            </div>
            <div class="col-md-2 text-center tm20">
                <?php
                echo '<strong>Artist: </strong>' . $row->fullname . '<br>' .
                '<strong>Date of birth: </strong>' . date('d-m-Y', strtotime($row->date_of_birth)) . '<br>' .
                '<strong>Country: </strong>' . $row->country . '<br>' .
                '<strong>Genre: </strong>' . $row->genre . '<br>' .
                '<strong>Style: </strong>' . $row->style;
                ?>
            </div>
            <div class="col-md-3 text-center tm20" style="word-wrap: break-word;">
                <?php
                echo '<strong>Biography</strong><br>' . substr($row->bio, 0, 300);
                ;
                ?>
            </div>
            <div class="col-md-4 text-center tm20">
                <?php
                echo '<strong>Artworks</strong><br>';
                foreach ($data['artworks'][$row->id] as $artwork) {
                    echo '<img src="' . base_url() . $artwork->path . '/' . $artwork->filename . '" width=auto height="70">';
                }
                ?>
            </div>
        </div>
    <?php } ?>
</div>

<script src="<?php echo base_url() ?>resources/app/js/star-rating.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/filestyle/bootstrap-filestyle.min.js"></script>