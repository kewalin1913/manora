<?php
    if(!$_POST){
        echo json_encode(array("status"=>"error", "msg"=>"ไม่มีการ ส่งข้อมูล"));
        exit();
    }

    include_once('conn/strconn.php');

/*----------------------------------------- Add ----------------------------------------------*/
    if($_POST['action']=='add'){
        $clo_name = $_POST['clo_name'];
        $clo_detail = $_POST['clo_detail'];

        $sql = "REPLACE INTO tb_cloting VALUES('','$clo_name','$clo_detail')";
        if (mysqli_query($conn, $sql)) {

            $sqlclo = "Select Max(clo_id) as MaxID from tb_cloting";
            $resultclo = mysqli_query($conn,$sqlclo);
            $rsclo = mysqli_fetch_assoc($resultclo);
            $clo_id = $rsclo['MaxID'];

            // เช็คว่ามีรูปมาด้วย
            if($_FILES['clo_img']['name'][0]!="") {
               $imgCount = count($_FILES['clo_img']['name']);
               for($i=0;$i<$imgCount;$i++){
                    $img_name = $_FILES['clo_img']['name'][$i];
                    $img_size = $_FILES['clo_img']['size'][$i];
                    $img_tmp = $_FILES['clo_img']['tmp_name'][$i];
 
                   if($img_name != ""){
                    
                        // สร้าง imgc_id ใหม่
                        $sql="Select Max(imgc_id)+1 as MaxID from tb_cloting_img";
                        $result=mysqli_query($conn,$sql);
                        $rs=mysqli_fetch_array($result);
                        $new_id=$rs['MaxID'];
                            if($new_id==''){ 
                                $imgc_id="IC001";
                            }else{
                                $imgc_id="IC".sprintf("%03d",$new_id);
                            }
                        
                        $allow = array('jpg', 'jpeg', 'png','gif');
                        $extension = explode('.', $img_name);
                        $fileActExt = strtolower(end($extension));                        
                        $fileNew = $imgc_id . "." . $fileActExt;  // rand function create the rand number 
                        $filePath = 'img/cloting/'.$fileNew;
 
                       if (in_array($fileActExt, $allow)) {                    
                           if ($img_size > 0 && $img_size < 1000000) {
                               if(move_uploaded_file($img_tmp,$filePath)){                                   
 
                                   // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                                   $sql = "REPLACE INTO tb_cloting_img VALUES('','$fileNew','$clo_id')";
                                   mysqli_query($conn, $sql);  
                               
                               // ไฟล์รูป Upload ไม่ได้
                               }else{
                                   echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปไม่สามารถ Upload ไปปลายทางได้ !!!"));   
                                   exit();                         
                               }
                           // แจ้งไฟล์มีขนาดใหญ่กว่า 1 MB
                           }else{
                               echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปมีขนาดใหญ่เกินไป !!!"));
                               exit();
                           }
                       // แจ้ง Error นามสกุลไฟล์รูปไม่ตรง
                       }else{
                           echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปไม่ใช่ jpg, jpeg, png, gif !!!"));   
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
        $clo_id = $_POST['clo_id'];
        $clo_name = $_POST['clo_name'];
        $clo_detail = $_POST['clo_detail'];
        
        $sql = "REPLACE INTO tb_cloting VALUES('$clo_id','$clo_name','$clo_detail')";
        if (mysqli_query($conn, $sql)) {
            // เช็คว่ามีรูปมาด้วย
            if($_FILES['clo_img']['name'][0]!="") {
               $imgCount = count($_FILES['clo_img']['name']);
               for($i=0;$i<$imgCount;$i++){
                    $img_name = $_FILES['clo_img']['name'][$i];
                    $img_size = $_FILES['clo_img']['size'][$i];
                    $img_tmp = $_FILES['clo_img']['tmp_name'][$i];

                   if($img_name != ""){
                    
                        // สร้าง imgc_id ใหม่
                        $sql="Select Max(imgc_id)+1 as MaxID from tb_cloting_img";
                        $result=mysqli_query($conn,$sql);
                        $rs=mysqli_fetch_array($result);
                        $new_id=$rs['MaxID'];
                            if($new_id==''){ 
                                $imgc_id="IC001";
                            }else{
                                $imgc_id="IC".sprintf("%03d",$new_id);
                            }
                        
                        $allow = array('jpg', 'jpeg', 'png','gif');
                        $extension = explode('.', $img_name);
                        $fileActExt = strtolower(end($extension));                        
                        $fileNew = $imgc_id . "." . $fileActExt;  // rand function create the rand number 
                        $filePath = 'img/cloting/'.$fileNew;

                       if (in_array($fileActExt, $allow)) {                    
                           if ($img_size > 0 && $img_size < 1000000) {
                               if(move_uploaded_file($img_tmp,$filePath)){                                   

                                   // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                                   $sql = "REPLACE INTO tb_cloting_img VALUES('','$fileNew','$clo_id')";
                                   mysqli_query($conn, $sql);  
                               
                               // ไฟล์รูป Upload ไม่ได้
                               }else{
                                   echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปไม่สามารถ Upload ไปปลายทางได้ !!!"));   
                                   exit();                         
                               }
                           // แจ้งไฟล์มีขนาดใหญ่กว่า 1 MB
                           }else{
                               echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปมีขนาดใหญ่เกินไป !!!"));
                               exit();
                           }
                       // แจ้ง Error นามสกุลไฟล์รูปไม่ตรง
                       }else{
                           echo json_encode(array("status"=>"error", "msg"=> "ไฟล์รูปไม่ใช่ jpg, jpeg, png, gif !!!"));   
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
        $clo_id = $_POST['clo_id'];

        // ลบรูปเครื่องดนตรี
        $sql="SELECT * FROM tb_cloting_img WHERE clo_id='$clo_id'";
        $result = $conn->query($sql); 
        if ($result->num_rows !== 0){
            while($row=$result->fetch_assoc()){
                $imgc_name=$row['imgc_name'];
                $Path = "img/cloting/".$imgc_name;
                unlink($Path);     
            }
        }        
        // ลบตารางรูปเครื่องดนตรี
        $sqldelimg="DELETE FROM tb_cloting_img WHERE clo_id='$clo_id';";
        mysqli_query($conn, $sqldelimg);

        // ลบตารางเครื่องดนตรี
        $sqldel="DELETE FROM tb_cloting WHERE clo_id='$clo_id';";
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
    $imgc_id = $_POST['imgc_id'];

    // ลบรูปเครื่องดนตรี
    $sql="SELECT * FROM tb_cloting_img WHERE imgc_id='$imgc_id'";
    $result = $conn->query($sql); 
    if ($result->num_rows !== 0){
        while($row=$result->fetch_assoc()){
            $imgc_name=$row['imgc_name'];
            $Path = "img/cloting/".$imgc_name;
            unlink($Path);     
        }
    }        
    // ลบตารางรูปเครื่องดนตรี
    $sqldelimg="DELETE FROM tb_cloting_img WHERE imgc_id='$imgc_id';";
    
    if (mysqli_query($conn, $sqldelimg)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการลบรูปภาพเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถลบรูปภาพ !!!"));
    }
}

mysqli_close($conn);

?>