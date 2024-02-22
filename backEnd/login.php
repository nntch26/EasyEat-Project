<?php
include('includes/connectDB.php');
session_start(); // Start the session

function loginUser($userName, $userPhoneNum)
{
    // Start the connection to database
    $db = getDB();

    //find User
    $select_user = $db->prepare("SELECT * FROM Users WHERE phoneNumber= :phoneNumber AND userName= :userName");
    $select_user->bindParam(':phoneNumber', $userPhoneNum);
    $select_user->bindParam(':userName', $userName);
    $select_user->execute();
    $user = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($user['userName'] == $userName && $user['userPhoneNum'] == $userPhoneNum) {
        $_SESSION["userName"] = $userName;
        $_SESSION['userPhoneNum'] = $userPhoneNum;
        $_SESSION['is_login'] = true;

        //get info from userPhoneNum
        $selectinfo = $db->prepare("SELECT * FROM Users WHERE userPhoneNum = :userPhoneNum");
        $selectinfo->bindParam(':userPhoneNum', $userPhoneNum);
        $selectinfo->execute();
        $info = $selectinfo->fetch(PDO::FETCH_ASSOC);

        //set session
        // $_SESSION["userid"] = $info['user_id'];
        // $_SESSION["firstname"] = $info['users_first_name'];
        // $_SESSION["lastname"] = $info['users_last_name'];
        // $_SESSION["username"] = $info['users_username'];
        // $_SESSION["email"] = $info['users_email'];
        // $_SESSION["password"] = $info['users_password'];
        // $_SESSION["phonenumber"] = $info['users_phone_number'];
        // $_SESSION["address"] = $info['users_address'];
        // $_SESSION["role"] = $info['users_role'];

        // if ($info['users_role'] == "ADMIN") {
        //     header('location: ../Admin/admin.php');
        // } else {
        //     header('location: ../index.php');
        // }
    } else {
        $_SESSION['err_pw'] = "กรุณากรอกรหัสผ่านให้ตรงกัน";
        header('location: ../login.php');
        exit;
    }

    // Close the connection to database
    $db = null;
}

function registerUser($userName, $userPhoneNum)
{
    // Start the connection to database
    $db = getDB();
    
    $registerUser = $db->prepare("INSERT INTO users (users_username, users_password, users_email, users_role) 
                                VALUES (:users_username, :users_password, :users_email ,'TOURIST')");
    $registerUser->bindParam(':users_username', $username);
    $registerUser->bindParam(':users_password', $password);
    $registerUser->bindParam(':users_email', $email);
    $registerUser->execute();

    if ($registerUser) {
        // Close the connection to database
        $db = null;
        header('../login.php');
    }

    // Close the connection to database
    $db = null;
}
