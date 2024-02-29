<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--- bootstrap --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!--- stylesheet --->
    <link rel="stylesheet" href="css/profile.css">

    <!--- fonts.google --->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
    <title>หน้าโปรไฟล์สมาชิก</title>
</head>
<body>

 
    <!--- navbar --->
    <?php require('inc/navbar.php'); ?>


    <div class="section-profile">
        <div class="container">
            <h1 class="mb-3 text-center">บัตรสมาชิก</h1>

            <div class="box-profile">
                <div class="row">

                    <div class="col-md-6 con-left3"> 
                        <div class="picbox text-center">
                            <img src="img2/user2.png" alt="chef" class="pic mb-3 mt-2">
                            <h1 class="text4 mb-2 mt-4"> Afdfdsf DFsdfdfds</h1>
                            <h2 for="" class="text3">คะแนนสะสม : <span class="sore">10</span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 con-right3">
                        <div class="card-body-profile" style="line-height: 3;">
                            <h4>รายละเอียดบัญชี</h4>
                            <hr class="mt-3 mb-3" style="width: 50%; border-top: 3px solid #000;">

                            <span class="mt-5" style="font-weight: 400;">Username</span> : <?php echo $_SESSION["username"]; ?> <br>
                            <span style="font-weight: 400;">ชื่อ - นามสกุล</span> : <?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?> <br>
                            <span class="mt-5" style="font-weight: 400;">Email</span> : <?php echo $_SESSION["email"]; ?> <br>
                            <span style="font-weight: 400;">หมายเลขโทรศัพท์ </span> : <?php echo $_SESSION["phonenumber"]; ?> <br>
                        </div>

                        <div class="col-md-12">
                            <div class="cont-btn mt-2">
                                <a href="editprofile.php" class="btn btn-primary shadow-none btn-cus2" data-bs-toggle="modal" data-bs-target="#editProfileModal">แก้ไขข้อมูล</a>
                                    
                            </div>
            
                        </div>
                    
                    </div>

                  



                </div>
            </div>
            
            
            

        </div>
    </div>



    <!---- model แก้ไขข้อมูลสมาชิก ----->

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="update_profile.php" method="post">

                        <div class="row">
                            <div class="form-outline mb-3 col-md-6">
                                <label class="form-label">ชื่อ</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="กรอกชื่อของคุณ" minlength="5" required/>
                            </div>
        
                            <div class="form-outline mb-3 col-md-6">
                                <label class="form-label">นามสกุล</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="กรอกนามสกุลของคุณ" minlength="5" required/>
                            </div>
                        </div>
        
        
                        <div class="form-outline mb-3">
                            <label class="form-label" for="username">ชื่อผู้ใช้</label>
                            <input type="text" name="username" id="username" class="form-control" minlength="5" required disabled/>
                        </div>
        
                        <div class="form-outline mb-3">
                            <label class="form-label" for="email">อีเมล</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="กรอกอีเมลของคุณ" required/>
                        </div>
            
        
                        <div class="form-outline mb-3">
                            <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="tel" name="booking_phone" class="form-control" required minlength="10" maxlength="10" pattern="[0-9]{10}" disabled>
                        </div>

                        <div class="cont-btn mt-3">
                            <button type="submit" class="btn btn-primary btn-cus2 ">บันทึก</button>
                        </div>
        
                    </form>
                </div>
            </div>
        </div>
    </div>









    
</body>
</html>