<?php
include('includes/connectDB.php');
session_start();

if (isset($_POST['submit_booking_insert'])) {
    $table_id = $_POST['table_idxD'];
    $booking_firstname = $_POST['booking_firstname'];
    $booking_lastname = $_POST['booking_lastname'];
    $booking_userphone = $_POST['booking_phone'];
    $booking_cap = $_POST['booking_num'];
    $booking_date = $_POST['booking_date'];
    $booking_time = $_POST['booking_time'];

    try {
        // Insert reservation
        $insertReservation = $db->prepare("INSERT INTO Reservations (table_id, res_cap, res_date, res_time, cus_fname, cus_lname, cus_phone) VALUES (:table_id, :cap, :res_date, :res_time, :fname, :lname, :phone)");
        $insertReservation->bindParam(':table_id', $table_id);
        $insertReservation->bindParam(':cap', $booking_cap);
        $insertReservation->bindParam(':res_date', $booking_date);
        $insertReservation->bindParam(':res_time', $booking_time);
        $insertReservation->bindParam(':fname', $booking_firstname);
        $insertReservation->bindParam(':lname', $booking_lastname);
        $insertReservation->bindParam(':phone', $booking_userphone);
        $insertReservation->execute();

        // Update table status
        $changeStatus = $db->prepare("UPDATE Tables SET table_status = 'Booked' WHERE table_id = :table_id");
        $changeStatus->bindParam(':table_id', $table_id);
        $changeStatus->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $db = null;
}
?>
