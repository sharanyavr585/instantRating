<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentellela Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 80%;
      }
    </style>
  </head>

  <body class="nav-md">
    <div class="container">

      <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <?php
        class Ratings{

          public $userRating=0;
          public $reviewTime=0;
          public $instaRating=0;

        }
            $ratingsArray=array();
            session_start();
            $con=mysqli_connect("localhost","minoura","minoura","instantRating");
            // Check connection
      
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
      
            $state=$_POST['state'];
            $locality=$_POST['locality'];

            $restaurant=$_POST['restaurant'];


            $count=0;
            $instantRating=0;
            $rating=0;
            $sqlCount="SELECT count(*) as count1 FROM instantRating.review where reviewTime >=1420070400 and restaurantId in (select restaurantId from restaurant where state =\"$state\" and locality=\"$locality\" and restaurantName =\"$restaurant\") order by reviewTime desc;";

            if ($result1=mysqli_query($con,$sqlCount)){
              $rowcount1=mysqli_num_rows($result1);
              if($rowcount1>0){
      
                $row1 = $result1->fetch_assoc() ;
      
                $count= $row1['count1'];
      
                //after getting the count of restaurants having reviewtime>2015 fetching review time and rating for those restaurants
      
                $sql= "SELECT user_rating, reviewTime FROM instantRating.review where reviewTime >=1420070400 and restaurantId in (select restaurantId from restaurant where state =\"$state\" and locality=\"$locality\" and restaurantName =\"$restaurant\") order by reviewTime desc;";
      
                if ($result=mysqli_query($con,$sql))
                {
      
                  $i=$count;
                  while($row=$result->fetch_assoc() and $i>=1){

      
                    $userRating=$row['user_rating'];
                    $reviewTime=$row['reviewTime'];
                    $instaRating=0;

                    $instance= new Ratings();
                    $instance->userRating=$row['user_rating'];
                    $instance->reviewTime=$row['reviewTime'];

                    $rating=$rating+$userRating;
                    if($reviewTime>=1464739200){ // June 2016 to Aug 2016
                      $instaRating=$userRating;
                    }
                    else if($reviewTime>=1454284800 and $reviewTime<1464739200){
                      $instaRating=($userRating*0.9); // Feb 2016 to April 2016
                    }
                    else if($reviewTime>=1477958400 and $reviewTime<1454284800 ){ // November 2015 to Jan 2016
                      $instaRating=($userRating*0.8);
                    }
                    else if($reviewTime>=1438387200 and $reviewTime<1477958400){ // Aug 2015 to Oct 2015
                      $instaRating=($userRating*0.7);
                    }
                    else if($reviewTime>=1427846400 and $reviewTime<1438387200){ //April 2015 to July 2015
                      $instaRating=($userRating*0.6);
                    }
                    else{
                      $instaRating=($userRating*0.5); // Jan 2015 to March 2015
                    }
      
                    $instantRating=$instantRating+$instaRating;
      
                    $i--;

                    $instance->instaRating=$instaRating;
                    $ratingsArray[]=$instance;
                    $instance=null;


                  }

                  echo "<br>";

                  $instantRating= $instantRating/$count;
                  $rating=$rating/$count;
      
      
                }
              }
      
            }

        $sqlDetails="select * from restaurant where state ='$state' and locality='$locality' and restaurantName =\"$restaurant\";";
          if ($result2=mysqli_query($con,$sqlDetails)){
            $row2=mysqli_num_rows($result2);

               if($row2>0) {

                  $row2 = $result2->fetch_assoc();

                   $address=$row2['address'];
                   $website=$row2['website'];
                   $overallRating = $row2['overallRating'];
                   $priceLevel=$row2['priceLevel'];


                  }
            else{
              echo "There are no rows";
            }


                }

        else{
          echo "Connection Failed.";
        }


            mysqli_close($con);
           ?>



      <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-building"></i> Restaurant</span>
              <div class="count green" style="font-size: x-large"><?php echo $restaurant ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-star"></i> Normal Rating</span>
              <div class="count grey"><?php echo round($rating*2) / 2; ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-star"></i> Instant Rating</span>
              <div class="count green"><?php echo round($instantRating*2) / 2; ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-dollar"></i> Price Level</span>
              <div class="count grey"><?php echo $priceLevel ?></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-globe"></i> Website</span>
              <div class="count green"><h4><?php echo $website ?></h4></div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Ratings</span>
              <div class="count grey"><?php echo $count ?></div>
            </div>
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Rating Vs Time <small>Select the time frame here</small></h3>
                  </div>
                  <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                  <div style="width: 100%;">
                    <div id="canvas_dahs" class="demo-placeholder" style="width: 135%; height:270px;"></div>
                  </div>
                </div>


                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Restaurant Location</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>

                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>

                <div id="map"></div>
              </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                  <h2>Restaurant Weightage in States</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p>Top 5</p>
                      </th>
                      <th>
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                         <p>states</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">

                        </div>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                      </td>
                      <td>
                        <table class="tile_info">
                          <tr>
                            <td>
                              <p><i class="fa fa-square blue"></i>California </p>
                            </td>
                            <td>30%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square green"></i>Florida</p>
                            </td>
                            <td>10%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square purple"></i>New York</p>
                            </td>
                            <td>20%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square aero"></i>North Carolina </p>
                            </td>
                            <td>15%</td>
                          </tr>
                          <tr>
                            <td>
                              <p><i class="fa fa-square red"></i>Virginia</p>
                            </td>
                            <td>30%</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>


            <div class="col-md-4 col-sm-4 col-xs-12">

                <div class="x_panel fixed_height_320 overflow_hidden">
                  <div class="x_title">
                    <h2>Weather Information <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="temperature"><b>Monday</b>, 07:30 AM
                          <span>F</span>
                          <span><b>C</b></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="weather-icon">
                          <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                        </div>
                      </div>
                      <div class="col-sm-8">


                        <div class="weather-text">
                          <?php $ch = curl_init();

                          $url="http://api.openweathermap.org/data/2.5/weather?q=$state&APPID=29edda973b85e43f041a28f36aa7a451";

                          curl_setopt($ch,CURLOPT_URL,$url);
                          curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                          curl_setopt($ch,CURLOPT_HEADER, false);

                          $output=curl_exec($ch);

                          curl_close($ch);
                          $obj=json_decode($output);
                          echo "<br>";
                          $temperature= $obj->main->temp;
                          $description= $obj->weather[0]->description;
                          $humidity=$obj->main->humidity;
                          $maxTemperature= $obj->main->temp_max;

                          ?>
                          <h2><?php echo $state ?><br></h2>
                          <h2><?php echo $description?> Day!</h2>
                        </div>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row weather-days">
                      <h2>Current Temperature : <?php echo $temperature ?> 250 Kelvins</h2>
                      <h2>Expected Max Temperature: <?php echo $maxTemperature ?>  280 Kelvins </h2>
                      <h2>Current Humidity : <?php echo $humidity ?> 240

                        Kelvins</h2>

                    </div>
                      <div class="clearfix"></div>
                    </div>
                  </div>


              </div>
            </div>

          </div>




        <!-- /page content -->

        <!-- footer content -->

        <footer style="margin-left:0;">
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="js/flot/jquery.flot.orderBars.js"></script>
    <script src="js/flot/date.js"></script>
    <script src="js/flot/jquery.flot.spline.js"></script>
    <script src="js/flot/jquery.flot.navigationControl.js"></script>
    <script src="js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Flot -->
    <script>

      var MyFlot = {};
      $(document).ready(function() {
        MyFlot.data1 =[

          <?php echo "\n";
          for($i=0; $i<$count-1; $i++){
          echo "[gd(".date('Y', $ratingsArray[$i]->reviewTime).", ".date('n', $ratingsArray[$i]->reviewTime).", ".date('j', $ratingsArray[$i]->reviewTime)."), ".$ratingsArray[$i]->instaRating."],\n";
          }
          echo "[gd(".date('Y', $ratingsArray[$count-1]->reviewTime).", ".date('n', $ratingsArray[$count-1]->reviewTime).", ".date('j', $ratingsArray[$count-1]->reviewTime)."), ".$ratingsArray[$count-1]->instaRating."]\n";
          ?>
        ];
        MyFlot.data2 = [

          <?php echo "\n";

          for($j=0; $j<$count-1; $j++){
          echo "[gd(".date('Y', $ratingsArray[$j]->reviewTime).", ".date('n', $ratingsArray[$j]->reviewTime).", ".date('j', $ratingsArray[$j]->reviewTime)."), ".$ratingsArray[$j]->userRating."],\n";
        }
          echo "[gd(".date('Y', $ratingsArray[$count-1]->reviewTime).", ".date('n', $ratingsArray[$count-1]->reviewTime).", ".date('j', $ratingsArray[$count-1]->reviewTime)."), ".$ratingsArray[$count-1]->userRating."]\n";?>

        ];
        MyFlot.flotoptions = {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [7, "day"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10

          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: false
        }


        MyFlot.flot = $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          MyFlot.data1, MyFlot.data2
        ], MyFlot.flotoptions);

        function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
        }
      });
    </script>
    <!-- /Flot -->

    <!-- jVectorMap -->
    <script src="js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/maps/jquery-jvectormap-us-aea-en.js"></script>
    <script src="js/maps/gdp-data.js"></script>
    <script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
          map: 'world_mill_en',
          backgroundColor: 'transparent',
          zoomOnScroll: false,
          series: {
            regions: [{
              values: gdpData,
              scale: ['#E6F2F0', '#149B7E'],
              normalizeFunction: 'polynomial'
            }]
          },
          onRegionTipShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>-->
    <!-- /jVectorMap -->

    <!-- Skycons -->
    <script>
      $(document).ready(function() {
        var icons = new Skycons({
            "color": "#73879C"
          }),
          list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
          ],
          i;

        for (i = list.length; i--;)
          icons.set(list[i], list[i]);

        icons.play();
      });
    </script>
    <!-- /Skycons -->

    <!-- Doughnut Chart -->
   <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- Doughnut Chart -->
    
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2016',
          maxDate: '12/31/2016',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          autoApply: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
          //MyFlot.flotoptions.xaxis.min = gd(picker.startDate.format('YYYY'),picker.startDate.format('M'),picker.startDate.format('D'));
          //console.log(MyFlot.flotoptions.xaxis.min);
          MyFlot.flot.getOptions().xaxes[0].min = gd(picker.startDate.format('YYYY'),picker.startDate.format('M'),picker.startDate.format('D'));
          MyFlot.flot.getOptions().xaxes[0].max = gd(picker.endDate.format('YYYY'),picker.endDate.format('M'),picker.endDate.format('D'));
          MyFlot.flot.setupGrid();
          MyFlot.flot.draw();



        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
        function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
        }
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = 6000;
      gauge.animationSpeed = 32;
      gauge.set(3200);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    <!-- /gauge.js -->
    <script>
      <?php $ck = curl_init();
      $localityurl = urlencode($address);
      $url1="https://maps.googleapis.com/maps/api/geocode/json?address=$localityurl&key=AIzaSyCkKZMcjdyC8Iw2oka7kWY7nZU1Dj04nmU";

      curl_setopt($ck,CURLOPT_URL,$url1);
      curl_setopt($ck,CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ck,CURLOPT_HEADER, false);

      $output1=curl_exec($ck);

      curl_close($ck);

      $obj1 = json_decode($output1);
      $lang=$obj1->results[0]->geometry->location->lat;
      $long=$obj1->results[0]->geometry->location->lng;

      ?>

      function initMap() {
        var myLatLng = {lat: <?php echo $lang ?>, lng: <?php echo $long ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkKZMcjdyC8Iw2oka7kWY7nZU1Dj04nmU&callback=initMap">
    </script>

  </body>
</html>