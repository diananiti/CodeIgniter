<!--<div class="parallax parallax2 customers">-->
<div class="light-wrapper">
    <!--<div class="container inner">-->
    <div class="container inner panel panel-default panel-flat tm20">
        <fieldset>
            <h1 class="text-center">Profile</h1>
        </fieldset>
        <fieldset>
            <div class="col-md-3 text-center">
                <?php echo '<img src="' . base_url() . '/avatars/noavatar.png" width=auto height="120">'; ?>
            </div>
            <div class="col-md-9 text-center tm40">
                <strong>
                    <div class="col-md-3">Full name:</div>
                    <div class="col-md-3">Username:</div>
                    <div class="col-md-3">E-mail:</div>
                    <div class="col-md-3">Created on:</div>
                </strong>
                <div class="col-md-3"><?php echo $user->fullname ?></div>
                <div class="col-md-3"><?php echo $user->username ?></div>
                <div class="col-md-3"><?php echo $user->email ?></div>
                <div class="col-md-3"><?php echo date('d-m-Y', strtotime($user->datecreated)) ?></div>
            </div>
        </fieldset>
        <fieldset>
            <h2>
                <div class="text-center col-md-3">
                    <a href="<?php site_url()?>profile/password">Change password</a>
                </div>
                <div class="text-center col-md-3">
                    <a href="#">Change avatar</a>
                </div>
                <div class="text-center col-md-3">
                    <a href="#">Change full name</a>
                </div>
                <div class="text-center col-md-3">
                    <a href="#">Change username</a>
                </div>
            </h2>
        </fieldset>

    </div>
</div>

