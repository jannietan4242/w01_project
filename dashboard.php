<?php
  include "backend_header.php";
  include "db.php";

?>

<div class="container-fluid">
  <div class="row">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard<span class="sr-only">(current)</span> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="booking_mng.php">
              <span data-feather="shopping-cart"></span>
              Booking Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="venue_list.php">
              <span data-feather="file"></span>
              Venue List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="game_mng.php">
              <span data-feather="bar-chart-2"></span>
              Game Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin_mng.php">             
              <span data-feather="users"></span>
              Admin Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="banner_list.php">
              <span data-feather="layers"></span>
              Banner  Management
            </a>
          </li>
        </ul>
      </div>
  </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Dashboard</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
        
          </div>
         
        </div>
      </div>
      <h4>Booking Statistics</h4>

      <input type="date" id="startdate" placeholder="Startdate" />
      <input type="date" id="enddate" placeholder="end date" />
      <a class="btn btn-primary" href="javascript: refreshChart();">Filter</a>

      <div id="curve_chart" style="width: 100%; height: 500px"></div>

      <div id="piechart" style="width: 100%; height: 500px;"></div>
      
    </main>
  </div>
</div>

<?php
  include "backend_footer.php";
  // booking analysis
  // get latest date
  $latest_date = "";
  $sql = mysqli_query($link, "SELECT * FROM booking WHERE is_deleted = 0 ORDER BY date DESC LIMIT 1");
  if(mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_array($sql);
    $latest_date = substr($row['date'],0,10);//YYYY-mm-dd
  }

  $earliest_date = "";
  $sql = mysqli_query($link, "SELECT * FROM booking WHERE is_deleted = 0 ORDER BY date ASC LIMIT 1");
  if(mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_array($sql);
    $earliest_date = substr($row['date'],0,10);//YYYY-mm-dd
  }

  $start_date_ut = strtotime($earliest_date);
  $end_date_ut   = strtotime($latest_date);

  $dateArray = [];
  $dateArray[] = ["Date", "Number of Booking"];

  for($i = $start_date_ut; $i <= $end_date_ut; $i=$i+24*3600) {
    
    $total_count = 0;
    $sql = mysqli_query($link, "SELECT COUNT(id) AS total_booking FROM booking WHERE is_deleted = 0 AND date LIKE '".date("Y-m-d", $i)."%'");
    if(mysqli_num_rows($sql) > 0){
      $row = mysqli_fetch_array($sql);
      $total_count = !empty($row['total_booking'])?(int)$row['total_booking']:0;
    }
    $dateArray[] = [ date("Y-m-d", $i), $total_count];
  }

  // Game rooms statistics
  $game_array = [];
  $game_array[] = ["Game Rooms","Game Count"];

  $sql = mysqli_query($link, "SELECT * FROM game ORDER BY title ASC");
  if(mysqli_num_rows($sql) > 0) {
    while($row1 = mysqli_fetch_array($sql)){
      $count = 0;
      $sql2 = mysqli_query($link, "SELECT COUNT(id) AS total_count FROM booking WHERE is_deleted = 0  AND game_title = '".$row1['title']."'") or die(mysqli_error($link));
      if(mysqli_num_rows($sql2) > 0) {
        $row2 = mysqli_fetch_array($sql2);
        $count = $row2['total_count'];
      }

      $game_array[] = [
        $row1['title'],(int)$count
      ];
    }
  }
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?=json_encode($dateArray)?>);

        var options = {
          title: 'Booking Analysis',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart1.draw(data, options);



        var data = google.visualization.arrayToDataTable(<?=json_encode($game_array)?>);

        var options = {
          title: 'Game Rooms Statistics'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart'));

        chart2.draw(data, options);
      }
    </script>
    <script>
      function refreshChart() {
        var startdate = $("#startdate").val();
        var enddate = $("#enddate").val();

        $.getJSON("dashboard_view_ajax.php?startdate="+startdate+'&enddate='+enddate, function(res){
          var data = google.visualization.arrayToDataTable(res);

          var options = {
            title: 'Booking Analysis',
            curveType: 'function',
            legend: { position: 'bottom' }
          };

          var chart1 = new google.visualization.LineChart(document.getElementById('curve_chart'));

          chart1.draw(data, options);
        })
      }
    </script>