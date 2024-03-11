

<div class="container">
    <div class="row">
        <div class="text-header">
            <h1>จัดการระบบสมาชิก</h1>
        </div>


        <div class="content-table">
            <div style="height: 100%; overflow: auto;">


            <table id="dataTable" class="table table-striped" style="width:100%; text-align: left;">
                    <thead>
                        <tr>
                            <th>รหัส</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>อีเมล</th>
                            <th>คะแนนสะสม</th>
                            <th>จัดการ</th>
                        
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $sqlUser = $db->prepare("SELECT * FROM Users WHERE user_role = 'Member'");
                        $sqlUser->execute();

                        while ($rowUser= $sqlUser->fetch(PDO::FETCH_ASSOC)) :


                        ?>

                        <tr>
                            <td><?php echo $rowUser['user_id'] ?></td>
                            <td><?php echo $rowUser['user_fname'] ?></td>
                            <td><?php echo $rowUser['user_lname'] ?></td>
                            <td><?php echo $rowUser['user_username']?></td>
                            <td><?php echo $rowUser['user_phonenum']?></td>
                            <td><?php echo $rowUser['user_email'] ?></td>
                            <td><?php echo $rowUser['user_points'] ?></td>

                            <td>

       
                                <button type="button" class="btn btn-warning btnEdit" data-bs-toggle="modal" data-bs-target="#editProfileModal<?php echo $rowUser['user_id']; ?>">
                                    <i class="fs-5 bi bi-pencil-square"></i>
                                </button>


                                <button type="button" class="btn btn-danger btnDelete" data-bs-toggle="modal" data-bs-target="#DeleteModal<?php echo $rowUser['user_id']; ?>">
                                    <i class="fs-5 bi-trash3-fill"></i>
                                </button>

                               

                            </td>
                        </tr>

                        <!---- model แก้ไขข้อมูลสมาชิก ----->

                        <div class="modal fade" id="editProfileModal<?php echo $rowUser['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">

                                        <form action="admin_profile_system.php" method="post">

                                            <div class="row">
                                                <div class="form-outline mb-3 col-md-6">
                                                    <label class="form-label">ชื่อ</label>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" minlength="3"
                                                        value="<?php
                                                        echo $rowUser['user_fname'] ?>"/>
                                                </div>

                                                <div class="form-outline mb-3 col-md-6">
                                                    <label class="form-label">นามสกุล</label>
                                                    <input type="text" name="lastname" id="lastname" class="form-control" minlength="3"
                                                        value="<?php
                                                        echo $rowUser['user_lname']; ?>"/>
                                                </div>
                                            </div>


                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="username">ชื่อผู้ใช้</label>
                                                <input type="text" name="username" id="username" class="form-control" minlength="5"
                                                    value="<?php echo $rowUser['user_username']; ?>"/>
                                            </div>

                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="email">อีเมล</label>
                                                <input type="email" name="email" id="email" class="form-control" value="<?php
                                                echo $rowUser['user_email']; ?>"/>
                                            </div>


                                            <div class="form-outline mb-3">
                                                <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                                                <input type="tel" name="phone" class="form-control" value="<?php
                                                echo $rowUser['user_phonenum']; ?>">
                                            </div>

                                        

                                            <div class="cont-btn mt-3" style="text-align:right; ">
                                                <input type="hidden" name="user_id" value="<?php echo $rowUser['user_id']; ?>"> 

                                                <button type="button" class="btn btn-secondary btn-cus2 me-2" data-bs-dismiss="modal">ยกเลิก</button>
                                                <button type="submit" class="btn btn-primary btn-cus2 me-5" name="upbtn" > บันทึก</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal  ยืนยันการลบข้อมูล -->
                       
                        <div class="modal fade"  id="DeleteModal<?php echo $rowUser['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">ยืนยันการลบข้อมูล</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="mb-3" style="color:crimson;">คุณต้องการจะลบข้อมูลนี้จริงๆ ใช่ไหม?</h4>
                                        <p>
                                           <b>ชื่อ-นามสกุล :</b>  <?php echo $rowUser['user_fname']." ".$rowUser['user_lname'] ?> <br>
                                           <b>ชื่อผู้ใช้ :</b> <?php echo $rowUser['user_username'] ?><br>
                                           <b>เบอร์โทรศัพท์ :</b> <?php echo $rowUser['user_phonenum'] ?><br>
                                           <b>อีเมล :</b> <?php echo $rowUser['user_email'] ?>
                                        </p>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <form action="admin_profile_system.php" method="post">
                                            <input type="hidden" name="user_id" value="<?php echo $rowUser['user_id']; ?>"> 

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


<?php
 $db = null;


?>

