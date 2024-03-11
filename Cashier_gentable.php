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

?>
<div class="navbox" id="navbox">
    <div class="navborderstyle">
        <button class="navbtnall me-2">ทั้งหมด <label class="counter colorGray"><?= $allTable ?></label></button>
        <button class="navbtn me-2">ว่าง <label class="counter colorGreen"><?= $emptyTable ?></label></button>
        <button class="navbtn me-2">จอง <label class="counter colorYellow"><?= $reservedTable ?></label></button>
        <button class="navbtn">ไม่ว่าง <label class="counter colorRed"><?= $occupiedTable ?></label></button>
    </div>
</div>

<?php
try {
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

        ?>
        <div class="smallbox">
            <div class="tinybox_top">
                <div class="box_left_top">
                    <label class="orderid"><?= $table['table_id'] ?></label><br>
                    <label class="tableid">โต๊ะ : <label><?= $table['table_id'] ?></label></label>
                </div>
                <div class="box_right_top <?= ($table['table_status'] == "ว่าง") ? "colorGreen" : (($table['table_status'] == "จอง") ? "colorYellow" : "colorRed") ?>">
                    <p><?= $table['table_status'] ?></p>
                </div>
            </div>
            <hr>

            <div class="tinybox_middle">
                <?php
                if (!empty($order_date_time)) {
                    $order_info = $order_date_time[0];
                    ?>
                    <p><b>ว/ด/ป</b> : <?= $order_date_time[0]['order_date'] ?> <br><b>เวลา : </b><?= $order_date_time[0]['order_time'] ?></p>
                    <p> รวม : <?php echo ($sum == 0) ? 'ไม่มีรายการอาหาร' : $sum . " บาท"; ?></p>
                    <?php
                } else {
                    echo '<p>ยังไม่มีการรับลูกค้า</p>';
                }
                ?>
            </div>
            <div class="tinybox_bottom">
                <a class="btn btn-outline-dark me-2" href="#popup-box-info<?= $table['table_id'] ?>">รายละเอียด</a></button>
                <a class="btn btn-warning" onclick="showmenu('btn_payment_info') ">เช็คบิล</a></button>
            </div>
        </div>

        <div class="modal" id="popup-box-info<?= $table['table_id'] ?>">
            <div class="content" style="overflow: scroll;scrollbar-color: #222222;scrollbar-width: thin; height:fit-content; max-height: 90%;">
                <h3>รายละเอียด</h3>
                <hr>
                <div class="list" id="list-content">
                    <?php
                    foreach ($order as $info) {
                        ?>
                        <div style="display:flex; flex-direction:row;justify-content: space-between;">
                            <p><?= $info['menu_name'] ?> x<?= $info['order_quantity'] ?></p>
                            <p><strong>ราคา <?= $info['order_quantity'] * $info['menu_price'] ?> บาท</strong></p>
                        </div>
                        <?php
                    }
                    ?>
                    <hr>
                    <h3>รวม</h3>
                    <?php
                    if ($sum == 0) {
                        echo '<h5> <strong> ไม่มีรายการอาหาร </strong> </h5>';
                    } else {
                        echo '<h5> <strong>' . $sum . " บาท" . ' </strong> </h5>';
                    }
                    ?>
                    <hr>
                </div>
                <a class="box-close" href="#">
                    x
                </a>
            </div>
        </div>
        <?php
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>