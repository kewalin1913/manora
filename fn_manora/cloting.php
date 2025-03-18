<?php
    include_once "conn/strconn.php";

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
    // กำหนดหน้า
    $rows_per_page = 12;
    include_once "lib/pagination/pagination.php";
    $sql.=" LIMIT $start,$rows_per_page"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>มโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง</title>

    <!------------ Favicon ------------>
    <link href="img/icon/manora-logo.ico" rel="icon">

    <!------------ Google Web Fonts ------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!---------- Icon font awesome 5.10 ---------->
    <link rel="stylesheet" href="css/all.css">
    
    <!---------- Customized Bootstrap Stylesheet ---------->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!---------- Template Stylesheet ---------->
    <link href="css/styles.css" rel="stylesheet">

    <!---------- jQuery ---------->
    <script src="js/jQuery-3.7.1.js"></script>

</head>
<body>
    <!------------ Navbar Header ------------>
    <nav class="navbar navbar-expand-xl bg-dark bg-gradient" data-bs-theme="dark">
        <?php include_once "header.php";?>
    </nav>
    <!------------ end Navbar Header ------------>
        
    <!------------ Carousel Start ------------>    
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">    
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active c-item" data-bs-interval="10000">
                <img src="img/carousel/p1.jpg" class="d-block w-100 c-img" alt="..." >
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item c-item" data-bs-interval="8000">
                <img src="img/carousel/p3.jpg" class="d-block w-100 c-img" alt="..." >
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item c-item" data-bs-interval="8000">
                <img src="img/carousel/p4.jpg" class="d-block w-100 c-img" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!---------- Carousel End ---------->
    
    <!---------- Main Content ---------->
        <!-- Content Start -->
        <div class="container">
            <!-- หัวข้อ -->
            <div class="m-auto mb-4 p-3 text-center h3 text-bg-warning border border-3 border-top-0 border-warning-subtle rounded-bottom-5">
                เครื่องแต่งกาย มโนราห์
            </div>

            <!-- รายละเอียด -->
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-4 p-4">
                    <?php
                        $result = $conn->query($sql);
                        while($row=$result->fetch_assoc()){                        
                    ?>
                    <div class="col">
                        <div class="card h-100">
                            <?php
                                $clo_id = $row['clo_id'];
                                $sqlimg = "select * from tb_cloting_img where clo_id='$clo_id'";
                                $resultCimg = $conn->query($sqlimg);
                                if ($resultCimg->num_rows == 0){
                            ?>
                                <img src="../bo_manora/img/No_Image_Available.jpg" class="card-img-top">    
                            <?php 
                                }else{ 
                                    $rowImg = $resultCimg->fetch_assoc();                                                         
                            ?>
                                <img src="../bo_manora/img/cloting/<?=$rowImg['imgc_name'];?>" class="card-img-top">
                            <?php }?>
                            <div class="card-body">
                                <h5 class="card-title border border-info border-start-0 border-end-0 p-1 text-center"><?=$row['clo_name'];?></h5>
                                <p class="card-text">
                                    <?php
                                        $clo_detail = $row['clo_detail'];
                                        if(strlen($clo_detail) > 90){
                                            $clo_detail = mb_substr($clo_detail, 0, 90).' ...';
                                        }
                                        echo $clo_detail;
                                    ?>   
                                    <button class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" 
                                    onclick="window.location.href='cloting_show.php?clo_id=<?=$row['clo_id'];?>'">อ่านต่อ</button> 
                                </p>
                            </div>
                        </div>                    
                    </div>   
                    <?php }?> 
                </div>      
            </div>

            <!-- หน้าข้อมูล -->
            <div class="d-flex me-2 justify-content-center" >
                <?php include_once "lib/pagination/pagination-btn.php"; ?>
            </div>   
        </div>
        <!-- Content End -->
    <!---------- Main Content End ---------->

    <!-- Modal Start -->
    <div class="modal fade" id="ModalDetail" tabindex="-1" aria-labelledby="ModalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!---------- footer ---------->
        <footer class="mt-3">
            <?php include_once "footer.php";?>
        </footer>
    <!---------- footer End ---------->

    <!-- JavaScript Libraries -->
    <script src="js/bootstrap.bundle.js"></script>
    
</body>
</html>