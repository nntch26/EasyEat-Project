<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/LogRegis_style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Register - สมัครสมาชิก</title>
</head>

<body>

    <!--- navbar ---->
    <nav class="navbar navbar-expand-lg fixed-top navbar-white">
        <div class="container">

            <a href="index.php" class="navbar-brand a_nav" aria-current="page"> หน้าแรก</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>


    <div class="container">
        <div class="content-regis">


            <!------ register form ----->

            <form class="card card-cus" action="backEnd/login_system.php" method="post">

                <h1 class="mb-3 text-center">สมัครสมาชิก</h1>

                <!------ alert ----->

                <!-- มีข้อมูลแล้วในระบบ -->
                <?php
                if (isset($_SESSION['error_chck'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error_chck']; ?>
                    </div>
                <?php
                endif; ?>


                <!-- สมัครไม่สำเร็จ -->
                <?php
                if (isset($_SESSION['err_insert'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['err_insert']; ?>
                    </div>
                <?php
                endif; ?>


                <div class="row">
                    <div class="form-outline mb-3 col-md-6">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="กรอกชื่อของคุณ" minlength="3" pattern="[a-zA-Zก-๏\s]+" required />
                    </div>

                    <div class="form-outline mb-3 col-md-6">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="กรอกนามสกุลของคุณ" minlength="3" pattern="[a-zA-Zก-๏\s]+" required />
                    </div>
                </div>


                <div class="form-outline mb-3">
                    <label class="form-label" for="username">ชื่อผู้ใช้</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="กรอกชื่อผู้ใช้" minlength="5" required />
                </div>

                <div class="form-outline mb-3">
                    <label class="form-label" for="email">อีเมล</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="กรอกอีเมลของคุณ" required />
                </div>

                <div class="form-outline mb-3">
                    <label class="form-label" for="password">รหัสผ่าน</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="กรอกรหัสผ่าน" minlength="6" maxlength="16" required />
                </div>

                <div class="form-outline mb-5">
                    <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="tel" name="phone" class="form-control" required placeholder="กรอกเบอร์โทร" minlength="10" maxlength="10" pattern="[0-9]{10}">
                </div>


                <button type="submit" name="submitRegis" class="btn login-btn">สมัครสมาชิก</button>


                <div class="check mt-4 text-center">
                    <label class="form-label">ถ้าคุณมีบัญชีอยู่แล้ว <a href="login.php">เข้าสู่ระบบที่นี่</a></label>
                </div>

            </form>


        </div>


    </div>


</body>

</html>


<!-- ล้าง session --->

<?php
if (isset($_SESSION['error_chck']) || isset($_SESSION['err_insert'])) {
    session_destroy();
}


?>