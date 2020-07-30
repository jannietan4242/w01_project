<?php
  include "backend_header.php";
  include "db.php";

  if(isset($_POST['venue'])) {

    $id = $_POST['id'];
    $venue = $_POST['venue'];

    mysqli_query($link, "UPDATE venue SET venue = '$venue', modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '$id'") or die(mysqli_error($link));

    header("Location: venue_list.php");
    exit;
  }

    $id = $_GET['id'];

    $sql = mysqli_query($link, "SELECT * FROM venue WHERE id = '$id'") or die(mysqli_error($link));
    if(mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
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
            <a class="nav-link active" href="venue_list.php">
              <span data-feather="file"></span>
              Venue List<span class="sr-only">(current)</span> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product_mng.php">
              <span data-feather="bar-chart-2"></span>
              Product Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="member_mng.php">             
              <span data-feather="users"></span>
              Member Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="import.php">
              <span data-feather="layers"></span>
              Import
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Venue</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            
            
          </div>
          
        </div>
      </div>

      

      <h2>Edit Venue</h2>
      <form method="POST" action="venue_edit.php" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?=$row['id']?>"/>
        <div class="form-group">
            <label for="venue">Venue</label>
            <input type="text" name="venue" class="form-control" id="venue" aria-describedby="venue" value="<?=$row['venue']?>">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
  </div>
</div>

<?php
  include "backend_footer.php";
?>