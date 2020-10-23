<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="navbar default centered">
    <div class="navbar-header">
        <div class="container basic-wrapper"> <a class="btn responsive-menu pull-right" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
            <div class="navbar-brand text-center"><a href="<?php echo site_url() ?>"><img src="<?php echo base_url() ?>resources/frontend/images/logo.png" alt="" data-src="<?php echo base_url() ?>resources/frontend/images/logo.png" data-ret="<?php echo base_url() ?>resources/frontend/images/logo@2x.png" class="retina" /></a></div>
        </div>
        <!--/.container -->
        <nav class="collapse navbar-collapse text-center">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url() ?>">Home</a></li>
                <li><a href="<?php echo site_url() . '/contact' ?>">Contact</a></li>
                <li><a href="<?php echo site_url() . '/search' ?>">Search</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle js-activated">Language</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url() ?>/langswitch/switchLanguage/english">English</a></li>
                        <li><a href="<?php echo site_url() ?>/langswitch/switchLanguage/romanian">Romanian</a></li>
                        <li><a href="<?php echo site_url() ?>/langswitch/switchLanguage/french">French</a></li>
                        <li><a href="<?php echo site_url() ?>/langswitch/switchLanguage/german">German</a></li>
                    </ul>
                </li>
                <?php foreach ($this->session->userdata('menu_pages') as $page) { ?>
            <!--<li><a href = "<?php echo site_url() . '/frontend/index/' . $page->slug ?>"><?php echo $page->title; ?></a></li>-->
                    <li><a href = "<?php echo site_url() . '/' . $page->slug ?>"><?php echo $page->title; ?></a></li>
                <?php } ?>

                <?php
                if ($this->session->userdata('user')) {
                    $user = $this->session->userdata('user');
                    ?>


                    <li class="dropdown pull-right"><a href="<?php echo site_url() . '/profile' ?>" class="dropdown-toggle js-activated">Account</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-submenu"><a href="<?php echo site_url() . '/profile' ?>">Profile</a>
<!--                                <ul class="dropdown-menu">
                                    <li><a href="#"><?php echo $user['fullname'] ?></a></li>
                                    <li><a href="#"><?php echo $user['username'] ?></a></li>
                                </ul>-->
                            </li>
                            <li class="dropdown-submenu"><a href="#">Settings</a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url() ?>/user/forgot_password">Change Password</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo site_url() ?>/frontend/logout">Logout</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="pull-right"><a href = "<?php echo site_url() ?>/login">Log in!</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <!--/.navbar-header --> 

</div>
<!--/.navbar -->
<div class="offset2"></div>