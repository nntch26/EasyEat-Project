<?php
include '../connectDB.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$data = json_decode(file_get_contents("php://input"));
try{
    $stmt = $db->prepare("SELECT o.order_id, o.menu_id, m.menu_name ,o.order_quantity from Orders o
    LEFT JOIN Menus m ON o.menu_id = m.menu_id where o.Bill_id = ?;");
    
    $bill_id = $data->bill_id;
    $stmt->bindParam(1, $bill_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $data = array();
    foreach ($result as $row) {
            $data[] = array(
            'order_id' => $row['order_id'],
            'menu_id' => $row['menu_id'],
            'menu_name' => $row['menu_name'],
            'order_quantity' => $row['order_quantity']
        );
    }

    // แปลง array เป็น JSON string
    $json_data = json_encode($data);
    echo $json_data;
    $db = null;
}catch(PDOException $e){
    print "". $e->getMessage()."<br/>";
    die();
}


?>