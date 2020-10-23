<?php
/**
 * Created by
 * User: web
 * Date: 8/9/2015
 * Time: 21:46
 */
?>
<!-- END Main wrapper-->
<!-- START Scripts-->
<!-- Main vendor Scripts-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Plugins-->
<script src="<?php echo base_url() ?>resources/vendor/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/slider/js/bootstrap-slider.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/filestyle/bootstrap-filestyle.min.js"></script>
<!-- Animo-->
<script src="<?php echo base_url() ?>resources/vendor/animo/animo.min.js"></script>
<!-- Sparklines-->
<script src="<?php echo base_url() ?>resources/vendor/sparklines/jquery.sparkline.min.js"></script>
<!-- Slimscroll-->
<script src="<?php echo base_url() ?>resources/vendor/slimscroll/jquery.slimscroll.min.js"></script>
<!-- START Page Custom Script-->
<!--  Flot Charts-->
<script src="<?php echo base_url() ?>resources/vendor/flot/jquery.flot.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/flot/jquery.flot.categories.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/moment/min/moment-with-langs.min.js"></script>
<script src="<?php echo base_url() ?>resources/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!--[if lt IE 8]><script src="<?php echo base_url() ?>resources/js/excanvas.min.js"></script><![endif]-->
<!-- END Page Custom Script-->
<!-- App Main-->

<script src="<?php echo base_url() ?>resources/wysihtml5/bootstrap3-wysihtml5.js"></script>
<script src="<?php echo base_url() ?>resources/wysihtml5/locales/bootstrap-wysihtml5.en-US.js"></script>
<script type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.3/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/wysihtml5/advanced_unwrap.js"></script>
<script src="<?php echo base_url() ?>resources/wysihtml5/wysihtml5x-toolbar.min.js"></script>
<script src="<?php echo base_url() ?>resources/app/js/app.js"></script>
<script src="<?php echo base_url() ?>resources/app/js/star-rating.min.js"></script>

<script>
    var editors = [];
    if ($('.ewrapper').length != 0) {
        $('.ewrapper').each(function (idx, wrapper) {

            var e = new wysihtml5.Editor($(wrapper).find('.editable').get(0), {
                toolbar: $(wrapper).find('.toolbar').get(0),
                parserRules: wysihtml5ParserRules,
                stylesheets: "css/stylesheet.css"
                        //showToolbarAfterInit: false
            });
            editors.push(e);
        });
    }
</script>

<script type="text/javascript">
    // When the document is ready
    $(function () {
        $('#dateofbirth').datetimepicker({
            lang: 'en',
            format: 'DD-MM-YYYY'
        });
    });
    if ($('#bio').length != 0) {
        $('#bio').wysihtml5({
            "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": true, //Italics, bold, etc. Default true
            "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": false, //Button which allows you to edit the generated HTML. Default false
            "link": true, //Button to insert a link. Default true
            "image": true, //Button to insert an image. Default true,
            "color": false, //Button to change color of font
            "blockquote": true, //Blockquote
            "size": 'sm' //default: none, other options are xs, sm, lg
        });
    }
</script>

<script language="JavaScript" type="text/javascript">
    function checkDelete() {
        return confirm('Are you sure?');
    }
</script>

<!-- END Scripts-->
</body>

</html>