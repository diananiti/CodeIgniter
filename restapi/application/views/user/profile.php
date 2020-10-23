<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading text-center">Profile</div>
        <div class="panel-body">
            <!--<div class="table-responsive">-->
            <div class="container-fluid">
                <div class="col-md-3 text-center">
                    <?php echo '<img src="' . base_url() . '/avatars/noavatar.png" width=auto height="120">'; ?>
                </div>
                <div class="col-md-9 text-center mrg45T">
                    <strong>
                        <div class="col-md-3">Fullname:</div>
                        <div class="col-md-3">Username:</div>
                        <div class="col-md-3">Email:</div>
                        <div class="col-md-3">Datecreated:</div>
                    </strong>
                    <div class="col-md-3"><?php echo $user->fullname ?></div>
                    <div class="col-md-3"><?php echo $user->username ?></div>
                    <div class="col-md-3"><?php echo $user->email ?></div>
                    <div class="col-md-3"><?php echo date('d-m-Y', strtotime($user->datecreated)) ?></div>
        <!--            Fullname: <?php echo $user->fullname ?> <br>
                Username: <?php echo $user->username ?> <br>
                Email: <?php echo $user->email ?> <br>
                Datecreated: <?php echo date('d-m-Y', strtotime($user->datecreated)) ?> <br>-->

                </div>
            </div>
        </div>
    </div>
</div>

