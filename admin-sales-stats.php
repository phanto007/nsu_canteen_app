<?php
include 'includes/connect.php';


  if($_SESSION['admin_sid']==session_id())
  {

    $result = mysqli_query($con, "SELECT * FROM items");

    $itemIds = array();
    $itemNames = array();
    $itemsSold = array();
    $itemsRevenue = array();
    $totalRevenue = 0;

    while($row = mysqli_fetch_array($result)){
      array_push($itemIds, $row['id']);
      array_push($itemNames, $row['name']);
    }
    $xx = count($itemIds);

    for($i = 0; $i < count($itemIds); $i++){

      $sum = 0;
      $rev = 0;
      $result = mysqli_query($con, "SELECT * FROM order_details");

      while($row = mysqli_fetch_array($result)){

        if($itemIds[$i] == $row['item_id']){
          $sum = $sum + $row['quantity'];
          $rev = $rev + $row['price'];
        }
      }
      $itemsSold[$i] = $sum;
      $itemsRevenue[$i] = $rev;
      $totalRevenue = $totalRevenue + $rev;
    }

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>User List</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
     <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style> 
</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
   <?php
          include 'includes/admin_header.php';
      ?>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <?php
          include 'includes/admin_sidebar.php';
      ?>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Sales Stats</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">Overall stats and orders</p>
          <div class="divider"></div>
        </div>
        <!--end container-->
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Item Id</th>
              <th scope="col">Item Name</th>
              <th scope="col">Quantity Sold</th>
              <th scope="col">Revenue</th>
            </tr>
          </thead>
          <tbody>
            <?php 

            $x = 0;
            while ($x<$xx) {
              
            ?>
            <tr>
              <th scope="row"><?php echo $itemIds[$x]; ?></th>
              <td><?php echo $itemNames[$x]; ?></td>
              <td><?php echo $itemsSold[$x]; ?></td>
              <td><?php echo '৳ '.$itemsRevenue[$x]; ?></td>
            </tr>

            <?php
              $x++;
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td style="text-align: right;"><b>Total Revenue</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><?php echo '৳ '.$totalRevenue; ?></td>
            </tr>
          </tfoot>
        </table>
      </section>
      <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->
  </div>
  <!-- END MAIN -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

    <?php
      include 'includes/footer.php';
    ?>


    <!-- ================================================
    Scripts
    ================================================ -->
    
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
      
  
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script>

      window.onload = function() {

      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
          text: "Quantity of Food Sold"
        },
        data: [{
          type: "pie",
          startAngle: 240,
          yValueFormatString: "##0",
          indexLabel: "{label} {y}",
          dataPoints: [
            
            <?php for($i = 0; $i < count($itemIds); $i++){
              echo '{y: '.$itemsSold[$i].', label: "'.$itemNames[$i].'"},';
            }
            ?>
          ]
        }]
      });

      var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        theme: "light2",
        title: {
          text: "Sales Data"
        },
        axisX: {
          valueFormatString: "MMM"
        },
        axisY: {
          prefix: "৳",
          labelFormatter: addSymbols
        },
        toolTip: {
          shared: true
        },
        legend: {
          cursor: "pointer",
          itemclick: toggleDataSeries
        },
        data: [
        {
          type: "column",
          name: "Actual Sales",
          showInLegend: true,
          xValueFormatString: "MMMM YYYY",
          yValueFormatString: "৳#,##0",
          dataPoints: [
            { x: new Date(2019, 0), y: 20000 },
            { x: new Date(2019, 1), y: 30000 },
            { x: new Date(2019, 2), y: 25000 },
            { x: new Date(2019, 3), y: 70000, indexLabel: "High Renewals" },
            { x: new Date(2019, 4), y: 50000 },
            { x: new Date(2019, 5), y: 35000 },
            { x: new Date(2019, 6), y: 30000 },
            { x: new Date(2019, 7), y: 43000 },
            { x: new Date(2019, 8), y: 35000 },
            { x: new Date(2019, 9), y:  30000},
            { x: new Date(2019, 10), y: 40000 },
            { x: new Date(2019, 11), y: 50000 },
          ]
        }, 
        {
          type: "line",
          name: "Expected Sales",
          showInLegend: true,
          yValueFormatString: "৳#,##0",
          dataPoints: [
            { x: new Date(2019, 0), y: 40000 },
            { x: new Date(2019, 1), y: 42000 },
            { x: new Date(2019, 2), y: 45000 },
            { x: new Date(2019, 3), y: 45000 },
            { x: new Date(2019, 4), y: 47000 },
            { x: new Date(2019, 5), y: 43000 },
            { x: new Date(2019, 6), y: 42000 },
            { x: new Date(2019, 7), y: 43000 },
            { x: new Date(2019, 8), y: 41000 },
            { x: new Date(2019, 9), y: 45000 },
            { x: new Date(2019, 10), y: 42000 },
            { x: new Date(2019, 11), y: 50000 }
          ]
        },
        {
          type: "area",
          name: "Profit",
          markerBorderColor: "white",
          markerBorderThickness: 2,
          showInLegend: true,
          yValueFormatString: "৳#,##0",
          dataPoints: [
            { x: new Date(2019, 0), y: 5000 },
            { x: new Date(2019, 1), y: 7000 },
            { x: new Date(2019, 2), y: 6000},
            { x: new Date(2019, 3), y: 30000 },
            { x: new Date(2019, 4), y: 20000 },
            { x: new Date(2019, 5), y: 15000 },
            { x: new Date(2019, 6), y: 13000 },
            { x: new Date(2019, 7), y: 20000 },
            { x: new Date(2019, 8), y: 15000 },
            { x: new Date(2019, 9), y:  10000},
            { x: new Date(2019, 10), y: 19000 },
            { x: new Date(2019, 11), y: 22000 }
          ]
        }]
      });

      function addSymbols(e) {
        var suffixes = ["", "K", "M", "B"];
        var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

        if(order > suffixes.length - 1)                 
          order = suffixes.length - 1;

        var suffix = suffixes[order];      
        return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
      }

      function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
          e.dataSeries.visible = false;
        } else {
          e.dataSeries.visible = true;
        }
        e.chart2.render();
      }

      chart.render();
      chart2.render();

      }
    </script>
    
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>
<?php
  }
  else
  {
    if($_SESSION['customer_sid']==session_id())
    {
      header("location:index.php");   
    }
    else{
      header("location:login.php");
    }
  }
?>
