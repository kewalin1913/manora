<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>มโนราห์ ประศิลป์ ดาวรุ่ง</title>

    <!-- Favicon -->
    <link href="img/icon/manora-logo.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> -->
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

</head>
<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row vh-100 align-items-center justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="shadow p-3 mb-5 bg-light rounded p-4 p-sm-5 my-4 mx-3">

                        <form action="signin_action.php" method="post">
                            <div class="text-center justify-content-between mb-3">                                                            
                                <img src="img/icon/logo-manora1.png" alt="" width="40" class="mb-3">
                                <h3 class="text-primary"> มโนราห์ ประศิลป์ ดาวรุ่ง</h3>                                
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                                <label for="floatingInput">Username</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="InputPwd form-control" id="floatingInput" placeholder="">
                                <label for="floatingInput">Password</label>
                                <i class="fa-regular fa-eye-slash ShowPwd"></i>
                            </div> 

                            <button type="submit" name="login_adm" value="เข้าสู่ระบบ" class="btn btn-primary py-3 w-100 mb-4">เข้าสู่ระบบ</button>

                        </form>
                        
                        <?php if (isset($_SESSION['success'])){ ?>
                                <div class="msgAleart alert alert-warning text-center" role="alert" >
                                    <?php
                                        echo $_SESSION['success']; 
                                        unset($_SESSION['success']);
                                    ?>
                                </div>
                        <?php } ?>                    
                </div>
            </div>
        </div>
        <!-- Sign In End -->
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

    <!-- show Password -->
    <script>
    const ShowPwd = document.querySelector(".ShowPwd"),
          input = document.querySelector(".InputPwd");
          ShowPwd.addEventListener("click", () =>{             
              if(input.type ==="password"){
                input.type = "text";
                ShowPwd.classList.replace("fa-eye-slash", "fa-eye");
              }else{
                input.type = "password";
                ShowPwd.classList.replace("fa-eye","fa-eye-slash");
              }
          })
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>