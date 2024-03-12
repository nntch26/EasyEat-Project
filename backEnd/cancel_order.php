<?php
include('includes/connectDB.php');
session_start();

// เมื่อกดปุ่มยกเลิกรายการอาหารทั้งหมด
if (isset($_POST['cancelbtn'])) {

    $id = $_POST['Bill_id'];

    // เปลี่ยนสถานะ bill เป็น cancel
    $up_sql = $db->prepare("UPDATE Bills SET bill_status = 'cancel' WHERE Bill_id = :id;");
    $up_sql->bindParam(':id', $id);


    // ลบรายการอาหารที่สั่งของ bill นั้นๆ
    $up_sql2 = $db->prepare(" UPDATE Orders SET order_status = 'cancel' WHERE Bill_id = :id;");
    $up_sql2->bindParam(':id', $id);

    $up_sql->execute();
    $up_sql2->execute();

    // ยกเลิกรายการอาหารแล้ว
    if ($up_sql->rowCount() > 0 && $up_sql2->rowCount() > 0) {
        $_SESSION['order_cancel'] = "ยกเลิกรายการอาหารเรียบร้อยแล้ว";
        header('location: ../preparemenu.php');
    } // ไม่สำเร็จ
    else {
        $_SESSION['err_cancel'] = "เกิดข้อผิดพลาดโปรดลองใหม่";
        header('location: ../preparemenu.php');
    }
}
