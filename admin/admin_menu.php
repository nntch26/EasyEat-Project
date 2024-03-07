<?php

include('../backend/includes/connectDB.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
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
    }else if (isset($_GET['btn0'])) {
        $menuQuery .= ";";
    }

    $sql = $db->prepare($menuQuery);
    $sql->execute();
}


?>

<div class="container">
    <div class="row">
        <div class="text-header mb-5">
            <h1>จัดการเมนูอาหาร</h1>
        </div>

        <div class="boxBtn mb-1">
            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="btnadd d-flex">

                    <div class="con-btnAdd me-2">
                        <button type="submit" class="btn btn-dark" name="btn0" >
                            <span class="ms-1">ทั้งหมด</span>
                        </button>
                    </div>

                    <div class="con-btnAdd me-2">
                        <button type="submit" class="btn btn-outline-dark" name="btn1">
                            <span class="ms-1">ทานเล่น</span>
                        </button>
                    </div>
                    <div class="con-btnAdd me-2">
                        <button type="submit" class="btn btn-outline-dark" name="btn2">
                            <span class="ms-1">กับข้าว</span>
                        </button>
                    </div>
                    <div class="con-btnAdd me-2">
                        <button type="submit" class="btn btn-outline-dark" name="btn3">
                            <span class="ms-1">อาหารจานเดียว</span>
                        </button>
                    </div>
                    <div class="con-btnAdd me-2">
                        <button type="submit" class="btn btn-outline-dark" name="btn4">
                            <span class="ms-1">แกง</span>
                        </button>
                    </div>
                    <div class="con-btnAdd me-2">
                        <button type="submit" class="btn btn-outline-dark" name="btn5">
                            <span class="ms-1">ขนมหวาน</span>
                        </button>
                    </div>
                    <div class="con-btnAdd">
                        <button type="submit" class="btn btn-outline-dark" name="btn6">
                            <span class="ms-1">เครื่องดื่ม</span>
                        </button>
                    </div>

                    <div class="con-btnAdd ms-auto">
                        <a href="addMenu.php" class="btn btn-primary btnAdd">
                            <i class="fs-5 bi bi-plus-circle-fill"></i><span class="ms-1">เพิ่มเมนูอาหาร</span>
                        </a>
                    </div>

                </div>
            </form>
        </div>



        <div class="content-table">
            <div style="height: 100%; overflow: auto;">


                <table id="dataTable" class="table table-striped" style="width:100%; text-align: left;">
                    <thead>
                    <tr>
                        <th>รหัส</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อเมนู</th>
                        <th>ราคา</th>
                        <th>ประเภท</th>
                        <th>จัดการ</th>

                    </tr>
                    </thead>
                    <tbody>


                    <?php

                        while ($row= $sql->fetch(PDO::FETCH_ASSOC)) :


                        ?>

                        <tr>
                            <td><?php echo $row['menu_id'] ?></td>
                            <td><img src='../backEnd/menu_img/<?php echo $row['menu_pic'] ?>' style='max-width: 100px; max-height: 100px;'></td>
                            <td><?php echo $row['menu_name'] ?></td>
                            <td><?php echo $row['menu_price'] ?></td>
                            <td><?php echo $row['menu_type']?></td>
                            <td>


                                <button type="button" class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#editProfileModal<?php echo $row['menu_id']; ?>">
                                    <i class="fs-5 bi bi-pencil-square"></i>
                                </button>


                                <button type="button" class="btn btn-danger btnDelete" data-bs-toggle="modal" data-bs-target="#DeleteModal<?php echo $row['menu_id']; ?>">
                                    <i class="fs-5 bi-trash3-fill"></i>
                                </button>



                            </td>
                        </tr>



                        <!---- model แก้ไขข้อมูล ----->

                        <div class="modal fade" id="editProfileModal<?php echo $row['menu_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขเมนูอาหาร</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">

                                        <form action="../backEnd/manage_menu.php" method="post" enctype="multipart/form-data">

                                            <div class="form-outline mb-3 col-md-12">
                                                <label class="form-label">ชื่อเมนูอาหาร</label>
                                                <input type="text" name="menu_name" class="form-control" minlength="3"
                                                       value="<?php echo $row['menu_name'] ?>" required/>
                                            </div>


                                            <div class="form-outline mb-3 col-md-12">
                                                <label class="form-label" for="username">ราคา</label>
                                                <input type="text" name="menu_price" id="username" class="form-control"
                                                       value="<?php echo $row['menu_price'] ?>" required/>
                                            </div>

                                            <div class="col-md-12 ps-0 mb-3">
                                                <label class="form-label">ประเภทอาหาร</label>
                                                <select name="menu_type" class="form-select shadow-none" required>
                                                    <option value="0" selected hidden>---เลือกประเภท---</option>
                                                    <option value="ทานเล่น">ทานเล่น</option>
                                                    <option value="กับข้าว">กับข้าว</option>
                                                    <option value="อาหารจานเดียว">อาหารจานเดียว</option>
                                                    <option value="แกง">แกง</option>
                                                    <option value="ขนมหวาน">ขนมหวาน</option>
                                                    <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                                                </select>
                                            </div>


                                            <div class="col-md-12 ps-0 mb-3">
                                                <label class="form-label">อัปโหลดรูปภาพอาหาร</label>
                                                <input type="file" name="food_img" class="form-control shadow-none" required>
                                            </div>

                                            <div class="cont-btn mt-3" style="text-align:right; ">
                                                <input type="hidden" name="menu_id" value="<?php echo $row['menu_id']; ?>">

                                                <button type="button" class="btn btn-secondary btn-cus2 me-2" data-bs-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-primary btn-cus2 " name="upbtn" > บันทึก</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal  ยืนยันการลบข้อมูล -->

                        <div class="modal fade"  id="DeleteModal<?php echo $row['menu_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">ยืนยันการลบข้อมูล</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="mb-3" style="color:crimson;">คุณต้องการจะลบข้อมูลนี้จริงๆ ใช่ไหม?</h4>
                                        <p>
                                            <b>ชื่อเมนู :</b>  <?php echo $row['menu_name'] ?> <br>
                                            <b>ราคา :</b> <?php echo $row['menu_price'] ?><br>
                                            <b>ประเภท :</b> <?php echo $row['menu_type']?><br>
                                        </p>

                                    </div>
                                    <div class="modal-footer">
                                        <form action="admin_profile_system.php" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $row['menu_id']; ?>">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-danger" name="deletebtn">ยืนยัน</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>





                    <?php endwhile ?>

                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>





