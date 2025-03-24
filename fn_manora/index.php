<?php
    include "conn/strconn.php";
    $tb = "tb_poetry";
    $sql = "SELECT * FROM $tb";

    if(isset($_GET['strSearch'])){
        $strSearch=$_GET['strSearch'];
        $txtSearch = $_GET['txtSearch'];

        if($strSearch == "Y"){
            $sql.= " WHERE poe_name LIKE '%".$txtSearch."%'";
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
                    <h5>การเข้าโรงครู</h5>
                    <p>ต.หนองหงส์ อ.ทุ่งสง จ.นครศรีธรรมราช</p>
                </div>
            </div>
            <div class="carousel-item c-item" data-bs-interval="8000">
                <img src="img/carousel/p3.jpg" class="d-block w-100 c-img" alt="..." >
                <div class="carousel-caption d-none d-md-block">
                    <h5>รำโบราณให้ทานไฟ</h5>
                    <p>(วัดวังขรี) ต.นาไม้ไผ่ อ.ทุ่งสง จ.นครศรีธรรมราช</p>
                </div>
            </div>
            <div class="carousel-item c-item" data-bs-interval="8000">
                <img src="img/carousel/p4.jpg" class="d-block w-100 c-img" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>รำโบราณให้ทานไฟ</h5>
                    <p>ต.นาไม้ไผ่ อ.ทุ่งสง จ.นครศรีธรรมราช</p>
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
            <div class="m-auto mb-4 p-3 text-center h3 text-bg-primary border border-3 border-top-0 border-primary-subtle rounded-bottom-5">
                ประวัติความเป็นมา มโนราห์
            </div>

            <!-- ประวัติ -->
            <div class="clearfix m-auto px-4">
                <img src="img/history.jpg" class="col-md-6 float-md-end mb-3 ms-md-3 rounded" style="width: 50%;">
                <p>
                    โนรา (Nohra) หรือ มโนราห์ (Manohra) ศิลปะการละเล่นอีกอย่างหนึ่งของชาวปักษ์ใต้ ซึ่งมีมาแต่โบราณและเป็นที่รู้จักกันแพร่หลาย 
                    มโนราห์เป็นการเล่นที่นิยมกันมากทั่วภาคใต้ไม่ว่างานเทศกาล นักขัตฤกษ์หรืองานมงคลต่าง ๆ ก็มักจะมีมโนราห์มาแสดงด้วยเสมอ 
                    มโนราห์เป็นศิลปะการแสดงที่ถ่ายทอดทั้งเพื่อความบันเทิง และการรำในพิธีกรรม คุณค่าของมโนราห์ นอกจากเครื่องแต่งกายที่มีความเป็นเอกลักษณ์ 
                    และมนต์เสน่ห์แห่งท่ารำ สีสันของชุด รวมกันเป็นวัฒนธรรมที่ ล้ำค่า และงดงาม จากคุณค่าของวัฒนธรรม ที่เคยขึ้นชื่อว่า “อมตะโนรา” 
                    ในอดีตที่สร้างความผูกพันไว้ระหว่างความสัมพันธ์ของมนุษย์ด้วยกัน มนุษย์กับธรรมชาติแวดล้อม มนุษย์กับสิ่งเหนือธรรมชาติ 
                    โดยผ่านกระบวนการด้วยท่ารำและบทกลอนที่สัมผัสด้วยความไพเราะผสมผสานกับภาษาพื้นเมืองปักษ์ใต้ที่มีเสน่ห์ ถูกนำมาถ่ายทอด 
                    ให้สอดคล้องกับดนตรีอย่างกลองทับที่ฟังแล้วฮึกเหิมชวนให้สนุก ตลอดจนการเล่าเนื้อเรื่องจากจารีตประเพณี วิถีชีวิต การทำมาหากิน และพิธีกรรมต่าง ๆ 
                </p>

                <p>
                      คณะมโนราห์กัน หรือ นายกัน เดชรักษา ผู้เป็นบิดาของ นายประกอบ(หรือประสิทธิ์) เดชรักษา ได้ฝึกหัดการร่ายรำมโนราห์ตั้งแต่อายุ 10 ขวบ ฝึกร่ายรำพื้นฐาน 
                      ซึ่งแฝงด้วยความเชื่อ พิธีการ และรูปแบบเฉพาะของท่านั้นๆ เมื่อมีความชำนาญในการร่ายรำ เวลาต่อมาบิดาได้ถึงแก่กรรม จึงได้สืบทอดคณะมโนราห์ต่อจากบิดาจนถึงปัจจุบัน 
                      เปลี่ยนชื่อเป็นคณะประสิทธิ์ศิลป์ ดาวรุ่ง และได้ฝึกสอนลูกศิษย์จำนวนมาก ทั้งโรงเรียนประถมศึกษา และระดับมัธยมศึกษา เช่น โรงเรียนเทศบาลบ้านนาเหนือ โรงเรียนวัดก้างปลา 
                      โรงเรียนทุ่งสง โรงเรียนสตรีทุ่งสง โรงเรียนทุ่งสงวิทยา โรงเรียนบางขัน หรือกลุ่มครูที่สนใจ ของศูนย์การศึกษานอกระบบและการศึกษาตามอัธยาศัย คณะมโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง 
                      นายประกอบ(หรือประสิทธิ์) เดชรักษา เป็นครูภูมิปัญญา ด้านศิลปกรรม(การแสดงพื้นบ้าน มโนราห์) เป็นผู้มีความรู้ ความสามารถในรำมโนราห์ เช่นรำแก้เหมรฺย การรำโรงครู การรำเหยียบเสน 
                      การด้นกลอน(การขับร้องสดตามสถานการณ์) จนกระทั่งในปี 2554 นายประกอบ(หรือประสิทธิ์) เดชรักษา ได้รับการคัดเลือกเป็นครูภูมิปัญญาไทย รุ่นที่ 7 ด้านศิลปกรรม(การแสดงพื้นบ้าน มโนราห์) 
                      จากสำนักงานเลขาธิการสภาการศึกษา กระทรวงศึกษาธิการ จนถึงปัจจุบันได้มีชื่อเสียงโด่งดัง จึงทำให้เกิดปัญหาการประชาสัมพันธ์ของคณะมโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง ไม่ได้มีช่องทางที่เป็นช่องทางหลัก 
                      ในการเผยแพร่ความรู้ที่เกี่ยวกับมโนราห์ได้ไม่เต็มที่เท่าที่ บางครั้งการเข้าหาข้อมูลที่เกี่ยวกับมโนราห์ยังมีไม่ครบถ้วน จึงได้นำปัญหานี้มาทำเป็นเว็บไซต์ให้แก่คณะมโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง 
                      เพื่อเเก้ปัญหาที่กล่าวมาข้างต้น จากการสืบทอดมรดกทางวัฒนธรรมมาอย่างยาวนาน ทำให้มโนราห์ในปัจจุบันและอดีตมีความเปลี่ยนแปลงไปบ้างตามกาลเวลา แต่ยังคงความสวยงามและถูกสืบทอดจากรุ่นสู่รุ่น 
                      สิ่งสำคัญที่ทำให้เกิดความแตกต่างจากอดีต คือ ระยะเวลาโอกาส องค์ความรู้ที่เกิดขึ้น และการเรียนรู้ จากสื่อต่าง ๆ ทำให้มีการปรับเปลี่ยนไปบ้าง แต่ในปัจจุบัน มีสื่อ ตัวอย่าง 
                      มีอะไรหลายอย่างที่ทำให้ทุกคนเข้าถึงมโนราห์ได้ง่ายขึ้น ถือเป็นการเผยแพร่วัฒนธรรมมโนราห์ได้อีกรูปแบบหนึ่ง
                </p>
                <p>
                      จากปัญหาการเผยแพร่ประชาสัมพันธ์หรือการส่งเสริมการเรียนรู้ จึงนำปัญหามาวิเคราะห์แก้ปัญหาโดย ผู้วิจัยจึงมีแนวคิดในการนำเทคโนโลยีเว็บไซต์ มาช่วยในการเผยแพร่ความรู้ความเข้าใจเกี่ยวกับวัฒนธรรมมโนราห์ 
                      โดยสร้างเว็บไซต์มโนราห์ เพื่อให้ความรู้เกี่ยวกับประวัติความเป็นมาของมโนราห์ บทกลอนของมโนราห์ ท่ารำ เครื่องแต่งกาย เครื่องดนตรี ฯลฯ การนำเสนอเนื้อหา ด้วยภาพและวีดีโอ เป็นการสืบสานวัฒนธรรม 
                      ศิลปะที่ถูกสร้างสะสมจนกลายเป็นวัฒนธรรมที่ทรงคุณค่า ให้คนรุ่นใหม่มีความรักและศรัทธาในสมบัติที่บรรพบุรุษเชิดชูให้คงอยู่เป็นศิลปวัฒนธรรมประจำภาคใต้ต่อไป
                </p>
            </div>

            <!-- ข่าวประชาสัมพันธ์ -->
            <div class="m-auto">
                <div class="text-bg-primary p-2 rounded text-center mb-3"><h4>ข่าวประชาสัมพันธ์</h4></div>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <?php
                        $sql="SELECT * FROM tb_news LIMIT 0,4";
                        $result=$conn->query($sql);
                        while($row=$result->fetch_assoc()){
                    ?>
                    <a href="news_show.php?news_id=<?= $row['news_id']; ?>" class="text-decoration-none">
                        <div class="col">
                            <div class="card h-100">
                            <?php
                                $sqlimg="SELECT * FROM tb_news_img WHERE news_id='".$row['news_id']."'";
                                $resultimg=$conn->query($sqlimg);
                                $rowimg=$resultimg->fetch_assoc()
                            ?>
                                <img src="../bo_manora/img/news/<?=$rowimg['imgn_name'];?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title"><?=$row['news_title'];?></h6>
                            </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>

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