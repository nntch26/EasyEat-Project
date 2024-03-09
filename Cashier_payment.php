<?php


?>

    <div style="text-align:left;">
        <button onclick="showmenu('btn_payment')" class="btnstyle">ย้อนกลับ</button>
    </div>
    <form action="#" mrthod="post"id="printJS-form">
        <div>
            <div style="text-align : center;">
                <h3>EasyEat</h3>
                <p>เลขที่บิล : ....</p>
                <p>รายการโต๊ะ ...... จำนวน ...... คน วันที่/เวลา ........</p>
            </div>
            <div style="text-align : center;">
                <input type="radio" name="smt">something
                <input type="radio" name="smt">something
                <hr>
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
                background-color: lightblue;
                border-color: gray;
                border-style: solid;
                border-width: thin;
            }
                
            tr, td {
                    border-color: gray;
                    border-style: solid;
                    border-width: thin;
                    background-color: white;
                    font-weight: normal;
                }
        </style>
    </form>

<br>
<div>
    <button class="btnstyle"><a href="#popup-box-print" class="descripAhref">พิมพ์ใบเสร็จ</a></button>
    <button class="btnstyle"><a href="#popup-box-pay" class="descripAhref">เช็คบิล</a></button>
</div>