<div class="btn-toolbar" role="toolbar">
    <div class="btn-group" role="group" aria-label="First group">
                         
 
 <!--++++++++++ First botton ++++++++++-->
    <!-- <a href="?page-nr=1">First</a> -->

<!--++++++++++ Previous botton ++++++++++-->

    <?php
        if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
    ?>
        <a href="?page-nr=<?php echo $_GET['page-nr'] - 1;?>&strSearch=<?php echo $strSearch;?>&txtSearch=<?php echo $txtSearch;?>" class="btn btn-outline-secondary me-1">
            <i class="fa-solid fa-angles-left"></i>
        </a>
    <?php }else{?>
        <a class="btn btn-outline-secondary me-1">
            <i class="fa-solid fa-angles-left" ></i>
        </a>
    <?php }?>
    
<!--++++++++++ Page Number botton ++++++++++-->
    <!-- <div class="page-numbers"> -->
                
        <?php            
            $page_nr = @$_GET['page-nr'];

            if(!isset($_GET['page-nr'])){ 
                $page_nr=1;
            }

            for($counter = 1; $counter <= $pages; $counter++){
 
                if ($counter == $page_nr){
        ?>
            <a href="?page-nr=<?php echo $counter?>&strSearch=<?php echo $strSearch;?>&txtSearch=<?php echo $txtSearch;?>" class="btn btn-outline-secondary me-1 active">
                <?php echo $counter?>
            </a>
        
        <?php }else{ ?>
            <a href="?page-nr=<?php echo $counter?>&strSearch=<?php echo $strSearch;?>&txtSearch=<?php echo $txtSearch;?>" class="btn btn-outline-secondary me-1">
                <?php echo $counter?>
            </a>
        
        <?php }}?>
    <!-- </div> -->
<!--++++++++++ Next botton  ++++++++++-->
    <!-- ไม่มีค่า page-nr และ pages มากว่า 1 หน้า -->
    <?php if((!isset($_GET['page-nr'])) && ($pages > 1)){ ?>        
        <a href="?page-nr=2&strSearch=<?php echo $strSearch;?>&txtSearch=<?php echo $txtSearch;?>" class="btn btn-outline-secondary me-1">
            <i class="fa-solid fa-angles-right"></i>
        </a>

    <!-- ไม่มีค่า page-nr -->
    <?php }elseif(!isset($_GET['page-nr'])){ ?>
        <a class="btn btn-outline-secondary me-1">
            <i class="fa-solid fa-angles-right"></i>
        </a> 

    <!-- มีหน้าส่งมามากกว่าหน้าทั้งหมดไม่ต้อง แสดง link -->
    <?php }elseif($_GET['page-nr'] >= $pages){ ?>    
        <a class="btn btn-outline-secondary me-1">
            <i class="fa-solid fa-angles-right"></i>
        </a>
        
    <!-- มีหน้าส่งมาปกติให้ link เลื่อนไปหน้าถัดไป -->   
    <?php }else{ ?>
        <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>&strSearch=<?php echo $strSearch;?>&txtSearch=<?php echo $txtSearch;?>" class="btn btn-outline-secondary me-1">
            <i class="fa-solid fa-angles-right"></i>    
        </a>
    <?php }?>
    
<!--++++++++++ Last botton  ++++++++++-->
    <!-- <a href="?page-nr=<?php echo $pages;?>" class="btn btn-outline-secondary me-1">Last</a> -->

    </div>    
</div>