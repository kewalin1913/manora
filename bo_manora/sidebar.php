        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <!-- logo -->
                <a href="index.php" class="bg-primary ms-3 mb-3 px-4 py-1 border border-3 d-flex justifile-content-center  " style="width: 100%;border-radius:10px;">
                    
                        <img src="img/icon/logo-manora1.png" alt="" height="60">
                        <div class="ms-3">
                            <h2 class="text-size-1 text-light mb-0">มโนราห์</h2>
                            <span class="text-light fs-6 text-primary">ประศิลป์ ดาวรุ่ง</span>
                        </div>
                  
                </a>
                <!-- end logo -->

                <!-- Admin -->
                <!-- <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/adm/<?php echo $row['adm_img'];?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $row['adm_name'];?></h6>
                        <span><?php echo $row['adm_lname'];?></span>
                    </div>
                </div> -->
                <!-- end Admin -->

                <!-- Menu -->
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>หน้าแรก</a>
                    <?php if($row['adm_status']=='2'){ ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i> ข้อมูลหลัก</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="admin.php" class="dropdown-item"><i class="fa-solid fa-user ms-4 me-2"></i> ผู้ดูแลระบบ</a>
                            <!-- <a href="initial.php" class="dropdown-item"><i class="fa-solid fa-user-tag ms-4 me-2"></i> คำนำหน้าชื่อ</a>
                            <a href="news_type.php" class="dropdown-item "><i class="fa-solid fa-file-invoice ms-4 me-2"></i> ประเภทข่าวสาร</a>                             -->
                        </div>
                    </div>
                    <?php }?>
                    <a href="poetry.php" class="nav-item nav-link"><i class="fa-solid fa-file-signature me-2"></i> บทกลอน</a>
                    <a href="musical.php" class="nav-item nav-link"><i class="fa-solid fa-drum me-2"></i> เครื่องดนตรี</a>
                    <a href="cloting.php" class="nav-item nav-link"><i class="fa-solid fa-shirt me-2"></i> เครื่องแต่งกาย</a>
                    <a href="dance.php" class="nav-item nav-link"><i class="fa-solid fa-person-falling me-2"></i> ท่ารำ</a>
                    <a href="news.php" class="nav-item nav-link"><i class="fa-regular fa-newspaper me-2"></i> ข่าวสาร</a>                    
                    <a href="logout.php" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket me-2"></i> ออกจากระบบ</a>
                    </div>
                </div>
                <!-- end Menu -->
            </nav>
        </div>