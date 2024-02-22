<?php
include('includes/connectDB.php');
include('includes/login.php');
session_start();

if (isset($_POST['submit'])) {
    $tableNum = $_POST['tableNum'];
    $userName = $_POST['name'];
    $userPhoneNum = $_POST['phonenum'];

    if (isRegister($userName, $userPhoneNum)) {
        //สมัครเป็น User แล้ว
        if ($_SESSION['is_login'] = true){
            //login แล้ว
            reservationTable($tableNum, $userName, $userPhoneNum);
        }else{
            //ยังไม่ได้ login
            reservationLogin($tableNum, $userName, $userPhoneNum);
        }
    } else {
        //ยังไม่ได้สมัคร
        reservationRegister($tableNum, $userName, $userPhoneNum);
    }
}

function isRegister($userName, $userPhoneNum)
{
    // Start the connection to database
    $db = getDB();

    // Check if user already registered
    $findUser1 = $db->prepare("SELECT COUNT(phoneNumber) AS amountOfPhoneNum FROM Users WHERE phoneNumber= :phoneNumber AND userName= :userName");
    $findUser1->bindParam(':phoneNumber', $userPhoneNum);
    $findUser1->bindParam(':userName', $userName);
    $findUser1->execute();
    $findUser = $findUser1->fetch(PDO::FETCH_ASSOC);

    if ($findUser['amountOfPhoneNum'] == 0) {
        // Close the connection to database
        $db = null;
        return false;
    } else {
        // Close the connection to database
        $db = null;
        return true;
    }
}


function reservationTable($tableNum, $userName, $userPhoneNum)
{
    // Start the connection to database
    $db = getDB();

    // Insert table
    $insertTable = $db->prepare("INSERT INTO booking_table (table_num, name, phone_num) VALUES (:table_num, :name, :phone_num)");
    $insertTable->bindParam(':table_num', $tableNum);
    $insertTable->bindParam(':name', $userName);
    $insertTable->bindParam(':phone_num', $userPhoneNum);
    $insertTable->execute();

    // Close the connection to database
    $db = null;
}

function reservationLogin($tableNum, $userName, $userPhoneNum)
{
    loginUser($userName, $userPhoneNum);
    reservationTable($tableNum, $userName, $userPhoneNum);
}

function reservationRegister($tableNum, $userName, $userPhoneNum)
{
    registerUser($userName, $userPhoneNum);
    loginUser($userName, $userPhoneNum);
    reservationTable($tableNum, $userName, $userPhoneNum);
}

