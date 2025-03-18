<?php
    if(!$_POST){
        echo json_encode(array("status"=>"error", "msg"=>"ไม่มีการ ส่งข้อมูล"));
        exit();
    }

    include_once('conn/strconn.php');

/*----------------------------------------- Add ----------------------------------------------*/
    if($_POST['action']=='add'){
        $dan_name = $_POST['dan_name'];
        $dan_detail = $_POST['dan_detail'];
        $dan_clip="";

        // เช็คว่ามี Clip มาด้วย
        if($_FILES['dan_clip']['name'] != "") {

            $clip_name = $_FILES['dan_clip']['name'];
            $clip_size = $_FILES['dan_clip']['size'];
            $clip_tmp = $_FILES['dan_clip']['tmp_name'];
           if($clip_name != ""){
            
                // สร้าง Clip Name ใหม่
                $sql="Select Max(dan_id)+1 as MaxID from tb_dance";
                $result=mysqli_query($conn,$sql);
                $rs=mysqli_fetch_array($result);
                $new_id=$rs['MaxID'];
                    if($new_id==''){ 
                        $cname="CL001";
                    }else{
                        $cname="CL".sprintf("%03d",$new_id);
                    }
                
                $allow = array('mp4', 'avi', '3gp');
                $extension = explode('.', $clip_name);
                $fileActExt = strtolower(end($extension));                        
                $fileNew = $cname . "." . $fileActExt;  // rand function create the rand number 
                $filePath = 'vdo/'.$fileNew;
                 
               if (in_array($fileActExt, $allow)) {                    
                   if ($clip_size > 0 && $clip_size < 10000000) {
                       if(move_uploaded_file($clip_tmp,$filePath)){                                   
                           // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                           $dan_clip = $fileNew;
                       
                       // ไฟล์ Clip Upload ไม่ได้
                        }else{
                           echo json_encode(array("status"=>"error", "msg"=> "ไฟล์ Clip ไม่สามารถ Upload ไปปลายทางได้ !!!"));   
                           exit();                         
                        }
                   // แจ้งไฟล์มีขนาดใหญ่กว่า 10 MB
                    }else{
                       echo json_encode(array("status"=>"error", "msg"=> "ไฟล์ Clip มีขนาดใหญ่เกินไป !!!"));
                       exit();
                    }
               // แจ้ง Error นามสกุลไฟล์รูปไม่ตรง
                }else{
                   echo json_encode(array("status"=>"error", "msg"=> "ไฟล์ Clip ไม่ใช่ mp4, avi, 3gp !!!"));   
                   exit();                 
                }
            }
        }

        $sql = "REPLACE INTO tb_dance VALUES('','$dan_name','$dan_detail','$dan_clip')";
        if (mysqli_query($conn, $sql)) {

            $sqldan = "Select Max(dan_id) as MaxID from tb_dance";
            $resultdan = mysqli_query($conn,$sqldan);
            $rsdan = mysqli_fetch_assoc($resultdan);
            $dan_id = $rsdan['MaxID'];
             
                // เช็คว่ามีรูปมาด้วย
                if($_FILES['dan_img']['name'][0]!="") {
                    $imgCount = count($_FILES['dan_img']['name']);
                    for($i=0;$i<$imgCount;$i++){
                         $img_name = $_FILES['dan_img']['name'][$i];
                         $img_size = $_FILES['dan_img']['size'][$i];
                         $img_tmp = $_FILES['dan_img']['tmp_name'][$i];
                               if($img_name != ""){
                         
                             // สร้าง imgd_id ใหม่
                             $sql="Select Max(imgd_id)+1 as MaxID from tb_dance_img";
                             $result=mysqli_query($conn,$sql);
                             $rs=mysqli_fetch_array($result);
                             $new_id=$rs['MaxID'];
                                 if($new_id==''){ 
                                     $imgd_id="ID001";
                                 }else{
                                     $imgd_id="ID".sprintf("%03d",$new_id);
                                 }
                             
                             $allow = array('jpg', 'jpeg', 'png','gif');
                             $extension = explode('.', $img_name);
                             $fileActExt = strtolower(end($extension));                        
                             $fileNew = $imgd_id . "." . $fileActExt;  // rand function create the rand number 
                             $filePath = 'img/dance/'.$fileNew;
                                   if (in_array($fileActExt, $allow)) {                    
                                if ($img_size > 0 && $img_size < 1000000) {
                                    if(move_uploaded_file($img_tmp,$filePath)){                                   
                                               // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                                        $sql = "REPLACE INTO tb_dance_img VALUES('','$fileNew','$dan_id')";
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
        $dan_id = $_POST['dan_id'];
        $dan_name = $_POST['dan_name'];
        $dan_detail = $_POST['dan_detail'];
        $dan_clip = $_POST['dan_clip'];
        
        // เช็คว่ามี Clip มาด้วย
        if($_FILES['dan_clip']['name'] != "") {
            $clip_name = $_FILES['dan_clip']['name'];
            $clip_size = $_FILES['dan_clip']['size'];
            $clip_tmp = $_FILES['dan_clip']['tmp_name'];

           if($clip_name != ""){
            
                // สร้าง Clip Name ใหม่
                $new_id=$dan_id;
                $cname="CL".sprintf("%03d",$new_id);
                
                $allow = array('mp4', 'avi', '3gp');
                $extension = explode('.', $clip_name);
                $fileActExt = strtolower(end($extension));                        
                $fileNew = $cname . "." . $fileActExt;  // rand function create the rand number 
                $filePath = 'vdo/'.$fileNew;
                 
               if (in_array($fileActExt, $allow)) {                    
                   if ($clip_size > 0 && $clip_size < 10000000) {
                       if(move_uploaded_file($clip_tmp,$filePath)){                                   
                           // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                           $dan_clip = $fileNew;
                       
                       // ไฟล์ Clip Upload ไม่ได้
                        }else{
                           echo json_encode(array("status"=>"error", "msg"=> "ไฟล์ Clip ไม่สามารถ Upload ไปปลายทางได้ !!!"));   
                           exit();                         
                        }
                   // แจ้งไฟล์มีขนาดใหญ่กว่า 10 MB
                    }else{
                       echo json_encode(array("status"=>"error", "msg"=> "ไฟล์ Clip มีขนาดใหญ่เกินไป !!!"));
                       exit();
                    }
               // แจ้ง Error นามสกุลไฟล์รูปไม่ตรง
                }else{
                   echo json_encode(array("status"=>"error", "msg"=> "ไฟล์ Clip ไม่ใช่ mp4, avi, 3gp !!!"));   
                   exit();                 
                }
            }
        }

        $sql = "REPLACE INTO tb_dance VALUES('$dan_id','$dan_name','$dan_detail','$dan_clip')";
        if (mysqli_query($conn, $sql)) {
            // เช็คว่ามีรูปมาด้วย
            if($_FILES['dan_img']['name'][0]!="") {
            $imgCount = count($_FILES['dan_img']['name']);
            for($i=0;$i<$imgCount;$i++){
                    $img_name = $_FILES['dan_img']['name'][$i];
                    $img_size = $_FILES['dan_img']['size'][$i];
                    $img_tmp = $_FILES['dan_img']['tmp_name'][$i];

                if($img_name != ""){
                    
                        // สร้าง imgd_id ใหม่
                        $sql="Select Max(imgd_id)+1 as MaxID from tb_dance_img";
                        $result=mysqli_query($conn,$sql);
                        $rs=mysqli_fetch_array($result);
                        $new_id=$rs['MaxID'];
                            if($new_id==''){ 
                                $imgd_id="ID001";
                            }else{
                                $imgd_id="ID".sprintf("%03d",$new_id);
                            }
                        
                        $allow = array('jpg', 'jpeg', 'png','gif');
                        $extension = explode('.', $img_name);
                        $fileActExt = strtolower(end($extension));                        
                        $fileNew = $imgd_id . "." . $fileActExt;  // rand function create the rand number 
                        $filePath = 'img/dance/'.$fileNew;

                    if (in_array($fileActExt, $allow)) {                    
                        if ($img_size > 0 && $img_size < 1000000) {
                            if(move_uploaded_file($img_tmp,$filePath)){                                   

                                // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                                $sql = "REPLACE INTO tb_dance_img VALUES('','$fileNew','$dan_id')";
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
        $dan_id = $_POST['dan_id'];
        
        // ลบคลิปท่ารำ
        $sqlclip="SELECT * FROM tb_dance WHERE dan_id = $dan_id";
        $resultclip = $conn->query($sqlclip);
        $rowclip = $resultclip->fetch_assoc();
        
        $dan_clip = $rowclip['dan_clip'];
        $PathClip="vdo/".$dan_clip;
        unlink($PathClip);

        // ลบรูปท่ารำ
        $sql="SELECT * FROM tb_dance_img WHERE dan_id = $dan_id";
        $result = $conn->query($sql); 
        if ($result->num_rows !== 0){
            while($row=$result->fetch_assoc()){
                $imgd_name=$row['imgd_name'];
                $Path = "img/dance/".$imgd_name;
                unlink($Path);     
            }
        }        
        // ลบตารางรูปท่ารำ
        $sqldelimg="DELETE FROM tb_dance_img WHERE dan_id='$dan_id';";
        mysqli_query($conn, $sqldelimg);

        // ลบตารางท่ารำ
        $sqldel="DELETE FROM tb_dance WHERE dan_id='$dan_id';";
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
        $imgd_id = $_POST['imgd_id'];

        // ลบรูปเครื่องดนตรี
        $sql="SELECT * FROM tb_dance_img WHERE imgd_id='$imgd_id'";
        $result = $conn->query($sql); 
        if ($result->num_rows !== 0){
            while($row=$result->fetch_assoc()){
                $imgd_name=$row['imgd_name'];
                $Path = "img/dance/".$imgd_name;
                unlink($Path);     
            }
        }        
        // ลบตารางรูปเครื่องดนตรี
        $sqldelimg="DELETE FROM tb_dance_img WHERE imgd_id='$imgd_id';";
        
        if (mysqli_query($conn, $sqldelimg)) {
            echo json_encode(array("status"=>"success", "msg"=>"ทำการลบรูปภาพเรียบร้อยแล้ว"));
        } 
        else {
            echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถลบรูปภาพ !!!"));
        }
    }

mysqli_close($conn);

?>