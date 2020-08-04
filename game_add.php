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
    $venue_id = $_POST['venue_id'];
    $story = $_POST['story'];
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
                $resizedImage = PIPHP_ImageResize($uploadedImage,350,400);
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


    mysqli_query($link, "INSERT INTO game (title, photo, venue_id, story, created_date) VALUES ('$title', '$photo', '$venue_id', '$story', '$created_date')") or die(mysqli_error($link));

    header("Location: game_mng.php");
    exit;
  }

  $venue = [];
  $sql = mysqli_query($link,"SELECT * FROM venue WHERE is_deleted = 0") or die(mysqli_error($link));
    if(mysqli_num_rows($sql)>0) {
      while($row = mysqli_fetch_array($sql)){
        $venue[$row['id']] = $row['venue']; //associative array
      }
    }
?>

<div class="container-fluid">
  <div class="row">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="home"></span>
              Dashboard 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Order List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Order Management
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="venue_list.php">
              <span data-feather="bar-chart-2"></span>
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
            <a class="nav-link" href="#">             
              <span data-feather="users"></span>
              Member Management
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
        <h1 class="h2">Game Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            
            
          </div>
          
        </div>
      </div>

      

      <h2>Add Game</h2>
      <form method="POST" action="game_add.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" aria-describedby="titleHelp" name="title">
  </div>

  <div class="form-group">
    <label for="venue">Venue</label>
    <select class="form-control" name="venue_id">
      <?php
       foreach($venue as $k=>$v) {
      ?>
              
      <option value="<?=$k?>"><?=$v?></option>
                  
      <?php
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo">
  </div>
  
  <div class="form-group">
    <label for="story">Story</label>
    <textarea rows="15" class="form-control" id="story" name="story"></textarea>
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