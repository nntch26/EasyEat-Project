<?php
include('backEnd/includes/connectDB.php');
$db = getDB();
$stmt = $db->prepare("SELECT t.table_id, t.table_status, u.*
                    FROM Tables t
                    INNER JOIN Reservations r ON t.table_id = r.table_id
                    INNER JOIN Users u ON r.user_id = u.user_id
                    WHERE t.table_id IN ('A01', 'A02')
                    ORDER BY t.table_id");
$stmt->execute();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <div class="card-body-profile">
        <h2>Check Table</h2>
        <hr>
        <div style="height: 400px; overflow: auto;">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Table ID</th>
                    <th>Table Status</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Check</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                    <tr>
                        <td><?php
                            echo $row["table_id"]; ?></td>
                        <td><?php
                            echo $row["table_status"]; ?></td>
                        <td><?php
                            echo $row["user_id"]; ?></td>
                        <td><?php
                            echo $row["user_username"]; ?></td>
                        <td>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#myModal<?php
                            echo $row["table_id"]; ?>"><?php
                                echo $row["table_status"] ?></a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php
                    echo $row["table_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <?php
                                                if ($row["table_status"] == "Available") {
                                                    // ถ้าโต๊ะว่าง (Available) ให้แสดงรายละเอียดของผู้จองโต๊ะ
                                                    ?>
                                                    <div class="card-body">
                                                        <h5 class="card-title"><b>User ID :</b> <?php
                                                            echo $row["user_id"]; ?></h5>
                                                        <p class="card-text"><b>User Name : </b> <?php
                                                            echo $row["user_username"]; ?></p>
                                                        <p class="card-text"><b>First Name :</b> <?php
                                                            echo $row["user_fname"]; ?></p>
                                                        <p class="card-text"><b>Last Name :</b> <?php
                                                            echo $row["user_lname"] ?></p>
                                                    </div>
                                                    <?php
                                                } elseif ($row["table_status"] == "Occupied") {
                                                    $stmt2 = $db->prepare("SELECT Menus.*, MenuItems_Table.*
                                                                                FROM Menus
                                                                                JOIN MenuItems_Table ON Menus.menu_id = MenuItems_Table.menu_id
                                                                                WHERE MenuItems_Table.table_id = :id;
                                                            ");
                                                    $stmt2->bindParam(':id', $row["table_id"]);
                                                    $stmt2->execute();

                                                    if ($stmt2->rowCount() > 0) {
                                                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "Menu ID: " . $row2["menu_id"] . "<br>";
                                                            echo "Menu Name: " . $row2["menu_name"] . "<br>";
                                                            echo "Menu Price: " . $row2["menu_price"] . "<br>";
                                                            echo "<hr>";
                                                            // สามารถแสดงข้อมูลเพิ่มเติมตามที่ต้องการได้
                                                        }
                                                    } else {
                                                        echo "No menu items found for this table";
                                                    }
                                                } else {
                                                    // กรณีอื่น ๆ ที่ไม่ได้ระบุในเงื่อนไขข้างบน
                                                    echo "Invalid table status";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
$db = null;
?>
</body>

</html>