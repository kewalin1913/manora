<?php
    
if(!$_POST){
    exit;
}
include_once 'conn/strconn.php';

/*----------------------------------------- Add ----------------------------------------------*/
if ($_POST['action'] == 'add'){

    $tnews_name=$_POST['tnews_name'];       

        $sql="Select Max(substr(tnews_id,-2))+1 as MaxID from tb_news_type";
        $result=mysqli_query($conn,$sql);
        $rs=mysqli_fetch_array($result);
        $new_id=$rs['MaxID'];
            if($new_id==''){ 
                $tnews_id="T01";
            }else{
                $tnews_id="T".sprintf("%02d",$new_id);
            }

        $sql = "REPLACE INTO tb_news_type VALUES('$tnews_id', '$tnews_name')";
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

	$tnews_id = $_POST['tnews_id'];
	$tnews_name=$_POST['tnews_name'];
	
	$sql = "REPLACE INTO tb_news_type VALUES('$tnews_id', '$tnews_name')";
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
    $tnews_id = $_POST['tnews_id'];
    
    $sql = "DELETE FROM tb_news_type WHERE tnews_id = '$tnews_id'";
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