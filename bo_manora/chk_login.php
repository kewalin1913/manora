<?php
    session_start();
    if (!isset($_SESSION['adm_id'])){
        header('location: signin.php');
        exit;
    }
	date_default_timezone_set("Asia/Bangkok");
?>