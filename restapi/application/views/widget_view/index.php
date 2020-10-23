<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="container basic-wrapper"> <a class="btn responsive-menu pull-right" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
    <div class="navbar-brand text-center"><img src="<?php echo base_url() ?>resources/frontend/images/logo.png" alt="" data-src="<?php echo base_url() ?>resources/frontend/images/logo.png" data-ret="<?php echo base_url() ?>resources/frontend/images/logo@2x.png" class="retina" /></div>
</div>
<!--/.container -->
<nav class="collapse navbar-collapse text-center">
    <ul class="nav navbar-nav">
      
        <?php
        $user = $this->session->userdata('user');
        ?>
           <li><a href="<?php echo site_url() ?>/contact">CONTACT</a></li>
             <li><a href="<?php echo site_url() ?>/frontend">HOME</a></li>
                  
                      <li class="dropdown pull-right"><a href="#" class="dropdown-toggle js-activated">SEARCH</a>
                        <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url() ?>/artist">Artist</a></li>
                              
                         
                            <li><a href="<?php echo site_url() ?>/artwork">Artwork</a></li>
                       </ul>

    </ul>
</nav>
</div>
<!--/.navbar-header --> 

</div>
<!--/.navbar -->
