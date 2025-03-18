<div class="container-fluid">
            <!-- logo brandner -->
            <a class="navbar-brand d-flex" href="#">
                <img src="img/icon/manora-logo.ico" alt="logo" height="50">
                <div class="align-self-center fs-5 fw-bold">มโนราห์ประสิทธิ์ศิลป์ ดาวรุ่ง</div>                 
            </a>

            <!-- ปุ่มเมื่อ respont หน้าจอ -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- เมนู -->
            <div class="collapse navbar-collapse d-xl-flex" id="navbarSupportedContent">
                <ul class="navbar-nav col-xl-9 justify-content-xl-center mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="poetry.php">บทกลอน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cloting.php">เครื่องแต่งกาย</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="musical.php">เครื่องดนตรี</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dance.php">ท่ารำ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="news.php">ข่าวประชาสัมพันธ์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">ติดต่อเรา</a>
                    </li>
                </ul>
                <!-- ค้นหา -->
                <form class="d-flex col-xl-3 justify-conten-xl-end" role="search" method="get" action="">
                    <input type="hidden" name="strSearch" value="Y">
                    <input class="form-control me-2" type="search" placeholder="ค้นหา" aria-label="Search" name="txtSearch" value="<?php echo $txtSearch;?>">
                    <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                </form>
            </div>
        </div>