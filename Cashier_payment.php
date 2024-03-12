<?php

include('backend/includes/connectDB.php');
session_start();

date_default_timezone_set('Asia/Bangkok');


$table_id = $_GET['table_id'];
//echo  $table_id;

$sql1 = $db->prepare("SELECT Bills.Bill_id, Orders.*,Bills.*,Menus.*
                     FROM Orders
                     JOIN Menus ON Orders.menu_id = Menus.menu_id
                     LEFT JOIN Bills ON Orders.Bill_id = Bills.Bill_id
                     WHERE Orders.table_id  = :table_id AND Bills.bill_status = 'finised';");
// table id เปลี่ยนตามโต๊ะที่สั่งอาหาร

$sql1->bindParam(':table_id', $table_id);
$sql1->execute();


if ($sql1->rowCount() > 0) {
    $result = $sql1->fetch(PDO::FETCH_ASSOC);
    $numBill = $result['Bill_id'];

} else {
    $numBill = '';
    //echo "ไม่พบข้อมูล";
}

$num = 1;
$total = 0;
$usepoint = 0;


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
                    <p><b>เลขที่บิล : </b>  <?php echo $numBill ?></p>
                    <p><b>รายการโต๊ะ : </b> <?php echo $table_id; ?></p>
                    <p><b>วันที่ : </b> <?php echo date('Y-m-d') ?> | <b>เวลา : </b> <?php echo date('H:i:s'); ?></p>

                </div>
            </div>

            <!-- มีข้อมูลในระบบ -->
            <?php
            if (isset($_SESSION['succ_chck'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['succ_chck']; ?>
                </div>
            <?php
            endif; ?>

            <!-- ไม่เจอข้อมูลในระบบ -->
            <?php
            if (isset($_SESSION['error_chck'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error_chck']; ?>
                </div>
            <?php
            endif; ?>


            <div class="con-table">
                <table class="table">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 20%">ชื่อ</th>
                        <th style="width: 10%">ราคา/หน่วย</th>
                        <th style="width: 5%">จำนวน</th>
                        <th style="width: 10%">รวม</th>
                    </tr>
                    <?php while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) :

                        while ($row2 = $sql1->fetch(PDO::FETCH_ASSOC)) :
                            $sql2 = $db->prepare("SELECT * FROM Orders
                                                    JOIN Menus ON Orders.menu_id = Menus.menu_id
                                                    LEFT JOIN Bills ON Orders.Bill_id = Bills.Bill_id
                                                    WHERE Bills.Bill_id = :Bill_id");
                            $sql2->bindParam(':Bill_id', $row1['Bill_id']);

                            $sql2->execute();



                            $total += $row2['menu_price'] * $row2['order_quantity'];

                            ?>

                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo $row2['menu_name']; ?></td>
                                <td><?php echo $row2['menu_price']; ?></td>
                                <td><?php echo $row2['order_quantity']; ?></td>
                                <td><?php echo $row2['order_quantity'] * $row2['menu_price']; ?></td>
                            </tr>

                            <?php $num++ ?>

                        <?php endwhile; ?>
                    <?php endwhile; ?>

                    <tr>
                        <th colspan="4">รวม</th>
                        <td><?php echo $total; ?> บาท</td>
                    </tr>

                    <?php if (isset($_SESSION['usepoint'])):?>
                    <tr>
                        <th colspan="4">ส่วนสด</th>
                        <td><?php echo $_SESSION['usepoint'] ?> บาท</td>
                    </tr>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['succ_bill'])):?>
                    <tr>
                        <th colspan="4">รับมา</th>
                        <td><?php echo $_SESSION['recieved'] ?> บาท</td>
                    </tr>
                    <tr>
                        <th colspan="4">ทอน</th>
                        <td><?php echo $_SESSION['change'] ?> บาท</td>
                    </tr>
                    <?php endif; ?>

                </table>
            </div>

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
        <h4 class="mb-5 text-center">เช็คบิล โต๊ะ <?php echo $table_id; ?> เลขที่ใบเสร็จ <?php echo $numBill; ?> <br> รูปแบบการจ่าย : เงินสด</h4>

        <div class="list" style="font-size: 20px;">

            <form action="backEnd/payment_system.php" method="post">
                <label>รวมทั้งสิ้น (บาท) :</label>
                <input type="text" class="mb-3" style="width: 50%;" name="total" readonly value="<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : $total; ?>">
                <hr>

                <h5>สำหรับสมาชิก</h5>
                <label>เบอร์โทร : </label>
                <input type="text" class="mb-4" style="width: 50%;" name="telmem" value="<?php echo isset($_SESSION['telmem']) ? $_SESSION['telmem'] : ''; ?>">

                <div>
                    <input type="hidden" name="table_id" value="<?php echo ($table_id); ?>">
                    <button type="submit" class="btn btn-danger" name="btnmem"">เช็คสมาชิก</button>

                    <?php if (isset($_SESSION['telmem'])): ?>
                        <a href="#popup-box-member" class="btn btn-warning">ใช้คะแนน</a>
                    <?php endif; ?>

                </div>

                <hr>
                <label>รับเงินมา (บาท) :</label>
                <input type="text" class="mb-4" name="recieved">
                <label>ถอน (บาท) : (ถ้ามี)</label>
                <input type="text" class="mb-4" name="change" readonly value="<?php echo isset($_SESSION['change']) ? $_SESSION['change'] : ''; ?>">
                <br>

                <input type="hidden" name="table_id" value="<?php echo ($table_id); ?>">
                <input type="hidden" name="numBill" value="<?php echo ($numBill); ?>">
                <input type="hidden" name="total2" value="<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : $total; ?>">

                <button type="submit" class="btn btn-success" name="btnbills">เช็คบิล</button>
                <a class="btn btn-secondary" href="#">ยกเลิก</a>
            </form>

        </div>

        <a class="box-close" href="#">
            x
        </a>

    </div>
</div>


<!--- popup สำหรับสแกนจ่าย -->
<div class="modal" id="popup-box-promppay">
    <div class="content">
        <h4 class="mb-5 text-center">เช็คบิล โต๊ะ <?php echo $table_id; ?> เลขที่ใบเสร็จ <?php echo $numBill; ?>  <br> รูปแบบการจ่าย : สแกนจ่าย</h4>
        <div class="list">

            <form action="backEnd/payment_system.php" method="post">
                <label>รวมทั้งสิ้น (บาท) :</label>
                <input type="text" class="mb-3" style="width: 50%;" readonly value="<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : $total; ?>" >
                <hr>

                <h5>สำหรับสมาชิก</h5>
                <label>เบอร์โทร : </label>
                <input type="text" class="mb-4" style="width: 50%;" name="telmem" value="<?php echo isset($_SESSION['telmem']) ? $_SESSION['telmem'] : ''; ?>">

                <div>
                    <input type="hidden" name="table_id" value="<?php echo ($table_id); ?>">
                    <button type="submit" class="btn btn-danger" name="btnmem"">เช็คสมาชิก</button>

                    <?php if (isset($_SESSION['telmem'])): ?>
                        <a href="#popup-box-member" class="btn btn-warning">ใช้คะแนน</a>
                    <?php endif; ?>

                </div>

                <hr>
                <img src="img2/qrcode.jpg" alt="" width="100%">

                <hr>

                <input type="hidden" name="table_id" value="<?php echo ($table_id); ?>">
                <input type="hidden" name="numBill" value="<?php echo ($numBill); ?>">
                <input type="hidden" name="total" value="<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : $total; ?>">

                <button type="submit" class="btn btn-success" name="btnbillsQR">เช็คบิล</button>
                <a class="btn btn-secondary" href="#">ยกเลิก</a>

            </form>

        </div>
        <a class="box-close" href="#">
            x
        </a>
    </div>
</div>

<!--- popup ใส่คะแนน -->
<div class="modal" id="popup-box-member">
    <div class="content">
        <h4 class="mb-3 text-center">กรอกคะแนนที่ต้องการใช้</h4>
        <div class="list">
            <form action="backEnd/payment_system.php" method="post">
                <label>รวมทั้งสิ้น (บาท) :</label>
                <input type="text" class="mb-3" style="width: 50%;" name="total" readonly value="<?php echo $total; ?>">
                <hr>
                <h5>สำหรับสมาชิก</h5>
                <label>คะแนนที่มีอยู่ : </label>
                <input type="text" style="width: 50%;" class="mb-3" value="<?php echo isset($_SESSION['score']) ? $_SESSION['score'] : ''; ?>" readonly>
                <label>คะแนนที่ต้องการใช้ :</label>
                <input type="text" class="mb-3" style="width: 50%;" value="" name="scoreuse">
                <div>

                    <input type="hidden" name="table_id" value="<?php echo ($table_id); ?>">
                    <input type="hidden" name="telmem" value="<?php echo isset($_SESSION['telmem']) ? $_SESSION['telmem'] : ''; ?>">

                    <button type="submit" class="btn btn-warning" name="btnuse">ใช้คะแนน</button>
                </div>

            </form>


        </div>
        <a class="box-close" href="#">
            x
        </a>
    </div>
</div>



</body>

</html>

    <!-- ล้าง session --->

<?php
if (isset($_SESSION['error_chck']) || isset($_SESSION['succ_chck'])
    || isset($_SESSION['telmem']) || isset($_SESSION['total'])
    || isset($_SESSION['change']) || isset($_SESSION['succ_bill'])) {

    unset($_SESSION['error_chck']);
    unset($_SESSION['succ_chck']);
    unset($_SESSION['telmem']);
    unset($_SESSION['total']);
    unset($_SESSION['change']);
    unset($_SESSION['succ_bill']);

}


?>