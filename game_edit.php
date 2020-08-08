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

    $id = $_POST['id'];
    $title = $_POST['title'];
    $venue_id = $_POST['venue_id'];
    $story = $_POST['story'];
    $photo = "";

    mysqli_query($link, "UPDATE game SET title = '$title', venue_id = '$venue_id', story = '$story', modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '$id'") or die(mysqli_error($link));

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
                $resizedImage = PIPHP_ImageResize($uploadedImage,350,400);
                $new_name = "./uploads/".date("YmdHis").".jpg";
                // save your image on disk
                if (!imagejpeg ($resizedImage, $new_name)) {
                      throw new Exception('failed to save resized image');
                }
                $photo = $new_name;
              }

              mysqli_query($link, "UPDATE game SET photo = '$photo' WHERE id = '$id'") or die(mysqli_error($link));   

          } else {
              echo "Your photo is not a jpeg or png file (".$check['mime'].")";
              exit;
          }
      }
    }

    header("Location: game_mng.php");
    exit;
  }

  $venue = [];
  $sql = mysqli_query($link,"SELECT * FROM venue WHERE is_deleted = 0");
    if(mysqli_num_rows($sql)>0) {
      while($row2 = mysqli_fetch_array($sql)){
        $venue[$row2['id']] = $row2['venue']; //associative array
      }
    }

  $id = $_GET['id'];
  $sql = mysqli_query($link, "SELECT * FROM game WHERE id = '$id'") or die(mysqli_error($link));
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
            <a class="nav-link active" href="game_mng.php">
              <span data-feather="bar-chart-2"></span>
              Game Management<span class="sr-only">(current)</span>
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
      
      <h2>Edit Game Details</h2>
      <form method="POST" action="game_edit.php" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?=$row['id']?>" />

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title" value="<?=$row['title']?>">
  </div>

  <div class="form-group">
    <label for="venue">Venue</label>
    <select class="form-control" name="venue_id">
      <?php
       foreach($venue as $k=>$v) {
      ?>
              
       <option value="<?=$k?>" <?=$k==$row['venue_id']?'selected="selected"':''?>><?=$v?></option>
                  
      <?php
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo">
    <?php
      if(!empty($row['photo'])) {
    ?>
      <img src="<?=$row['photo']?>" class="img-fluid" />
    <?php
      }
    ?>
    
  </div>
  
  <div class="form-group">
    <label for="story">Story</label>
    <textarea rows="15" class="form-control" id="story" name="story"><?=$row['story']?></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </main>
  </div>
</div>

<?php
  include "backend_footer.php";
?>

<script>
  CKEDITOR.replace("story");
</script>