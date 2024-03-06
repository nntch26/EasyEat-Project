<?php
include('includes/connectDB.php');

session_start();
$db = getDB();


// ถ้ากดปุ่มสมัครสมาชิก

if (isset($_POST['submitRegis'])) {

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // เพิ่มข้อมูลเข้าระบบ
    registerUser($fname, $lname, $username, $email, $password, $phone, $db);


} // ถ้ากดปุ่มเข้าสู่ระบบ

else if (isset($_POST['submitLogin'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // เช็คว่า ผู้ใช้กรอกข้อมูลครบมั้ย

    if (empty($username) || empty($password)) {
        $_SESSION['error_empty'] = "<b>ข้อผิดพลาด : </b> โปรดกรอกข้อมูลให้ครบถ้วน!";
        header("location: ../login.php");
        exit();
    } // ถ้ากรอกข้อมูลครบ
    else {

        loginUser($username, $password, $db);

    }
}


// ฟังก์ชัน เข้าสู่ระบบ

function loginUser($username, $password, $db)
{


    $sqlUser = $db->prepare("SELECT * FROM Users 
    WHERE user_username = :username");

    $sqlUser->bindParam(':username', $username);
    $sqlUser->execute();

    // กรณีที่ไม่มีข้อมูลในระบบ
    if ($sqlUser->rowCount() == 0) {

        $_SESSION['error_nouser'] = "<b>ข้อผิดพลาด : </b> ไม่มี <b> ชื่อผู้ใช้ </b>นี้แล้วในระบบ! โปรดลองอีกครั้ง";
        header('location: ../login.php');
        exit;

    } else {

        // มีข้อมูลในระบบ
        $rowuser = $sqlUser->fetch(PDO::FETCH_ASSOC);


        // เช็ค role Admin
        if ($rowuser['user_role'] == "Admin") {

            header('location: ../admin/admin.php');

        } else if ($rowuser['user_role'] == "Chef") {

            header('location: ../index.php');

        } else if ($rowuser['user_role'] == "Cashier") {
            header('location: ../index.php');

        } // เข้าสู่ระบบสำหรับ user
        else if (password_verify($password, $rowuser['user_pass'])) {

            $_SESSION["username"] = $username;
            $_SESSION["userid"] = $rowuser['user_id'];
            $_SESSION['user_phone'] = $rowuser['user_phonenum'];


            $_SESSION['is_login'] = true;

            header('location: ../index.php');


        } // กรณี login ไม่สำเร็จ
        else {
            $_SESSION['is_login'] = false;

            $_SESSION['err_pw'] = "<b>ข้อผิดพลาด : </b> กรุณากรอกรหัสผ่านให้ตรงกัน!";
            header('location: ../login.php');
            exit;
        }
    }
}


// ฟังก์ชัน สมัครสมาชิก

function registerUser($fname, $lname, $username, $email, $password, $phone, $db)
{


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

    } // ผ่านทุกกรณี เพิ่มข้อมูลเข้าระบบได้

    else {

        $password = password_hash($password, PASSWORD_DEFAULT); // เข้ารหัส password ก่อน

        $sqlInsert = $db->prepare("INSERT INTO Easyeat.Users 
        (user_phonenum, user_username, user_pass, user_fname, user_lname, user_email,user_points, user_role) 
        VALUES (:phone, :username, :pass, :fname, :lname, :email, 0 , 'Member');");

        $sqlInsert->bindParam(':username', $username);
        $sqlInsert->bindParam(':phone', $phone);
        $sqlInsert->bindParam(':pass', $password);
        $sqlInsert->bindParam(':fname', $fname);
        $sqlInsert->bindParam(':lname', $lname);
        $sqlInsert->bindParam(':email', $email);

        $sqlInsert->execute();


        // สมัครสำเร็จ
        if ($sqlInsert) {
            $_SESSION['succ_insert'] = "สมัครสำเร็จ!  โปรดเข้าสู่ระบบ";
            header('location: ../login.php');
        } // สมัครไม่สำเร็จ
        else {
            $_SESSION['error_insert'] = "<b>ข้อผิดพลาด:</b> ไม่สามารถนำเข้าข้อมูลได้";
            header('location: ../register.php');
        }
    }
}
