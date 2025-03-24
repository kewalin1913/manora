<?php
    include_once "chk_login.php";
    include_once "conn/strconn.php";

    $adm_id=$_SESSION['adm_id'];

    $sqladm="select * from tb_admin where adm_id='$adm_id'";
    $resultadm = $conn->query($sqladm);
    $row=$resultadm->fetch_assoc();   
    
    $tb = "tb_cloting";
    $sql = "SELECT * FROM $tb";

    if(isset($_GET['strSearch'])){
        $strSearch=$_GET['strSearch'];
        $txtSearch = $_GET['txtSearch'];

        if($strSearch == "Y"){
            $sql.= " WHERE clo_name LIKE '%".$txtSearch."%'";
        }
    }else{
        $strSearch = "";
        $txtSearch = "";
    }

    include_once "lib/pagination/pagination.php";

    $sql.=" LIMIT $start,$rows_per_page"; 
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
            //+++++ ปุ่มเพิ่ม +++++
            $(".add-sub").click(function() {  //คลิกปุ่ม "เพิ่มผู้จัดส่งสินค้า"
                $('#frm-modal')[0].reset();
                $('#title-modal').text('เพิ่มเครื่องแต่งกาย');
                $('clo_name').focus();
                $('#action').val('add');                   
            });

            //+++++ ปุ่มบันทึก +++++
            $("#frm-modal").submit(function(e){
                if (frm.clo_name.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ ชื่อเครื่องแต่งกาย",
                        icon: "question"
                    });                    
                    return false;			
                }

                if (frm.clo_detail.value == ''){
                    Swal.fire({
                        title: "ผิดพลาด?",
                        text: "ยังไม่ได้ใส่ รายละเอียดเครื่องแต่งกาย",
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
                    url : "cloting_action.php",
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
                                window.location.href="cloting.php";
                            });
                        }else{
                            console.log("Error", result)
                            swal.fire("ล้มเหลว", result.msg, result.status);
                        }
                    }
                });
            });

            //+++++ ปุ่มลบ +++++
            $(".del-sub").click(function(e){
                e.preventDefault();
                var id = $(this).attr('data-id');   
                DelConfirm({'action': 'del', 'clo_id': id});    
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
                            url : "cloting_action.php",
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
                                <h4 class="mx-3">เครื่องแต่งกาย</h4>
                                <!-- search -->
                                                             
                                <form class="frm-search" action="" method="get">                                 
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="strSearch" value="Y">
                                        <input type="text" name="txtSearch" class="form-control" value="<?php echo $txtSearch;?>" placeholder="" aria-label="Button" aria-describedby=""/>
                                        <button class="btn btn-outline-secondary" type="submit" id="">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div> 
                                 </form> 
                                <!-- end search -->
                                <div class="flex-grow-1"></div>
                                <button type="button" id="add-sub" class="add-sub btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#userModal" data-bs-whatever="@mdo"><i class="fa-solid fa-plus"></i> เพิ่มเครื่องแต่งกาย</button>
                            </div>
                            <!-- end header table -->
                            
                            <div class="table-responsive" >
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-1">#</th>
                                            <th class="col-2">ชื่อเครื่องแต่งกาย</th>
                                            <th class="col" >รายละเอียดเครื่องแต่งกาย</th>
                                            <th class="col-2">รูปเครื่องแต่งกาย</th>
                                            <th class="col">คำสั่ง</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = $start + 1;
                                            $resultadm = $conn->query($sql);  
                                            if ($resultadm->num_rows == 0){
                                                echo "<p><td colspan='4' class='text-center'>No data available</td></p>";
                                            }else{
                                                while($row=$resultadm->fetch_assoc()){
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i;?></th>
                                            <td><?php echo $row['clo_name'];?></td>                                            
                                            <td><?php echo substr($row['clo_detail'],0,500);?></td> 
                                            <?php
                                                $clo_id=$row['clo_id'];
                                                $sqlimg="SELECT * FROM tb_cloting_img WHERE clo_id ='$clo_id'";
                                                $resultimg=$conn->query($sqlimg);
                                                $img=$resultimg->fetch_assoc();                                                
                                            ?>
                                            <td><img class="rounded" src="img/cloting/<?php echo $img['imgc_name'];?>" style="height:80px;" alt=""></td> 
                                            
                                            <td>
                                                <a href="cloting_edit.php?clo_id=<?=$row["clo_id"];?>"><botton class="edit-sub btn btn-square btn-outline-secondary m-0"><i class="far fa-edit"></i></botton></a>
                                                <botton class="del-sub btn btn-square btn-outline-danger m-0" id="del-sub" data-id="<?=$row["clo_id"];?>"><i class="far fa-trash-alt"></i></botton>
                                            </td>
                                        </tr>
                                        <?php $i++; }}?>
                                    </tbody>
                                </table>
                            </div>                            
                            <div>
                                <div class="d-flex me-2" >
                                    <?php include_once "lib/pagination/pagination-btn.php"; ?>
                                </div>                                
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
                    
                        <div class="modal-body">
                            <form enctype="multipart/form-data" id="frm-modal" name="frm">
                                <!-- Data Detail -->
                                 <input type="hidden" name="action" id="action" class="action">
                                 <input type="hidden" name="clo_id" id="clo_id" class="clo_id">
                                <div class="form-floating mb-3">
                                    <input type="text" name="clo_name" class="clo_name form-control" id="floatingInput" placeholder="">
                                    <label for="floatingInput">ชื่อเครื่องแต่งกาย</label>
                                </div>   
                                
                                <div class="form-floating mb-3">
                                    <textarea name="clo_detail" class="clo_detail form-control" style="height: 200px;" id="floatingTextarea" placeholder=""></textarea>
                                    <label for="floatingTextarea">รายละเอียด</label>
                                </div>  

                                <div class="form-floating mb-3">
                                    <?php
                                        $img_mus="";
                                    ?>
                                </div>  

                                <div class="mb-3 text-end">
                                    เพิ่มรูป : <button type="button" class="Add-InputFile btn btn-primary" id="Add-InputFile"><i class="fa-solid fa-plus"></i></button>
                                </div>                              
  
                                <!-- Data Image -->
                                <div class="NewInput mb-3 border" id="NewInput">
                                    <div class="mb-1 text-center d-flex justifile-center align-items-center">
                                        <input type="file" class="form-control my-2" id="formFileMultiple" name="clo_img[]" style="width: 75%;">
                                        <img src="" class="img_adm mx-3" loading="lazy" width="50px" id="previewImg" alt="">
                                        <!-- <button type="button" class="Del-InputFile btn btn-danger" id="Del-InputFile"><i class="fa-solid fa-xmark"></i></button> -->
                                    </div>
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
                '<input type="file" class="form-control my-1" id="imgInput" name="clo_img[]" style="width: 75%;">'+
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