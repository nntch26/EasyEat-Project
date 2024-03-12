<?php

include('backEnd/includes/connectDB.php');
$get_table_info = $db->prepare("SELECT * FROM `Tables`");
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

echo '<div class="title_top">';
echo '<h2>ระบบจัดการโต๊ะ</h2>';
echo '</div>';
echo '<div class="navbox" id="navbox">';
echo '<div class="navborderstyle">';
echo '<button class="navbtnall me-2">ทั้งหมด <label class="counter colorGray">' . $allTable . '</label></button>';
echo '<button class="navbtn me-2">ว่าง <label class="counter colorGreen">' . $emptyTable . '</label></button>';
echo '<button class="navbtn me-2">จอง <label class="counter colorYellow">' . $reservedTable . '</label></button>';
echo '<button class="navbtn">ไม่ว่าง <label class="counter colorRed">' . $occupiedTable . '</label></button>';
echo '</div>';
echo '</div>';

try {
    foreach ($get_tables as $table) {
        $get_reservinfo = $db->prepare("SELECT * FROM Reservations WHERE table_id = :id ORDER BY res_date DESC, res_time DESC LIMIT 1;");
        $get_reservinfo->bindParam(':id', $table['table_id']);
        $get_reservinfo->execute();
        $reservinfo = $get_reservinfo->fetch(PDO::FETCH_ASSOC);

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
        echo '<hr>';
        echo '<div class="tinybox_bottom">';
        if ($table['table_status'] == 'ไม่ว่าง') {
            echo '<a class="btn btn-outline-secondary me-3 disabled" href="#">รับลูกค้า</a>';
        } else if ($table['table_status'] == 'ว่าง') {
            echo '<a class="btn btn-warning me-3" href="#popup-box-table' . $table['table_id'] . '">รับลูกค้า</a>';
        } else if ($table['table_status'] == 'จอง'){
            echo '<a class="btn btn-warning me-3" href="#popup-box-reservinfo' . $table['table_id'] . '">ข้อมูลคนจอง</a>';
            echo '<a class="btn btn-warning me-3" href="#popup-box-table1.5' . $table['table_id'] . '">แสดง QR</a>';
        }
        echo '<a class="';
        if ($table['table_status'] == "จอง") {
            echo "btn btn-outline-danger";
        } else {
            echo "btn btn-outline-secondary disabled";
        }
        echo '" href="#" id="cancelButton' . $table['table_id'] . '">ยกเลิก</a></button>';
        echo '</div>';
        echo '</div>';

        echo '<div class="modal" id="popup-box-table' . $table['table_id'] . '">';
?>
        <div class="content">
            <h3>โต๊ะที่ : <?php echo $table['table_id'] ?></h3>
            <label style="color: red">*จำนวนคนที่รองรับในโต็ะ : <?php echo $table['table_cap'] ?> </label>
            <hr>
            <div class="list">
                <label>จำนวนคน : </label>
                <input style="width: 15%; font-size: 18px;" type="number">
                <hr>
                <a class="btn btn-success" id="orderButton<?php echo $table['table_id']; ?>">สั่งอาหาร</a>
            </div>
            <a class="box-close" href="#">
                x
            </a>
        </div>
        </div>

        <div class="modal" id="popup-box-reservinfo<?php echo $table['table_id']; ?>">
            <div class="content">
                <h3>รายละเอียดการจอง โต็ะ <?php echo $table['table_id']; ?></h3>
                <hr>
                <div class="list">
                    <?php
                    if (empty($reservinfo)) {
                        echo "<label> รับลูกค้าหน้าร้าน </label>";
                    } else {
                        echo "<label> Reservation ID: " . $reservinfo['res_id'] . "</label> <br>";
                        echo "<label> Customer Name: " . $reservinfo['cus_fname'] . " " . $reservinfo['cus_lname'] . "</label> <br>";
                        echo "<label> Customer Tel.: " . $reservinfo['cus_phone'] . "</label> <br>";
                        echo "<label> Reservation Cap: " . $reservinfo['res_cap'] . "</label> <br>";
                        echo "<label> Reservation Date: " . $reservinfo['res_date'] . "</label> <br>";
                        echo "<label> Reservation Time" . $reservinfo['res_time'] . "</label> <br>";
                    }
                    ?>
                </div>
                <a class="box-close" href="#">
                    x
                </a>
            </div>
        </div>

        <div class="modal" id="popup-box-table1.5<?php echo $table['table_id']; ?>">
            <div class="content">
                <h3>QR Code สำหรับโต็ะ <?php echo $table['table_id']; ?></h3>
                <hr>
                <div class="list" style="text-align: center;">
                    <?php echo '<img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=http://10.0.15.21/it/65070117/G-09-EasyEat/order-menu.php?table_id=' . $table['table_id'] . '"/>'; ?>
                </div>
                <a class="box-close" href="#">
                    x
                </a>
            </div>
        </div>
<?php
    }
} catch (PDOException $e) {
    // If an error occurs, display the error message
    echo "Error: " . $e->getMessage();
}
?>

<script>
    // JavaScript function to handle cancel button click
    <?php foreach ($get_tables as $table) : ?>
        document.getElementById('cancelButton<?php echo $table['table_id']; ?>').addEventListener('click', function(event) {
            event.preventDefault(); // ป้องกันการกระทำเริ่มต้นของลิงก์

            // เพิ่มเงื่อนไขเช็คสถานะของโต๊ะ
            <?php if ($table['table_status'] == "จอง") : ?>
                // เงื่อนไขที่ต้องทำงานเมื่อสถานะไม่ใช่ "ว่าง"
                var tableId = '<?php echo $table['table_id']; ?>';
                var confirmation = confirm('ยืนยันการยกเลิกโต๊ะหมายเลข ' + tableId + ' ?');
                if (confirmation) {
                    // Send AJAX request to update table status
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'backEnd/cancel_reserv.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status == 200) {
                            location.reload();
                        } else {
                            alert('เกิดข้อผิดพลาดในการอัปเดตสถานะโต๊ะ');
                        }
                    };
                    xhr.send('table_id=' + tableId);
                }
            <?php endif; ?>
        });
    <?php endforeach; ?>

    <?php foreach ($get_tables as $table) : ?>
        document.getElementById('orderButton<?php echo $table['table_id']; ?>').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of the link

            // Check if the table status is "ว่าง" or "จอง"
            <?php if ($table['table_status'] == "ว่าง" || $table['table_status'] == "จอง") : ?>
                var tableId = '<?php echo $table['table_id']; ?>';
                var confirmation = confirm('ยืนยันการรับลูกค้าที่โต๊ะหมายเลข ' + tableId + ' ?');
                if (confirmation) {
                    // Send AJAX request to update table status
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'backEnd/changestatus.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onload = function() {
                        if (xhr.status == 200) {
                            // Reload the page after successful update
                            location.reload();
                        } else {
                            alert('เกิดข้อผิดพลาดในการอัปเดตสถานะโต๊ะ');
                        }
                    };
                    xhr.send('table_id=' + tableId);
                }
            <?php endif; ?>
        });
    <?php endforeach; ?>
</script>