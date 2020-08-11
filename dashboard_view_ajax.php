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
    $dateArray[] = ["Date", "BlogView"];

    for($i = $start_date_ut; $i <= $end_date_ut; $i=$i+24*3600) {

        
        $total_count = 0;
        $sql = mysqli_query($link, "SELECT SUM(qty) AS total_view FROM blog_statistics WHERE created_date LIKE '".date("Y-m-d", $i)."%'") or die(mysqli_error($link));
        if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_array($sql);
        $total_count = !empty($row['total_view'])?(int)$row['total_view']:0;
        }

        $dateArray[] = [ date("Y-m-d", $i), $total_count ];

    }

    echo json_encode($dateArray);

?>