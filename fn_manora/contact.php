<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>มโนราห์ประศิลป์ ดาวรุ่ง</title>

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
        <?php include_once "header.php"; ?>
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
                <img src="img/carousel/p1.jpg" class="d-block w-100 c-img" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item c-item" data-bs-interval="8000">
                <img src="img/carousel/p3.jpg" class="d-block w-100 c-img" alt="...">
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
    <div class="container">
        <!-- หัวข้อ -->
        <div class="m-auto mb-4 p-3 text-center h3 text-bg-primary border border-3 border-top-0 border-primary-subtle rounded-bottom-5">
            ติดต่อ มโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง
        </div>

        <!-- รายละเอียด -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-3">
            <!-- Contact 1 -->
            <div class="col wow fadeIn" data-wow-delay="0.1s">
                <div class="team-item bg-white text-center rounded p-4 pt-0">
                    <img class="img-fluid rounded-circle p-4" src="img/pagrop.jpg" width="200" alt="">
                    <h5 class="mb-0">ประกอบ เดชรักษา</h5>
                    <small>เบอร์โทร : 0878957690 (ครูสิทธิ์)</small>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-square btn-primary m-1" href="https://www.facebook.com/profile.php?id=100010092129346" target="_blank"><i
                                class="fab fa-facebook-f"></i> ประกอบ เดชรักษา </a>
                    </div>
                </div>
            </div>

            <!-- Contact 2 -->
            <div class="col wow fadeIn" data-wow-delay="0.5s">
                <div class="team-item bg-white text-center rounded p-4 pt-0">
                    <img class="img-fluid rounded-circle p-4" src="img/contact2.jpg" width="200" alt="">
                    <h5 class="mb-0">อุดมลักษณ์ เดชรักษา</h5>
                    <small>เบอร์โทร : 0829299359 (พี่จอย)</small>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-square btn-primary m-1" href="https://www.facebook.com/profile.php?id=100003571798715" target="_blank"><i
                                class="fab fa-facebook-f"></i> อุดมลักษณ์ เดชรักษา </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ที่อยู่ -->
        <div class="row row-cols-1 row-cols-md-2 bg-white text-center rounded p-4 m-0 d-flex justify-content-center align-items-center">
            <div class="col my-5 text-center">
                <h2 class="">มโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง</h2>
                <p class="fs-5">55 หมู่2 ต.นาไม้ไผ่ <br> อ.ทุ่งสง จ.นครศรีธรรมราช</p>
            </div>
        </div>
    </div>
    <!---------- Main Content End ---------->

    <!---------- footer ---------->
    <footer class="mt-3">
        <?php include_once "footer.php"; ?>
    </footer>
    <!---------- footer End ---------->

    <!-- JavaScript Libraries -->
    <script src="js/bootstrap.bundle.js"></script>

</body>

</html>