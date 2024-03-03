<?php
include('includes/connectDB.php');

session_start(); 
$db = getDB(); 


// ถ้ากดปุ่มบันทึกข้อมูล อัพเดท

if (isset($_POST['upbtn'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    // เช็คว่า email ซ้ำมั้ย
    $sql = $db->prepare("SELECT * FROM Users WHERE user_email = :user_email");
    $sql->bindParam(':user_email', $email);

    $sql->execute();

     // อีเมลที่ผู้ใช้กรอกเข้ามา ซ้ำ มั้ย
    if ($sql->rowCount() != 0){
        $_SESSION['error_chck'] = "<b>ข้อผิดพลาด : </b> มี <b> อีเมล </b> นี้แล้วในระบบ! โปรดกรอกข้อมูลใหม่";
        header('location: ../profile.php');
        exit();
    }

    // ข้อมูลครบ ไม่ซ้ำ

    else{

        $update_sql = $db->prepare("UPDATE Easyeat.Users
        SET user_fname = :firstname, 
        user_lname = :lastname , 
        user_email = :email 
        WHERE user_id = :id");


        $update_sql->bindParam(':firstname', $firstname);
        $update_sql->bindParam(':lastname', $lastname);
        $update_sql->bindParam(':email', $email);
        $update_sql->bindParam(':id', $_SESSION["userid"]);

        $update_sql->execute();

        // เพิ่มข้อมูลแล้ว 
        if ($update_sql) {
            $_SESSION['profile_update'] = "อัปเดตข้อมูลของคุณเรียบร้อยแล้ว";
            header('location: ../profile.php');
        }

        // เพิ่มข้อมูลไม่สำเร็จ
        else {
            $_SESSION['err_update'] = "ไม่สามารถนำเข้าข้อมูลได้";
            header('location: ../profile.php');


        }


    }







}





?>