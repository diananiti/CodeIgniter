<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Artwork Gallery</div>
        <div class="panel-body">
            <div class="container-fluid">
                <fieldset>
                    <div class="text-center"> 
                        <?php echo '<a href="' . site_url() . '/artworkgallery/add/"><button type="button" class="btn btn-labeled btn-success btn-lg"><span class="btn-label"><i class="fa fa-plus-square"></i></span>Add</button></a>'; ?>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <strong>
                            <div class="col-md-1 text-center">#ID</div>
                            <div class="col-md-1 text-center">Artwork_id</div>
                            <div class="col-md-3 text-center">Datecreated</div>
                            <div class="col-md-4 text-center">Image</div>
                            <div class="col-md-3 text-center">Actions</div>
                        </strong>
                    </div>
                </fieldset>

                <?php foreach ($results->result() as $row) { ?>
                    <fieldset>
                        <div class="row">
                            <?php
                            echo '<div class="col-md-1 text-center">' . $row->id . '</div>'
                            . '<div class="col-md-1 text-center">' . $row->artwork_id . '</div>'
                            . '<div class="col-md-3 text-center">' . $row->datecreated . '</div>';

                            echo '<div class="col-md-4 text-center"><img src="' . base_url() . $row->path . '/' . $row->filename . '" width=auto height="70"></div>';

                            echo '<div class="col-md-3 text-center"><a href="' . site_url() . '/artworkgallery/delete/' . $row->id . '" onclick="return checkDelete()"><button type="button" class="btn btn-labeled btn-danger" onclick="ConfirmDelete()" value="delete"><span class="btn-label"><i class="fa fa-times"></i></span>Delete</button></a></div>'
                            . '';
                            ?>
                        </div></fieldset>
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


