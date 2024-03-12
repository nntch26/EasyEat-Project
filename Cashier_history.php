<?php
include('backEnd/includes/connectDB.php');
$get_payment_info = $db->prepare("SELECT * FROM Payments");
$get_payment_info->execute();
$payment_info = $get_payment_info->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>ประวัติการขาย</h2>

<table id="dataTable" class="table table-striped" style="width:100%;">
    <thead>
    <tr>
        <th>ID</th>
        <th>Bill ID</th>
        <th>วันที่ทำรายการ</th>
        <th>เวลาที่ทำรายการ</th>
        <th>ราคารวม</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($payment_info as $row) {
        echo '<tr>';
        echo '<td>'. $row['payment_id'] .'</td>';
        echo '<td>'. $row['Bill_id'] . '</td>';
        echo '<td>'. $row['payment_date'] .'</td>';
        echo '<td>'. $row['payment_time'] .'</td>';
        echo '<td>'. $row['payment_total'] .'</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>

