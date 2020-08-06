<?php
  include "header.php";
  include "db.php";

  if(isset($_POST['name'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $num_of_person = $_POST['num_of_person'];
    $note = $_POST['note'];
    $game_title = $_POST['game_title'];
    $time_slot = $_POST['time_slot'];
    
    $created_date = date("Y-m-d H:i:s");
    
    mysqli_query($link, "INSERT INTO booking (name, mobile, email, num_of_person, note, game_title, time_slot,  created_date) VALUES ('$name', '$mobile', '$email', '$num_of_person', '$note', '$game_title', '$time_slot', '$created_date')") or die(mysqli_error($link));

    header("Location: booking_success.php");
    exit;
  }

  include "footer.php";
?>