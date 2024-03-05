<?php
include('includes/connectDB.php');
session_start(); // Start the session
$db = getDB();
function loginUser($userName, $userPhoneNum, $db) {
    //find User
    $select_user = $db->prepare("SELECT * FROM Users WHERE phone = :phoneNumber AND username = :userName");
    $select_user->bindParam(':phoneNumber', $userPhoneNum);
    $select_user->bindParam(':userName', $userName);
    $select_user->execute();
    $user = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($user['username'] == $userName && $user['phone'] == $userPhoneNum) {
        $_SESSION["userName"] = $userName;
        $_SESSION['userPhoneNum'] = $userPhoneNum;
        $_SESSION['is_login'] = true;

        header('location: ../index.html');
        exit;
    } else {
        header('location: ../index.html');
        exit;
    }
}

function registerUser($userName, $userPhoneNum, $db) {

    $registerUser = $db->prepare("INSERT INTO Users (username, phone) 
                                VALUES (:username, :phone)");
    $registerUser->bindParam(':username', $userName);
    $registerUser->bindParam(':phone', $userPhoneNum);
    $registerUser->execute();

}
