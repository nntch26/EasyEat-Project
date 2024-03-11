<?php

global $db;
include('backend/includes/connectDB.php');
session_start();

$tableid = "A04";

$sql1 = $db->prepare("SELECT DISTINCT Bills.Bill_id, Orders.table_id, Orders.order_status,Bills.bill_status
                     FROM Orders
                     JOIN Menus ON Orders.menu_id = Menus.menu_id
                     LEFT JOIN Bills ON Orders.Bill_id = Bills.Bill_id
                     WHERE Orders.table_id  = :table_id;");
// table id เปลี่ยนตามโต๊ะที่สั่งอาหาร

$sql1->bindParam(':table_id', $tableid);
$sql1->execute();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้ารออาหาร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\preparemenu-styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>


<script>
    function opendetail(detailId) {
        console.log(detailId)
        var detail = document.getElementById(detailId);
        if (detail.style.width == "100%") {
            detail.style.width = "0";
            detail.style.height = "0";
        } else {
            detail.style.width = "100%";
            detail.style.height = "100%";
        }
    }

    function refreshPage() {
        location.reload();
    }


</script>

<div class="topbar">
    <div class="undo">
        <a href="order-menu.html"><ion-icon name="chevron-back-outline"></ion-icon></a>
    </div>
    <div class="topic">
        <h5 class="panels">หน้ารออาหาร</h5>
    </div>
    <div class="topichead">
        <label class="easy">EasyEat</label>
    </div>
</div>

<div class="headbar">
    <div class="leftbar">
        <button class="btn btn-secondary" type="button" onclick="refreshPage()"><i class="bi bi-arrow-repeat"></i></button>
    </div>
    <div class="rightbar">
        <!-- <button class="btn btn-secondary" type="button"><i class="bi bi-arrow-repeat"></i></button> -->
        <a href="order-menu.php" class="btn btn-primary" type="button"><i class="bi bi-plus-lg"></i> เพิ่มออเดอร์</a>
    </div>
</div>

<div class="main">
    <div class="container">

        <!------ alert ----->


        <!-- สำเร็จ -->
        <?php
        if (isset($_SESSION['order_cancel'])) : ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['order_cancel']; ?>
            </div>
        <?php
        endif; ?>

        <!-- สมัครไม่สำเร็จ -->
        <?php
        if (isset($_SESSION['err_cancel'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['err_cancel']; ?>
            </div>
        <?php
        endif; ?>



        <?php while ($row1 = $sql1->fetch(PDO::FETCH_ASSOC)) :
            $status = $row1['bill_status'];
            // เช็คสถานะแต่ละรายการอาหาร

            if ($status == 'pending') { // รอการตอบรับออเดอร์
                $btnClass = 'btn-warning';
                $btnCancel = 'btn-outline-danger';
                $textLabel = ' อยู่ในครัว';
                $detailId = 'detail';
                $gifClass = 'gif1';
                $gifSrc = 'pic\55687e10bd871de7.gif';

            } elseif ($status == 'ordered') { // รอพ่อครัวทำอาหาร

                $btnClass = 'btn-info';
                $btnCancel = 'btn-secondary disabled';
                $textLabel = ' กำลังทำอาหาร';
                $detailId = 'detail';
                $gifClass = 'gif2';
                $gifSrc = 'pic\a15083b4e5446356.gif';

            } elseif ($status == 'finised') { // พ่อครัวทำอาหารเสร็จแล้ว
                $btnClass = 'btn-success';
                $btnCancel = 'btn-secondary disabled';
                $textLabel = ' พร้อมเสิร์ฟ';
                $detailId = 'detail';
                $gifClass = 'gif2';
                $gifSrc = 'pic\dc9c997833496937.gif';

            } elseif ($status == 'cancel') { // ยกเลิกรายการอาหาร
                $btnClass = 'btn-danger';
                $btnCancel = 'btn-secondary disabled';
                $textLabel = ' ถูกปฏิเสธ';
                $detailId = 'detail';
                $gifClass = 'gif1';
                $gifSrc = 'pic\9dc9419fe50d3e5a.gif';

            }
            ?>

            <div class="box">
                <div class="smallbox">

                    <div class="process">
                        <img class="<?php echo $gifClass; ?>" src="<?php echo $gifSrc; ?>">
                    </div>

                    <div class="right">

                        <div class="cancel">
                            <button type="button" class="btn <?php echo $btnCancel; ?>" data-bs-toggle="modal" data-bs-target="#CancelModal<?php echo $row1['Bill_id']; ?>">
                                ยกเลิก
                            </button>
                        </div>

                        <div class="number">
                            <h5>#<?php echo $row1['Bill_id']; ?></h5>
                            <h5>โต๊ะที่ <?php echo $row1['table_id']; ?></h5>
                        </div>

                        <div class="butt">
                            <label class="btn <?php echo $btnClass; ?>" for="">
                                <i class="bi bi-chat-text"></i><?php echo $textLabel; ?>
                            </label>

                            <label class="btn btn-dark" for="" onclick="opendetail('detail<?php echo $row1['Bill_id']; ?>')">รายละเอียด</label>

                        </div>
                    </div>
                </div>

                <!--แสดงรายการอาหารทั้งหมด รวมยอดทั้งหมด--->

                <div class="detail mt-3" id="detail<?php echo $row1['Bill_id']; ?>">

                    <?php
                    $sql2 = $db->prepare("SELECT * FROM Orders
                                                    JOIN Menus ON Orders.menu_id = Menus.menu_id
                                                    LEFT JOIN Bills ON Orders.Bill_id = Bills.Bill_id
                                                    WHERE Bills.Bill_id = :Bill_id");
                    $sql2->bindParam(':Bill_id', $row1['Bill_id']);

                    $sql2->execute();

                    $total = 0;

                    while ($row2 = $sql2->fetch(PDO::FETCH_ASSOC)) :
                        $total += $row2['menu_price'] * $row2['order_quantity'];

                        ?>

                        <div class="order">
                            <div class="de-left">
                                <label for=""><?php echo $row2['menu_name']; ?></label>
                                <label for="">x <?php echo $row2['order_quantity']; ?> จำนวน</label>
                            </div>
                            <label class="de-right" for=""><?php echo $row2['menu_price']; ?> ราคา</label>
                        </div>
                    <?php endwhile; ?>
                    <hr>

                    <div class="order">
                        <div class="de-left">
                            <label for="">รวมทั้งหมด</label>
                        </div>
                        <label class="de-right" for=""><?php echo $total ; ?> ราคา</label>
                    </div>

                </div>
            </div>


            <!-- Modal  ยืนยันการยกเลิกออเดอร์ -->

            <div class="modal fade" id="CancelModal<?php echo $row1['Bill_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title">ยืนยันการยกเลิก</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 class="mb-3 text-center" style="color: crimson;">คุณต้องการยกเลิกรายการอาหารทั้งหมดนี้ ใช่หรือไม่?</h4>
                            <h5>#<?php echo $row1['Bill_id']; ?></h5>
                            <h5>โต๊ะที่ <?php echo $row1['table_id']; ?></h5>
                        </div>
                        <div class="modal-footer">
                            <form action="backEnd/cancel_order.php" method="post">
                                <input type="hidden" name="Bill_id" value="<?php echo ($row1['Bill_id']); ?>">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                <button type="submit" class="btn btn-danger" name="cancelbtn">ยืนยัน</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>




    </div>
</div>
</body>
</html>

<?php
if (isset($_SESSION['order_cancel']) || isset($_SESSION['err_cancel'])) {
    unset($_SESSION['err_cancel']);
    unset($_SESSION['order_cancel']);

}


?>
