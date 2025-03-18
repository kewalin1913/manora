<?php
    if(!$_POST){
        echo json_encode(array("status"=>"error", "msg"=>"ไม่มีการ ส่งข้อมูล"));
        exit();
    }

    include_once('conn/strconn.php');

/*----------------------------------------- Add ----------------------------------------------*/
    if($_POST['action']=='add'){

        $news_title = $_POST['news_title'];        
        $news_detail = $_POST['news_detail'];
        $news_post = $_POST['news_post'];
        $adm_id = $_POST['adm_id'];
        $news_status = $_POST['news_status'];
    
        $sql = "REPLACE INTO tb_news VALUES('','$news_title','$news_detail','$news_post','$adm_id','$news_status')";
        if (mysqli_query($conn, $sql)) {

            $sqlnews = "Select Max(news_id) as MaxID from tb_news";
            $resultnews = mysqli_query($conn,$sqlnews);
            $rsnews = mysqli_fetch_assoc($resultnews);
            $news_id = $rsnews['MaxID'];

            // เช็คว่ามีรูปมาด้วย
            if($_FILES['news_img']['name'][0]!="") {
               $imgCount = count($_FILES['news_img']['name']);
               for($i=0;$i<$imgCount;$i++){
                    $img_name = $_FILES['news_img']['name'][$i];
                    $img_size = $_FILES['news_img']['size'][$i];
                    $img_tmp = $_FILES['news_img']['tmp_name'][$i];
 
                   if($img_name != ""){
                    
                        // สร้าง imgn_id ใหม่
                        $sql="Select Max(imgn_id)+1 as MaxID from tb_news_img";
                        $result=mysqli_query($conn,$sql);
                        $rs=mysqli_fetch_array($result);
                        $new_id=$rs['MaxID'];
                            if($new_id==''){ 
                                $imgn_id="IN001";
                            }else{
                                $imgn_id="IN".sprintf("%03d",$new_id);
                            }
                        
                        $allow = array('jpg', 'jpeg', 'png','gif');
                        $extension = explode('.', $img_name);
                        $fileActExt = strtolower(end($extension));                        
                        $fileNew = $imgn_id . "." . $fileActExt;  // rand function create the rand number 
                        $filePath = 'img/news/'.$fileNew;
 
                       if (in_array($fileActExt, $allow)) {                    
                           if ($img_size > 0 && $img_size < 1000000) {
                               if(move_uploaded_file($img_tmp,$filePath)){                                   
 
                                   // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                                   $sql = "REPLACE INTO tb_news_img VALUES('','$fileNew','$news_id')";
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
        $news_id = $_POST['news_id'];
        $news_title = $_POST['news_title'];
        $news_detail = $_POST['news_detail'];
        $news_post = $_POST['news_post'];
        $adm_id = $_POST['adm_id'];
        $news_status = $_POST['news_status'];
        
        $sql = "REPLACE INTO tb_news VALUES('$news_id','$news_title','$news_detail','$news_post','$adm_id','$news_status')";
        
        if (mysqli_query($conn, $sql)) {
            // เช็คว่ามีรูปมาด้วย
            if($_FILES['news_img']['name'][0]!="") {
               $imgCount = count($_FILES['news_img']['name']);
               for($i=0;$i<$imgCount;$i++){
                    $img_name = $_FILES['news_img']['name'][$i];
                    $img_size = $_FILES['news_img']['size'][$i];
                    $img_tmp = $_FILES['news_img']['tmp_name'][$i];

                   if($img_name != ""){
                    
                        // สร้าง imgn_id ใหม่
                        $sql="Select Max(imgn_id)+1 as MaxID from tb_news_img";
                        $result=mysqli_query($conn,$sql);
                        $rs=mysqli_fetch_array($result);
                        $new_id=$rs['MaxID'];
                            if($new_id==''){ 
                                $imgn_id="IN001";
                            }else{
                                $imgn_id="IN".sprintf("%03d",$new_id);
                            }
                        
                        $allow = array('jpg', 'jpeg', 'png','gif');
                        $extension = explode('.', $img_name);
                        $fileActExt = strtolower(end($extension));                        
                        $fileNew = $imgn_id . "." . $fileActExt;  // rand function create the rand number 
                        $filePath = 'img/news/'.$fileNew;

                       if (in_array($fileActExt, $allow)) {                    
                           if ($img_size > 0 && $img_size < 1000000) {
                               if(move_uploaded_file($img_tmp,$filePath)){                                   

                                   // ทำการบันทึกข้อมูลรูปภาพลงฐานข้อมูล
                                   $sql = "REPLACE INTO tb_news_img VALUES('','$fileNew','$news_id')";
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
        $news_id = $_POST['news_id'];

        // ลบรูปเครื่องดนตรี
        $sql="SELECT * FROM tb_news_img WHERE news_id='$news_id'";
        $result = $conn->query($sql); 
        if ($result->num_rows !== 0){
            while($row=$result->fetch_assoc()){
                $imgn_name=$row['imgn_name'];
                $Path = "img/news/".$imgn_name;
                unlink($Path);     
            }
        }        
        // ลบตารางรูปเครื่องดนตรี
        $sqldelimg="DELETE FROM tb_news_img WHERE news_id='$news_id';";
        mysqli_query($conn, $sqldelimg);

        // ลบตารางเครื่องดนตรี
        $sqldel="DELETE FROM tb_news WHERE news_id='$news_id';";
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
    $imgn_id = $_POST['imgn_id'];

    // ลบรูปเครื่องดนตรี
    $sql="SELECT * FROM tb_news_img WHERE imgn_id='$imgn_id'";
    $result = $conn->query($sql); 
    if ($result->num_rows !== 0){
        while($row=$result->fetch_assoc()){
            $imgn_name=$row['imgn_name'];
            $Path = "img/news/".$imgn_name;
            unlink($Path);     
        }
    }        
    // ลบตารางรูปเครื่องดนตรี
    $sqldelimg="DELETE FROM tb_news_img WHERE imgn_id='$imgn_id';";
    
    if (mysqli_query($conn, $sqldelimg)) {
        echo json_encode(array("status"=>"success", "msg"=>"ทำการลบรูปภาพเรียบร้อยแล้ว"));
    } 
    else {
        echo json_encode(array("status"=>"error", "msg"=>"ไม่สามารถลบรูปภาพ !!!"));
    }
}

mysqli_close($conn);

?>