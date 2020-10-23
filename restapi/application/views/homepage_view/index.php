<div class="light-wrapper">
    <?php if ($data['slide']) { ?>
        <div class = "container inner">
            <div class = "tp-banner-container">
                <div class = "tp-banner" >
                    <ul>
                        <?php foreach ($data['slide'] as $result) { ?>
                            <li data-transition="fade" data-delay="9000"  data-saveperformance="on"  data-title="Ken Burns Slide"> 
                                <img src="<?php echo base_url() ?>resources/frontend/images/dummy.png"  alt="" data-lazyload="<?php echo base_url() . $result->path . '/' . $result->filename ?>" data-bgposition="right top" data-kenburns="on" data-duration="12000" data-ease="Power0.easeInOut" data-bgfit="115" data-bgfitend="100" data-bgpositionend="center bottom">
                                <div class="caption sfr title light-layer" data-x="right" data-y="400" data-speed="700" data-start="2300" data-easing="Sine.easeOut"><?php echo $result->title ?></div>
                                <div class="caption sfr lead light-layer" data-x="right" data-y="454" data-speed="700" data-start="2800" data-easing="Sine.easeOut"><?php echo substr($result->content, 0, 70) ?></div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>

                <div class="tp-bannertimer tp-bottom"></div>
            </div>
        </div>
    </div>
</div>
<!-- /.light-wrapper -->
<div class="dark-wrapper">
    <div class="container inner">
        <h1 class="intro text-center">Hello! We are BoostIT Academy</h1>
        <p class="lead main text-center" style="margin-bottom: 0px;">Our company covers the entire business solution lifecycle through consultancy on optimal solution to implementation of complex projects based on customer needs.</p>
    </div>
</div>
<div class="light-wrapper">
    <div class="container inner">
        <?php if ($data['gallery']) { ?>
            <h3 class="section-title pull-left">Our Awesome Shots</h3>
            <div class="portfolio fix-portfolio">
                <div id="filters" class="button-group pull-right">
                    <button class="button is-checked" data-filter="*">All</button>
                    <button class="button" data-filter=".boost">BoostIT</button>
                    <button class="button" data-filter=".web">Web Design</button>
                    <button class="button" data-filter=".graphic">Graphic Design</button>
                    <button class="button" data-filter=".video">Motion Graphics</button>
                    <button class="button" data-filter=".photography">Photography</button>
                </div>
                <div class="clearfix"></div>
                <div class="isotope items">
                    <?php
                    $size = array('width2 height2 web', 'grafic', 'video', 'web', 'photography', 'web', 'width2 height2 video', 'boost', 'photography');

                    foreach ($data['gallery'] as $data) {
                        ?>
                        <div class = "item <?php echo $size[rand(0, 8)] ?>">
                            <figure><a href = "<?php echo base_url() . $data->path . '/' . $data->filename ?>" class="fancybox-media" data-rel="portfolio" rel="portfolio">
                                    <div class = "text-overlay">
                                        <div class = "info"><span><?php echo $data->title ?></span></div>
                                    </div>
                                    <img src = "<?php echo base_url() . $data->path . '/' . $data->filename ?>" style="width:auto; height:100%; max-height:1000%; max-width:1000%;" alt = "" /> </a>
                            </figure>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!-- /.portfolio -->

            <div class="divide70"></div>

        <?php } ?>

        <h3 class="section-title text-center">Let's make something great together</h3>
        <div class="text-center"> 
            <a href="<?php echo site_url() . '/search' ?>" class="btn btn-large fixed-width">View More Work</a>
            <a href="<?php echo site_url() . '/contact' ?>" class="btn btn-large btn-maroon fixed-width">Get in Touch</a> </div>
    </div>
    <!-- /.container --> 
</div>
<!-- /.light-wrapper -->

<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1xdEVYy8IZdBKJGQp_QpDWaNQT7ZHGhY&sensor=false&extension=.js"></script> 
<script> google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(44.8366356, 24.9574793),
            zoom: 14,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            disableDoubleClickZoom: false,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            },
            scaleControl: true,
            scrollwheel: false,
            streetViewControl: true,
            draggable: true,
            overviewMapControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{stylers: [{saturation: -100}, {gamma: 1}]}, {elementType: "labels.text.stroke", stylers: [{visibility: "off"}]}, {featureType: "poi.business", elementType: "labels.text", stylers: [{visibility: "off"}]}, {featureType: "poi.business", elementType: "labels.icon", stylers: [{visibility: "off"}]}, {featureType: "poi.place_of_worship", elementType: "labels.text", stylers: [{visibility: "off"}]}, {featureType: "poi.place_of_worship", elementType: "labels.icon", stylers: [{visibility: "off"}]}, {featureType: "road", elementType: "geometry", stylers: [{visibility: "simplified"}]}, {featureType: "water", stylers: [{visibility: "on"}, {saturation: 50}, {gamma: 0}, {hue: "#50a5d1"}]}, {featureType: "administrative.neighborhood", elementType: "labels.text.fill", stylers: [{color: "#333333"}]}, {featureType: "road.local", elementType: "labels.text", stylers: [{weight: 0.5}, {color: "#333333"}]}, {featureType: "transit.station", elementType: "labels.icon", stylers: [{gamma: 1}, {saturation: 50}]}]
        }

        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [
            ['Strada Golești, Golești 117717', 44.8366356, 24.9574793]
        ];
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                icon: '<?php echo base_url() ?>resources/frontend/images/map-pin.png',
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });
        }
    }

</script>