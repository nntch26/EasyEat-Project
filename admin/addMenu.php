<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเมนูอาหาร</title>

    <!--- stylesheet --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link rel="stylesheet" href="adminStyle/admin_style.css">

    <!--- fonts.google --->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">



</head>

<body>

    <div class="container">
        <div class="cus-cont">
            <form action="../backEnd/manage_menu.php" method="post" enctype="multipart/form-data">
                <h1 class="mt-5 mb-5">เพิ่มเมนูอาหารใหม่!</h1>

                <!---alert -->

                <!-- เพิ่มข้อมูลสำเร็จ -->
                <?php
                if (isset($_SESSION['succ_insert'])) : ?>
                    <div class="alert alert-success" role="alert">
                        <?php
                        echo $_SESSION['succ_insert']; ?>
                    </div>
                <?php
                endif; ?>

                <!-- เพิ่มข้อมูลไม่สำเร็จ -->
                <?php
                if (isset($_SESSION['error_insert'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php
                        echo $_SESSION['error_insert']; ?>
                    </div>
                <?php
                endif; ?>


                <div class="contentMenu-body">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">ชื่อเมนูอาหาร</label>
                                <input type="text" name="menu_name" class="form-control shadow-none" required minlength="3">
                            </div>

                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label">ราคา</label>
                                <input type="text" name="menu_price" class="form-control shadow-none" required>
                            </div>


                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">ประเภทอาหาร</label>
                                <select name="menu_type" class="form-select shadow-none" required>
                                    <option value="0" selected hidden>---เลือกประเภท---</option>
                                    <option value="ทานเล่น">ทานเล่น</option>
                                    <option value="กับข้าว">กับข้าว</option>
                                    <option value="อาหารจานเดียว">อาหารจานเดียว</option>
                                    <option value="แกง">แกง</option>
                                    <option value="ขนมหวาน">ขนมหวาน</option>
                                    <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                                </select>
                            </div>


                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">อัปโหลดรูปภาพอาหาร</label>
                                <input type="file" name="food_img" class="form-control shadow-none" required>
                            </div>




                            <div class="text-center my-1">
                                <a href="admin.php" class="btn btn-secondary  mb-4 mt-4 me-2">ยกเลิก</a>
                                <button type="submit" name="food_update" class="btn btn-primary mb-4 mt-4  me-2">เพิ่มข้อมูล</button>

                            </div>

                        </div>
                    </div>
            </form>

        </div>
    </div>





</body>

</html>

<?php
$db = null;

// ล้าง session

if (isset($_SESSION['succ_insert']) || isset($_SESSION['error_insert'])) {

    unset($_SESSION['succ_insert']);
    unset($_SESSION['error_insert']);
}
?>