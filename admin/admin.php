<?php

global $db;
include('../backend/includes/connectDB.php');

$menu = $db->prepare("SELECT COUNT(menu_id) AS count_menu FROM Easyeat.Menus;");
$user = $db->prepare("SELECT COUNT(user_id) AS count_users FROM Easyeat.Users;");
$bill = $db->prepare("SELECT COUNT(Bill_id) AS count_bill FROM Easyeat.Bills;");

$menu->execute();
$user->execute();
$bill->execute();

$rowMenu = $menu->fetch(PDO::FETCH_ASSOC);
$rowUser = $user->fetch(PDO::FETCH_ASSOC);
$rowBill = $bill->fetch(PDO::FETCH_ASSOC);

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าระบบจัดการ</title>

    <!--- stylesheet --->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!--- DataTable --->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.css">
    
    <link rel="stylesheet" href="adminStyle/admin_style.css">

    <!--- fonts.google --->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">



</head>
<body>

<div class="container-fluid">
    <div class="row vh-100 overflow-auto">

        <!-- narbar --->
        <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-dark d-flex sticky-top">

            <div class="d-flex flex-sm-column align-items-center px-3 pt-2 text-white">

                <a href="#home" class="text-decoration-none mt-3" style="color: #ff7b00;" onclick="showmenu('btnhome')">
                    <i class="bi bi-person-fill-gear" style="font-size: 32px;"></i>
                    <span class="ms-2" style="font-size: 28px;">ระบบจัดการ</span>
                </a>

                <hr class="mb-3" style="width: 100%; border-width: 2px;">

                <ul class="nav">
                    <li class="nav-item">
                        <a href="#home" class="nav-link" onclick="showmenu('btnhome')">
                            <i class="fs-5 bi bi-bar-chart-fill"></i><span class="ms-1">รายงานผล</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#menu" class="nav-link" onclick="showmenu('btnfoodmenu')">
                            <i class="fs-5 bi-grid"></i><span class="ms-1">จัดการเมนูอาหาร</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="#member" class="nav-link" onclick="showmenu('btnmember')">
                            <i class="fs-5 bi bi-people-fill"></i><span class="ms-1">จัดการระบบสมาชิก</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#sale" class="nav-link" onclick="showmenu('btnsale')">
                            <i class="fs-5 bi bi-table"></i><span class="ms-1">ดูประวัติการขาย</span>
                        </a>
                    </li>

                    <hr class="mt-5" style="width: 100%; border-width: 2px;">


                    <li class="nav-item">
                        <a href="../backEnd/logout.php" class="nav-link">
                            <i class="fs-5 bi bi-box-arrow-in-right"></i><span class="ms-1">ออกจากระบบ</span>
                        </a>
                    </li>
                </ul>

            </div>


        </div>

        <!-- content --->

        <div class="col py-3 dashboard" id="home">
            <div class="container">
                <div class="row">

                    <div class="text-header">
                        <h1>รายงานผลทั้งหมด</h1>
                    </div>

                     <!------ alert ----->

                        <!-- อัพเดทข้อมูลสำเร็จ -->
                        <?php
                        if (isset($_SESSION['profile_update'])) : ?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['profile_update']; ?>
                            </div>
                        <?php
                        endif; ?>

                        <!-- อัพเดทข้อมูลเมนูสำเร็จ -->
                        <?php
                        if (isset($_SESSION['menu_update'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['menu_update']; ?>
                            </div>
                        <?php
                        endif; ?>

                         <!-- ลบข้อมูลสำเร็จ -->
                         <?php
                        if (isset($_SESSION['profile_delete'])) : ?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['profile_delete']; ?>
                            </div>
                        <?php
                        endif; ?>

                        <!-- ข้อมูลซ้ำ -->
                        <?php
                        if (isset($_SESSION['error_chck'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['error_chck']; ?>
                            </div>
                        <?php
                        endif; ?>


                        <!-- อัพเดทข้อมูลไม่สำเร็จ -->
                        <?php
                        if (isset($_SESSION['err_update'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo $_SESSION['err_update']; ?>
                            </div>
                        <?php
                        endif; ?>

                        <!-- ลบข้อมูลไม่สำเร็จ -->
                        <?php
                        if (isset($_SESSION['err_delete'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo $_SESSION['err_delete']; ?>
                            </div>
                        <?php
                        endif; ?>





                    <!-- ส่วนสรุปผล --->
                    <div class="content-das">
                        <div class="show1 col-3 me-3">
                            <h3>ยอดขาย</h3>
                            <h6>ทั้งหมด 188,365.00 บาท</h6>

                        </div>

                        <div class="show2 col-3 me-3">
                            <h3>จำนวนบิล</h3>
                            <h6><?php echo $rowBill['count_bill'] ?> รายการ</h6>


                        </div>

                        <div class="show3 col-3 me-3">
                            <h3>จำนวนอาหาร</h3>
                            <h6><?php echo $rowMenu['count_menu'] ?> รายการ</h6>


                        </div>

                        <div class="show4 col-3">
                            <h3>สมาชิกทั้งหมด</h3>
                            <h6><?php echo $rowUser['count_users'] ?> คน</h6>


                        </div>

                    </div>

                    <!-- ตารางข้อมูล --->
                    <div class="content-das2">
                        
                        <!-- รายการอาหาร --->

                        <div class="content-table col-5 me-3 ">
                            <div style="height: 100%; overflow: auto;">

                                <div class="title d-flex mb-3">
                                    <h3>รายการอาหาร</h3>

                                    <a href="" class="ms-4">
                                        <button type="button" class="btn btn-warning">
                                            <i class="fs-5 bi bi-eye-fill"></i>
                                            <span class="ms-1">ทั้งหมด</span>
                                        </button>
                                    </a>
                                </div>


                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Phone</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>



                                        </tr>

                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>




                                        </tr>

                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>




                                        </tr>


                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <!-- ระบบสมาชิก --->

                        <div class="content-table col-7">
                            <div style="height: 100%; overflow: auto;">

                                <div class="title d-flex mb-3">
                                    <h3>ระบบสมาชิก</h3>

                                    <a href="#" class="ms-4" onclick="showmenu('btnmember')">
                                        <button type="button" class="btn btn-warning">
                                            <i class="fs-5 bi bi-eye-fill"></i>
                                            <span class="ms-1">ทั้งหมด</span>
                                        </button>
                                    </a>
                                </div>


                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>รหัส</th>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>ชื่อผู้ใช้</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>คะแนนสะสม</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sqlUser = $db->prepare("SELECT * FROM Users WHERE user_role = 'Member' LIMIT 5");
                                    $sqlUser->execute();

                                    while ($rowUser= $sqlUser->fetch(PDO::FETCH_ASSOC)) :


                                    ?>

                                    <tr>
                                        <td><?php echo $rowUser['user_id'] ?></td>
                                        <td><?php echo $rowUser['user_fname']." ".$rowUser['user_lname'] ?></td>
                                        <td><?php echo $rowUser['user_username'] ?></td>
                                        <td><?php echo $rowUser['user_phonenum'] ?></td>
                                        <td><?php echo $rowUser['user_points'] ?></td>
                                    </tr>

                                <?php endwhile ?>

                                </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        

       

        <div class="col foodmenu" id="foodmenu">
            <?php include("admin_menu.php"); ?>
        </div>

        <div class="col member" id="member">

            <?php include("admin_member.php"); ?>

        </div>

        <div class="col sale" id="sale">
        Content area...4
            <?php include("admin_sale.php"); ?>
            
        </div>


    </div>

</div>


<!-- script เปลี่ยนหน้า --->

<script>
    function showmenu(btnvalue) {
        var home = document.getElementById("home");
        var foodmenu = document.getElementById("foodmenu");
        var member = document.getElementById("member");
        var sale = document.getElementById("sale");

        foodmenu.style.display = "none";
        member.style.display = "none";
        sale.style.display = "none";

        if (btnvalue == "btnfoodmenu") {
            foodmenu.style.display = "block";
            home.style.display = "none";

        } else if (btnvalue == "btnmember") {
            member.style.display = "block";
            home.style.display = "none";

        } else if (btnvalue == "btnhome") {
            home.style.display = "block";

        } else if (btnvalue == "btnsale") {
            sale.style.display = "block";
            home.style.display = "none";
        }
    }
</script>

<!--- DataTable --->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>

<script>


    $(document).ready(function() {
    $('#dataTable').DataTable( {
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


</body>
</html>

<?php
 $db = null;

// ล้าง session 

 if (isset($_SESSION['profile_update']) 
 || isset($_SESSION['error_chck']) || isset($_SESSION['err_update']) 
 || isset($_SESSION['profile_delete']) ||isset($_SESSION['err_delete'])
 || isset($_SESSION['menu_update'])) {

    unset($_SESSION['error_chck']);
    unset($_SESSION['err_update']);
    unset($_SESSION['profile_update']);
    unset($_SESSION['profile_delete']);
    unset($_SESSION['err_delete']);
    unset($_SESSION['menu_update']);

}
?>
