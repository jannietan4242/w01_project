<?php
include "header.php";
include "db.php";
    $sql = mysqli_query($link, "SELECT * FROM game WHERE is_deleted = 0 AND is_hide = 0 ORDER BY created_date DESC") or die (mysqli_error($link));
?>
<style>
.card-text {
  color:red;
  font-size: large;
  font-family:'papyrus';
  font-weight: bold;
}
</style>

<main role="main">
<div style="background-image: url('./uploads/contact_background.jpg'); width:100%; padding:5%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">

  <section class="jumbotron text-center">
    <div class="container">
      <img src="./uploads/list1.jpg" style="width:100%;">
    </div>
  </section>

  <div id="list" class="album py-5" style="background-color:transparent;">
    <div class="container">

      <div class="row">
      <?php
        if(mysqli_num_rows($sql) > 0) {
        while($row = mysqli_fetch_array($sql)){
      ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <a href="detail.php?id=<?=$row['id']?>"><img src="<?=$row['photo']?>"/></a>
            <div class="card-body">
              <p class="card-text text-center"><?=$row['title']?></p>
              <div class="d-flex justify-content-between align-items-center">
                
                
              </div>
            </div>
          </div>
        </div>

    <?php
        }
        }
    ?>       
        
      </div>
    </div>
  </div>
  </div>
<?php
    include "footer.php";
?>