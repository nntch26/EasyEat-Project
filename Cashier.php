<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>หน้าแคชเชียร์</title>

    <!---print --->
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link href="https://printjs-4de6.kxcdn.com/print.min.css">

    <!--- stylesheet --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link href="css\Cashier_style.css" rel="stylesheet">
    <link rel="stylesheet" href="admin\adminStyle\admin_style.css">

    <!--- fonts.google --->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>

    <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">

        <div class="d-flex flex-sm-column align-items-center px-3 pt-2 text-white">

            <a href="#" class="text-decoration-none mt-3" style="color: #ff7b00;" onclick="showmenu('btn_payment')">
                <i class="bi bi-bank2" style="font-size: 32px;"></i>
                <span class="ms-2" style="font-size: 28px;">แคชเชียร์</span>
            </a>

            <hr class="mb-3" style="width: 100%; border-width: 2px;">

            <ul class="nav">
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showmenu('btn_payment')">
                        <i class="fs-5 bi bi-cash-coin"></i><span class="ms-1">ระบบชำระเงิน</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showmenu('btn_table')">
                        <i class="fs-5 bi bi-card-checklist"></i><span class="ms-1">ระบบจัดการโต๊ะ</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="showmenu('btn_history')">
                        <i class="fs-5 bi bi-table"></i><span class="ms-1">ดูประวัติการขาย</span>
                    </a>
                </li>

                <hr class="mt-5" style="width: 100%; border-width: 2px;">


                <li class="nav-item">
                    <a href="backEnd/logout.php" class="nav-link">
                        <i class="fs-5 bi bi-box-arrow-in-right"></i><span class="ms-1">ออกจากระบบ</span>
                    </a>
                </li>
            </ul>

        </div>


    </div>


    <div class="bigbox">

        <div class="BoxOrder">

            <div class="PaymentMenu" id="PaymentMenu">
                <div class="title_top">
                    <h2>ระบบชำระเงิน</h2>
                </div>
                
                <!-- สร้างโต็ะในหน้าชำระเงิน และ แทบนับจำนวนโต็ะที่ว่าง-->
                <?php include("Cashier_gentable.php"); ?>

            </div>

            <div class="PaymentBox" id="PaymentBox">

                <?php include("Cashier_payment.php"); ?>

            </div>
            <!------------------------------------------------------------->
            <div class="ManageTableMenu" id="ManageTableMenu">

                <?php include("Cashier_managetable.php"); ?>

            </div>
            <div class="HistoryMenu" id="HistoryMenu">

                <?php include("Cashier_history.php"); ?>

            </div>
            <!------------------------------------------------------------->
        </div>
    </div>

    <!--popup แสดงรายละเอียด-->
    <div class="popup-box">
        <div class="modal" id="popup-box-info">
            <div class="content">
                <h3>รายละเอียด</h3>
                <hr>
                <div class="list">
                    <p>กล้วย</p>
                    <p>มาม่า</p>
                    <p>ส้ม</p>
                    <hr>
                    <h3>รวม</h3>
                    <p>เป็นล้านเลยพี่</p>
                    <hr>
                </div>
                <a class="box-close" href="#">
                    x
                </a>
            </div>
        </div>


        <!--- popup สำหรับจ่ายเงินสด -->
        <div class="modal" id="popup-box-pay">
            <div class="content">
                <h4 class="mb-5 text-center">เช็คบิล โต๊ะ ..... เลขที่ใบเสร็จ ..... <br> รูปแบบการจ่าย : เงินสด</h4>
                <div class="list" style="font-size: 20px;">
                    <label>รวมทั้งสิ้น (บาท) :</label>
                    <input type="text" class="mb-3" style="width: 50%;" >
                    <hr>
                    <h5>สำหรับสมาชิก</h5>
                    <label>เบอร์โทร : </label>
                    <input type="text" style="width: 50%;" class="mb-4">
                    <div>
                        <button class="btn btn-danger" onclick="printJS('printJS-form2', 'html')">เช็คสมาชิก</button>
                        <button class="btn btn-warning" ">ใช้คะแนน</button>
                    </div>

                    <hr>
                    <label>รับเงินมา (บาท) :</label>
                    <input type="text" class="mb-4">
                    <label>ถอน (บาท) : (ถ้ามี)</label>
                    <input type="text" class="mb-4">
                    <br>

                    <button class="btn btn-success" onclick="printJS('printJS-form2', 'html')">เช็คบิล</button>
                    <a class="btn btn-secondary" href="#">ยกเลิก</a>

                    <div style="display: none;">
                        <?php include("Cashier_payment2.php"); ?>
                    </div>

                </div>

                <a class="box-close" href="#">
                    x
                </a>

            </div>
        </div>


        <!--- popup สำหรับสแกนจ่าย -->
        <div class="modal" id="popup-box-promppay">
            <div class="content">
                <h4 class="mb-5 text-center">เช็คบิล โต๊ะ ..... เลขที่ใบเสร็จ ..... <br> รูปแบบการจ่าย : สแกนจ่าย</h4>
                <div class="list">
                    <label>รวมทั้งสิ้น (บาท) :</label>
                    <input type="text" class="mb-3" style="width: 50%;" >
                    <hr>
                    <h5>สำหรับสมาชิก</h5>
                    <label>เบอร์โทร : </label>
                    <input type="text" style="width: 50%;" class="mb-4">
                    <div>
                        <button class="btn btn-danger" onclick="printJS('printJS-form2', 'html')">เช็คสมาชิก</button>
                        <button class="btn btn-warning" ">ใช้คะแนน</button>
                    </div>

                    <hr>
                    <h1>ใส่ QR ตรงนี้เด้อจ่ะ</h1>

                    <hr>
                    <button class="btn btn-success" onclick="printJS('printJS-form2', 'html')">เช็คบิล</button>
                    <a class="btn btn-secondary" href="#">ยกเลิก</a>
                </div>
                <a class="box-close" href="#">
                    x
                </a>
            </div>
        </div>


        <!--- popup รับลูกค้าใหม่เข้าโต๊ะ -->

        <div class="modal" id="popup-box-table1">
            <div class="content">
                <h3>โต๊ะที่ : A01</h3>
                <hr>
                <div class="list">
                    <label>จำนวนคน : </label>
                    <input style="width: 15%; font-size: 18px;" type="number">
                    <hr>
                    <a class="btn btn-success" href="#popup-box-table1.5">สั่งอาหาร</a>
                </div>
                <a class="box-close" href="#">
                    x
                </a>
            </div>
        </div>

        <!--- popup QR สั่งอาหาร -->

        <div class="modal" id="popup-box-table1.5">
            <div class="content">
                <h3>QR Code</h3>
                <div class="list">
                    <h1>ใส่ QR ตรงนี้เด้อจ่ะ</h1>
                </div>
                <a class="box-close" href="#">
                    x
                </a>
            </div>
        </div>

        
    </div>


    <!---------- script สำหรับเปลี่ยนหน้า --------------->
    <script>
        function showmenu(btnvalue) {
            document.getElementById("PaymentMenu").style.display = "none";
            document.getElementById("ManageTableMenu").style.display = "none";
            document.getElementById("HistoryMenu").style.display = "none";
            document.getElementById("navbox").style.display = "none";
            document.getElementById("PaymentBox").style.display = "none";
            if (btnvalue == "btn_payment") {
                document.getElementById("PaymentMenu").style.display = "flex";
                document.getElementById("navbox").style.display = "flex";
            } else if (btnvalue == "btn_table") {
                document.getElementById("ManageTableMenu").style.display = "flex";
                document.getElementById("navbox").style.display = "flex";
            } else if (btnvalue == "btn_history") {
                document.getElementById("HistoryMenu").style.display = "flex";
            } else if (btnvalue == "btn_payment_info") {
                document.getElementById("PaymentBox").style.display = "flex";
            }
        }

    </script>




</body>
</html>