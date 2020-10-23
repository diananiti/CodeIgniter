
<div class="full-layout">
    <div class="body-wrapper animsition">
      <div class="navbar default centered">
        <div class="navbar-header">

        </div>
      </div>
      <div class="light-wrapper">
        <div class="container inner">
          <div class="row">
            <div class="col-sm-8">
                
                <?php 
                if(strlen(trim(validation_errors()))==0 && isset($_POST['name'])){?>
                
                <h2 style="background-color:#F3ECEC"> <?php echo 'The message was send and our team will process him'; ?></h2>
                <?php }else{ ?>

                <h3 class="section-title"><strong>Contact Page</strong></h3>  
             
                <fieldset>
                  
                        <?php
                        $attributes = array('data' => 'db', 'id' => 'myform', 'class' => 'form-horizontal');
                        echo form_open('contact/' . $op, $attributes);
                        ?>
                        <fieldset>

                            <div class="form-group
                            <?php
                            if (form_error('contact')) {
                                echo 'has-error';
                            } else {
                                echo 'control-label';
                            }
                            ?>">
                                <div class="col-md-12">
                                    <?php echo form_label('Name : ', 'name', array("class" => "col-sm-2 control-label")); ?>
                                    <div class="col-sm-10">
                                        <?php
                                        $data = array(
                                            'name' => 'name',
                                            'id' => 'name',
                                            'placeholder' => "Name (Required)",
                                            'value' => isset($results->name) ? $results->name : set_value('name'),
                                            'maxlength' => '100',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        if (!is_null(form_error('name'))) {
                                            // echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('name') . '</li></ul>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group 
                            <?php
                            if (form_error('email')) {
                                echo 'has-error';
                            } else {
                                echo 'control-label';
                            }
                            ?>">
                                <div class="col-md-12">
                                    <?php echo form_label('Email: ', 'email', array("class" => "col-sm-2 control-label")); ?>
                                    <div class="col-sm-10">
                                        <?php
                                        $data = array( 
                                            'name' => 'email',
                                            'id' => 'email',
                                            'placeholder' => "Email (Required)",
                                            'value' => isset($results->email) ? $results->email : set_value('email'),
                                            'maxlength' => '100',
                                            'class' => 'form-control'
                                        );
                                        echo form_input($data);
                                        if (!is_null(form_error('email'))) {
                                            // echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('email') . '</li></ul>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-group 
                            <?php
                            if (form_error('message')) {
                                echo 'has-error';
                            } else {
                                echo 'control-label';
                            }
                            ?>">
                                <div class="col-md-12">
                                    <?php echo form_label('Message: ', 'message', array("class" => "col-sm-2 control-label")); ?>
                                    <div class="col-sm-10">
                                        <?php
                                        $data = array(
                                            'name' => 'message',
                                            'id' => 'message',
                                            'placeholder' => "Message (Required)",
                                            'value' => isset($results->message) ? $results->message : set_value('message'),
                                            'maxlength' => '100',
                                            'class' => 'form-control'
                                        );
                                        echo form_textarea($data);
                                        if (!is_null(form_error('message'))) {
                                            //   echo '<ul class="parsley-errors-list filled"><li class="parsley-required">' . form_error('message') . '</li></ul>';
                                        }
                                        ?>   
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcLoAsTAAAAADltr0gvE7S4eq8NkmMJmiVVgCZ3"></div>
                    </div>

                    <?php echo form_error('recaptcha'); ?>
                   
                  
                        <fieldset>
                            <div class="col-md-4">
 
                                <?php echo form_submit(array('value' => 'Send'), '', 'class="btn btn-lg btn-success"'); ?>
                              
                            </div>
                            
                     
                        </fieldset>
                        <?php echo form_close(); ?>
                    
                    </fieldset>
            <?php  }?>
            
               
              </div>
              <!-- /.form-container --> 

            <!-- /.span8 -->
            <aside class="col-sm-4 sidebar lp20">
              <div class="sidebox widget">
                <h3 class="section-title widget-title">Address</h3>
                <p>Fusce dapibus, tellus commodo, tortor mauris condimentum utellus fermentum, porta sem malesuada magna. Sed posuere consectetur est at lobortis. Morbi leo risus, porta ac consectetur.</p>
                <address>
                <strong>Finch, Inc.</strong><br>
                Moon Street Light Avenue, 14/05 <br>
                Jupiter, JP 80630<br>
                <abbr title="Phone">P:</abbr> 00 (123) 456 78 90 <br>
                <abbr title="Email">E:</abbr> <a href="mailto:#">first.last@email.com</a>
                </address>
              </div>
              <!-- /.widget --> 
            </aside>
              </div>
            <!-- /.span4 --> 
          </div>
          <!-- /.row --> 
        </div>
      </div>
    </div>

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
                    icon: 'style/images/map-pin.png',
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map
                });
            }
        }

    </script>
</div>




