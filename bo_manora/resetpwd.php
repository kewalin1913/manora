<?php
    include_once "chk_login.php";
    include_once "conn/strconn.php";

    $adm_id=$_SESSION['adm_id'];

    $sqladm="select * from tb_admin where adm_id='$adm_id'";
    $resultadm = $conn->query($sqladm);
    $row=$resultadm->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>มโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icon/manora-logo.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!------------ Icon font awesome 5.10 ------------>
    <link href="css/fontawesome.css" rel="stylesheet" />
    <link href="css/brands.css" rel="stylesheet" />
    <link href="css/solid.css" rel="stylesheet" />
    <link href="css/regular.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Java Script -->
    <script src="js/jQuery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            //+++++ โชว์ passwrod เก่า +++++
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#ShowPwdOle').removeClass("fa-eye");
                    $('#ShowPwdOle').addClass("fa-eye-slash");                        
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#ShowPwdOle').removeClass("fa-eye-slash");
                    $('#ShowPwdOle').addClass("fa-eye");
                }
            });
            //+++++ โชว์ passwrod ใหม่ +++++
            $("#show_hide_password1 a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password1 input').attr("type") == "text"){
                    $('#show_hide_password1 input').attr('type', 'password');
                    $('#ShowPwdNew').removeClass("fa-eye");
                    $('#ShowPwdNew').addClass("fa-eye-slash");                        
                }else if($('#show_hide_password1 input').attr("type") == "password"){
                    $('#show_hide_password1 input').attr('type', 'text');
                    $('#ShowPwdNew').removeClass("fa-eye-slash");
                    $('#ShowPwdNew').addClass("fa-eye");
                }
            });
            //+++++ โชว์ repasswrod +++++
            $("#show_hide_password2 a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password2 input').attr("type") == "text"){
                    $('#show_hide_password2 input').attr('type', 'password');
                    $('#ShowRePwd').removeClass("fa-eye");
                    $('#ShowRePwd').addClass("fa-eye-slash");                        
                }else if($('#show_hide_password2 input').attr("type") == "password"){
                    $('#show_hide_password2 input').attr('type', 'text');
                    $('#ShowRePwd').removeClass("fa-eye-slash");
                    $('#ShowRePwd').addClass("fa-eye");
                }
            }); 

            //+++++ ปุ่มบันทึก +++++
            $("#frm-resetpwd").submit(function(e){
                if (frm.pwd_ole.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ รหัสผ่านเดิม",
                        icon: "question"
                    });                    
                    return false;			
                }

                if (frm.pwd_new.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ รหัสผ่านใหม่",
                        icon: "question"
                    });                    
                    return false;			
                }

                if (frm.pwd_renew.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ ยืนยันรหัสผ่านใหม่",
                        icon: "question"
                    });                    
                    return false;			
                }
              
                // เอาข้อมูลใน form มาเก็บในตัวแปร
                e.preventDefault();
                // let frmData = $(this).serialize();
                var frmData = new FormData(this);
                
                // ส่งข้อมูลไปทำในไฟล์ Action
                $.ajax({
                    url : "admin_action.php",
                    type: "post",
                    data: frmData,
                    contentType:false,
                    processData:false,                    
                    success: function(data){
                        let result = JSON.parse(data);
                        if (result.status == "success"){
                            console.log("Success", result)
                            swal.fire({
                                title :"สำเร็จ",
                                text : result.msg,
                                icon :result.status,
                                timer : 3000
                            }).then(function(){
                                window.location.href="resetpwd.php";
                            });
                        }else{
                            console.log("Error", result)
                            swal.fire("ล้มเหลว", result.msg, result.status);
                        }
                    }
                });
            });

        })
    </script>

</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->         
            <?php include_once "sidebar.php";?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include_once "navbar.php";?>
            <!-- Navbar End -->

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g2">
                    <div class="col-12 ">
                        <div class="bg-light py-5">
                            <div class="card border col-10 col-md-8 col-lg-6 col-xl-4 col-xxl-3 mx-auto d-block">
                                <form action="" class="" name="frm" id="frm-resetpwd">
                                <div class="card-header">
                                    <h3>เปลี่ยนรหัสผ่าน</h3>
                                </div>
                                <div class="card-body">         
                                    <input type="hidden" name="action" value="resetpwd">   
                                    <input type="hidden" name="adm_id" value="<?=$adm_id?>">                    
                                    <div class="form-floating mb-3" id="show_hide_password">
                                        <input type="password" name="pwd_ole" class="pwd_ole form-control" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">รหัสผ่านเดิม</label>
                                        <a><i class="fa-regular fa-eye-slash" id="ShowPwdOle" style="position: absolute; top:30px; right:20px;"></i></a>
                                    </div>
                                    <div class="form-floating mb-3" id="show_hide_password1">
                                        <input type="password" name="pwd_new" class="pwd_new form-control" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">รหัสผ่านใหม่</label>
                                        <a><i class="fa-regular fa-eye-slash" id="ShowPwdNew" style="position: absolute; top:30px; right:20px;"></i></a>

                                    </div>
                                    <div class="form-floating" id="show_hide_password2">
                                        <input type="password" name="pwd_renew" class="pwd_renew form-control" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">ยืนยันรหัสผ่านใหม่</label>
                                        <a><i class="fa-regular fa-eye-slash" id="ShowRePwd" style="position: absolute; top:30px; right:20px;"></i></a>

                                    </div>                                
                                </div>
                                <div class="card-footer text-end">
                                        <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Footer Start -->
            <?php include_once "footer.php";?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>