<?php

    include "db.php";

    $startdate = $_GET['startdate'];
    $enddate   = $_GET['enddate'];

    // get latest date
    $latest_date = $enddate;
    $earliest_date = $startdate;

    $start_date_ut = strtotime($earliest_date);
    $end_date_ut   = strtotime($latest_date);

    $dateArray = [];
    $dateArray[] = ["Date", "Number of Booking"];

    for($i = $start_date_ut; $i <= $end_date_ut; $i=$i+24*3600) {
    
    $total_count = 0;
    $sql = mysqli_query($link, "SELECT COUNT(id) AS total_booking FROM booking WHERE date LIKE '".date("Y-m-d", $i)."%'");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_array($sql);
        $total_count = !empty($row['total_booking'])?(int)$row['total_booking']:0;
    }
    $dateArray[] = [ date("Y-m-d", $i), $total_count];
    }

    echo json_encode($dateArray);
?>