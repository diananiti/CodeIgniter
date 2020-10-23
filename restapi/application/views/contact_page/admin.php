
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Contact page</strong></div>
        <div class="panel-body">
            <!--<div class="table-responsive">-->
            <div class="container-fluid">
                <fieldset>
                    <div class="text-center"> 
                        <?php echo '<a href="' . site_url() . '/contact/add/"><button type="button" class="btn btn-labeled btn-success btn-lg"><span class="btn-label"><i class="fa fa-plus-square"></i></span>Add</button></a>'; ?>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <strong>
                            <div class="col-md-1 text-center">ID</div>
                            <div class="col-md-2 text-center">Name</div>
                            <div class="col-md-2 text-center">Email</div>
                            <div class="col-md-2 text-center">Message</div>
                           
                        </strong>
                    </div>
                </fieldset>
                </thead>
                <?php
                foreach ($results->result() as $row) {
                    ?>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-1 text-center">
                                <?php echo $row->id ?>
                            </div>
                            <div class="col-md-2 text-center">
                                <?php echo $row->name?>
                            </div>
                            <div class="col-md-2 text-center" style="word-wrap: break-word">
                                <?php echo $row->email ?>
                            </div>
                            
                            <div class="col-md-2 text-center" style="word-wrap: break-word">
                                <?php echo substr($row->message, 0, 300); ?>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="col-md-4 text-center">
                                    <a href="<?php echo site_url() . '/contact/edit/' . $row->id ?>">
                                        <button type="button" class="btn btn-labeled btn-warning btn-md">
                                            <span class="btn-label">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            Edit
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-4 text-center">
                                    <a href="<?php echo site_url() . '/contact/delete/' . $row->id ?>" onclick="return checkDelete()">
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
                <ul class="pagination pagination-lg">
                    <?php echo $pagination_links; ?>
                </ul>
            </div>
            <!--</div>-->
        </div>
    </div>
</div>




