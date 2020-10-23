<?php
/**
 * Created by
 * User: web
 * Date: 8/9/2015
 * Time: 21:46
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="ie ie7 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="ie ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>
<html class="ie ie9" lang="en"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-ie">
    <!--<![endif]-->

    <head>
        <!-- Meta-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <title>ArtGrade </title>
       
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/app/css/bootstrap.css">
        <!-- Vendor CSS-->
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/vendor/animo/animate+animo.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/vendor/csspinner/csspinner.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/wysihtml5/bootstrap3-wysihtml5.css">
        <!-- START Page Custom CSS-->
        <!-- END Page Custom CSS-->
        <!-- App CSS-->
        <link rel="stylesheet" href="<?php echo base_url() ?>resources/app/css/app.css">
        <link href="<?php echo base_url() ?>resources/app/css/multi-select.css"  media="screen" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>resources/app/css/star-rating.min.css"  media="screen" rel="stylesheet" type="text/css">
        <!-- Modernizr JS Script-->
        <script src="<?php echo base_url() ?>resources/vendor/modernizr/modernizr.js"
        type="application/javascript"></script>
        <!-- FastClick for mobiles-->
        <script src="<?php echo base_url() ?>resources/vendor/fastclick/fastclick.js"
        type="application/javascript"></script>
        
        <style>
            #toolbar [data-wysihtml5-action] {
                float: right;
            }

            #toolbar,
            textarea {
                width: 100%;
                padding: 5px;
                -webkit-box-sizing: border-box;
                -ms-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            textarea {
                height: 280px;
            }

            textarea:focus {
                color: black;
                border: 2px solid black;
            }

            .wysihtml5-command-active {
                font-weight: bold;
            }

            [data-wysihtml5-dialog] {
                margin: 5px 0 0;
                padding: 5px;
                border: 1px solid #666;
            }
        </style>

        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
