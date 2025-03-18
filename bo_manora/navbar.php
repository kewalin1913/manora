            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0" style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">

                <!-- Admin Name -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/adm/<?php echo $row['adm_img'];?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $row['adm_name'] . "  " . $row['adm_lname'];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="myprofile.php" class="dropdown-item">ข้อมูลของฉัน</a>
                            <a href="resetpwd.php" class="dropdown-item">เปลี่ยนรหัสผ่าน</a>
                            <a href="logout.php" class="dropdown-item">ออกจากระบบ</a>
                        </div>
                    </div>
                    <!-- end Admin Name -->
                </div>
            </nav>