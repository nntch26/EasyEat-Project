<?php

include('../backend/includes/connectDB.php');
$db = getDB();

?>

<div class="container">
    <div class="row">

        <div class="text-header">
            <h1>จัดการระบบสมาชิก</h1>
        </div>

        <form class="d-flex col-md-4 content-search" role="search">
            <input class="form-control me-2" type="search" placeholder="ค้นหาเบอร์โทรศัพท์" aria-label="Search">
            <button class="btn btn-dark btn-cus" type="submit">
                <i class="bi bi-search"></i><span class="ms-1">ค้นหา</span>
            </button>
        </form>



        <div class="content-table">
            <div style="height: 100%; overflow: auto;">


                <table class="table">
                    <thead>
                        <tr>
                            <th>เลขสมาชิก</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ชื่อผู้ใช้</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th>อีเมลบัญชี</th>
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
                            <td><?php echo $rowUser['user_fname']." ".$rowUser['user_lname'] ?></td>
                            <td><?php echo $rowUser['user_username'] ?></td>
                            <td><?php echo $rowUser['user_phonenum'] ?></td>
                            <td><?php echo $rowUser['user_email'] ?></td>
                            <td><?php echo $rowUser['user_points'] ?></td>

                            <td>
                                <input type="hidden" name="user_id" value="<?php echo $rowUser['user_id']; ?>"> 

                                <button type="button" class="btn btn-warning" name="btnEdit">
                                    <i class="fs-5 bi bi-pencil-square"></i>
                                </button>

                                <button type="button" class="btn btn-danger" name="btnDelete">
                                    <i class="fs-5 bi-trash3-fill"></i>
                                </button>

                               

                            </td>

                          

                        </tr>

                    <?php endwhile ?>

                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>