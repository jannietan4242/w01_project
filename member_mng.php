<?php
  include "backend_header.php";
  include "db.php";
  
  

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
      $orderBy = "ORDER BY email ASC";
      break;
    case "titleDESC":
      $orderBy = "ORDER BY email DESC";
      break;
  }

  //total rows
//   $sql = mysqli_query($link, "SELECT * FROM member WHERE name LIKE '%".$q."%' ") or die(mysqli_error($link));
  

  if(!empty($q)) {
    $sql = mysqli_query($link, "SELECT * FROM customer WHERE email LIKE '%".$q."%' ".$orderBy) or die(mysqli_error($link));
  } else {
    $sql = mysqli_query($link, "SELECT * FROM customer ".$orderBy) or die(mysqli_error($link));
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
            <a class="nav-link" href="order_mng.php">
              <span data-feather="shopping-cart"></span>
              Order Management
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
            <a class="nav-link active" href="member_mng.php">             
              <span data-feather="users"></span>
              Member Management<span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product_import.php">
              <span data-feather="layers"></span>
              Product Import
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h3">Member Management</h3>
        <form method="GET" action="member_mng.php">
          <input type="search" name="q" placeholder="Search by keywords..." value="<?=isset($_GET['q'])?$_GET['q']:''?>" />
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
              <option value="titleASC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='titleASC'?'selected="selected"':''?>>-Sort By Item alphabet ASC-</option>
              <option value="titleDESC" <?=isset($_GET['sortby'])&&$_GET['sortby']=='titleDESC'?'selected="selected"':''?>>-Sort By Item alphabet DESC-</option>
            </select>
          <a href="product_category_add.php" class="btn btn-sm btn-outline-secondary">Add Product Category</a>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          
        </div>
      </div>

      

      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Created Date</th>
              <th>Action</th>
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
              <td><?=$row['email']?></td>
              <td><?=$row['created_date']?></td>              
              <td>
                  <a href="member_mng_details.php?id=<?=$row['id']?>" class="btn btn-xs btn-info">View</a>
              </td>
            </tr>

            <?php
                }
              }
            ?>
          </tbody>
        </table>

        

      </div>
    </main>
  </div>
</div>

<script>
  function changeSort(val){

    switch(val){
      case "":
        location.href='member_mng.php';
        break;
      case "idASC":
        location.href='member_mng.php?sortby=idASC';
        break;
      case "titleASC":
        location.href='member_mng.php?sortby=titleASC';
        break;
      case "titleDESC":
        location.href='member_mng.php?sortby=titleDESC';
        break;
    }

  }
</script>

<?php
  include "backend_footer.php";
?>