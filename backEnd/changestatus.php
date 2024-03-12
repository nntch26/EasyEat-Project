<?php

include('includes/connectDB.php');

if (isset($_POST['table_id'])) {
    $table_id = $_POST['table_id'];
    try {
        $stmt = $db->prepare("UPDATE Tables SET table_status = 'จอง' WHERE table_id = :table_id");
        $stmt->bindParam(':table_id', $table_id);
        $stmt->execute();

        //echo "Table status updated successfully";
    } catch (PDOException $e) {
        // Handle errors here
        echo "Error: " . $e->getMessage();
    }
    http_response_code(200);
} else {
    http_response_code(400);
}
