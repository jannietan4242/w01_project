<?php
    session_start();
    include "db.php";

    if(isset($_POST['game_id'])) {

        $game_id = $_POST['game_id'];
        
        $status_text = "";

        $sql = mysqli_query($link, "SELECT * FROM game WHERE id = '".$game_id."'")or die (mysqli_error($link));
        if(mysqli_num_rows($sql) > 0) {

            $game = mysqli_fetch_array($sql);
            
            if($game['is_hide']==1) {

                $status_text = "show";

                mysqli_query($link, "UPDATE game SET is_hide = 0, modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '".$game_id."'");
            } else {

                $status_text = "hide";

                mysqli_query($link, "UPDATE game SET is_hide = 1, modified_date = '".date("Y-m-d H:i:s")."' WHERE id = '".$game_id."'");
            }

        }
        echo $status_text;
    }   

?>