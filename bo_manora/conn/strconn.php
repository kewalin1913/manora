<?php
    // ประกาศตัวแปร
    $servername="localhost";
    $username="mrlu_manora";
    $password="%1ekg8N70";
    $dbname="manora-db";

    // create connection
    //$conn=mysqli_connect($servername,$username,$password,$dbname);
    $conn=new mysqli($servername,$username,$password,$dbname);
    
    // check connection
    /*
    if (!$conn){
        die("ไม่สามารถติดต่อฐานข้อมูลได้".mysqli_connect_errno());
    }*/

    if ($conn->connect_error){
        die("ไม่สามารถติดต่อฐานข้อมูลได้".$conn->connect_error);
    }
?>