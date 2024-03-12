<?php

?>

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

<div class="container">
    <div class="PaymentBox2" id="PaymentBox2">
        <div style="text-align:left;">
            <a class="btn btn-outline-dark" href="Cashier.php">ย้อนกลับ</a>
        </div>
        <form action="#" method="post"id="printJS-form">
            <div>
                <div style="text-align : center;">
                    <h3>EasyEat</h3>
                    <p>เลขที่บิล : ....</p>
                    <p>รายการโต๊ะ ...... จำนวน ...... คน วันที่/เวลา ........</p>
                </div>
            </div>

            <table class="table">
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 20%">ชื่อ</th>
                    <th style="width: 10%">ราคา/หน่วย</th>
                    <th style="width: 5%">จำนวน</th>
                    <th style="width: 10%">รวม</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>กล้วย</td>
                    <td>2000.0</td>
                    <td>54</td>
                    <td>546467613.0</td>
                </tr>
                <tr>
                    <th colspan="4">รวม</th>
                    <td>54646165.0 บาท</td>
                </tr>
            </table>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                th {
                    border-collapse: collapse;
                    background-color: rgba(34, 34, 34, 0.18);
                    border-color: gray;
                    border: 1px solid #222;
                }

                tr, td {
                    background-color: white;
                    font-weight: normal;
                    border: 1px solid #222;
                }
            </style>

        </form>

        <br>

        <div class="cont-btn">
            <a class="btn btn-secondary me-2" onclick="printJS('printJS-form', 'html')" class="descripAhref">
                <i class="fs-5 bi bi-printer-fill"></i> <spen class="ms-1">พิมพ์ใบเสร็จ</spen>
            </a>

            <a class="btn btn btn-success me-2" href="#popup-box-pay" class="descripAhref">
                <i class="fs-5 bi bi-cash-coin"></i><spen class="ms-2">เงินสด</spen>
            </a>

            <a class="btn btn-warning" href="#popup-box-promppay" class="descripAhref">
                <i class="fs-5 bi bi-qr-code-scan"></i><spen class="ms-2">สแกนจ่าย</spen>
            </a>

        </div>
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


</body>

</html>
