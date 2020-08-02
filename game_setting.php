<?php
    // print_r($_POST);
    if(isset($_POST['min'])) {

        include "db.php";

        foreach($_POST['game_interval'] as $a=>$b) {
            
            $interval = $b;
            $target_id = $_POST['idinterval'][$a];
            mysqli_query($link, "UPDATE game SET game_interval = '".$interval."' WHERE id = '".$target_id."'") or die(mysqli_error($link));  
        }
        foreach($_POST['game_duration'] as $a=>$b) {
            
            $game_duration = $b;
            $target_id = $_POST['idgame_duration'][$a];
            mysqli_query($link, "UPDATE game SET game_duration = '".$game_duration."' WHERE id = '".$target_id."'") or die(mysqli_error($link));  
        }
        foreach($_POST['starttime'] as $c=>$d) {
            
            $start_time = $d;
            $target_id = $_POST['idstart'][$c];
            mysqli_query($link, "UPDATE game SET start_time = '".$start_time."' WHERE id = '".$target_id."'") or die(mysqli_error($link));  
        }
        foreach($_POST['endtime'] as $c=>$d) {
            
            $end_time = $d;
            $target_id = $_POST['idend'][$c];
            mysqli_query($link, "UPDATE game SET end_time = '".$end_time."' WHERE id = '".$target_id."'") or die(mysqli_error($link));  
        }
        foreach($_POST['min'] as $k=>$v) {
            $min = $v;
            $target_id = $_POST['idmin'][$k];
            mysqli_query($link, "UPDATE game SET min = '".$min."' WHERE id = '".$target_id."'") or die(mysqli_error($link));
        }
        foreach($_POST['max'] as $s=>$t) {
            
            $max = $t;
            $target_id = $_POST['idmax'][$s];
            mysqli_query($link, "UPDATE game SET max = '".$max."' WHERE id = '".$target_id."'") or die(mysqli_error($link));  
        }

    header("Location:game_mng.php");
    }
?>