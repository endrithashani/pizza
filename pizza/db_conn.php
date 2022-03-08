<?php
    //connect to database

    $conn = mysqli_connect('localhost','root','','pizza');

    //check connection
    if(!$conn){
        echo 'connection error :' . mysqli_connect_error();
    }


?>