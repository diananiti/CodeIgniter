<?php
/**
 * Created by PhpStorm.
 * User: web
 * Date: 8/9/2015
 * Time: 21:55
 */
?>
<section class="wrapper">
    <?php if ($this->session->userdata('user')) { ?>
        <!-- START Top Navbar-->
        <nav class="navbar navbar-default navbar-top navbar-fixed-top" role="navigation">
            <!-- START navbar header-->
            <div class="navbar-header">
                <a class="navbar-brand" href="javascript:void(0);">
                    <div class="brand-logo">ArtGrade</div>
                    <div class="brand-logo-collapsed">ArtGrade</div>
                </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
                <!-- START Left navbar-->
                <ul class="nav navbar-nav">
                    <li>
                        <a data-toggle="aside" href="javascript:void(0);">
                            <em class="fa fa-align-left"></em>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="navbar-search" href="javascript:void(0);">
                            <em class="fa fa-search"></em>
                        </a>
                    </li>
                </ul>
                <!-- END Left navbar-->

            </div>
            <!-- END Nav wrapper-->
            <!-- START Search form-->
            <form class="navbar-form" role="search">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Type and hit Enter..">
                    <div class="fa fa-times form-control-feedback" data-toggle="navbar-search-dismiss"></div>
                </div>
                <button class="hidden btn btn-default" type="submit">Submit</button>
            </form>
            <!-- END Search form-->
        </nav>
        <!-- END Top Navbar-->
        <!-- START aside-->
        <aside class="aside">
            <!-- START Sidebar (left)-->
            <nav class="sidebar">
                <ul class="nav">
                    <!-- START user info-->
                    <li>
                        <div class="item user-block has-submenu" data-toggle="collapse-next">
                            <!-- User picture-->
                            <div class="user-block-picture">
                                <!--<img width="60" height="60" class="img-thumbnail img-circle" alt="Avatar" src="app/img/user/02.jpg">-->
                                <!-- Status when collapsed-->
                                <div class="user-block-status">
                                    <div class="point point-success point-lg"></div>
                                </div>
                            </div>
                            <!-- Name and Role-->
                            <div class="user-block-info">

                                <span class="user-block-name item-text"><?php
                                    $user = $this->session->userdata('user');
                                    echo $user['fullname'];
                                    ?></span>

                                <span class="user-block-role">Designer</span>
                                <br>
                                <!-- START Dropdown to change status-->
                                <div class="btn-group user-block-status">
                                    <button class="btn btn-xs dropdown-toggle" data-duration="0.2" data-play="fadeIn" data-toggle="dropdown" type="button">
                                        <div class="point point-success"></div>Online</button>
                                    <ul class="dropdown-menu text-left pull-right">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="point point-success"></div>Online</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="point point-warning"></div>Away</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <div class="point point-danger"></div>Busy</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END Dropdown to change status-->
                            </div>
                        </div>
                        <!-- START User links collapse-->
                        <ul class="nav collapse">
                            <li><a href="<?php echo site_url() . '/user/user_profile' ?>">Profile</a>
                            </li>
                            <li><a href="javascript:void(0);">Settings</a>
                            </li>
                            <li><a href="javascript:void(0);">Notifications<div class="label label-danger pull-right">120</div></a>
                            </li>
                            <li><a href="javascript:void(0);">Messages<div class="label label-success pull-right">300</div></a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url() ?>/user/logout">Logout</a>
                            </li>
                        </ul>
                        <!-- END User links collapse-->
                    </li>
                    <!-- END user info-->
                    <!-- START Menu-->
                    <li class="col-md-12">
                        <?php
                        $menu = array(
                            'Roles' => array(
                                'href' => site_url() . "/roles",
                                'icon' => "fa fa-users"
                            ),
                            'Genre' => array('href' => site_url() . "/genre", 'icon' => "fa fa-bars"),
                            'Vote' => array('href' => site_url() . "/vote", 'icon' => "fa fa-thumbs-up"),
                            'Style' => array('href' => site_url() . "/style", 'icon' => "fa fa-star"),
                            'Continents' => array('href' => site_url() . "/continents", 'icon' => "fa fa-globe"),
                            'Countries' => array('href' => site_url() . "/countries", 'icon' => "fa fa-flag"),
                            'Artist' => array('href' => site_url() . "/artist", 'icon' => "fa fa-question"),
                            'Pages' => array('href' => site_url() . "/pages", 'icon' => "fa fa-file-text-o"),
                            'Artwork' => array('href' => site_url() . "/artwork", 'icon' => "fa fa-desktop")
                        );
                        echo '<ul>';
                        foreach ($menu as $key => $value) {
                            echo '<br><li><a class="no-submenu" data-toggle="<br> title="' . $key . '" href="' . $value['href'] . '">   
                             <em class="' . $value['icon'] . '"></em>
                            <div class="label label-primary pull-right">new</div>
                            <span class="item-text">' . $key . '</span>
                            </a></li>';
                        }
                        echo '</ul>';
                        ?>
                        <!-- END Menu-->
                </ul>
            </nav>
            <!-- END Sidebar (left)-->
        </aside>
        <!-- End aside-->
        <!-- START aside-->


    </aside>
    <!-- END aside-->
<?php } ?>
<!-- START Main section-->
<section>
    <!-- START Page content-->
    <section class="main-content">
        <?php
//            $data['input'] = $data;
        $this->load->view($viewpath, $data);
        ?>
        <!-- END row-->
    </section>
    <!-- END Page content-->
</section>
<!-- END Main section-->
</section>