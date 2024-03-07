<?php
include('../backend/includes/connectDB.php');


    $menuQuery = "SELECT menu_id, menu_name, menu_price, menu_type, menu_pic FROM Easyeat.Menus";

    if (isset($_GET['btn1'])) {
        $menuQuery .= " WHERE menu_type = 'ทานเล่น'";
    } else if (isset($_GET['btn2'])) {
        $menuQuery .= " WHERE menu_type = 'กับข้าว'";
    } else if (isset($_GET['btn3'])) {
        $menuQuery .= " WHERE menu_type = 'อาหารจานเดียว'";
    } else if (isset($_GET['btn4'])) {
        $menuQuery .= " WHERE menu_type = 'แกง'";
    } else if (isset($_GET['btn5'])) {
        $menuQuery .= " WHERE menu_type = 'ขนมหวาน'";
    } else if (isset($_GET['btn6'])) {
        $menuQuery .= " WHERE menu_type = 'เครื่องดื่ม'";
    }

    $sql = $db->prepare($menuQuery);
    $sql->execute();

    return $sql;




?>
