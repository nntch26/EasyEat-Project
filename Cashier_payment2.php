<?php

global $db;
include('backend/includes/connectDB.php');
session_start();

$table_id = $_GET['table_id'];

$sql1 = $db->prepare("SELECT DISTINCT Bills.Bill_id, Orders.*, Orders.*,Bills.*
                     FROM Orders
                     JOIN Menus ON Orders.menu_id = Menus.menu_id
                     LEFT JOIN Bills ON Orders.Bill_id = Bills.Bill_id
                     WHERE Orders.table_id  = :table_id;");

// table id เปลี่ยนตามโต๊ะที่สั่งอาหาร
$sql1->bindParam(':table_id', $table_id);
$sql1->execute();

?>

<form action="#" method="post"id="printJS-form2">
        <div>
            <div style="text-align : center;">
                <h3>EasyEat</h3>
                <p>เลขที่บิล : ..... </p>
                <p>รายการโต๊ะ ..... จำนวน ...... คน วันที่/เวลา ........</p>
            </div>
        </div>

        <table>
            <tr>
                <th style="width: 5%">#</th>
                <th style="width: 20%">ชื่อ</th>
                <th style="width: 10%">ราคา/หน่วย</th>
                <th style="width: 5%">จำนวน</th>
                <th style="width: 10%">รวม</th>
            </tr>


            <tr>
                <td>1</td>
                <td>กล้วย</td>
                <td>2000.0</td>
                <td>54</td>
                <td>546467613.0</td>
            </tr>
            <tr>
                <th colspan="4">รวม</th>
                <td>54646165.0 บาท</td>
            </tr>
            <tr>
                <th colspan="4">รับมา</th>
                <td>54646165.0 บาท</td>
            </tr>
            <tr>
                <th colspan="4">ทอน</th>
                <td>54646165.0 บาท</td>
            </tr>
        </table>
        <style>
            table {
            border-collapse: collapse;
            width: 100%;
            }

            th {
            border-collapse: collapse;
            background-color: rgb(255, 234, 217);
            border-color: gray;
            border: 1px solid #222;
            }

            tr, td {
            background-color: white;
            font-weight: normal;
            border: 1px solid #222;
            }
        </style>

    </form>