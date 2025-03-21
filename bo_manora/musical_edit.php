<?php
    include_once "chk_login.php";
    include_once "conn/strconn.php";

    $adm_id=$_SESSION['adm_id'];

    $sqladm="select * from tb_admin where adm_id='$adm_id'";
    $resultadm = $conn->query($sqladm);
    $row=$resultadm->fetch_assoc();  

    if(!isset($_GET)){
        exit();
    }
    
    $mus_id=$_GET['mus_id'];
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
        $(document).ready(function(){
            //+++++ ปุ่มบันทึก +++++
            $("#frm-modal").submit(function(e){
                if (frm.mus_name.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ ชื่อเครื่องดนตรี",
                        icon: "question"
                    });                    
                    return false;			
                }

                if (frm.mus_detail.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ รายละเอียดเครื่องดนตรี",
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
                    url : "musical_action.php",
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
                                window.location.href="musical.php";
                            });
                        }else{
                            console.log("Error", result)
                            swal.fire("ล้มเหลว", result.msg, result.status);
                        }
                    }
                });
            });

            //+++++ ปุ่มลบ +++++
            $(".delImg-sub").click(function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');   
                DelConfirm({'action': 'delImg', 'imgm_id': id});    
            })

        })

        function DelConfirm(dataJSON){
            Swal.fire({
                title: "คูณแน่ใจ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                showLoaderOnConfirm: true,
                preConfirm:function(){
                    return new Promise(function(){
                        $.ajax({
                            url : "musical_action.php",
                            type : "post",
                            data : dataJSON,   
                            success: function(data){
                                let result = JSON.parse(data);
                                if (result.status == "success"){
                                    console.log("Success", result)
                                    swal.fire({
                                        title :"สำเร็จ",
                                        text : result.msg,
                                        icon : result.status,
                                        timer : 3000
                                    }).then(function(){
                                        location.reload();
                                    });
                                }else{
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
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <!-- header table -->
                            <div class="search d-flex align-items-center">
                                <h4 class="mx-3">แก่ไขข้อมูลเครื่องดนตรี</h4> 
                            </div>

                            <!-- form edit -->
                            <div class="">
                                <?php
                                    $sql="SELECT * FROM tb_musical WHERE mus_id='$mus_id'";
                                    $result=$conn->query($sql);
                                    $row=$result->fetch_assoc();
                                ?>
                                <form  enctype="multipart/form-data" id="frm-modal" name="frm">
                                    <!-- Data Detail -->
                                    <input type="hidden" name="action" id="action" class="action" value="edit">
                                    <input type="hidden" name="mus_id" id="mus_id" class="mus_id" value="<?php echo $row['mus_id'];?>">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="mus_name" class="mus_name form-control" id="floatingInput" placeholder="" value="<?php echo $row['mus_name'];?>">
                                        <label for="floatingInput">ชื่อเครื่องดนตรี</label>
                                    </div>   
                                    
                                    <div class="form-floating mb-3">
                                        <textarea name="mus_detail" class="mus_detail form-control" style="height: 200px;" id="floatingTextarea" placeholder=""><?php echo $row['mus_detail'];?></textarea>
                                        <label for="floatingTextarea">รายละเอียด</label>
                                    </div>  

                                    <div class="form-floating d-flex mb-3">
                                        <?php
                                            $sqlimg="SELECT * FROM tb_musical_img WHERE mus_id='$mus_id'";
                                            $resultimg=$conn->query($sqlimg);
                                            while($row=$resultimg->fetch_assoc()){
                                        ?>
                                        <div class="position-relative m-3">                                            
                                            <img class="rounded" src="img/musical/<?php echo $row['imgm_name'];?>" style="height: 100px; width:100px;">  
                                            <a href="" class="delImg-sub" id="delImg-sub" data-id="<?=$row["imgm_id"];?>"><i class="fa-solid fa-circle-xmark fs-4 position-absolute top-0 start-100 translate-middle"></i></a>
                                            
                                        </div>
                                        <?php }?>
                                    </div>  

                                    <div class="mb-3 text-end">
                                        เพิ่มรูป : <button type="button" class="Add-InputFile btn btn-primary" id="Add-InputFile"><i class="fa-solid fa-plus"></i></button>
                                    </div>                              
    
                                    <!-- Data Image -->
                                    <div class="NewInput mb-3 border" id="NewInput">
                                        <div class="mb-1 text-center d-flex justifile-center align-items-center">
                                            <input type="file" class="form-control my-2" id="formFileMultiple" name="mus_img[]" style="width: 75%;">
                                            <img src="" class="img_adm mx-3" loading="lazy" width="50px" id="previewImg" alt="">
                                            <!-- <button type="button" class="Del-InputFile btn btn-danger" id="Del-InputFile"><i class="fa-solid fa-xmark"></i></button> -->
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div class="modal-footer">
                                        <a href="musical.php"><button type="button" class="btn btn-secondary">ยกเลิก</button></a>
                                        <button type="submit" name="submit" class="btn btn-success">ตกลง</button>
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Modal -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="title-modal" class="modal-title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                  
                    </div>
                </div>
            </div>
            <!-- end Modal -->

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
    <!-- show -->
    <script>
        let imgInput = document.getElementById('imgInput[]');
        let previewImg = document.getElementById('previewImg[]');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>

    <!-- Add Input File -->
     <script type="text/javascript">
        
        $('#Add-InputFile').click(function(){
            NewRowAdd=          
                '<div class="mb-1 text-center d-flex justifile-center align-items-center" id="row">'+
                '<input type="file" class="form-control my-1" id="imgInput" name="mus_img[]" style="width: 75%;">'+
                '<img src="" class="img_adm mx-3" loading="lazy" width="50px" id="previewImg" alt="">'+
                '<button type="button" class="Del-InputFile btn btn-danger" id="Del-InputFile"><i class="fa-solid fa-xmark"></i></button>'+
                '</div>';
            $('#NewInput').append(NewRowAdd);         
        })
        
        $("body").on('click','#Del-InputFile',function(){
            $(this).parents('#row').remove();
        })

        

     </script>

</body>

</html>