<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><strong>Roles</strong></div>
        <div class="panel-body">
            <div class="container-fluid">
                <fieldset>
                    <div class="text-center">
                        <?php echo '<a href="' . site_url() . '/roles/add/"><button type="button" class="btn btn-labeled btn-success btn-lg"><span class="btn-label"><i class="fa fa-plus-square"></i></span>Add</button></a>'; ?></center><br>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <strong>
                            <div class="col-md-1 text-center">#ID</div>
                            <div class="col-md-2 text-center">Role</div>
                            <div class="col-md-2 text-center">Ratio</div>
                            <div class="col-md-2 text-center">Datecreated</div>
                            <div class="col-md-2 text-center">Dateupdated</div>
                            <div class="col-md-3 text-center">Actions</div>
                        </strong>
                    </div>
                </fieldset>

                <?php foreach ($results->result() as $row) { ?>
                    <fieldset>
                        <div class="row">
                            <?php
                            echo '<div class="col-md-1 text-center">' . $row->id . '</div>'
                            . '<div class="col-md-2 text-center">' . $row->role . '</div>'
                            . '<div class="col-md-2 text-center">' . $row->ratio . '</div>'
                            . '<div class="col-md-2 text-center">' . date('d-m-Y', strtotime($row->datecreated)) . '</div>'
                            . '<div class="col-md-2 text-center">' . date('d-m-Y', strtotime($row->dateupdated)) . '</div>'
                            . '<div class="col-md-3"><div class="col-md-6 text-center"><a href="' . site_url() . '/roles/edit/' . $row->id . '"><button type="button" class="btn btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-pencil"></i></span>Edit</button></a></div>'
                            . '<div class="col-md-6 text-center"><a href="' . site_url() . '/roles/delete/' . $row->id . '" onclick="return checkDelete()"><button type="button" class="btn btn-labeled btn-danger" onclick="ConfirmDelete()" value="delete"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</button></a></div>'
                            . '';
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
            <!--</div>-->
        </div>
    </div>
</div>


