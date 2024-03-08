<?php
include('backEnd/includes/connectDB.php');
$get_table_info = $db->prepare("SELECT `table_id`, `table_status` FROM `Tables`");
$get_table_info->execute();
$get_tables = $get_table_info->fetchAll(PDO::FETCH_ASSOC);

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
}

echo '<div class="navbox" id="navbox">';
echo '<div class="navborderstyle">';
echo '<button class="navbtn">ว่าง <label class="counter colorGreen">' . $emptyTable . '</label></button>';
echo '<button class="navbtn">จอง <label class="counter colorYellow">' . $reservedTable . '</label></button>';
echo '<button class="navbtn">ไม่ว่าง <label class="counter colorRed">' . $occupiedTable . '</label></button>';
echo '</div>';
echo '</div>';

try {
    // Loop through the data and generate the HTML structure
    foreach ($get_tables as $table) {
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
        echo '<p>วันที่ :</p>';
        echo '<p>เวลา :</p>';
        echo '<p>รวม :</p>';
        echo '</div>';
        echo '<div class="tinybox_bottom">';
        echo '<button class="btnstyle" style="margin-right:20px;"><a class="descripAhref" href="#popup-box-pay">แสดงรายละเอียด</a></button>';
        echo '<button class="btnstyle"><a class="descripAhref" onclick="showmenu(\'btn_payment_info\')">เช็คบิล</a></button>';
        echo '</div>';
        echo '</div>';
    }
} catch (PDOException $e) {
    // If an error occurs, display the error message
    echo "Error: " . $e->getMessage();
}

?>

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