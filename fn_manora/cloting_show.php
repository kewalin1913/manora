<?php
    include_once "conn/strconn.php";

    if(isset($_GET['clo_id'])){
        $clo_id=$_GET['clo_id'];
        $tb = "tb_cloting";
        $sql = "SELECT * FROM $tb WHERE clo_id = $clo_id";
        
    }else{
        header('location: cloting.php');
        exit;
    }

    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
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
<body class="bg-light">
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
        <div class="container ">
            <!-- หัวข้อ -->
            <div class="m-auto mb-4 p-3 text-center h3 text-bg-warning border border-3 border-top-0 border-warning-subtle rounded-bottom-5">
                เครื่องแต่งกาย มโนราห์
            </div>

            <!-- รายละเอียด -->
            <div class="row row-cols-1 row-cols-sm-2">
                <div class="col">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                    <?php
                        $sqlimg = "SELECT * FROM tb_cloting_img WHERE clo_id = $clo_id";
                        $resultimg = $conn->query($sqlimg);
     
                        while($rowimg=$resultimg->fetch_assoc()){
                    ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <img src="../bo_manora/img/cloting/<?=$rowimg['imgc_name'];?>" alt="" class="card-img">
                            </div>                            
                        </div>

                    <?php } ?>
                    </div>
                </div>
                <div class="col bg-white rounded-4 shadow-sm">
                    <h1 class="px-2 m-1 border-bottom"><?=$row['clo_name'];?></h1>
                    <p class="px-3"><?=$row['clo_detail'];?></p>
                </div>
            </div> 
        </div>
        <!-- Content End -->
    <!---------- Main Content End ---------->

    <!---------- footer ---------->
        <footer class="mt-3">
            <?php include_once "footer.php";?>
        </footer>
    <!---------- footer End ---------->

    <!-- JavaScript Libraries -->
    <script src="js/bootstrap.bundle.js"></script>
    
</body>
</html>