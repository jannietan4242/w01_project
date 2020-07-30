<?php
include "header.php";
include "db.php";

    $id = $_GET['id'];
    $sql = mysqli_query($link, "SELECT * FROM game WHERE id = '$id'") or die (mysqli_error($link));
        if(mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
        }
?>

<div>

        <h1>Story</h1>
        <p><?=$row['story']?></p>
</div>

<?php
    include "footer.php";
?>