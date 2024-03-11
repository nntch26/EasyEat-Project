<?php


?>

    <div style="text-align:left;">
        <button onclick="showmenu('btn_payment')" class="btn btn-outline-dark">ย้อนกลับ</button>
    </div>
    <form action="#" method="post"id="printJS-form">
        <div>
            <div style="text-align : center;">
                <h3>EasyEat</h3>
                <p>เลขที่บิล : ....</p>
                <p>รายการโต๊ะ ...... จำนวน ...... คน วันที่/เวลา ........</p>
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
        </table>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th {
                border-collapse: collapse;
                background-color: rgba(34, 34, 34, 0.18);
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

<br>

<div>
    <a class="btn btn-secondary me-2" onclick="printJS('printJS-form', 'html')" class="descripAhref">
        <i class="fs-5 bi bi-printer-fill"></i> <spen class="ms-1">พิมพ์ใบเสร็จ</spen>
    </a>

    <a class="btn btn btn-success me-2" href="#popup-box-pay" class="descripAhref">
        <i class="fs-5 bi bi-cash-coin"></i><spen class="ms-2">เงินสด</spen>
    </a>

    <a class="btn btn-warning" href="#popup-box-promppay" class="descripAhref">
        <i class="fs-5 bi bi-qr-code-scan"></i><spen class="ms-2">สแกนจ่าย</spen>
    </a>

</div>
