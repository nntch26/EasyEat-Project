<?php

include('backEnd/includes/connectDB.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/booking_style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <title>จองโต๊ะล่วงหน้า</title>
</head>

<body>

    <!--- navbar ---->
    <nav class="navbar navbar-expand-lg fixed-top navbar-white">
        <div class="container">

            <a href="index.php" class="navbar-brand a_nav" aria-current="page"> ย้อนกลับ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mt-3 ms-auto">
                    <li class="nav-item">
                        <h1 class="ms-auto">จองโต๊ะล่วงหน้า</h1>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">

        <!--- content table ---->
        <div class="row">
            <div class="content-table">
                <div class="content-header text-center mb-3 mt-3">
                    <h4>โปรดเลือกโต๊ะที่คุณต้องการจะ <span style="color: #FF3E1D;"><u>จองวันนี้</u></span></h4>
                </div>

                <div class="box-table mt-5">

                    <!-- โต๊ะทั้งหมดในร้านแถว 1 --->
                    <div class="row mb-2">

                        <?php
                        $sql1 = $db->prepare("SELECT table_id, table_status, table_cap
                                             FROM Easyeat.Tables
                                             WHERE table_id IN ('A01', 'A02', 'A03', 'A04');");
                        $sql1->execute();

                        while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) :

                            if ($row1['table_status'] == 'ว่าง') {
                                $style = 'card-booking1';
                                $btnClass = 'btn-success';
                                $btnbooking = 'btn-success';
                                $textLabel = ' ว่าง';
                            } else if ($row1['table_status'] == 'ไม่ว่าง') {
                                $style = 'card-booking2';
                                $btnClass = 'btn-danger';
                                $btnbooking = 'btn-secondary disabled';
                                $textLabel = ' ไม่ว่าง';
                            } else if ($row1['table_status'] == 'จอง') {
                                $style = 'card-booking1';
                                $btnClass = 'btn-warning';
                                $btnbooking = 'btn-secondary disabled';
                                $textLabel = 'จอง';
                            }
                        ?>

                            <div class="col-md-3 col-sm-5 col-sm-4 mb-3">

                                <div class="card text-center <?php echo $style; ?>" style="width: 200px;">
                                    <div class="card-header d-flex">
                                        <h6 class="mt-2 ">สถานะ : </h6>
                                        <button type="button" class="btn <?php echo $btnClass; ?> ms-3"><?php echo $textLabel; ?></button>
                                    </div>

                                    <div class="card-body">
                                        <i class="fs-5 bi bi-people-fill ms-2"></i>
                                        <span class="ms-1"><?php echo $row1['table_cap'] ?></span>
                                        <h5 class="card-title">โต๊ะ <?php echo $row1['table_id'] ?></h5>

                                        <!--- เช็คว่า ว่างหรือไม่ ถ้าว่างให้ปุ่ม สามารถกดได้ -->
                                        <?php if ($row1['table_status'] == 'ว่าง') : ?>

                                            <a href="booking_form.php?table_id=<?php echo $row1['table_id'] ?>">
                                                <button type="button" class="btn <?php echo $btnbooking; ?> btn-booking">จอง</button>
                                            </a>
                                        <?php
                                        else : ?>
                                            <button type="button" class="btn <?php echo $btnbooking; ?> btn-booking">จอง</button>
                                        <?php endif ?>

                                    </div>
                                </div>
                            </div>

                        <?php endwhile ?>

                    </div>


                    <!-- โต๊ะทั้งหมดในร้านแถว 2 --->

                    <div class="row mb-2">

                        <?php
                        $sql1 = $db->prepare("SELECT table_id, table_status, table_cap
                                             FROM Easyeat.Tables
                                             WHERE table_id IN ('B01', 'B02', 'B03');");
                        $sql1->execute();

                        while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) :

                            if ($row1['table_status'] == 'ว่าง') {
                                $style = 'card-booking1';
                                $btnClass = 'btn-success';
                                $btnbooking = 'btn-success';
                                $textLabel = ' ว่าง';
                            } else if ($row1['table_status'] == 'ไม่ว่าง') {
                                $style = 'card-booking2';
                                $btnClass = 'btn-danger';
                                $btnbooking = 'btn-secondary disabled';
                                $textLabel = ' ไม่ว่าง';
                            } else if ($row1['table_status'] == 'จอง') {
                                $style = 'card-booking1';
                                $btnClass = 'btn-warning';
                                $btnbooking = 'btn-secondary disabled';
                                $textLabel = ' ไม่ว่าง';
                            }
                        ?>

                            <div class="col-md-4 mb-3">

                                <div class="card text-center <?php echo $style; ?>" style="width: 400px;">
                                    <div class="card-header d-flex">
                                        <h6 class="mt-2 ">สถานะ : </h6>
                                        <button type="button" class="btn <?php echo $btnClass; ?> ms-3"><?php echo $textLabel; ?></button>
                                    </div>

                                    <div class="card-body">
                                        <i class="fs-5 bi bi-people-fill ms-2"></i>
                                        <span class="ms-1"><?php echo $row1['table_cap'] ?></span>
                                        <h5 class="card-title">โต๊ะ <?php echo $row1['table_id'] ?></h5>

                                        <?php if ($row1['table_status'] == 'ว่าง') : ?>

                                            <a href="booking_form.php?table_id=<?php echo $row1['table_id'] ?>">
                                                <button type="button" class="btn <?php echo $btnbooking; ?> btn-booking">จอง</button>
                                            </a>
                                        <?php
                                        else : ?>
                                            <button type="button" class="btn <?php echo $btnbooking; ?> btn-booking">จอง</button>
                                        <?php endif ?>




                                    </div>
                                </div>
                            </div>

                        <?php endwhile ?>

                    </div>


                    <!-- โต๊ะทั้งหมดในร้านแถว 3 --->
                    <div class="row">

                        <?php
                        $sql1 = $db->prepare("SELECT table_id, table_status, table_cap
                                            FROM Easyeat.Tables
                                            WHERE table_id IN ('C01', 'C02', 'C03');");
                        $sql1->execute();

                        while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) :
                            if ($row1['table_status'] == 'ว่าง') {
                                $style = 'card-booking1';
                                $btnClass = 'btn-success';
                                $btnbooking = 'btn-success';
                                $textLabel = ' ว่าง';
                            } else if ($row1['table_status'] == 'ไม่ว่าง') {
                                $style = 'card-booking2';
                                $btnClass = 'btn-danger';
                                $btnbooking = 'btn-secondary disabled';
                                $textLabel = ' ไม่ว่าง';
                            } else if ($row1['table_status'] == 'จอง') {
                                $style = 'card-booking1';
                                $btnClass = 'btn-warning';
                                $btnbooking = 'btn-secondary disabled';
                                $textLabel = ' ไม่ว่าง';
                            }
                        ?>

                            <div class="col-md-4 mb-3">

                                <div class="card text-center <?php echo $style; ?>" style="width: 300px;">
                                    <div class="card-header d-flex">
                                        <h6 class="mt-2 ">สถานะ : </h6>
                                        <button type="button" class="btn <?php echo $btnClass; ?> ms-3"><?php echo $textLabel; ?></button>
                                    </div>

                                    <div class="card-body">
                                        <i class="fs-5 bi bi-people-fill ms-2"></i>
                                        <span class="ms-1"><?php echo $row1['table_cap'] ?></span>
                                        <h5 class="card-title">โต๊ะ <?php echo $row1['table_id'] ?></h5>

                                        <?php if ($row1['table_status'] == 'ว่าง') : ?>

                                            <a href="booking_form.php?table_id=<?php echo $row1['table_id'] ?>">
                                                <button type="button" class="btn <?php echo $btnbooking; ?> btn-booking">จอง</button>
                                            </a>
                                        <?php
                                        else : ?>
                                            <button type="button" class="btn <?php echo $btnbooking; ?> btn-booking">จอง</button>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile ?>

                    </div>


                </div>
            </div>


        </div>
    </div>


</body>

</html>