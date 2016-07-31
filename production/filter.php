<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Flying Fish! </title>

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
</head>

<body class="nav-md" style="background-color: white;">
<div class="container body">
    <div class="main_container">


        <!-- /top navigation -->

            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <img alt="Brand" src="">
                        </a>

                    </div>
                    <div class="col-lg-6 col-lg-offset-5 text-right">
                        <a href="#"><h4 style="display: inline-block;margin-left: 1%">Home</h4> </a>
                        <a href="#"><h4 style="display: inline-block; margin-left: 1%" >About  </h4> </a>
                        <a href="#"><h4 style="display: inline-block;margin-left: 1%">Gallery  </h4> </a>
                        <a href="#"><h4 style="display: inline-block;margin-left: 1%">Team  </h4> </a>
                        <a href="#"><h4 style="display: inline-block;margin-left: 1%">Contact  </h4> </a>
                        <a href="#"><h4 style="display: inline-block;margin-left: 1%">Sign Out  </h4> </a>
                    </div>
            </nav>

        <!-- /top navigation -->


        <div class ="container">
            <div class="row">
                <br><br><br><br><br><br><br>

              <div class="col-lg-12 jumbotron bg-success">
                 <div class="col-lg-2 col-lg-offset-2 ">


                         <label>SELECT STATE</label>
                         <select id="state"  style="width:100%;">
                             <option value="California">California</option>
                             <option value="Florida">Florida</option>
                             <option value="New York">New York</option>
                             <option value="North Crolina">North Carolina</option>
                             <option value="Virginia">Virginia</option>

                         </select>
                         <br><br>

                 </div>
                  <div class="col-lg-2 col-lg-offset-1">

                        <label>SELECT CITY</label>
                        <select id="city" style="width:100%;">
                            

                        </select>
                        <br><br>




                </div>
                <div class="col-lg-2 col-lg-offset-1">

                        <label>SELECT RESTAURANT</label>
                        <select id ="restaurant"  style="width:100%;">

                        </select>
                        <br><br>



                </div>
               </div>

        </div>
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

<!-- Flot -->

</body>
</html>