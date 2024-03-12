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

    <title>Login - เข้าสู่ระบบ</title>
</head>

<body>

    <!--- navbar ---->
    <nav class="navbar navbar-expand-lg fixed-top navbar-white">
        <div class="container">

            <a href="index.php" class="navbar-brand a_nav" aria-current="page"> ย้อนกลับ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </nav>


    <div class="container">
        <div class="content-login">

            <!------ login form ----->

            <form class="card card-cus" action="backEnd/login_system.php" method="post">
                <h1 class="mb-5 text-center">เข้าสู่ระบบ</h1>

                <!------ alert ----->

                <!-- สมัครสำเร็จ -->
                <?php
                if (isset($_SESSION['succ_insert'])) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['succ_insert']; ?>
                    </div>
                <?php
                endif; ?>

                <!-- ใส่ข้อมูลไม่ครบ -->
                <?php
                if (isset($_SESSION['error_empty'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error_empty']; ?>
                    </div>
                <?php
                endif; ?>


                <!-- ไม่มีข้อมูลในระบบ -->
                <?php
                if (isset($_SESSION['error_nouser'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error_nouser']; ?>
                    </div>
                <?php
                endif; ?>

                <!-- ใส่รหัสไม่ตรงกัน -->
                <?php
                if (isset($_SESSION['err_pw'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['err_pw']; ?>
                    </div>
                <?php
                endif; ?>


                <div class="form-outline mb-3">
                    <label class="form-label" for="username">ชื่อผู้ใช้</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="กรอกชื่อผู้ใช้" />
                </div>

                <div class="form-outline mb-5">
                    <label class="form-label" for="password">รหัสผ่าน</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="กรอกรหัสผ่าน" />
                </div>


                <button type="submit" name="submitLogin" class="btn login-btn">เข้าสู่ระบบ</button>


                <div class="check mt-4 text-center">
                    <label class="form-label">ถ้าคุณยังไม่มีบัญชี <a href="register.php">สมัครสมาชิกที่นี่</a></label>
                </div>

            </form>


        </div>
    </div>

</body>

</html>


<!-- ล้าง session --->

<?php
if (
    isset($_SESSION['succ_insert']) || isset($_SESSION['error_nouser'])
    || isset($_SESSION['err_pw']) || isset($_SESSION['error_empty'])
) {

    session_destroy();
}


?>