<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">Vote</div>
        <div class="panel-body">

            <div class="container-fluid">
                <fieldset>
                    <div class="text-center">
                        <?php
                        echo '<a href="' . site_url() . '/vote/add/"><button type="button" class="btn btn-labeled btn-success btn-lg">'
                        . '<span class="btn-label"><i class="fa fa-plus-square"></i></span>Add</button></a>';
                        ?>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <strong>
                            <div class="col-md-2">
                                <div class="col-md-4 text-center">#ID</div>
                                <div class="col-md-4 text-center">Users_id</div>
                                <div class="col-md-4 text-center">Artist_id</div>
                            </div>
                            <div class="col-md-3 text-center">Vote</div>
                            <div class="col-md-1 text-center">Comment</div>
                            <div class="col-md-1 text-center">Datecreated</div>
                            <div class="col-md-1 text-center">Dateupdated</div>
                            <div class="col-md-1 text-center">Flag</div>
                            <div class="col-md-3 text-center">Actions</div>
                        </strong>

                </fieldset> 
                <?php
                foreach ($results->result() as $row) {
                    $data = array(
                        'name' => 'vote',
//                            'id' => 'input-399a',
                        'class' => 'rating',
                        'min' => "0",
                        'max' => "5",
                        'step' => "0.5",
                        'data-size' => "xs",
//                            'data-symbol' => "&#xe005;",
                        'data-glyphicon' => "false",
//                            'data-rating-class' => "rating-fa",
                        'data-stars' => "5",
                        'data-show-clear' => "false",
                        'data-show-caption' => "true",
                        'value' => $row->vote,
                        'disabled' => 'true',
                    );
                    ?>
                    <fieldset>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="col-md-4 text-center"><?php echo $row->id ?></div>
                                <div class="col-md-4 text-center"><?php echo $row->users_id ?></div>
                                <div class="col-md-4 text-center"><?php echo $row->artist_id ?></div>
                            </div>
                            <div class="col-md-3 text-center"> <?php echo form_input($data) ?></div>
                            <div class="col-md-1 text-center"> <?php echo $row->comment ?></div>
                            <div class="col-md-1 text-center"><?php echo date('d-m-Y', strtotime($row->datecreated)) ?> </div>
                            <div class="col-md-1 text-center"><?php echo date('d-m-Y', strtotime($row->dateupdated)) ?> </div>
                            <div class="col-md-1 text-center"><?php echo $row->flag ?> </div>
                            <div class="col-md-3">
                                <div class="col-md-6 text-center">
                                    <a href="<?php echo site_url() . '/vote/edit/' . $row->id ?>">
                                        <button type="button" class="btn btn-labeled btn-warning btn-md">
                                            <span class="btn-label">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            Edit
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6 text-center">
                                    <a href="<?php echo site_url() . '/vote/delete/' . $row->id ?>" onclick="return checkDelete()">
                                        <button type="button" class="btn btn-labeled btn-danger btn-md" onclick="ConfirmDelete()" value="delete">
                                            <span class="btn-label">
                                                <i class="fa fa-times"></i>
                                            </span>
                                            Delete
                                        </button>
                                    </a>
                                </div>
                            </div>
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
