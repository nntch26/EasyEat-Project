<?php

include('../backend/includes/connectDB.php');
$sql = $db->prepare("SELECT * FROM Payments");
$sql->execute();
?>



<div class="container">
    <div class="row">

        <div class="text-header">
            <h1>รายงานประวัติการขาย</h1>
        </div>

        <div class="content-table">
            <div style="height: 100%; overflow: auto;">
                <table id="dataTable3" class="table table-striped" style="width:100%; text-align: left;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>หมายเลขใบเสร็จ</th>
                            <th>หมายเลขโต๊ะ</th>
                            <th>วันที่ทำรายการ</th>
                            <th>เวลาที่ทำรายการ</th>
                            <th>ราคารวม</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row= $sql->fetch(PDO::FETCH_ASSOC)):

                    ?>

                        <tr>
                            <td><?php echo $row['payment_id'] ?></td>
                            <td><?php echo $row['Bill_id'] ?></td>
                            <td><?php echo $row['table_id'] ?></td>
                            <td><?php echo $row['payment_date'] ?></td>
                            <td><?php echo $row['payment_time'] ?></td>
                            <td><?php echo $row['payment_total'] ?></td>

                            <td>
                                <a class="btn btn-info"
                                   href="../Cashier_payment.php?table_id=<?= $row['table_id'] ?>">
                                    <i class="fs-5 bi bi-eye-fill"></i>
                                    <span class="ms-1">เรียกดู</span>
                                </a>
                            </td>


                        </tr>



                    <?php endwhile ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>

<!--- DataTable --->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>

<script>


    $(document).ready(function() {
        $('#dataTable3').DataTable( {
            "language": {
                "lengthMenu": "แสดงข้อมูล  _MENU_  แถว",
                "zeroRecords": "ไม่พบอะไรเลย - ขออภัย",
                "info": "แสดงหน้า  _PAGE_ จาก _PAGES_",
                "infoEmpty": "ไม่มีข้อมูลในระบบ",
                "infoFiltered": "(กรองจากข้อมูลทั้งหมด _MAX_ รายการ)",
                "search": "ค้นหา :"
            }


        } );
    } );
</script>