<?php
include('includes/connectDB.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if table_id is set in the POST data
    if (isset($_POST['table_id'])) {
        // Sanitize the input
        $tableId = htmlspecialchars($_POST['table_id']);

        try {
            // Prepare and execute the SQL query to update the table status
            $updateStatement = $db->prepare("UPDATE `Tables` SET `table_status` = 'ว่าง' WHERE `table_id` = :tableId");
            $updateStatement->bindParam(':tableId', $tableId);
            $updateStatement->execute();

            // Check if any rows were affected
            if ($updateStatement->rowCount() > 0) {
                // Return success message
                http_response_code(200);
                echo "อัพเดทข้อมูลแล้ว";
                exit;
            } else {
                // Return error message if no rows were affected
                http_response_code(400);
                echo "ไม่ได้อัพเดท";
                exit;
            }
        } catch (PDOException $e) {
            // Return error message if database error occurs
            http_response_code(500);
            echo "ฐานข้อมูลบึ้ม: " . $e->getMessage();
            exit;
        }
    } else {
        // Return error message if table_id is not set
        http_response_code(400);
        echo "ไม่มี Table id นี้";
        exit;
    }
} else {
    // Return error message if the request method is not POST
    http_response_code(405);
    echo "ที่ส่งมาไม่ใช่ POST ส่งมาใหม่!!!";
    exit;
}
