<?php
    ob_start();
    session_start();
    
    $timezone = date_default_timezone_set('America/New_York');
    
    $con = mysqli_connect("localhost", "root","","social");

    if(mysqli_connect_error()){
        echo "failed to connect: " . mysqli_connect_error();

    }
    

?>
