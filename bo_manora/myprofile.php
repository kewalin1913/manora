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
            //+++++ ปุ่มแก้ไข +++++
            $(".edit-sub").click(function(){                
                var imgadm = $(this).attr('data-img')

                $('#title-modal').text('แก้ไขผู้ดูแลระบบ');
                $('.action').val('edit'); 
                $('.adm_id').val($(this).attr('data-id'));
                $('.adm_name').val($(this).attr('data-adm_name'));
                $('.adm_lname').val($(this).attr('data-adm_lname'));
                $('.adm_username').val($(this).attr('data-adm_username'));
                $('.adm_status').val($(this).attr('data-adm_status'));
                $('.img_adm').attr('src',imgadm);  
            });

            //+++++ ปุ่มบันทึก +++++
            $("#frm-modal").submit(function(e){
                if (frm.adm_name.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ ชื่อผู้ดูแลระบบ",
                        icon: "question"
                    });                    
                    return false;			
                }

                if (frm.adm_lname.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ นามสกุลผู้ดูแลระบบ",
                        icon: "question"
                    });                    
                    return false;			
                }

                if (frm.adm_username.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ ชื่อผู้ใช้",
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
                                window.location.href="myprofile.php";
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
                            <div class="card border col-10 col-md-8 col-lg-6 mx-auto d-block">
                                <!-- card header -->
                                <div class="card-header d-flex">
                                    <!-- title -->
                                    <div class="title pt-2">
                                        <h4>ข้อมูลส่วนตัว</h4>
                                    </div>                                    

                                    <!-- Edit button -->
                                    <div class="add-btn ms-auto p-2">
                                        <a class="edit-sub btn btn-primary " id="edit-sub" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo"
                                        data-id="<?=$row['adm_id'];?>" data-adm_name="<?=$row['adm_name'];?>" data-adm_lname="<?=$row['adm_lname'];?>" 
                                        data-img="img/adm/<?=$row['adm_img'];?>" data-adm_username="<?=$row['adm_username'];?>" data-adm_status="<?=$row['adm_status'];?>">
                                            <i class="fa-regular fa-pen-to-square"></i> แก้ไข
                                        </a>   
                                    </div>
                                </div>
                                <!-- card body -->
                                <div class="card-body row g-3">      
                                    <div class="col-12 col-md-12">
                                        <img src="img/adm/<?=$row['adm_img'];?>" style="width: 45%;" class="border border-3 border-primary rounded-circle mx-auto d-block shadow mb-3" alt="">

                                    </div>
               
                                    <div class="form-floating col-md-6" id="show_hide_password">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?=$row['adm_name'];?>">
                                        <label for="floatingInput">ชื่อ :</label>                                        
                                    </div>
                                    <div class="form-floating col-md-6" id="show_hide_password1">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?=$row['adm_lname'];?>">
                                        <label for="floatingInput">นามสกุล :</label>   
                                    </div>
                                    <div class="form-floating" id="show_hide_password2">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?=$row['adm_username'];?>">
                                        <label for="floatingInput">ชื่อผู้ใช้ :</label>  
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Modal Add -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="title-modal" class="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                        <div class="modal-body">
                            <form enctype="multipart/form-data" id="frm-modal" name="frm">
                                <!-- Data Detail -->
                                 <input type="hidden" name="action" id="action" class="action">
                                 <input type="hidden" name="adm_id" id="adm_id" class="adm_id">
                                 <input type="hidden" name="adm_status" id="adm_status" class="adm_status">

                                <div class="form-floating mb-3">
                                    <input type="text" name="adm_name" class="adm_name form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">First Name</label>
                                </div>   
                                <div class="form-floating mb-3">
                                    <input type="text" name="adm_lname" class="adm_lname form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">Last Name</label>
                                </div>                                 
                                <div class="form-floating mb-3">
                                    <input type="text" name="adm_username" class="adm_username form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">Username</label>
                                </div> 
 
                                <!-- Data Image -->
                                <div class="mb-3 text-center">
                                    <input type="file" class="form-control mb-3" id="imgInput" name="adm_img">
                                    <img src="" class="img_adm" loading="lazy" width="50%" id="previewImg" alt="">
                                </div>

                                <!-- Button -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" name="submit" class="btn btn-success">ตกลง</button>
                                </div>
                            </form>
                        </div>                    
                    </div>
                </div>
            </div>
            <!-- end Modal Add -->

            <!-- Footer Start -->
            <?php include_once "footer.php";?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- show img-->
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>

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