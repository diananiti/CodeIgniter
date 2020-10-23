<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<div class="light-wrapper">
    <div class="container inner">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-md-4 text-left">  
                        <?php echo $percentage_artworks->num_rows(); ?>
                        <script type="text/javascript">
                            google.load("visualization", "1", {packages: ["corechart"]});
                            google.setOnLoadCallback(drawChartArtWorks);
                            function drawChartArtWorks() {

                                var data = google.visualization.arrayToDataTable([
                                    ['Types', 'Percents'],
                                    ['Artworks', <?php echo $percentage_artworks->num_rows(); ?>],
                                    ['Artists', <?php echo $percentage_artist->num_rows(); ?>],
                                    ['Votes', <?php echo $percentage_votes->num_rows(); ?>]

                                ]);

                                var options = {
                                    title: 'Artworks&Artists'
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('artworks_artists'));

                                chart.draw(data, options);
                            }
                        </script>
                        <div id="artworks_artists"  style="width: 400px; height: 250px;"></div>

                    </div>
                    <div class="col-md-4 text-left">  
                        <script type="text/javascript">
                            google.load("visualization", "1", {packages: ["corechart"]});
                            google.setOnLoadCallback(drawChartUsersVotes);
                            function drawChartUsersVotes() {
                               var data = google.visualization.arrayToDataTable([
                                    ['Types', 'Percents'],
                                    ['users', <?php echo $percentage_users->num_rows(); ?>],
                                    ['votes', <?php echo $percentage_votes->num_rows(); ?>],
                               ]);

                                var options = {
                                    title: 'Users & Votes'
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('users_votes'));

                                chart.draw(data, options);
                            }
                            ;
                        </script>
                        <div id="users_votes" style="width: 400px; height: 250px;"></div>
                    </div>

                    <div class="col-md-4 text-left">  
                        <script type="text/javascript">
                            google.load("visualization", "1", {packages: ["corechart"]});
                            google.setOnLoadCallback(drawChart);
                            function drawChart() {

                                var data = google.visualization.arrayToDataTable([
                                     ['Types', 'Percents'],
                                    ['Artworks', <?php echo $percentage_atyle->num_rows(); ?>],
                                    ['Artists', <?php echo $percentage_artworks->num_rows(); ?>],
                                ]);

                                var options = {
                                    title: 'Style&Artworks'
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('Style_Artworks'));

                                chart.draw(data, options);
                            };
                        </script>
                        <div id="Style_Artworks"  style="width: 400px; height: 250px;"></div>

                    </div>

                    <div class="col-md-4 text-left"> 
                        <script type="text/javascript">
                            google.load("visualization", "1", {packages: ["geomap"]});
                            google.setOnLoadCallback(drawMap);

                            function drawMap() {
                                var data = google.visualization.arrayToDataTable([                                  
                                    ['Country', 'artworks'],
                                    ['',<?php echo   $artworkcountry[$country->country] ?> ],
                                    ['',  <?php echo   $artworkcountry[$country->country] ?>,
                                    
                                ]);

                                var options = {};
                                options['dataMode'] = 'regions';

                                var container = document.getElementById('regions_div');
                                var geomap = new google.visualization.GeoMap(container);

                                geomap.draw(data, options);
                            }
                            ;
                        </script>
                        <div id="regions_div" style="width: 500px; height: 250px;"></div>
                    </div> 
   
                </div>
            </div>
        </div>
    </div>
</div>

