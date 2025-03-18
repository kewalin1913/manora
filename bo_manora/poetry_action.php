<?php
    
if(!$_POST){
    exit;
}
include_once 'conn/strconn.php';

/*----------------------------------------- Add ----------------------------------------------*/
if ($_POST['action'] == 'add'){

    $poe_name=$_POST['poe_name'];   
    $poe_detail = $_POST['poe_detail'];
    $poe_author = $_POST['poe_author'];


        $sql="Select Max(substr(poe_id,-2))+1 as MaxID from tb_poetry";
        $result=mysqli_query($conn,$sql);
        $rs=mysqli_fetch_array($result);

        $sql = "REPLACE INTO tb_poetry VALUES('','$poe_name','$poe_detail','$poe_author','1')";
        // $rows=mysqli_query($conn, $sql);

        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("status"=>"success", "msg"=>"ทำการบันทึกข้อมูลเรียบร้อยแล้ว"));
        } 
        else {
            echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถบันทึกข้อมูลได้ !!!"));
        }
    }

/*----------------------------------------- Edit ---------------------------------------------*/
if($_POST['action'] == "edit") {	

	$poe_id = $_POST['poe_id'];
	$poe_name=$_POST['poe_name'];
    $poe_detail = $_POST['poe_detail'];
    $poe_author = $_POST['poe_author'];
	
	$sql = "REPLACE INTO tb_poetry VALUES('$poe_id','$poe_name','$poe_detail','$poe_author','1')";
	// mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการแก้ไขข้อมูลเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถแก้ไขข้อมูลได้ !!!"));
    }
}

/*----------------------------------------- Del ---------------------------------------------*/
if($_POST['action'] == "del") {
    $poe_id = $_POST['poe_id'];
    
    $sql = "DELETE FROM tb_poetry WHERE poe_id = '$poe_id'";
    mysqli_query($conn, $sql);

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการลบข้อมูลเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถลบข้อมูลได้ !!!"));
    }
}

mysqli_close($conn);

?>