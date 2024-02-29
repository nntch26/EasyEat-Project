<?php
include('includes/connectDB.php');
include('login_system.php');
session_start();
$db = getDB();

if (isset($_POST['submit_booking_insert'])) {
    $table_id = $_POST['table_idxD'];
    $booking_username = $_POST['booking_username'];
    $booking_userphone = $_POST['booking_phone'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    if (isRegister($booking_username, $booking_userphone, $db)) {
        //สมัครเป็น User แล้ว
        // echo "condition :" . var_dump(isRegister($booking_username, $booking_userphone, $db));
        // echo "1";
        reservationTable($table_id, $booking_username, $booking_userphone, $booking_date, $booking_time, $db);
    } else {
        //ยังไม่ได้สมัคร
        // echo "condition :" . var_dump(isRegister($booking_username, $booking_userphone, $db));
        // echo "2";
        reservationRegister($table_id, $booking_username, $booking_userphone, $booking_date, $booking_time, $db);
    }
    $db = null;
}

function isRegister($booking_username, $booking_userphone, $db)
{

    // Check if user already registered
    $findUserQuery = $db->prepare("SELECT COUNT(*) AS rowCount FROM Users WHERE phone = :phoneNumber AND username = :userName");
    $findUserQuery->bindParam(':phoneNumber', $booking_userphone);
    $findUserQuery->bindParam(':userName', $booking_username);
    $findUserQuery->execute();
    $rowCount = $findUserQuery->fetch(PDO::FETCH_ASSOC)['rowCount'];

    if ($rowCount != 0) {
        return true;
    } else {
        return false;
    }
}



function reservationTable($tableid, $booking_username, $booking_userphone, $booking_date, $booking_time, $db)
{
    // Insert reservation
    $insertReservation = $db->prepare("INSERT INTO Reservations (table_id, user_username, user_phonenum, res_date, res_time) VALUES (:table_id, :user_username, :user_phonenum, :res_date, :res_time)");
    $insertReservation->bindParam(':table_id', $tableid);
    $insertReservation->bindParam(':user_username', $booking_username);
    $insertReservation->bindParam(':user_phonenum', $booking_userphone);
    $insertReservation->bindParam(':res_date', $booking_date);
    $insertReservation->bindParam(':res_time', $booking_time);
    $insertReservation->execute();
}


function reservationRegister($tableNum, $booking_username, $booking_userphone, $booking_date, $booking_time, $db)
{
    $registerUser = $db->prepare("INSERT INTO Users (username, phone) 
                                VALUES (:username, :phone)");
    $registerUser->bindParam(':username', $booking_username);
    $registerUser->bindParam(':phone', $booking_userphone);
    $registerUser->execute();
    
    reservationTable($tableNum, $booking_username, $booking_userphone, $booking_date, $booking_time, $db);
}
