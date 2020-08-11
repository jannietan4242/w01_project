<?php
  include "header.php";
  include "db.php";
  include "sendmail.php";

  if(isset($_POST['name'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $num_of_person = $_POST['num_of_person'];
    $note = $_POST['note'];
    $gameName = $_POST['gameName'];
    $time_slot = $_POST['time1'];
    $date1 = $_POST['date1'];
    $created_date = date("Y-m-d H:i:s");

    mysqli_query($link, "INSERT INTO booking (name, mobile, email, num_of_person, note, game_title, time_slot, date, created_date) VALUES ('$name', '$mobile', '$email', '$num_of_person', '$note', '$gameName', '$time_slot', '$date1', '$created_date')") or die(mysqli_error($link));

    $result = sendmail("tanjingyi94@gmail.com", "Jannie", "Lost in JB - Receive a new booking ".date("Y-m-d H:i:s"), "<h2>Hello Jannie</h2><p>You just received a new booking.</p>");

    $result = sendmail($email, $name, "Thanks for booking with us!", "<h2>Hello ".$name."</h2><p>Thanks for booking with us, please check your booking details below:<br><br>Date:".$date1."<br>Timeslot:".$time_slot."<br>Game Room:".$gameName."<br>Number of Person:".$num_of_person."</p><p>See you there!</p>");

    header("Location: booking_success.php");
    exit;
  }

  include "footer.php";
?>