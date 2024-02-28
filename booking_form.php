<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/booking_style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>จองโต๊ะล่วงหน้า - กรอกฟอร์มจองโต๊ะ</title>
</head>

<body>

    <!--- navbar ---->
    <nav class="navbar navbar-expand-lg fixed-top navbar-white">
        <div class="container">

            <a href="booking.html" class="navbar-brand a_nav" aria-current="page"> ย้อนกลับ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mt-3 ms-auto">
                    <li class="nav-item">
                        <h1 class="ms-auto">ฟอร์มสำหรับจองโต๊ะ</h1>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <!-- ฟอร์มสำหรับจองโต๊ะ -->
        <div class="form-booking">
            <div class="row">
                <div class="col-sm-12 col-md-12">

                    <!---alert -->



                    <!-- ส่วนของฟอร์ม -->
                    <form action="backEnd/query.php" method="post">

                        <div class="form-group row cont-numtable">
                            <label class="col-sm-5 text-num">เลขโต๊ะ : </label>
                            <div class="col-sm-6">
                                <input type="text" name="table_idxD" class="form-control inp-num" readonly value="<?php echo $_GET['table_id']; ?>">
                            </div>
                        </div>

                        <div class="form-group row cont-user">
                            <div class="mb-3">
                                <label class="col-form-label">ชื่อผู้จอง : </label>
                                <div class="mb-3">
                                    <input type="text" name="booking_username" class="form-control" required placeholder="กรอกชื่อผู้จอง" minlength="5">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label">เบอร์โทรติดต่อ : </label>
                                <input type="tel" name="booking_phone" class="form-control" required placeholder="กรอกเบอร์โทร" minlength="10" maxlength="10" pattern="[0-9]{10}">
                            </div>

                        </div>

                        <div class="form-group row cont-date mb-5">
                            <div class="mb-3 col-sm-4">
                                <label class="col-form-label">วันที่</label>
                                <input type="date" name="booking_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required readonly>

                            </div>

                            <div class="mb-3 col-sm-4">
                                <label class="col-form-label">เวลา</label>
                                <input type="time" name="booking_time" class="form-control" placeholder="เวลา">

                            </div>

                            <div class="mb-3 col-sm-4">
                                <label class="col-form-label">จำนวนคน</label>
                                <input type="text" name="booking_people_caps" class="form-control" placeholder="กรอกจำนวนคน">

                            </div>
                        </div>


                        <div class="btn-footer mb-5">
                            <button type="submit" name="submit_booking_insert" class="btn a_nav2">บันทึกการจอง</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>




    </div>



</body>

</html>