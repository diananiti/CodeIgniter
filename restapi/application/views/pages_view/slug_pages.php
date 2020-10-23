<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center"><strong><h2>Pages</h2></strong></div>
        <div class="panel-body">
 
            <!--<div class="table-responsive">-->
            <div class="container-fluid">
                <fieldset>
                    <div class="text-center">
                        <?php
                        if($page){ echo $page->page;
                            
                        }
                        
                        
                       
                        
                        
                        ?>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <strong>
                        
                      
                            <div class="col-md-1 text-center">Slug</div>
                            <div class="col-md-1 text-center">Title</div>
                            <div class="col-md-3 text-center">Content</div>
                        
                    </div>
                </fieldset>
                <?php //foreach ($results->result() as $row) { ?>
                    <fieldset>
                
                            </div>
                            <div class="col-md-1 text-center" style="word-wrap: break-word">
                                <?php echo $row->slug ?>
                            </div>
                            <div class="col-md-1 text-center" style="word-wrap: break-word">
                                <?php echo $row->title ?>
                            </div>
                            <div class="col-md-3 text-center" style="word-wrap: break-word">
                                <?php echo substr($row->content, 0, 300); ?>
                            </div>
                      
                           
                           
                                </div>
                            </div>
                        </div>
                    </fieldset>
                <?php// } ?>
                <div class="col-md-12 text-center">
                    <ul class="pagination pagination-lg">
                        <?php echo $pagination_links; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
