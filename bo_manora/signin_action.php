<?php
        session_start();
        include_once "conn/strconn.php";
        unset($_SESSION['success']);

        if (isset($_POST['login_adm'])){

            $username = $conn->real_escape_string($_POST['username']);
            $password = $conn->real_escape_string($_POST['password']);

            if (empty($username)){
                $_SESSION['success']="ยังไม่ได้ใส่ Username กรุณาใส่ Username ด้วย";
                echo $_SESSION['success'];
                header('location: index.php'); 
                exit();          
            }

            if (empty($password)){
                $_SESSION['success']="ยังไม่ได้ใส่ password กรุณาใส่ password ด้วย";
                echo $_SESSION['success'];
                header('location: index.php');  
                exit();
            }

            // if($username=="master" && $password=="manora123"){
            //     $_SESSION['adm_id']= "AM001";
            //     header("location: index.php");

            // }
        
            $sqladm = "select * from tb_admin where adm_username='$username' and adm_status<>'0'";
            $resultadm = $conn->query($sqladm);
    
                if ($resultadm->num_rows==1){

                    $row=$resultadm->fetch_assoc();
                    $adm_pwd=$row['adm_pwd'];

                    if (password_verify($password, $adm_pwd)) {
                        
                        $_SESSION['adm_id']=$row['adm_id'];
                        header("location: index.php");

                    } else {                        
                        $_SESSION['success']="รหัสผ่านไม่ถูกต้องกรุณา login ใหม่อีกครั้ง !!!";
                        header('location: index.php');
                    }    
                }else{
                    $_SESSION['success']="ไม่มีชื่อผู้ใช้นี้อยู่กรุณา login ใหม่อีกครั้ง !!!";
                    header('location: index.php');
                }  
        }




?>