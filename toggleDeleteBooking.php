<?php
    session_start();
    include "db.php";

    if(isset($_POST['booking_id'])) {

        $booking_id = $_POST['booking_id'];
        
        $status_text = "";

        $sql = mysqli_query($link, "SELECT * FROM booking WHERE id = '".$booking_id."'")or die (mysqli_error($link));
        if(mysqli_num_rows($sql) > 0) {

            $booking = mysqli_fetch_array($sql);
            
            if($booking['is_deleted']==1) {

                $status_text = "cancelled";

                mysqli_query($link, "UPDATE booking SET is_deleted = 0, modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '".$booking_id."'");
            } else {

                $status_text = "confirmed";

                mysqli_query($link, "UPDATE booking SET is_deleted = 1, modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '".$booking_id."'");
            }

        }
        echo $status_text;
    }   

?>