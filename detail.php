<?php
include "header.php";
include "db.php";

    $id = $_GET['id'];
    $sql = mysqli_query($link, "SELECT * FROM game WHERE id = '$id'") or die (mysqli_error($link));
        if(mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
        }
?>

<div style="background-image: url('./uploads/bg.jpg'); width:100%; padding:5%; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">

        <h1 style="font-family:castellar;"><?=$row['title']?></h1><br>
        <h3 style="font-family:papyrus;">Story</h3><br>
        <p style="font-family:'Times New Roman';"><?=$row['story']?></p>
        <a href="booking.php"><button class="btn btn-danger">Book Now</button></a>
</div>

<?php
    include "footer.php";
?>