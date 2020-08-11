<?php
include "header.php";
include "db.php";
    $sql = mysqli_query($link, "SELECT * FROM game WHERE is_deleted = 0 AND is_hide = 0 ORDER BY created_date DESC") or die (mysqli_error($link));
?>
<style>
.timeslot {
    display: block;
    width: 100%;
    border: 5px;
    border-radius: 5px;
    background-color: green;
    color: white;
    margin: 10px;
    padding: 5px 100px;
    font-size: 16px;
    cursor: pointer;
    text-align: center;
  }

  .timeslot:hover {
    background-color: orange;
  }

  .pickADate {
    color:red;
    margin:50px;
    margin-top:0px;
    font-family:'papyrus';
    font-weight:bold;
    font-size: 130%;
  }

  .card-text {
  color:black;
  font-size: large;
  font-family:'papyrus';
  font-weight: bold;
  }
</style>

<main role="main">

  <div class="album">
  
    <div class="container">

        <div class="pickADate">Pick a date: <input type="date" id="date" name="date"></div>

      <div class="row">
      <?php

        if(mysqli_num_rows($sql) > 0) {
        while($row = mysqli_fetch_array($sql)){

            // $startTime = $row['start_time'];
            // $timestamp = strtotime("+".$row['game_duration']." minutes", strtotime($startTime));
            // $endTime = date("H:i:s",$timestamp);
            // $interval = $timestamp + strtotime("+".$row['game_interval']." minutes", strtotime($timestamp));
            // $interval1 = date("H:i:s",$interval);

            $start_time = $row['start_time']; //time
            $end_time = $row['end_time']; //time
            $gametime   = $row['game_duration']; //minutes
            $interval   = $row['game_interval']; //minutes

            $stt = explode(":", $start_time);
            $ett = explode(":", $end_time); 
    
            $gt  = $gametime * 60; //seconds
            $itt = $interval * 60;   //seconds
    
            $start_time_ts = mktime($stt[0], $stt[1], $stt[2], 1, 1, 2020); //seconds
            $end_time_ts = mktime($ett[0], $ett[1], $ett[2], 1, 1, 2020); //seconds
    
            $timeslot = [];
            for($i=$start_time_ts; $i <= $end_time_ts; $i=$i+$gt+$itt) {
    
                $starting = date("H:i", $i);
                $endding  = date("H:i", $i+$gt);
    
                $timeslot[] = [
                    'starttime' => $starting,
                    'endtime'   => $endding,
                ];
    
            }

      ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <a href="detail.php?id=<?=$row['id']?>"><img src="<?=$row['photo']?>"/></a>
            <div class="card-body">
              <p class="card-text text-center" style="color:grey;"><?=$row['title']?></p>
              <div class="justify-content-between align-items-center">
              <div class="row">
              <div class="col-xs-12">
               <?php
                  foreach($timeslot as $v) {
               ?>
                
                 <button class="timeslot" data-toggle="modal" data-target="#bookmodal" onclick="openModal('<?=$row['title']?>','<?=$v['starttime']?> - <?=$v['endtime']?> ','<?=$row['min']?>', '<?=$row['max']?>' )"><?=$v['starttime']?> - <?=$v['endtime']?></button>
                
                
              <?php
                  }
              ?>
              </div>
               </div>
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
    <form action="booking2.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Booking Game Room: <span type="text" id="gameName1"></span></h5>

        <input type="hidden" id="gameName" name="gameName">
        <input type="hidden" id="time1" name="time1">
        <input type="text" id="date1" name="date1">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p class="modal-title" id="modalDate">Date: <span id="date2"></span></p>
      <p class="modal-title" id="modalTime">Time: <span id="time"></span></p>
      <p class="modal-title" id="modalPerson">Number of person: <span id="min"></span> - <span id="max"></span></p>
      
     

          <div class="form-group">
            <label for="name" class="col-form-label">Your name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>

          <div class="form-group">
            <label for="mobile" class="col-form-label">Your mobile:</label>
            <input type="text" class="form-control" id="mobile" name="mobile">
          </div>

          <div class="form-group">
            <label for="email" class="col-form-label">Your email:</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>

          <div class="form-group">
            <label for="num_per" class="col-form-label">Number of Person:</label>
            <input type="number" min="1" class="form-control" id="num_per" name="num_of_person">
          </div>

          <div class="form-group">
            <label for="note" class="col-form-label">Special Note:</label>
            <textarea class="form-control" id="note" name="note"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Submit</button>
      </div>
      </form>
    </div>
  </div>
  
</div>

<?php
    include "footer.php";
?>

<script>

    function openModal(game_title,time_slot,min,max) {

        $("#gameName").val(game_title);
        $("#gameName1").text(game_title);
        $("#time").text(time_slot);
        $("#time1").val(time_slot);
        // $("#date1").val()= $("#date").val();        
        document.getElementById("date1").value = document.getElementById("date").value; 
        // document.getElementById("date2").value = document.getElementById("date").value; 
        $("#date2").val(document.getElementById("date").value);

        $("#min").text(min);
        $("#max").text(max);
        $("#num_per").attr('min',min);
        $("#num_per").attr('max',max);

        $("#name").val('');
        $("#mobile").val('');
        $("#email").val('');
        $("#num_per").val('');
        $("#note").val('');
        $('#myModal').modal('show');    

    }    

</script>