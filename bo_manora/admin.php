<?php
include_once "chk_login.php";
include_once "conn/strconn.php";

$adm_id = $_SESSION['adm_id'];

$sqladm = "select * from tb_admin where adm_id='$adm_id'";
$resultadm = $conn->query($sqladm);
$row = $resultadm->fetch_assoc();

$tb = "tb_admin";
$sql = "SELECT * FROM $tb";

if (isset($_GET['strSearch'])) {
    $strSearch = $_GET['strSearch'];
    $txtSearch = $_GET['txtSearch'];

    if ($strSearch == "Y") {
        $sql .= " WHERE adm_name LIKE '%" . $txtSearch . "%'";
    }
} else {
    $strSearch = "";
    $txtSearch = "";
}

include_once "lib/pagination/pagination.php";

$sql .= " LIMIT $start,$rows_per_page";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>มโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง</title>
    <meta content="width=device-width, admial-scale=1.0" name="viewport">
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

    <script src="js/jQuery-3.7.1.js"></script>
    <script src="js/jquery-ui.min.js"> </script>
    <script src="js/jquery.blockUI.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <script>
        $(document).ready(function() {
            //+++++ ปุ่มเพิ่ม +++++
            $(".add-sub").click(function() { //คลิกปุ่ม "เพิ่ม"
                $('#frm-modal')[0].reset();
                $('#title-modal').text('เพิ่มผู้ดูแลระบบ');
                $('.adm_name').focus();
                $('#action').val('add');
                $('.img_adm').attr('src', '');
            });

            //+++++ ปุ่มแก้ไข +++++
            $(".edit-sub").click(function() {
                var tr = $(this).parent().parent();
                var imgadm = $(this).attr('data-img')

                $('#title-modal').text('แก้ไขผู้ดูแลระบบ');
                $('.action').val('edit_all');
                $('.adm_id').val($(this).attr('data-id'));
                $('.adm_name').val(tr.children(':eq(1)').text());
                $('.adm_lname').val(tr.children(':eq(2)').text());
                $('.adm_username').val(tr.children(':eq(3)').text());
                $('.adm_status').val($(this).attr('data-adm_status'));
                $('.img_adm').attr('src', imgadm);

            });

            //+++++ ปุ่มบันทึก +++++
            $("#frm-modal").submit(function(e) {
                if (frm.adm_name.value == '') {
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ ชื่อผู้ดูแลระบบ",
                        icon: "question"
                    });
                    return false;
                }

                if (frm.adm_lname.value == '') {
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ นามสกุลผู้ดูแลระบบ",
                        icon: "question"
                    });
                    return false;
                }

                if (frm.adm_username.value == '') {
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ USERNAME",
                        icon: "question"
                    });
                    return false;
                }

                if (frm.adm_pwd.value == '') {
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ รหัสผ่าน ",
                        icon: "question"
                    });
                    return false;
                }

                if (frm.adm_repwd.value == '') {
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ รหัสผ่านอีกครั้ง",
                        icon: "question"
                    });
                    return false;
                }

                if (frm.adm_pwd.value !== frm.adm_repwd.value) {
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "รหัสผ่านไม่ตรงกัน กรุณาใส่ใหม่อีกครั้ง",
                        icon: "question"
                    });
                    return false;
                }

                if (frm.adm_status.value == '') {
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้เลือกสถานะ !!!",
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
                    url: "admin_action.php",
                    type: "post",
                    data: frmData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        let result = JSON.parse(data);
                        if (result.status == "success") {
                            console.log("Success", result)
                            swal.fire({
                                title: "สำเร็จ",
                                text: result.msg,
                                icon: result.status,
                                timer: 3000
                            }).then(function() {
                                window.location.href = "admin.php";
                            });
                        } else {
                            console.log("Error", result)
                            swal.fire("ล้มเหลว", result.msg, result.status);
                        }
                    }
                });
            });

            //+++++ ปุ่มลบ +++++
            $(".del-sub").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var img = $(this).attr('data-img');

                DelConfirm({
                    'action': 'del',
                    'adm_id': id,
                    'adm_img': img
                });
            })
        })

        function DelConfirm(dataJSON) {
            Swal.fire({
                title: "คูณแน่ใจ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function() {
                        $.ajax({
                            url: "admin_action.php",
                            type: "post",
                            data: dataJSON,
                            success: function(data) {
                                let result = JSON.parse(data);
                                if (result.status == "success") {
                                    console.log("Success", result)
                                    swal.fire({
                                        title: "สำเร็จ",
                                        text: result.msg,
                                        icon: result.status,
                                        timer: 3000
                                    }).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    console.log("Error", result)
                                    swal.fire("ล้มเหลว", result.msg, result.status);
                                }
                            }
                        })

                    })
                }
            })
        }
    </script>

    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->

        <?php include_once "sidebar.php"; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include_once "navbar.php"; ?>
            <!-- Navbar End -->

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g2">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <!-- header table -->
                            <div class="search d-flex align-items-center">
                                <h4 class="mx-3">ผู้ดูแลระบบ</h4>
                                <!-- search -->

                                <form class="frm-search" action="" method="get">
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="strSearch" value="Y">
                                        <input type="text" name="txtSearch" class="form-control" value="<?php echo $txtSearch; ?>" placeholder="" aria-label="Button" aria-describedby="" />
                                        <button class="btn btn-outline-secondary" type="submit" id="">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                                <!-- end search -->
                                <div class="flex-grow-1"></div>
                                <button type="button" id="add-sub" class="add-sub btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo">
                                    <i class="fa-solid fa-plus"></i> เพิ่มผู้ดูแลระบบ
                                </button>
                            </div>
                            <!-- end header table -->

                            <div class="table-responsive-xl">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th scope="col-2">#</th>
                                            <th scope="col-3">ชื่อผู้ดูและระบบ</th>
                                            <th scope="col-3">นามสกุลผู้ดูแลระบบ</th>
                                            <th scope="col-1">ชื่อผู้ใช้</th>
                                            <th scope="col-1">สถานะ</th>
                                            <th scope="col-1">รูปถ่าย</th>
                                            <th scope="col-2">คำสั่ง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $resultadm = $conn->query($sql);
                                        if ($resultadm->num_rows < 0) {
                                            echo "<p><td colspan='5' class='text-center'>No data available</td></p>";
                                        } else {
                                            while ($row = $resultadm->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                <th scope="row"><?php echo 'AM00' . sprintf('%02d', $i); ?></th>
                                                    <td><?php echo $row['adm_name']; ?></td>
                                                    <td><?php echo $row['adm_lname']; ?></td>
                                                    <td><?php echo $row['adm_username']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['adm_status'] == '0') {
                                                            echo "ยกเลิก";
                                                        } else {
                                                            echo "ปกติ";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><img class="admimg rounded-circle" src="img/adm/<?php echo $row['adm_img']; ?>" style="width: 50px; height:50px;" alt=""></td>
                                                    <td>
                                                        <?php if ($row['adm_id'] != "AM001") { ?>
                                                            <botton class="edit-sub btn btn-square btn-outline-secondary m-0" id="edit-sub" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo"
                                                                data-id="<?= $row["adm_id"]; ?>" data-adm_status="<?= $row["adm_status"]; ?>" data-img="img/adm/<?= $row["adm_img"]; ?>">
                                                                <i class="far fa-edit"></i>
                                                            </botton>

                                                            <botton class="del-sub btn btn-square btn-outline-danger m-0" id="del-sub" data-id="<?= $row["adm_id"]; ?>" data-img="<?= $row["adm_img"]; ?>">
                                                                <i class="far fa-trash-alt"></i>
                                                            </botton>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                        <?php } 
                                        } $i++;?>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <div class="d-flex me-2">
                                    <?php include_once "lib/pagination/pagination-btn.php"; ?>
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

                                <!-- ซ่อนช่องที่ไม่จำเป็น -->
                                <style>
                                    #action,
                                    #adm_id {
                                        display: none;
                                    }
                                </style>

                                <!-- ช่องที่ซ่อนไว้ -->
                                <input type="text" name="action" id="action" class="action" >
                                <input type="text" name="adm_id" id="adm_id" class="adm_id" >

                                <div class="form-floating mb-3">
                                    <input type="text" name="adm_name" class="adm_name form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">ชื่อ :</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="adm_lname" class="adm_lname form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">นามสกุล :</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="adm_username" class="adm_username form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">ชื่อผู้ใช้ :</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="adm_pwd" class="adm_pwd InputPwd form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">รหัสผ่าน :</label>
                                    <i class="fa-regular fa-eye-slash ShowPwd"></i>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="adm_repwd" class="adm_repwd InputPwd2 form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">ยื่นยันรหัสผ่าน :</label>
                                    <i class="fa-regular fa-eye-slash ShowPwd2"></i>
                                </div>

                                <!-- สถานะเข้าใช้งานระบบ -->
                                <div class="form-floating mb-3">
                                    <select class="adm_status form-select" id="floatingSelect adm_status" name="adm_status" aria-label="Floating label select example">
                                        <option value="" selected>-- เลือก --</option>
                                        <option value="1">ปกติ</option>
                                        <option value="0">ยกเลิก</option>
                                    </select>
                                    <label for="floatingSelect">สถานะเข้าใช้งานระบบ : </label>
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
            <?php include_once "footer.php"; ?>
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

    <!-- show Password -->
    <script>
        const ShowPwd = document.querySelector(".ShowPwd"),
            input = document.querySelector(".InputPwd");
        ShowPwd.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";
                ShowPwd.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                input.type = "password";
                ShowPwd.classList.replace("fa-eye", "fa-eye-slash");
            }
        })
    </script>
    <script>
        const ShowPwd2 = document.querySelector(".ShowPwd2"),
            input2 = document.querySelector(".InputPwd2");
        ShowPwd2.addEventListener("click", () => {
            if (input2.type === "password") {
                input2.type = "text";
                ShowPwd2.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                input2.type = "password";
                ShowPwd2.classList.replace("fa-eye", "fa-eye-slash");
            }
        })
    </script>
</body>

</html>