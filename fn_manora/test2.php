<?php 
    include_once "conn/strconn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

        <!---------- Customized Bootstrap Stylesheet ---------->
        <link href="css/bootstrap.css" rel="stylesheet">
        
</head>
<body>
        <div class="container-fluid">
            <div class="col-10 m-auto mb-4 p-3 text-center h3 text-bg-success border border-3 border-top-0 border-success-subtle rounded-bottom-5">
                บทกลอน มโนราห์
            </div>  
            
            <div class="container">
                <div class="row row-cols-1 g-4">
                <?php
                        $sql="SELECT * FROM tb_poetry";
                        $result=$conn->query($sql);
                        while($row=$result->fetch_assoc()){
                        ?>
                        <div class="card p-0">
                            <div class="bg-light h3">
                                <?=$row['poe_name'];?>
                            </div>                
                            
                            <div class="card-body">
                                <h5 class="card-title">Special title treatment</h5>
                                <div class="card-text">
                                    <?php 
                                        $poe_detail=$row['poe_detail'];
                                        echo $poe_detail;
                                    ?>
                                </div>
                                
                            </div>
                            <div class="card-footer text-body-secondary text-end">
                                ผู้ประพันธ์ : <?=$row['poe_author'];?>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>          
        </div>
    
</body>
</html>