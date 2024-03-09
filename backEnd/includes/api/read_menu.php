<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include '../connectDB.php';

try{
    $menus = array();
    foreach($db->query('SELECT * from Menus') as $row){
        $menu = array(
            'id' => $row['menu_id'],
            'name' => $row['menu_name'],
            'price' => $row['menu_price'],
            'type' => $row['menu_type'],
            'pic' => $row['menu_pic']
        );
        array_push($menus, $menu);
    }
    echo json_encode($menus);
    $db = null;
}catch(PDOException $e){
    print "". $e->getMessage()."<br/>";
    die();
}


?>