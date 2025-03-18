<?php
    
if(!$_POST){
    exit;
}
include_once 'conn/strconn.php';

/*----------------------------------------- Add ----------------------------------------------*/
if ($_POST['action'] == 'add'){

    $init_name=$_POST['init_name'];       

        $sql="Select Max(substr(init_id,-2))+1 as MaxID from tb_initial";
        $result=mysqli_query($conn,$sql);
        $rs=mysqli_fetch_array($result);
        $new_id=$rs['MaxID'];
            if($new_id==''){ 
                $init_id="IN01";
            }else{
                $init_id="IN".sprintf("%02d",$new_id);
            }

        $sql = "REPLACE INTO tb_initial VALUES('$init_id', '$init_name')";
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

	$init_id = $_POST['init_id'];
	$init_name=$_POST['init_name'];
	
	$sql = "REPLACE INTO tb_initial VALUES('$init_id', '$init_name')";
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
    $init_id = $_POST['init_id'];
    
    $sql = "DELETE FROM tb_initial WHERE init_id = '$init_id'";
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