<?php
if(!$_POST){
    echo json_encode(array("status"=>"error", "msg"=>"ไม่มีการส่งข้อมูล"));
    exit();
}

include_once('conn/strconn.php');

/*----------------------------------------- Add ----------------------------------------------*/
if($_POST['action']=='add'){
    $mus_name = $_POST['mus_name'];
    $mus_detail = $_POST['mus_detail'];
    
    $sql = "REPLACE INTO tb_musical VALUES('','$mus_name','$mus_detail')";
    if (mysqli_query($conn, $sql)) {
        // เช็คว่ามีรูปมาด้วย
        $sqlmus = "Select Max(mus_id) as MaxID from tb_musical";
        $resultmus = mysqli_query($conn,$sqlmus);
        $rsmus = mysqli_fetch_assoc($resultmus);
        $mus_id = $rsmus['MaxID'];

        if($_FILES['mus_img']['name'][0]!="") {
           $imgCount = count($_FILES['mus_img']['name']);

           for($i=0;$i<$imgCount;$i++){
                $img_name = $_FILES['mus_img']['name'][$i];
                $img_size = $_FILES['mus_img']['size'][$i];
                $img_tmp = $_FILES['mus_img']['tmp_name'][$i];
                $img_size_kb = round($img_size / 1024, 2); // แปลงเป็น KB

               if($img_name != ""){
                    // สร้าง imgm_id ใหม่
                    $sql="Select Max(imgm_id)+1 as MaxID from tb_musical_img";
                    $result=mysqli_query($conn,$sql);
                    $rs=mysqli_fetch_array($result);
                    $new_id=$rs['MaxID'];
                        if($new_id==''){ 
                            $imgm_id="IM001";
                        }else{
                            $imgm_id="IM".sprintf("%03d",$new_id);
                        }
                    
                    $allow = array('jpg', 'jpeg', 'png','gif');
                    $extension = explode('.', $img_name);
                    $fileActExt = strtolower(end($extension));                        
                    $fileNew = $imgm_id . "." . $fileActExt;
                    $filePath = 'img/musical/'.$fileNew;

                   if (in_array($fileActExt, $allow)) {                    
                       if ($img_size > 0 && $img_size < 1000000) {
                           if(move_uploaded_file($img_tmp,$filePath)){                                   
                               // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                               $sql = "REPLACE INTO tb_musical_img VALUES('','$fileNew','$mus_id')";
                               mysqli_query($conn, $sql);  
                           }else{
                               echo json_encode(array(
                                   "status"=>"error", 
                                   "msg"=> "ไฟล์รูปไม่สามารถ Upload ไปปลายทางได้!\nขนาดไฟล์: $img_size_kb KB"
                               ));   
                               exit();                         
                           }
                       }else{
                           echo json_encode(array(
                               "status"=>"error", 
                               "msg"=> "ไฟล์รูปมีขนาดใหญ่เกินไป!\nขนาดไฟล์: $img_size_kb KB (จำกัดไม่เกิน 1000 KB)"
                           ));
                           exit();
                       }
                   }else{
                       echo json_encode(array(
                           "status"=>"error", 
                           "msg"=> "ไฟล์รูปไม่ใช่ jpg, jpeg, png, gif!\nขนาดไฟล์: $img_size_kb KB"
                       ));   
                       exit();                 
                   }
               }
           }
        }
        echo json_encode(array("status"=>"success", "msg"=>"ทำการบันทึกข้อมูลเรียบร้อยแล้ว")); 
    }else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถบันทึกข้อมูลได้ !!!"));
    } 
        
}    

/*-------------------------------------------- Edit ----------------------------------------------*/
if($_POST['action']=="edit"){
    // รับค่าตัวแปร
    $mus_id = $_POST['mus_id'];
    $mus_name = $_POST['mus_name'];
    $mus_detail = $_POST['mus_detail'];
    
    $sql = "REPLACE INTO tb_musical VALUES('$mus_id','$mus_name','$mus_detail')";
    if (mysqli_query($conn, $sql)) {
        // เช็คว่ามีรูปมาด้วย
        if($_FILES['mus_img']['name'][0]!="") {
           $imgCount = count($_FILES['mus_img']['name']);
           for($i=0;$i<$imgCount;$i++){
                $img_name = $_FILES['mus_img']['name'][$i];
                $img_size = $_FILES['mus_img']['size'][$i];
                $img_tmp = $_FILES['mus_img']['tmp_name'][$i];
                $img_size_kb = round($img_size / 1024, 2); // แปลงเป็น KB

               if($img_name != ""){
                    // สร้าง imgm_id ใหม่
                    $sql="Select Max(imgm_id)+1 as MaxID from tb_musical_img";
                    $result=mysqli_query($conn,$sql);
                    $rs=mysqli_fetch_array($result);
                    $new_id=$rs['MaxID'];
                        if($new_id==''){ 
                            $imgm_id="IM001";
                        }else{
                            $imgm_id="IM".sprintf("%03d",$new_id);
                        }
                    
                    $allow = array('jpg', 'jpeg', 'png','gif');
                    $extension = explode('.', $img_name);
                    $fileActExt = strtolower(end($extension));                        
                    $fileNew = $imgm_id . "." . $fileActExt;
                    $filePath = 'img/musical/'.$fileNew;

                   if (in_array($fileActExt, $allow)) {                    
                       if ($img_size > 0 && $img_size < 1000000) {
                           if(move_uploaded_file($img_tmp,$filePath)){                                   
                               // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                               $sql = "REPLACE INTO tb_musical_img VALUES('','$fileNew','$mus_id')";
                               mysqli_query($conn, $sql);  
                           }else{
                               echo json_encode(array(
                                   "status"=>"error", 
                                   "msg"=> "ไฟล์รูปไม่สามารถ Upload ไปปลายทางได้!\nขนาดไฟล์: $img_size_kb KB"
                               ));   
                               exit();                         
                           }
                       }else{
                           echo json_encode(array(
                               "status"=>"error", 
                               "msg"=> "ไฟล์รูปมีขนาดใหญ่เกินไป!\nขนาดไฟล์: $img_size_kb KB (จำกัดไม่เกิน 1000 KB)"
                           ));
                           exit();
                       }
                   }else{
                       echo json_encode(array(
                           "status"=>"error", 
                           "msg"=> "ไฟล์รูปไม่ใช่ jpg, jpeg, png, gif!\nขนาดไฟล์: $img_size_kb KB"
                       ));   
                       exit();                 
                   }
               }
           }
        }
        echo json_encode(array("status"=>"success", "msg"=>"ทำการบันทึกข้อมูลเรียบร้อยแล้ว")); 
    }else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถบันทึกข้อมูลได้ !!!"));
    }         
}

/*--------------------------------------------- Del ----------------------------------------------*/
if($_POST['action'] == "del") {
    $mus_id = $_POST['mus_id'];

    // ลบรูปเครื่องดนตรี
    $sql="SELECT * FROM tb_musical_img WHERE mus_id='$mus_id'";
    $result = $conn->query($sql); 
    if ($result->num_rows !== 0){
        while($row=$result->fetch_assoc()){
            $imgm_name=$row['imgm_name'];
            $Path = "img/musical/".$imgm_name;
            // ตรวจสอบขนาดไฟล์ก่อนลบ
            if(file_exists($Path)) {
                $file_size = round(filesize($Path) / 1024, 2); // ขนาดไฟล์ใน KB
                unlink($Path);
                echo json_encode(array(
                    "status"=>"info", 
                    "msg"=> "ลบไฟล์ $imgm_name เรียบร้อย\nขนาดไฟล์: $file_size KB"
                ));
            }
        }
    }        
    // ลบตารางรูปเครื่องดนตรี
    $sqldelimg="DELETE FROM tb_musical_img WHERE mus_id='$mus_id';";
    mysqli_query($conn, $sqldelimg);

    // ลบตารางเครื่องดนตรี
    $sqldel="DELETE FROM tb_musical WHERE mus_id='$mus_id';";
    mysqli_query($conn, $sqldel);

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการลบข้อมูลเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถลบข้อมูลได้ !!!"));
    }
}

/*--------------------------------------------- Del IMG ----------------------------------------------*/
if($_POST['action'] == "delImg") {
    $imgm_id = $_POST['imgm_id'];

    // ลบรูปเครื่องดนตรี
    $sql="SELECT * FROM tb_musical_img WHERE imgm_id='$imgm_id'";
    $result = $conn->query($sql); 
    if ($result->num_rows !== 0){
        while($row=$result->fetch_assoc()){
            $imgm_name=$row['imgm_name'];
            $Path = "img/musical/".$imgm_name;
            // ตรวจสอบขนาดไฟล์ก่อนลบ
            if(file_exists($Path)) {
                $file_size = round(filesize($Path) / 1024, 2); // ขนาดไฟล์ใน KB
                unlink($Path);
                echo json_encode(array(
                    "status"=>"info", 
                    "msg"=> "ลบไฟล์ $imgm_name เรียบร้อย\nขนาดไฟล์: $file_size KB"
                ));
            }
        }
    }        
    // ลบตารางรูปเครื่องดนตรี
    $sqldelimg="DELETE FROM tb_musical_img WHERE imgm_id='$imgm_id';";

    if (mysqli_query($conn, $sqldelimg)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการลบรูปภาพเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถลบรูปภาพได้ !!!"));
    }
}

mysqli_close($conn);
?>