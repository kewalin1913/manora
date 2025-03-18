<?php
    // include "conn/strconn.php";
// เริมต้น page
    $start = 0;
    
// จำนวนข้อมูลต่อหน้า
    $rows_per_page = 10;

// นับจำนวนข้อมูลทั้งหมดในตาราง
    $record = $conn->query($sql);
    $nr_for_rows = $record->num_rows;

// หาจำนวนหน้า
    $pages = ceil($nr_for_rows / $rows_per_page);

// รับค่าหน้า
    if(isset($_GET['page-nr'])){
        $page = $_GET['page-nr'] - 1;
        $start = $page * $rows_per_page;
    }

// ดึงข้อมูลแต่ละหน้า
    // $sql = "SELECT * FROM $tbl LIMIT $start,$rows_per_page";
    // $result = $conn->query($sql)
?>