<?php

include('includes/connectDB.php');

date_default_timezone_set('Asia/Bangkok');

$_SESSION['telmem'] = '';
$_SESSION['score'] = '';
session_start();

$table_id = $_POST['table_id'];

// ถ้ากดปุ่มเช็คสมาชิก
if (isset($_POST['btnmem'])) {

    $telmem = $_POST['telmem'];

    $sql = $db->prepare("SELECT * FROM Users WHERE user_phonenum = :telmem");

    $sql->bindParam(':telmem', $telmem);
    $sql->execute();

    // ถ้ามีแถว > 0 แปลว่า มีข้อมูลในระบบ
    if ($sql->rowCount() != 0) {
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        $_SESSION['succ_chck'] = "<b>มีข้อมูลในระบบ :</b><br>"
            . $result['user_fname'] . " " . $result['user_lname'] . " คะแนน " . $result['user_points'];

        $_SESSION['telmem'] = $telmem;
        $_SESSION['score'] = $result['user_points'];


        header('location: ../Cashier_payment.php?table_id=' . $table_id . '#popup-box-pay.php');
        exit();
    } else {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> ไม่มี <b> เบอร์โทร </b>นี้ในระบบ! โปรดกรอกข้อมูลใหม่";
        header('location: ../Cashier_payment.php?table_id=' . $table_id . '#popup-box-pay.php');
        exit();
    }
}
// ถ้ากดปุ่มใช้คะแนน
else if (isset($_POST['btnuse'])) {

    $totaldata = $_POST['total'];
    $telmem = $_POST['telmem'];

    // เงื่อนไขคือ จะใช้ส่วนลดคะแนนได้ก็ต่อเมื่อคะแนนที่มีอยู่ น้อยกว่าหรือเท่ากับ ราคาทั้งหมด
    if ($_POST['scoreuse'] <= $totaldata) {
        $scoreuse = $_POST['scoreuse'];

        $_SESSION['total'] = $totaldata - $scoreuse;
        $balance = $_SESSION['score'] - $scoreuse;

        $_SESSION['usepoint'] = "- " . $scoreuse;

        // ลบคะแนนในระบบ
        $sql = $db->prepare("UPDATE Users SET user_points = :balance
                                    WHERE user_phonenum = :telmem;");

        $sql->bindParam(':balance', $balance);
        $sql->bindParam(':telmem', $telmem);

        $sql->execute();

        if ($sql->rowCount() > 0) {

            $_SESSION['succ_chck'] = "<b>ใช้คะแนนเรียบร้อย :</b> คุณได้ใช้คะแนนส่วนลดไปจำนวน " . $scoreuse . " คะแนน";
            header('location: ../Cashier_payment.php?table_id=' . $table_id . '#popup-box-pay.php');
            exit();
        }
    } else {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> ไม่สามารถใช้คะแนนได้ โปรดกรอกข้อมูลใหม่";
        header('location: ../Cashier_payment.php?table_id=' . $table_id . '#popup-box-pay.php');
        exit();
    }
}

// กดปุ่มเช็คบิล ชำระเงิน
else if (isset($_POST['btnbills'])) {

    $recieved = $_POST['recieved'];
    $totaldata = $_POST['total2'];


    // เงื่อนไขคือ จำนวนเงิน มากกว่าหรือเท่ากับ ราคาทั้งหมด
    if ($recieved >= $totaldata) {
        $balance = (float) $recieved - (float) $totaldata;
        $numBill = $_POST['numBill'];
        $date =  date('Y-m-d');
        $time = date('H:i:s');

        echo $balance;



        // เพิ่มข้อมูลการชำระเงิน
        $sql = $db->prepare("INSERT INTO Payments (table_id, Bill_id, payment_total, payment_date, payment_time)
                                    VALUES (:table_id, :numBill, :total, :date, :time);");

        $sql->bindParam(':table_id', $table_id);
        $sql->bindParam(':numBill', $numBill);
        $sql->bindParam(':total', $totaldata);
        $sql->bindParam(':date', $date);
        $sql->bindParam(':time', $time);


        // เปลี่ยนสถานะโต๊ะ เป็นว่าง
        $sql2 = $db->prepare("UPDATE Tables
                                    SET table_status = 'ว่าง'
                                    WHERE table_id = :table_id;");

        $sql2->bindParam(':table_id', $table_id);

        $sql->execute();
        $sql2->execute();


        if ($sql->rowCount() > 0 && $sql2->rowCount() > 0) {

            $_SESSION['succ_chck'] = "<b>ชำระเงินเสร็จสิ้น :</b> การชำระเงินเรียบร้อย!";

            $_SESSION['change'] = $balance;
            $_SESSION['recieved'] = $_POST['recieved'];

            $_SESSION['succ_bill'] = true;

            header('location: ../Cashier_payment.php?table_id=' . $table_id . '#popup-box-pay.php');
            exit();
        }
    } else {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> โปรดกรอกข้อมูลใหม่";
        header('location: ../Cashier_payment.php?table_id=' . $table_id . '#popup-box-pay.php');
        exit();
    }
}

// กดปุ่มเช็คบิล ชำระเงินแบบสแกน QR Code
else if (isset($_POST['btnbillsQR'])) {

    $totaldata = $_POST['total'];
    $numBill = $_POST['numBill'];
    $date =  date('Y-m-d');
    $time = date('H:i:s');

    echo $totaldata . " " . $table_id;



    // เพิ่มข้อมูลการชำระเงิน
    $sql = $db->prepare("INSERT INTO Payments (table_id, Bill_id, payment_total, payment_date, payment_time)
                                VALUES (:table_id, :numBill, :total, :date, :time);");

    $sql->bindParam(':table_id', $table_id);
    $sql->bindParam(':numBill', $numBill);
    $sql->bindParam(':total', $totaldata);
    $sql->bindParam(':date', $date);
    $sql->bindParam(':time', $time);


    // เปลี่ยนสถานะโต๊ะ เป็นว่าง
    $sql2 = $db->prepare("UPDATE Tables
                                SET table_status = 'ว่าง'
                                WHERE table_id = :table_id;");

    $sql2->bindParam(':table_id', $table_id);

    $sql->execute();
    $sql2->execute();


    if ($sql->rowCount() > 0 && $sql2->rowCount() > 0) {

        $_SESSION['succ_chck'] = "<b>ชำระเงินเสร็จสิ้น :</b> การชำระเงินเรียบร้อย!";

        $_SESSION['change'] = 0;
        $_SESSION['recieved'] = $totaldata;

        $_SESSION['succ_bill'] = true;

        header('location: ../Cashier_payment.php?table_id=' . $table_id . '#popup-box-pay.php');
        exit();
    } else {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> โปรดกรอกข้อมูลใหม่";
        //header('location: ../Cashier_payment.php?table_id='.$table_id.'#popup-box-pay.php');
        exit();
    }
}
