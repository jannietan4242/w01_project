<?php
include "header.php";
include "db.php";
    $sql = mysqli_query($link, "SELECT * FROM game WHERE is_deleted = 0 AND is_hide = 0 ORDER BY created_date DESC") or die (mysqli_error($link));
?>

<main role="main">

  <div class="album">
    <div class="container">

        <div style="color:grey; margin:50px; margin-top:0px;">Pick a date: <input type="date"></div>

      <div class="row">
      <?php

        if(mysqli_num_rows($sql) > 0) {
        while($row = mysqli_fetch_array($sql)){

            $selectedTime = $row['start_time'];
            $timestamp = strtotime("+".$row['game_duration']." minutes", strtotime($selectedTime));
            $endTime = date("H:i:s",$timestamp);
            $interval = $timestamp + strtotime("+".$row['game_interval']." minutes", strtotime($timestamp));
            $interval1 = date("H:i:s",$interval);

      ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <a href="detail.php?id=<?=$row['id']?>"><img src="<?=$row['photo']?>"/></a>
            <div class="card-body">
              <p class="card-text text-center" style="color:grey;"><?=$row['title']?></p>
              <div class="d-flex justify-content-between align-items-center">
               <?php
                  
               ?>
                <button data-toggle="modal" data-target="#bookmodal"><?=$selectedTime?> - <?=$endTime?></button>
                
              <?php
                  
              ?>
                <button><?=$interval1?></button>
               
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

<div style="color:black;" id="bookmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h3></h3>
        <form>
          <div class="form-group">
            <label for="name" class="col-form-label">Your name:</label>
            <input type="text" class="form-control" id="name">
          </div>

          <div class="form-group">
            <label for="mobile" class="col-form-label">Your mobile:</label>
            <input type="text" class="form-control" id="mobile">
          </div>

          <div class="form-group">
            <label for="email" class="col-form-label">Your email:</label>
            <input type="text" class="form-control" id="email">
          </div>

          <div class="form-group">
            <label for="num_per" class="col-form-label">Number of Person:</label>
            <input type="number" min="1" class="form-control" id="num_per">
          </div>

          <div class="form-group">
            <label for="note" class="col-form-label">Special Note:</label>
            <textarea class="form-control" id="note"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<?php
    include "footer.php";
?>
