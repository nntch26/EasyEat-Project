<?php
include('backEnd/includes/connectDB.php');
session_start();

// เช็คว่า login หรือยัง 
if (!isset($_SESSION['is_login'])) {
    header('location: login.php');
} else {

    $db = getDB();

    $select_sql = $db->prepare("SELECT * FROM Users WHERE user_id = :userid");
    $select_sql->bindParam(':userid', $_SESSION["userid"]);
    $select_sql->execute();

    $row = $select_sql->fetch(PDO::FETCH_ASSOC);

}


?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--- bootstrap --->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>

        <!--- stylesheet --->
        <link rel="stylesheet" href="css/profile.css">

        <!--- fonts.google --->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
              rel="stylesheet">

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        <title>หน้าโปรไฟล์สมาชิก</title>
    </head>
    <body>


    <!--- navbar --->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">

            <a class="navbar-brand " href="index.php">- EasyEat -</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto mt-3">

                    <li class="nav-item me-2">
                        <a class="nav-link active text-white" aria-current="page" href="index.php">หน้าแรก</a>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link active text-white" aria-current="page" href="index.php">เกี่ยวกับ</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link active text-white  mb-1" aria-current="page" href="index.php">เมนูยอดนิยม</a>
                    </li>

                    <li class="nav-item me-3">
                        <a href="booking.php" class="btn  btnt1 mb-3" type="button">จองโต๊ะ</a>
                    </li>

                    <li class="nav-item me-3">
                        <a href="profile.php" class="btn btn-outline-light btnt2" type="button">โปรไฟล์สมาชิก</a>
                    </li>

                    <li class="nav-item">
                        <a href="backEnd/logout.php">
                            <ion-icon name="log-out-outline"
                                      style="color: white; font-size: 38px; margin-right: 5px;"></ion-icon>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!---- ข้อมูลสมาชิก ----->

    <div class="section-profile">
        <div class="container">

            <!------ alert ----->

            <!-- อัพเดทข้อมูลสำเร็จ -->
            <?php
            if (isset($_SESSION['profile_update'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['profile_update']; ?>
                </div>
            <?php
            endif; ?>

            <!-- อีเมลซ้ำ -->
            <?php
            if (isset($_SESSION['error_chck'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error_chck']; ?>
                </div>
            <?php
            endif; ?>


            <!-- อัพเดทข้อมูลไม่สำเร็จ -->
            <?php
            if (isset($_SESSION['err_update'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['err_update']; ?>
                </div>
            <?php
            endif; ?>


            <h1 class="mb-3 text-center">บัตรสมาชิก</h1>

            <div class="box-profile">
                <div class="row">

                    <div class="col-md-6 con-left3">
                        <div class="picbox text-center">
                            <img src="img2/user2.png" alt="chef" class="pic mb-3 mt-4">
                            <h1 class="text4 mb-2 mt-2"> <?php
                                echo $row['user_fname'] . " " . $row['user_lname']; ?></h1>
                            <h2 for="" class="text3">คะแนนสะสม : <span class="sore"><?php
                                    echo $row['user_points'] ?></span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 con-right3">
                        <div class="card-body-profile" style="line-height: 3;">
                            <h3>รายละเอียดบัญชี</h3>
                            <hr class="mt-3 mb-3" style="width: 50%; border-top: 3px solid #000;">

                            <span class="mt-5" style="font-weight: 600;">Username</span> : <?php
                            echo $row['user_username']; ?> <br>
                            <span style="font-weight: 600;">ชื่อ - นามสกุล</span> : <?php
                            echo $row['user_fname'] . " " . $row['user_lname']; ?> <br>
                            <span class="mt-5" style="font-weight: 600;">Email</span> : <?php
                            echo $row['user_email']; ?> <br>
                            <span style="font-weight: 600;">หมายเลขโทรศัพท์ </span> : <?php
                            echo $row['user_phonenum']; ?> <br>
                        </div>

                        <div class="col-md-12">
                            <div class="cont-btn mt-2">
                                <a href="editprofile.php" class="btn btn-primary shadow-none btn-cus2"
                                   data-bs-toggle="modal" data-bs-target="#editProfileModal">แก้ไขข้อมูล</a>

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

                    <form action="backEnd/update_profile.php" method="post">

                        <div class="row">
                            <div class="form-outline mb-3 col-md-6">
                                <label class="form-label">ชื่อ</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" minlength="3"
                                       value="<?php
                                       echo $row['user_fname'] ?>" vrequired/>
                            </div>

                            <div class="form-outline mb-3 col-md-6">
                                <label class="form-label">นามสกุล</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" minlength="3"
                                       value="<?php
                                       echo $row['user_lname']; ?>" required/>
                            </div>
                        </div>


                        <div class="form-outline mb-3">
                            <label class="form-label" for="username">ชื่อผู้ใช้</label>
                            <input type="text" name="username" id="username" class="form-control" minlength="5"
                                   value="<?php
                                   echo $row['user_username']; ?>" required disabled/>
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="email">อีเมล</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php
                            echo $row['user_email']; ?>" required/>
                        </div>


                        <div class="form-outline mb-3">
                            <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="tel" name="booking_phone" class="form-control" value="<?php
                            echo $row['user_phonenum']; ?>" required disabled>
                        </div>

                        <div class="cont-btn mt-3">
                            <button type="submit" class="btn btn-primary btn-cus2 " name="upbtn">บันทึก</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    </body>
    </html>


    <!-- ล้าง session --->

<?php
if (isset($_SESSION['profile_update']) || isset($_SESSION['error_chck']) || isset($_SESSION['err_update'])) {

    unset($_SESSION['error_chck']);
    unset($_SESSION['err_update']);
    unset($_SESSION['profile_update']);

}


?>