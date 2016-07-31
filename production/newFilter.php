
<!doctype html>

<html lang="en" class="no-js">

<head>

    <!-- meta data -->

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">

    <!-- title and favicon -->

    <title>Instant Rating</title>
    <link rel="icon" href="../Boots4_HTML/assets/img/icon/fav_icon.gif">


    <!--necessary stylesheets -->
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/mycss.css">
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/ionicons.min.css">
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/popup.css">
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/owl.carousel.css">
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/owl.theme.css">
    <link type="text/css" rel="stylesheet" href="../Boots4_HTML/assets/css/style.css">
    <link type="text/css" rel="stylesheet" href="../production/css/custom.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--[if IE]>

    <![endif]-->


</head>


<body>

<!--start-->

<nav class="navbar navbar-default" style="background-color:darkseagreen">
    <div class="container-fluid">
        <div class="row">
            <div class="navbar-header col-lg-2" style="display: inline-block;">
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="../production/images/Logo1.png" >
                </a>
            </div>
            <div class="col-lg-7 col-lg-offset-3" style="display: inline-block;">
                <a href="../Boots4_HTML/index.html"><h6 style="display: inline-block;margin-left: 1%;color: white">Home</h6></a>
                <a href="../Boots4_HTML/index.html#service"><h6 style="display: inline-block; margin-left: 1%;color: white" >About</h6> </a>
                <a href="../Boots4_HTML/index.html#portfolio"><h6 style="display: inline-block;margin-left: 1%;color: white">Gallery</h6> </a>
                <a href="../Boots4_HTML/index.html#about_us"><h6 style="display: inline-block;margin-left: 1%;color: white">Team</h6> </a>
                <a href="../Boots4_HTML/index.html#contact"><h6 style="display: inline-block;margin-left: 1%;color: white">Contact</h6> </a>
                <a href="./signOut.php"><h6 style="display: inline-block;margin-left: 1%;color: white">Sign Out</h6> </a>
            </div>

        </div>

</nav>



        <!--( a ) Portfolio Page Fixed Image Portion -->

        <div class="image-container col-md-3 col-sm-12" style="background-color:darkseagreen">

            <div class="main-heading">
                <h5 style="color:white">Choose Your Restaurant</h5>
            </div>
        </div>

        <!--( b ) Portfolio Page Content -->

        <div class="content-container col-md-9 col-sm-12">

            <div class ="container" ;">
                <div class="row">
                    <br><br><br><br><br>

                    <p style="margin-left: 18%;">Please select a State , City and Restaurant to get your Instant Rating and graphical analytic.</p>

                    <br><br>
                    <div class="col-lg-12">
                        <form action="index.php" method="post">
                            <div class="col-lg-3 col-lg-offset-1 ">
                            <label>SELECT STATE</label>
                            <select id="state"  class="custom-dropdown" style="width:100%;" name="state">
                                <option value="California">California</option>
                                <option value="Florida">Florida</option>
                                <option value="New York">New York</option>
                                <option value="North Carolina">North Carolina</option>
                                <option value="Virginia">Virginia</option>

                            </select>
                            <br><br>




                        </div>
                        <div class="col-lg-3 col-lg-offset-1">

                            <label>SELECT CITY</label>
                            <select id="city" class="custom-dropdown" style="width:100%;" name="locality">


                            </select>
                            <br><br>




                        </div>
                        <div class="col-lg-3 custom-dropdown col-lg-offset-1">

                            <label>SELECT RESTAURANT</label>
                            <select id ="restaurant"   class="custom-dropdown" style="width:100%;" name="restaurant">

                            </select>
                            <br><br>



                        </div>
                    </div>

                </div>
               <br><br>

                   <div class="col-lg-offset-1 text-center">

                       <button class="btn btn-success-outline" type="submit">Proceed to get the analytics</button>

                   </div>

                <br><br>
                    </form>

        </div>



<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>


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
<script src="js/flot/curvedLines.js"></script>
<!-- jVectorMap -->
<script src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="js/moment/moment.min.js"></script>
<script src="js/datepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script type="text/javascript">
    $('#state').change(function(){
        $('#city').find('option').remove().end();
        var selectedState = $(this).find("option:selected").text();

        //do the ajax call

        $.ajax({
            url: 'getCity.php',
            type: 'GET',
            data: {state:selectedState},
            dataType: 'json',
            cache: false,
            success: function(data){

                //var obj=JSON.parse(data); //no need if dataType is set to json
                var ddl = document.getElementById('city');
                var obj = Array.from(data);

                for(var c=0;c<obj.length;c++)
                {
                    var option = document.createElement('option');
                    option.value = obj[c];
                    option.text  = obj[c];
                    ddl.appendChild(option);
                }


            },
            error:function(jxhr){
                console.log(jxhr);
                alert("Error:" + jxhr.responseText);

            }
        });
    });

    $('#city').change(function(){
        $('#restaurant').find('option').remove().end();
        var selectedCity = $(this).find("option:selected").text();

        //do the ajax call

        $.ajax({
            url: 'getRestaurant.php',
            type: 'GET',
            data: {city:selectedCity},
            dataType: 'json',
            cache: false,
            success: function(data){

                //var obj=JSON.parse(data); //no need if dataType is set to json
                var ddl = document.getElementById('restaurant');
                var obj = Array.from(data);

                for(var i=0;i<obj.length;i++)
                {
                    var option = document.createElement('option');
                    option.value = obj[i];
                    option.text  = obj[i];
                    ddl.appendChild(option);
                }


            },
            error:function(jxhr){
                console.log(jxhr);
                alert("Error:" + jxhr.responseText);

            }
        });
    });


</script>

</body>
</html>