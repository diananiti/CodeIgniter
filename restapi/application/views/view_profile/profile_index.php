<div class="light-wrapper">
    <div class="container inner">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading text-left">Artist</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <fieldset>
                           <div class="col-md-10 text-left">  

               <?php
                            if ($artist->avatar) {
                                if (file_exists('./avatars/' . $artist->avatar)) {
                                    echo '<div class="col-md-1 text-center"><img src="' . base_url() . 'avatars/' . $artist->avatar . '" width="70" height="70"></div>';
                                } else {
                                    echo '<div class="col-md-1 text-center"><img src="' . base_url() . 'avatars/noavatar.png width="70" height="70""></div>';
                                }
                            } else {
                                echo '<div class="col-md-1 text-center"><img src="' . base_url() . 'avatars/noavatar.png width="70" height="70""></div>';
                            }
                            ?> 

                           </div>
                            </fieldset>
                                
                            <fieldset>
                                <div class ="fotorama__nav-wrap" >
                                    <div class="fotorama__nav fotorama__nav--thumbs fotorama__shadows--left fotorama__shadows--right"style="width: 903px;>
                            <div class="col-md-10 text-right"> <?php
                                foreach ($artworks as $row) {
                                    echo($row->title) . '<br>';
                                    if ($artist->avatar) {
                                        if (file_exists($row->path . '/' . $row->filename)) {
                                            echo '<div class="col-md-1 text-center"><img src="' . base_url() . $row->path . '/' . $row->filename . '" width="70" height="70"></div>';
                                        } else {
                                            echo '<div class="col-md-1 text-center"><img src="' . base_url() . 'avatars/noavatar.png width="70" height="70""></div>';
                                        }
                                    } else {
                                        echo '<div class="col-md-1 text-center"><img src="' . base_url() . 'avatars/noavatar.png width="70" height="70""></div>';
                                    }
                                }
                                ?></div></div></div>
                            <div class="col-md-10 text-right"> <?php
                                foreach ($votes as $row) {
                                    echo($row->vote) . '<br>';
                                }
                                ?></div>
                        </fieldset>
                        <fieldset>
                            <br>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                               
                                    <div class="col-md-6">
                                        <div class="col-md-4">
                                            <div class="col-md-6 text-center"><strong>Full Name</strong></div>
                                            <div class="col-md-6 text-center"><strong>Genre</strong></div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="col-md-3 text-center"><strong>Style</strong></div>

                                            <div class="col-md-3 text-center"><strong>Country</strong></div>
                                            <div class="col-md-4 text-center"><strong>Date of birth</strong></div>        
                                        </div>

                                        <div class="col-md-3 text-center"><strong>Bio</strong></div>



                                        <?php ?>
                                </strong>
                            </div>
                    </div>

                    </fieldset>


                    <?php if ($artist) { ?>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-4 text-center">

                                        <div class="col-md-6 text-center"><?php echo $artist->fullname ?></div>
                                        <div class="col-md-6 text-center"><?php echo $artist->genre ?></div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-md-3 text-center"><?php echo $artist->style ?></div>
                                        <div class="col-md-3 text-center"><?php echo $artist->country ?> </div>
                                        <div class="col-md-4 text-center"> <?php echo $artist->date_of_birth ?></div>
                                    </div>
                                    <div class="col-md-3 text-center"><?php echo $artist->bio ?> </div>

                                </div>
                            </div>
                        </fieldset>

                       
                    </div>

                    <?php
                }
                ?>
                <div class="col-md-12 text-center">
                    <ul class="pagination pagination-lg">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


