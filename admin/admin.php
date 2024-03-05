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

    <link rel="stylesheet" href="admin_style.css">

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
                        <a href="#" class="nav-link" onclick="showmenu('btnhome')">
                            <i class="fs-5 bi bi-bar-chart-fill"></i><span class="ms-1">รายงานผล</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showmenu('btnfoodmenu')">
                            <i class="fs-5 bi-grid"></i><span class="ms-1">จัดการเมนูอาหาร</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showmenu('btnmember')">
                            <i class="fs-5 bi bi-people-fill"></i><span class="ms-1">จัดการระบบสมาชิก</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showmenu('btnsale')">
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


                    <!-- ส่วนสรุปผล --->
                    <div class="content-das">
                        <div class="show1 col-3 me-3">
                            <h3>ยอดขาย</h3>
                            <h6>ทั้งหมด 188,365.00 บาท</h6>

                        </div>

                        <div class="show2 col-3 me-3">
                            <h3>จำนวนบิล</h3>
                            <h6>418.00 รายการ</h6>


                        </div>

                        <div class="show3 col-3 me-3">
                            <h3>จำนวนอาหาร</h3>
                            <h6>36 รายการ</h6>


                        </div>

                        <div class="show4 col-3">
                            <h3>สมาชิกทั้งหมด</h3>
                            <h6>205 คน</h6>


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
                                            <th>Address</th>
                                            <th>Location</th>
                                            <th>Postcode</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>


                                        </tr>

                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>



                                        </tr>

                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>



                                        </tr>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        

       

        <div class="col py-3 foodmenu" id="foodmenu">
            Content area...1
        </div>

        <div class="col py-3 member" id="member">

            <?php include("admin_member.php"); ?>

        </div>

        <div class="col py-3 sale" id="sale">
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

</body>
</html>
