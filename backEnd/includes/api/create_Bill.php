<?php
include '../connectDB.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$db = getDB();
$data = json_decode(file_get_contents("php://input"));
try {
    $stmt = $db->prepare("insert *
    FROM Menus 
    WHERE  menu_type  = ? ");

    // กำหนดค่าพารามิเตอร์สำหรับคำสั่ง SQL โดยใช้ bindParam()
    $types = $data->type;

    $stmt->bindParam(1, $types);

    // เรียก execute() เพื่อดำเนินการคำสั่ง SQL
    $stmt->execute();

    // เก็บผลลัพธ์ในรูปแบบของ associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // สร้าง array เพื่อเก็บข้อมูล
    $data = array();
    foreach ($result as $row) {
        $data[] = array(
            'menu_id' => $row['menu_id'],
            'menu_name' => $row['menu_name'],
            'menu_pic' => $row['menu_pic'],
            'menu_price' => $row['menu_price']
        );
    }

    // แปลง array เป็น JSON string
    $json_data = json_encode($data);

    // แสดง JSON string
    echo $json_data;

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $db = null;

    

    
    $db = null;
}catch(PDOException $e){
    print "". $e->getMessage()."<br/>";
    die();
}


?>