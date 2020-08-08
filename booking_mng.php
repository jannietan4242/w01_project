<?php
  include "backend_header.php";
  include "db.php";
  
  $item_per_page = 10;
  $page   = isset($_GET['page'])?$_GET['page']:1;
  $start = ($page - 1) * $item_per_page; //equation for calculating $start

  $q      = isset($_GET['q'])?$_GET['q']:'';
  $sortby = isset($_GET['sortby'])?$_GET['sortby']:'';

  switch($sortby) {
    case "":
      $orderBy = "ORDER BY created_date DESC";
      break;
    case "idASC":
      $orderBy = "ORDER BY created_date ASC";
      break;
    case "titleASC":
      $orderBy = "ORDER BY title ASC";
      break;
    case "titleDESC":
      $orderBy = "ORDER BY title DESC";
      break;
  }

  $venue = [];
  $sql = mysqli_query($link,"SELECT * FROM venue WHERE is_deleted = 0");
    if(mysqli_num_rows($sql)>0) {
      while($row = mysqli_fetch_array($sql)){
        $venue[$row['id']] = $row['venue']; //associative array
      }
    }

  //total rows
  $sql = mysqli_query($link, "SELECT * FROM booking WHERE name LIKE '%".$q."%' OR mobile LIKE '%".$q."%' OR email LIKE '%".$q."%' ");
  $total_data_rows = mysqli_num_rows($sql);
  $total_pages = ceil( $total_data_rows / $item_per_page );

  //search bar
  if(!empty($q)) {
    $sql = mysqli_query($link, "SELECT * FROM booking WHERE name LIKE '%".$q."%' OR mobile LIKE '%".$q."%' OR email LIKE '%".$q."%' ".$orderBy." LIMIT ".$start.",".$item_per_page);
  } else {
    $sql = mysqli_query($link, "SELECT * FROM booking ".$orderBy." LIMIT ".$start.",".$item_per_page);
  }
    
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
        <h1 class="h2">Booking list</h1>
        <form method="GET" action="booking_mng.php">
          <input type="search" name="q" placeholder="Search by name/mobile/email" value="<?=isset($_GET['q'])?$_GET['q']:''?>" />
          <button type="submit" class="btn btn-primary">Search</button>
          <?php
          if(!empty($q)) {
            echo "Total ".mysqli_num_rows($sql)." data have been found.";
          }
          ?>
        </form>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          <select name="sortby" onchange="changeSort(this.value)">
              <option value="">-Sort By Latest to Oldest-</option>
              <option value="idASC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='idASC'?'selected="selected"':''?>>-Sort By Oldest to Latest-</option>
              <option value="titleASC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='titleASC'?'selected="selected"':''?>>-Sort By Title alphabet ASC-</option>
              <option value="titleDESC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='titleDESC'?'selected="selected"':''?>>-Sort By Title alphabet DESC-</option>
            </select>
            <a href="game_export.php" class="btn btn-sm btn-outline-secondary">Export</a>
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
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <?php
            if($page > 1) {
            ?>
            <li class="page-item"><a class="page-link" href="booking_mng.php?page=<?=$page-1?>">Previous</a></li>
            <?php
            }

            for($i=1; $i <= $total_pages; $i++) {
            ?>
            <li class="page-item <?=$i == $page?'active':''?>"><a class="page-link" href="booking_mng.php?page=<?=$i?>"><?=$i?></a></li>
            <?php
            }
            ?>            
            <?php
            if($page < $total_pages) {
            ?>
            <li class="page-item"><a class="page-link" href="booking_mng.php?page=<?=$page+1?>">Next</a></li>
            <?php
            }
            ?>
          </ul>
        </nav>

      </div>
    </main>
  </div>
</div>

<script>
  function changeSort(val){

    switch(val){
      case "":
        location.href='booking_mng.php';
        break;
      case "idASC":
        location.href='booking_mng.php?sortby=idASC';
        break;
      case "titleASC":
        location.href='booking_mng.php?sortby=titleASC';
        break;
      case "titleDESC":
        location.href='booking_mng.php?sortby=titleDESC';
        break;
    }

  }
</script>

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