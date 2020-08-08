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
      <div id="piechart" style="width: 100%; height: 500px;"></div>
      
    </main>
  </div>
</div>

<?php

  $blog_category_array = [];
  $blog_category_array[] = ["Category","Product Count"];

  // get latest date
  $latest_date = "";
  $sql = mysqli_query($link, "SELECT * FROM booking ORDER BY created_date DESC LIMIT 1");
    if(mysqli_num_rows($sql) > 0) {
      $row = mysqli_fetch_array($sql);

      $latest_date = substr($row['created_date'],0,10);


      while($row = mysqli_fetch_array($sql)) {

        $count = 0;
        $sql2 = mysqli_query($link, "SELECT COUNT(*) AS total_count FROM product WHERE product_category_id = '".$row['id']."'") or die(mysqli_error($link));
        if(mysqli_num_rows($sql2) > 0) {
          $row1 = mysqli_fetch_array($sql2);
          $count = $row1['total_count'];
        }

        $blog_category_array[] = [
          $row['title'], (int)$count
        ];
      }
    }
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable(<?=json_encode($blog_category_array)?>);

        var options = {
          title: 'Booking by Game Rooms',
          legend: { position: 'bottom'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

<?php
  include "backend_footer.php";
?>