<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Artist</div>
        <div class="panel-body">
            <div class="container-fluid">
                <fieldset>
                    <div class="text-center"> <?php echo '<a href="' . site_url() . '/artist/add/"><button type="button" class="btn btn-labeled btn-success btn-lg"><span class="btn-label"><i class="fa fa-plus-square"></i></span>Add</button></a>'; ?>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <strong><div class="col-md-2">
                                <div class="col-md-2 text-center">#ID</div>
                                <div class="col-md-5 text-center">Full Name</div>
                                <div class="col-md-5 text-center">Genre</div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-2 text-center">Style</div>
                                <div class="col-md-3 text-center">Substyle</div>
                                <div class="col-md-3 text-center">Country</div>
                                <div class="col-md-4 text-center">Date of birth</div>        
                            </div>

                            <div class="col-md-1 text-center">Bio</div>
                            <div class="col-md-1 text-center">Vote</div>
                            <div class="col-md-1 text-center">Artworks</div>
                            <div class="col-md-1 text-center">Avatar</div>
                            <div class="col-md-1 text-center">Users</div>
                            <div class="col-md-2 text-center">Actions</div>
                        </strong>
                    </div>
                </fieldset>
                <?php foreach ($results->result() as $row) { ?>
                    <fieldset>
                        <div class="row">
                            <?php
                            $date = explode('-', $row->date_of_birth);
                            $date_of_birth = implode('-', array($date[2], $date[1], $date[0]));

                            echo '<div class="col-md-2 text-center"><div class="col-md-2 text-center">' . $row->id . '</div>'
                            . '<div class="col-md-5 text-center">' . $row->fullname . '</div>'
                            . '<div class="col-md-5 text-center">' . $row->genre . '</div></div>'
                            . '<div class="col-md-3"><div class="col-md-2 text-center">' . $row->style . '</div>'
                            . '<div class="col-md-3 text-center">' . $row->style . '</div>'
                            . '<div class="col-md-3 text-center">' . $row->country . '</div>'
                            . '<div class="col-md-4 text-center">' . $date_of_birth . '</div></div>'
                            . '<div class="col-md-1 text-center" style="word-wrap: break-word">' . $row->bio . '</div>'
                            . '<div class="col-md-1 text-center">' . $row->vote . '</div>'
                            . '<div class="col-md-1 text-center">' . $row->artworks . '</div>';
                            if (strlen(trim($row->avatar)) != 0) {
                                if (file_exists('./avatars/' . $row->avatar)) {
                                    echo '<div class="col-md-1 text-center"><img src="' . base_url() . 'avatars/' . $row->avatar . '" width="100" height=auto></div>';
                                } else {
                                    echo '<div class="col-md-1 text-center"><img src="' . base_url() . '/avatars/noavatar.png" width="100" height=auto></div>';
                                }
                            } else {
                                echo '<div class="col-md-1 text-center"><img src="' . base_url() . '/avatars/noavatar.png" width="100" height=auto></div>';
                            }

                            echo '<div class="col-md-1 text-center">' . $row->users . '</div>'
                            . '<div class="col-md-2 text-center"><div class="col-md-6 text-center"> <a href="' . site_url() . '/artist/edit/' . $row->id . '"><button type="button" class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Edit</button></a></div>'
                            . '<div class="col-md-6 text-center"> <a href="' . site_url() . '/artist/delete/' . $row->id . '" onclick="return checkDelete()"><button type="button" class="btn btn-labeled btn-danger" onclick="ConfirmDelete()" value="delete"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</button></a></div>'
                            . '</div>';
                            ?>
                        </div>
                    </fieldset>
                    <?php
                }
                ?>
                <div class="col-md-12 text-center">
                    <ul class="pagination pagination-lg">
                        <?php echo $pagination_links; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

