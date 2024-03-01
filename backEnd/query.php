<?php
include('includes/connectDB.php');
session_start();
$db = getDB();

if (isset($_POST['submit_booking_insert'])) {
    $table_id = $_POST['table_idxD'];
    $booking_firstname = $_POST['booking_firstname'];
    $booking_lastname = $_POST['booking_lastname'];
    $booking_userphone = $_POST['booking_phone'];
    $booking_cap = $_POST['booking_num'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    if (isRegister($booking_firstname, $booking_lastname, $booking_userphone, $db)) {
        //echo 1; // User already registered
        reservationTable($table_id, $booking_firstname, $booking_lastname, $booking_cap, $booking_date, $booking_time, $db);
    } else {
        //echo 2; // Successfully added new user to the database
        reservationRegister($table_id, $booking_firstname, $booking_lastname, $booking_userphone, $booking_cap, $booking_date, $booking_time, $db);
    }
    $db = null;
}

function isRegister($booking_firstname, $booking_lastname, $booking_userphone, $db)
{
    try {
        // Check if user already registered
        $findUserQuery = $db->prepare("SELECT COUNT(*) AS rowCount FROM Users WHERE user_phonenum = :phoneNumber AND user_fname = :firstName AND user_lname = :lastName");
        $findUserQuery->bindParam(':phoneNumber', $booking_userphone);
        $findUserQuery->bindParam(':firstName', $booking_firstname);
        $findUserQuery->bindParam(':lastName', $booking_lastname);
        $findUserQuery->execute();
        $rowCount = $findUserQuery->fetch(PDO::FETCH_ASSOC)['rowCount'];
        return ($rowCount != 0);
    } catch (PDOException $e) {
        //echo "isRegister";
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function reservationTable($tableid, $booking_firstname, $booking_lastname, $booking_cap, $booking_date, $booking_time, $db)
{
    try {
        // Find user_id
        $selectUserID = $db->prepare("SELECT user_id FROM Users WHERE user_fname = :fname && user_lname = :lastName");
        $selectUserID->bindParam(':fname', $booking_firstname);
        $selectUserID->bindParam(':lastName', $booking_lastname);
        $selectUserID->execute();
        $selectedUserID = $selectUserID->fetch(PDO::FETCH_COLUMN);
        // Insert reservation
        $insertReservation = $db->prepare("INSERT INTO Reservations (user_id, table_id, res_cap, res_date, res_time) VALUES (:userid, :tableid, :cap, :res_date, :res_time)");
        $insertReservation->bindParam(':tableid', $tableid);
        $insertReservation->bindParam(':userid', $selectedUserID);
        $insertReservation->bindParam(':cap', $booking_cap);
        $insertReservation->bindParam(':res_date', $booking_date);
        $insertReservation->bindParam(':res_time', $booking_time);
        $insertReservation->execute();

        $changeStatus = $db->prepare("UPDATE Tables SET table_status = :table_status WHERE table_id = :table_id");
        $changeStatus->bindValue(':table_id', $tableid);
        $changeStatus->bindValue(':table_status', "Booked");
        $changeStatus->execute();
    } catch (PDOException $e) {
        //echo "reservationTable";
        echo "Error: " . $e->getMessage();
    }
}

function reservationRegister($tableNum, $booking_firstname, $booking_lastname, $booking_userphone, $booking_cap, $booking_date, $booking_time, $db)
{
    try {
        $registerUser = $db->prepare("INSERT INTO Users (user_fname, user_lname, user_phonenum) 
                                VALUES (:firstName, :lastName, :user_phone)");
        $registerUser->bindParam(':firstName', $booking_firstname);
        $registerUser->bindParam(':lastName', $booking_lastname);
        $registerUser->bindParam(':user_phone', $booking_userphone);
        $registerUser->execute();
        //echo "reservationRegister";
        reservationTable($tableNum, $booking_firstname, $booking_lastname, $booking_cap, $booking_date, $booking_time, $db);
    } catch (PDOException $e) {
        //echo "reservationRegister";
        echo "Error: " . $e->getMessage();
    }
}
