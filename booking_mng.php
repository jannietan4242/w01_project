<?php
  include "backend_header.php";
  include "db.php";

  $q = isset($_GET['q'])?$_GET['q']:'';
  $startdate = isset($_GET['startdate'])?$_GET['startdate']:'';
  $enddate = isset($_GET['enddate'])?$_GET['enddate']:'';
  $filterByGame = isset($_GET['filterByGame'])?$_GET['filterByGame']:'';

  $venue = [];
  $sql = mysqli_query($link,"SELECT * FROM venue WHERE is_deleted = 0");
    if(mysqli_num_rows($sql)>0) {
      while($row = mysqli_fetch_array($sql)){
        $venue[$row['id']] = $row['venue']; //associative array
      }
    }

  //total rows

  $sqlString = "SELECT * FROM booking WHERE 1 ";

  if(!empty($startdate) && !empty($enddate)) {
      $sqlString .= "AND (date BETWEEN '".$startdate."' AND '".$enddate."') ";
  }

  if(!empty($filterByGame)) {
      $sqlString .= "AND (game_title LIKE '%".$filterByGame."%') ";
  }
  if(!empty($q)) {
      $sqlString .= "AND (name LIKE '%".$q."%' OR mobile LIKE '%".$q."%' OR email LIKE '%".$q."%') ";
  }

  $sql = mysqli_query($link, $sqlString);
    
?>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <span data-feather="home"></span>
              Dashboard 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="booking_mng.php">
              <span data-feather="shopping-cart"></span>
              Booking Management<span class="sr-only">(current)</span>
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
              Banner Management
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">Booking list</h2>
        <form method="GET" action="booking_mng.php">
          <input type="search" name="q" placeholder="Search by name/mobile/email" value="<?=isset($_GET['q'])?$_GET['q']:''?>" />
          <input type="date" id="startdate" name="startdate" placeholder="Start date" value="<?=isset($_GET['startdate'])?$_GET['startdate']:''?>"/>
          <input type="date" id="enddate" name="enddate" placeholder="End date" value="<?=isset($_GET['startdate'])?$_GET['startdate']:''?>"/>

          <select name="filterByGame">
          <option value="">-All Game Rooms-</option>
          <?php
            $filterByGame = mysqli_query($link, "SELECT * FROM game WHERE is_deleted = 0");
            if(mysqli_num_rows($filterByGame)>0) {
              while($row1 = mysqli_fetch_array($filterByGame)){
          ?>
              <option value="<?=$row1['title']?>" <?=isset($_GET['filterByGame'])?$_GET['filterByGame']:''?>><?=$row1['title']?></option>
          <?php
            }
          }
          ?>
          </select>

          <button type="submit" class="btn btn-primary">Search</button>
         
        </form>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a href="booking_export.php" class="btn btn-sm btn-outline-secondary">Export</a>
          </div>
         
        </div>
      </div>

      <div class="table-responsive">
      <form action="booking_mng.php" method="POST">
        
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Number of person</th>
              <th>Special Note</th>
              <th width="15%">Game room</th>
              <th>Date</th>
              <th>Time</th>
              <th>Booking Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if(mysqli_num_rows($sql) > 0) {
              while($row = mysqli_fetch_array($sql)){
            ?>

            <tr>
              <td><?=$row['id']?></td>
              <td><?=$row['name']?></td>
              <td><?=$row['mobile']?></td>
              <td><?=$row['email']?></td>
              <td><?=$row['num_of_person']?></td>
              <td><?=$row['note']?></td>
              <td><?=$row['game_title']?></td>
              <td><?=$row['date']?></td>
              <td><?=$row['time_slot']?></td>
              <td><?=$row['created_date']?></td>
              
              <td>
                <div><button class="btn btn-warning" style="width: 100px;" id="c<?=$row['id']?>" onclick="toggleDeleteBooking('<?=$row['id']?>')"><?=$row['is_deleted']?'cancelled':'confirmed'?></button></div>
              </td>
            </tr>

            <?php
                }
              }
            ?>
          </tbody>
        </table>
        
        </form>

      </div>
    </main>
  </div>
</div>

<?php
  include "backend_footer.php";
?>

<script>
  function toggleDeleteBooking(booking_id){
    $.post("toggleDeleteBooking.php", {
        booking_id: booking_id
    }, function(res){
      $("#c"+booking_id).html(res);
    });
    
  }
</script>