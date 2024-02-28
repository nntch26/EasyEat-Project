<?php
include('includes/connectDB.php');
session_start();
//open connection
$db = getDB();

if (isset($_POST['submit_booking_insert'])) {
    $table_id = $_POST['table_idxD'];
    $booking_username = $_POST['booking_username'];
    $booking_userphone = $_POST['booking_phone'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];
    $booking_people_caps = $_POST['booking_people_caps'];

    if (isRegister($booking_username, $booking_userphone, $db)) {
        //สมัครเป็น User แล้ว
        // echo "condition :" . var_dump(isRegister($booking_username, $booking_userphone, $db));
        // echo "1";
        reservationTable($table_id, $booking_username, $booking_userphone, $booking_people_caps, $booking_date, $booking_time, $db);
    } else {
        //ยังไม่ได้สมัคร
        // echo "condition :" . var_dump(isRegister($booking_username, $booking_userphone, $db));
        // echo "2";
        reservationRegister($table_id, $booking_username, $booking_userphone, $booking_people_caps, $booking_date, $booking_time, $db);
    }
    //close connection
    $db = null;
}

function isRegister($booking_username, $booking_userphone, $db)
{
    // Check if user already registered
    $findUserQuery = $db->prepare("SELECT COUNT(*) AS rowCount FROM Users WHERE phone = :phoneNumber AND username = :userName");
    $findUserQuery->bindValue(':phoneNumber', $booking_userphone);
    $findUserQuery->bindValue(':userName', $booking_username);
    $findUserQuery->execute();
    $rowCount = $findUserQuery->fetch(PDO::FETCH_ASSOC)['rowCount'];

    if ($rowCount != 0) {
        return true;
    } else {
        return false;
    }
}

function reservationTable($tableid, $booking_username, $booking_userphone, $booking_people_caps, $booking_date, $booking_time, $db)
{
    // Insert reservation
    $insertReservation = $db->prepare("INSERT INTO Reservations (table_id, user_username, user_phonenum, res_cap, res_date, res_time) VALUES (:table_id, :user_username, :user_phonenum, :res_cap, :res_date, :res_time)");
    $insertReservation->bindValue(':table_id', $tableid);
    $insertReservation->bindValue(':user_username', $booking_username);
    $insertReservation->bindValue(':user_phonenum', $booking_userphone);
    $insertReservation->bindValue(':res_cap', $booking_people_caps);
    $insertReservation->bindValue(':res_date', $booking_date);
    $insertReservation->bindValue(':res_time', $booking_time);
    $insertReservation->execute();

    $changeStatus = $db->prepare("UPDATE Tables SET table_status = :table_status WHERE table_id = :table_id");
    $changeStatus->bindValue(':table_id', $tableid);
    $changeStatus->bindValue(':table_status', "Booked");
    $changeStatus->execute();
}

function reservationRegister($tableNum, $booking_username, $booking_userphone, $booking_people_caps, $booking_date, $booking_time, $db)
{
    $registerUser = $db->prepare("INSERT INTO Users (username, phone) 
                                VALUES (:username, :phone)");
    $registerUser->bindValue(':username', $booking_username);
    $registerUser->bindValue(':phone', $booking_userphone);
    $registerUser->execute();

    reservationTable($tableNum, $booking_username, $booking_userphone, $booking_people_caps, $booking_date, $booking_time, $db);
}
