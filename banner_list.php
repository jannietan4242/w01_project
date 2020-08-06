<?php
  include "backend_header.php";
  include "db.php";

  //total rows
  $sql = mysqli_query($link, "SELECT * FROM banner WHERE is_deleted=0");
    
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
            <a class="nav-link" href="member_mng.php">             
              <span data-feather="users"></span>
              Member Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="banner_list.php">
              <span data-feather="layers"></span>
              Banner Management<span class="sr-only">(current)</span> 
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="h3">Banner List</h3>
        
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          
          <a href="banner_add.php" class="btn btn-sm btn-outline-secondary">Add banner</a>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
         
        </div>
      </div>

      

      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <tr>
              <th>#</th>
              <th>Title</th>
              <th width="40%">Photo</th>
              <th>URL link</th>
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
              <td><?=$row['title']?></td>
              <td><img src="<?=$row['photo']?>" class="img-fluid"/></td>
              <td><?=$row['url']?></td>
              <td><?=$row['created_date']?></td>              
              <td>
                  <a href="banner_edit.php?id=<?=$row['id']?>" class="btn btn-xs btn-info">Edit</a>
                  <a href="banner_del.php?id=<?=$row['id']?>" class="btn btn-xs btn-danger">Delete</a>
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

<?php
  include "backend_footer.php";
?>