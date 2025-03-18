<?php
    
if(!$_POST){
    echo json_encode(array("status"=>"error", "msg"=>"ไม่มีการ ส่งข้อมูล"));
    exit;
}
include_once 'conn/strconn.php';

/*----------------------------------------- Add ----------------------------------------------*/
if ($_POST['action'] == 'add'){
    // รับค่าตัวแปร
    $adm_name=$_POST['adm_name'];
    $adm_lname=$_POST['adm_lname'];
    $adm_username=$_POST['adm_username'];
    $adm_pwd=$_POST['adm_pwd'];
    $adm_img=$_FILES['adm_img'];

    $HashPwd = password_hash($adm_pwd,PASSWORD_DEFAULT);

    // Gen รหัสใหม่
    $sql="Select Max(substr(adm_id,-3))+1 as MaxID from tb_admin";
    $result=mysqli_query($conn,$sql);
    $rs=mysqli_fetch_array($result);
    $new_id=$rs['MaxID'];

        if($new_id==''){ 
            $adm_id="AM001";
        }else{
            $adm_id="AM".sprintf("%03d",$new_id);
        }
    
    
    // เช็คไฟล์รูป
    if($adm_img['name'] != ""){
        $allow = array('jpg', 'jpeg', 'png','gif');
        $extension = explode('.', $adm_img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = $adm_id . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'img/adm/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($adm_img['size'] > 0 && $adm_img['size'] < 1000000 && $adm_img['error'] == 0) {
                if (move_uploaded_file($adm_img['tmp_name'], $filePath)) {

                    // บันทึกใส่ฐานข้อมูลแบบมีรูป
                    $sql = "REPLACE INTO tb_admin VALUES('$adm_id','$adm_name','$adm_lname','$adm_username','$HashPwd','$fileNew','1')";
                }else{

                }
            }else{
                echo json_encode(array("status"=>"success", "msg"=> "ไฟล์รูปมีขนาดใหญ่เกินไป !!!"));
            }            
        }else{
            echo json_encode(array("status"=>"success", "msg"=> "นามสกุลไฟล์รูปไม่ใช่ jpg, jpeg, png, gif !!!"));
        }        
    }else{
        // บันทึกใส่ฐานข้อมูลไม่มีรูป
        $sql = "REPLACE INTO tb_admin VALUES('$adm_id','$adm_name','$adm_lname','$adm_username','$HashPwd','','1')";
    }

    if ($conn->query($sql)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการบันทึกข้อมูลเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถบันทึกข้อมูลได้ !!!"));
    }   
}
/*-----------------------------------------End Add ----------------------------------------------*/

/*----------------------------------------- Edit All ---------------------------------------------*/
if($_POST['action'] == "edit_all"){

    $adm_id=$_POST['adm_id'];
    $adm_name=$_POST['adm_name'];
    $adm_lname=$_POST['adm_lname'];
    $adm_username=$_POST['adm_username'];
    $adm_pwd=$_POST['adm_pwd'];
    $adm_status=$_POST['adm_status'];
    $adm_img=$_FILES['adm_img'];



    $HashPwd = password_hash($adm_pwd,PASSWORD_DEFAULT);

    if($adm_img['name'] != ""){
        $allow = array('jpg', 'jpeg', 'png','gif');
        $extension = explode('.', $adm_img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = $adm_id . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'img/adm/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($adm_img['size'] > 0 && $adm_img['size'] < 1000000 && $adm_img['error'] == 0) {
                if (move_uploaded_file($adm_img['tmp_name'], $filePath)) {

                    // บันทึกใส่ฐานข้อมูลแบบมีรูป
                    $sql = "REPLACE INTO tb_admin VALUES('$adm_id','$adm_name','$adm_lname','$adm_username','$HashPwd','$fileNew','$adm_status')";

                }else{

                }
            }else{
                echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปมีขนาดใหญ่เกินไป !!!"));
            }            
        }else{
            echo json_encode(array("status"=>"eroor", "msg"=> "นามสกุลไฟล์รูปไม่ใช่ jpg, jpeg, png, gif !!!"));
        }        
    }else{
        // บันทึกใส่ฐานข้อมูลไม่มีรูป
        $sql = "UPDATE tb_admin SET adm_name='$adm_name',adm_lname='$adm_lname',adm_username='$adm_username',adm_pwd='$HashPwd',adm_status='$adm_status' WHERE adm_id='$adm_id'";
    }


    if ($conn->query($sql)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการบันทึกข้อมูลเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถบันทึกข้อมูลได้ !!!"));
    }   
}


/*----------------------------------------- Edit ---------------------------------------------*/
if($_POST['action'] == "edit"){

    $adm_id=$_POST['adm_id'];
    $adm_name=$_POST['adm_name'];
    $adm_lname=$_POST['adm_lname'];
    $adm_username=$_POST['adm_username'];
    $adm_status=$_POST['adm_status'];
    $adm_img=$_FILES['adm_img'];

    if($adm_img['name'] != ""){
        $allow = array('jpg', 'jpeg', 'png','gif');
        $extension = explode('.', $adm_img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = $adm_id . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'img/adm/'.$fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($adm_img['size'] > 0 && $adm_img['size'] < 1000000 && $adm_img['error'] == 0) {
                if (move_uploaded_file($adm_img['tmp_name'], $filePath)) {

                    // บันทึกใส่ฐานข้อมูลแบบมีรูป
                    $sql = "UPDATE tb_admin SET adm_name='$adm_name',adm_lname='$adm_lname',adm_username='$adm_username',adm_img='$fileNew',adm_status='$adm_status' WHERE adm_id='$adm_id'";
                }else{

                }
            }else{
                echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปมีขนาดใหญ่เกินไป !!!"));
            }            
        }else{
            echo json_encode(array("status"=>"eroor", "msg"=> "นามสกุลไฟล์รูปไม่ใช่ jpg, jpeg, png, gif !!!"));
        }        
    }else{
        // บันทึกใส่ฐานข้อมูลไม่มีรูป
        $sql = "UPDATE tb_admin SET adm_name='$adm_name',adm_lname='$adm_lname',adm_username='$adm_username',adm_status='$adm_status' WHERE adm_id='$adm_id'";
    }

    if ($conn->query($sql)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการบันทึกข้อมูลเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถบันทึกข้อมูลได้ !!!"));
    }   
}

/*----------------------------------------- Del ---------------------------------------------*/
if($_POST['action'] == "del") {
    $adm_id = $_POST['adm_id'];
    $adm_img = $_POST['adm_img'];
    $Path = "img/adm/".$adm_img;
    
    $sql = "DELETE FROM tb_admin WHERE adm_id = '$adm_id'";
    // mysqli_query($conn, $sql);
    if($adm_img != ""){
        unlink($Path);     
    }

    if ($conn->query($sql)) {        
        echo json_encode(array("status"=>"success", "msg"=>"ทำการลบข้อมูลเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถลบข้อมูลได้ !!!"));
    }
}

/*-------------------------------------- Reset Password ----------------------------------------*/

if($_POST['action']== "resetpwd"){

    // รับตัวแปร
    $adm_id = $_POST['adm_id'];
    $pwd_ole = $_POST['pwd_ole'];
    $pwd_new = $_POST['pwd_new'];
    $pwd_renew = $_POST['pwd_renew'];

    $sqladm = "SELECT * FROM tb_admin WHERE adm_id = '$adm_id'";
    $resultadm = $conn->query($sqladm);
    $rowadm = $resultadm->fetch_assoc();

    $pwd_ole_db = $rowadm['adm_pwd'];

    if(password_verify($pwd_ole, $pwd_ole_db)){

        if($pwd_new == $pwd_renew){
            // แปลงรหัสผ่าน
            $HashPwd = password_hash($pwd_new,PASSWORD_DEFAULT);            
            $sql = "UPDATE tb_admin SET adm_pwd = '$HashPwd' WHERE adm_id = '$adm_id'";

            if($conn->query($sql)){
                echo json_encode(array("status"=>"success", "msg"=>"ทำการเปลี่ยนรหัสผ่านเรียบร้อย"));
            }else{
                echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถเปลี่ยนรหัสผ่านได้ กรุณาทำการเปลี่ยนรหัสผ่านใหม่อีกครั้ง"));
            }   
        }else{
            echo json_encode(array("status"=>"error", "msg"=>"รหัสใหม่ กับ ยืนยันรหัสผ่าน ไม่ตรงกัน !!!"));
        }       

    }else{
        echo json_encode(array("status"=>"error", "msg"=>"รหัสผ่านเดิมไม่ถูกต้อง !!!"));
    } 

}




mysqli_close($conn);

?>