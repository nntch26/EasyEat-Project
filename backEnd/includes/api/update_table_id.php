<?php
include '../connectDB.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));
try {
    $stmt = $db->prepare("UPDATE Bills  
    SET bill_status = ? 
    WHERE Bill_id = ?;");
    $stmt->bindParam(1, $data->bill_status);
    $stmt->bindParam(2, $data->bill_id);


    if ($stmt->execute()){
        echo json_encode(array("status" => "ok"));
    }else{
        echo json_encode(array("status" => "error"));
    }
    $db = null;
 
}catch(PDOException $e){
    print "". $e->getMessage()."<br/>";
    die();
}


?>