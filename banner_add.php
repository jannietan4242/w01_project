<?php
  include "backend_header.php";
  include "db.php";

  function PIPHP_ImageResize($image, $w, $h){
    $oldw = imagesx($image);
    $oldh = imagesy($image);
    $temp = imagecreatetruecolor($w, $h);
    imagecopyresampled($temp, $image, 0, 0, 0, 0, $w, $h, $oldw, $oldh);
    return $temp;
  }

  if(isset($_POST['title'])) {

    $title = $_POST['title'];
    $url = $_POST['url'];
    $created_date = date("Y-m-d H:i:s");
    $photo = "";

    if(isset($_FILES['photo'])) {
      // 1MB = 1000KB
      // 1KB = 1000bytes
      if($_FILES['photo']['size'] > (1*1000*1000)) {
          echo "Your photo is too large";
          exit;
      }
      if($_FILES['photo']['error'] == 0) {
          $check = getimagesize($_FILES['photo']['tmp_name']);
          if($check['mime']=="image/png" || $check['mime']=="image/jpeg") {
              move_uploaded_file($_FILES['photo']['tmp_name'], "./uploads/".$_FILES['photo']['name']);       
              $photo = "./uploads/".$_FILES['photo']['name'];  
              
              $uploadedImage = imagecreatefromjpeg($photo);

              if (!$uploadedImage) {
                throw new Exception('The uploaded file is corrupted (or wrong format)');
              } else {
                $resizedImage = PIPHP_ImageResize($uploadedImage,1920,650);
                $new_name = "./uploads/".date("YmdHis").".jpg";
                // save your image on disk
                if (!imagejpeg ($resizedImage, $new_name)) {
                      throw new Exception('failed to save resized image');
                }
                $photo = $new_name;
              }
          } else {
              echo "Your photo is not a jpeg or png file (".$check['mime'].")";
              exit;
          }
      }
    }


    mysqli_query($link, "INSERT INTO banner (title, photo, url, created_date) VALUES ('$title', '$photo', '$url', '$created_date')") or die(mysqli_error($link));

    header("Location: banner_list.php");
    exit;
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
            <a class="nav-link" href="booking_mng.php">
              <span data-feather="shopping-cart"></span>
              Booking Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="venue_list.php">
              <span data-feather="bar-chart-2"></span>
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
        <h1 class="h2">Banner</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            
            
          </div>
          
        </div>
      </div>

      

      <h2>Add Banner</h2>
      <form method="POST" action="banner_add.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" aria-describedby="title">
        </div>

        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" id="photo" name="photo">
        </div>

         <div class="form-group">
            <label for="url">Url link</label>
            <input type="text" name="url" class="form-control" id="url" aria-describedby="url">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </main>
  </div>
</div>

<?php
  include "backend_footer.php";
?>