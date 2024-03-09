<?php
// Include your database connection code here
include '../connectDB.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


// Get the JSON data sent from the client
$Data = json_decode(file_get_contents("php://input"));



try {
    // Start a transaction


    // Insert bill into Bills table
    $stmt = $db->prepare("INSERT INTO Bills (table_id, bill_status) VALUES (?, ?)");
    $status = "pending";
    $table_id = $Data[0]->table_id;
    $stmt->bindParam(1, $table_id);
    $stmt->bindParam(2, $status);
    $stmt->execute();
    
    $bill_id = $db->lastInsertId();
    echo "Bill ID: ". $bill_id ;
    
    foreach ($Data as $item) {
        $stmt = $db->prepare("INSERT INTO Orders (table_id, menu_id, order_quantity, order_status, Bill_id) 
        VALUES (?, ?, ?, ?, ?)");
    
        $table_id = $item->table_id;
        $menu_id = $item->menu_id;
        $order_quantity = $item->menu_value;
    
        $order_status = 'Pending';
    
        $stmt->bindParam(1, $table_id);
        $stmt->bindParam(2, $menu_id);
        $stmt->bindParam(3, $order_quantity);
        $stmt->bindParam(4, $order_status);
        $stmt->bindParam(5, $bill_id);
        $stmt->execute();
    }


    // Insert order into Orders table
   
     // ปิดการเชื่อมต่อกับฐานข้อมูล
     $db = null;

    // Send response back to client
    
} catch (PDOException $e) {
    // Rollback the transaction on error
    // Handle database errors
    echo "Error: " . $e->getMessage();
}