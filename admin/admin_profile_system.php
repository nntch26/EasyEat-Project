<?php

include('../backEnd/includes/connectDB.php');

session_start();




// ถ้ากดปุ่มบันทึกข้อมูล อัพเดท

if (isset($_POST['upbtn'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id = $_POST['user_id'];

    //เช็คข้อมูลที่กรอกเข้ามาซ้ำ ใน database หรือไม่
    $sql1 = $db->prepare("SELECT * FROM Users WHERE user_phonenum = :user_phonenum");
    $sql2 = $db->prepare("SELECT * FROM Users WHERE user_email = :user_email");
    $sql3 = $db->prepare("SELECT * FROM Users WHERE user_username = :username");

    $sql1->bindParam(':user_phonenum', $phone);
    $sql2->bindParam(':user_email', $email);
    $sql3->bindParam(':username', $username);

    $sql1->execute();
    $sql2->execute();
    $sql3->execute();


    // ถ้ามีแถว > 0 แปลว่า ข้อมูลซ้ำ
    if ($sql1->rowCount() != 0 && $sql2->rowCount() != 0 && $sql3->rowCount() != 0) {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> มี <b> ชื่อผู้ใช้, เบอร์โทร, อีเมล </b>นี้แล้วในระบบ! โปรดกรอกข้อมูลใหม่";
        header('location: ../register.php');
        exit();

    } // ชื่อผู้ใช้ที่กรอกเข้ามา ซ้ำ มั้ย
    else if ($sql3->rowCount() != 0) {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> มี <b> ชื่อผู้ใช้ </b> นี้แล้วในระบบ! โปรดกรอกข้อมูลใหม่";
        header('location: ../register.php');
        exit();

    } // อีเมลที่ผู้ใช้กรอกเข้ามา ซ้ำ มั้ย
    else if ($sql2->rowCount() != 0) {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> มี <b> อีเมล </b> นี้แล้วในระบบ! โปรดกรอกข้อมูลใหม่";
        header('location: ../register.php');
        exit();
    } // เบอร์โทรที่ผู้ใช้กรอกเข้ามา ซ้ำ มั้ย
    else if ($sql1->rowCount() != 0) {
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> มี <b> เบอร์โทร </b>นี้แล้วในระบบ! โปรดกรอกข้อมูลใหม่";
        header('location: ../register.php');
        exit();

    } 
    
    // ข้อมูลครบ ไม่ซ้ำ

    else {

        $update_sql = $db->prepare("UPDATE Easyeat.Users
        SET user_fname = :firstname, 
        user_lname = :lastname , 
        user_email = :email,
        user_username = :username,
        user_phonenum = :phone 
        WHERE user_id = :id");


        $update_sql->bindParam(':firstname', $fname);
        $update_sql->bindParam(':lastname', $lname);
        $update_sql->bindParam(':email', $email);
        $update_sql->bindParam(':username', $username);
        $update_sql->bindParam(':phone', $phone);

        $update_sql->bindParam(':id', $id);

        $update_sql->execute();

        // เพิ่มข้อมูลแล้ว 
        if ($update_sql) {
            $_SESSION['profile_update'] = "อัปเดตข้อมูลเรียบร้อยแล้ว";
            header('location: ../admin/admin.php#');




        } // เพิ่มข้อมูลไม่สำเร็จ
        else {
            $_SESSION['err_update'] = "ไม่สามารถนำเข้าข้อมูลได้";
            header('location: ../admin/admin.php#');

   


        }


    }

// ถ้ากดปุ่มบันทึกข้อมูล ลบข้อมูล

}else if (isset($_POST['deletebtn'])){

    $id = $_POST['user_id'];

    $delete_sql = $db->prepare("DELETE FROM Users WHERE user_id = :id;");

    $delete_sql->bindParam(':id', $id);
    $delete_sql->execute();

     // ลบข้อมูลแล้ว 
     if ($delete_sql) {
        $_SESSION['profile_delete'] = "ลบข้อมูลทิ้งเรียบร้อยแล้ว";
        header('location: ../admin/admin.php#');




    } // ลบข้อมูลไม่สำเร็จ
    else {
        $_SESSION['err_delete'] = "ไม่สามารถลบข้อมูลได้";
        header('location: ../admin/admin.php#');

    }





}


?>