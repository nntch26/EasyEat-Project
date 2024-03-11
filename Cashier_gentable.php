<?php
include('backEnd/includes/connectDB.php');
$get_table_info = $db->prepare("SELECT `table_id`, `table_status` FROM `Tables`");
$get_table_info->execute();
$get_tables = $get_table_info->fetchAll(PDO::FETCH_ASSOC);



$allTable = 0;
$emptyTable = 0;
$occupiedTable = 0;
$reservedTable = 0;

foreach ($get_tables as $check_status) {
    if ($check_status['table_status'] == "ว่าง") {
        $emptyTable++;
    } elseif ($check_status['table_status'] == "ไม่ว่าง") {
        $occupiedTable++;
    } elseif ($check_status['table_status'] == "จอง") {
        $reservedTable++;
    }
    $allTable++;
}

echo '<div class="navbox" id="navbox">';
echo '<div class="navborderstyle">';
echo '<button class="navbtn">ทั้งหมด <label class="counter colorGray">' . $allTable . '</label></button>';
echo '<button class="navbtn">ว่าง <label class="counter colorGreen">' . $emptyTable . '</label></button>';
echo '<button class="navbtn">จอง <label class="counter colorYellow">' . $reservedTable . '</label></button>';
echo '<button class="navbtn">ไม่ว่าง <label class="counter colorRed">' . $occupiedTable . '</label></button>';
echo '</div>';
echo '</div>';

try {
    // Loop through the data and generate the HTML structure
    foreach ($get_tables as $table) {
        $sum = 0;
        $get_order = $db->prepare("SELECT Menus.menu_name, Menus.menu_price, Orders.order_quantity FROM Orders JOIN Menus ON Orders.menu_id = Menus.menu_id WHERE table_id = :id");
        $get_order->bindParam(':id', $table['table_id']);
        $get_order->execute();
        $order = $get_order->fetchAll(PDO::FETCH_ASSOC);
        foreach ($order as $forsum) {
            $sum += $forsum['order_quantity'] * $forsum['menu_price'];
        }

        $date_time = $db->prepare("SELECT order_date, order_time FROM Orders WHERE table_id = :id ORDER BY order_date ASC, order_time ASC LIMIT 1");
        $date_time->bindParam(':id', $table['table_id']);
        $date_time->execute();
        $order_date_time = $date_time->fetchAll(PDO::FETCH_ASSOC);

        echo '<div class="smallbox">';
        echo '<div class="tinybox_top">';
        echo '<div class="box_left_top">';
        echo '<label class="orderid">' . $table['table_id'] . '</label><br>';
        echo '<label class="tableid">โต๊ะ : <label>' . $table['table_id'] . '</label></label>';
        echo '</div>';
        echo '<div class="box_right_top ';
        if ($table['table_status'] == "ว่าง") {
            echo "colorGreen";
        } else if ($table['table_status'] == "จอง") {
            echo "colorYellow";
        } else if ($table['table_status'] == "ไม่ว่าง") {
            echo "colorRed";
        }
        echo '">';
        echo '<p>' . $table['table_status'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="tinybox_middle">';    
        if (!empty($order_date_time)) {
            $order_info = $order_date_time[0];
            echo '<p>วันที่ : ' . $order_date_time[0]['order_date'] . '</p>';
            echo '<p>เวลา : ' . $order_date_time[0]['order_time'] . '</p>';
            echo '<p>รวม : ';
            if ($sum == 0) {
                echo '<strong> ไม่มีรายการอาหาร </strong>';
            } else {
                echo '<strong>' . $sum . " บาท" . ' </strong>';
            }
            echo '</p>';
        }else {
            echo '<p>ยังไม่มีการจอง.</p>';
        }
        echo '</div>';
        echo '<div class="tinybox_bottom">';
        echo '<button class="btnstyle" style="margin-right:20px;"><a class="descripAhref" href="#popup-box-info' . $table['table_id'] . '">แสดงรายละเอียด</a></button>';
        echo '<button class="btnstyle"><a class="descripAhref" onclick="showmenu(\'btn_payment_info\')">เช็คบิล</a></button>';
        echo '</div>';
        echo '</div>';

        echo '<div class="modal" id="popup-box-info' . $table['table_id'] . '">';
        echo '<div class="content" style="overflow: scroll;scrollbar-color: #222;scrollbar-width: thin; height:fit-content; max-height: 90%;" >';
        echo '<h3>รายละเอียด</h3>';
        echo '<hr>';
        echo '<div class="list" id="list-content">';
        foreach ($order as $info) {
            echo '<div style="display:flex; flex-direction:row;justify-content: space-between;">';
            echo '<p>' . $info['menu_name'] . " x" . $info['order_quantity'] . '</p>';
            echo "<p> <strong>ราคา " . $info['order_quantity'] * $info['menu_price'] . " บาท" . '</strong> </p>';
            echo '</div>';
        }
        echo '<hr>';
        echo '<h3>รวม</h3>';
        if ($sum == 0) {
            echo '<h5> <strong> ไม่มีรายการอาหาร </strong> </h5>';
        } else {
            echo '<h5> <strong>' . $sum . " บาท" . ' </strong> </h5>';
        }
        echo '<hr>';
        echo '</div>';
        echo '<a class="box-close" href="#">';
        echo 'x';
        echo '</a>';
        echo '</div>';
        echo '</div>';
    }
} catch (PDOException $e) {
    // If an error occurs, display the error message
    echo "Error: " . $e->getMessage();
}

?>

<!-- <div class="modal" id="popup-box-info">
    <div class="content">
        <h3>รายละเอียด</h3>
        <hr>
        <div class="list" id="list-content">
            <p>กล้วย</p>
            <p>มาม่า</p>
            <p>ส้ม</p>
            <hr>
            <h3>รวม</h3>
            <p>เป็นล้านเลยพี่</p>
            <hr>
        </div>
        <a class="box-close" href="#">
            x
        </a>
    </div>
</div> -->


<!-- สำรอง

<div class="navbox" id="navbox">
                    <div class="navborderstyle">
                        <button class="navbtn">ว่าง <label class="counter colorBlack">5</label></button>
                        <button class="navbtn">ไม่ว่าง <label class="counter colorGray">4</label></button>
                        <button class="navbtn">จอง <label class="counter colorYellow">3</label></button>
                    </div>
                </div>

<div class="smallbox">
    <div class="tinybox_top">
        <div class="box_left_top">
            <label class="orderid">1</label>
            <br>
            <label class="tableid">โต๊ะ : <label>A01</label></label>
        </div>
        <div class="box_right_top colorGray">
            <p>ว่าง</p>
        </div>
    </div>
    <div class="tinybox_middle">
        <p>วันที่ :</p>
        <p>เวลา :</p>
        <p>รวม :</p>
    </div>
    <div class="tinybox_bottom">
        <button class="btnstyle"><a class="descripAhref" href="#popup-box-pay">แสดงรายละเอียด</a></button>
        <button class="btnstyle"><a class="descripAhref" onclick="showmenu('btn_payment_info')">เช็คบิล</a></button>
    </div>
</div> -->