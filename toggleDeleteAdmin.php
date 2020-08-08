<?php
    session_start();
    include "db.php";

    if(isset($_POST['admin_id'])) {

        $admin_id = $_POST['admin_id'];
        
        $status_text = "";

        $sql = mysqli_query($link, "SELECT * FROM admin WHERE id = '".$admin_id."'")or die (mysqli_error($link));
        if(mysqli_num_rows($sql) > 0) {

            $admin = mysqli_fetch_array($sql);
            
            if($admin['is_deleted']==1) {

                $status_text = "active";

                mysqli_query($link, "UPDATE admin SET is_deleted = 0, modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '".$admin_id."'");
            } else {

                $status_text = "inactive";

                mysqli_query($link, "UPDATE admin SET is_deleted = 1, modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '".$admin_id."'");
            }

        }
        echo $status_text;
    }   

?>