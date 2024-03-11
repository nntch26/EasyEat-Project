<?php
include '../connectDB.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));
try {
    $stmt = $db->prepare("SELECT * FROM Bills WHERE bill_status != ? ORDER by bill_status desc;");

    // กำหนดค่าพารามิเตอร์สำหรับคำสั่ง SQL โดยใช้ bindParam()
    $status = "pay";
    $stmt->bindParam(1, $status);
    // เรียก execute() เพื่อดำเนินการคำสั่ง SQL
    $stmt->execute();

    // เก็บผลลัพธ์ในรูปแบบของ associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // สร้าง array เพื่อเก็บข้อมูล
    $data = array();
    foreach ($result as $row) {
        $data[] = array(
            'bill_id' => $row['Bill_id'],
            'table_id' => $row['table_id'],
            'bill_status' => $row['bill_status'],
            
        );
    }
    


    // แปลง array เป็น JSON string
    $json_data = json_encode($data);

    // แสดง JSON string
    echo $json_data;

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    

    

    
    $db = null;
}catch(PDOException $e){
    print "". $e->getMessage()."<br/>";
    die();
}


?>