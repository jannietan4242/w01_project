<?php
  include "db.php";

  $id = $_GET['id'];

  $sql = mysqli_query($link, "UPDATE game SET is_deleted = '1', modified_date= '".date("Y-m-d H:i:s")."' WHERE id = '$id'") or die(mysqli_error($link));
  header("Location: game_mng.php");

?>