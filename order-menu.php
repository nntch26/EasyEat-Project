<?php
session_start();

if (isset($_GET['table_id'])) {
    $_SESSION["table_id"] = $_GET['table_id'];
}

if (isset($_POST['ordered'])) {
    if ($_POST['count'] == 0) {
    } else {
        $table_id = $_SESSION["table_id"];
        $redirect_url = 'preparemenu.php?table_id=' . urlencode($table_id);
        header('Location: ' . $redirect_url);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\menuorder-styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<style>
    #order {
        width: 100%;
        padding: 5px;
        border-radius: 10px;
        background-color: #FF3E1D;
        border: 2px solid #FF3E1D;
    }
</style>

<body onload="loadallmenu()" ;>
    <!-- ส่วนของแถบข้าง ๆ -->
    <div class="topbar">
        <div id="mySidenav" class="sidenav">

            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="container" id="showBill">


            </div>
            <div class="butbox">
                <form action="order-menu.php" method="post">
                    <input type="hidden" id="table_id" name="table_id" value="<?php echo $_SESSION['table_id']; ?>">
                    <input type="hidden" name="count" id="count" name="count" value="">
                    <button type="submit" class="btn-order" id="order" name="ordered" onclick="Ordered()" style="width: 100%;">สั่งอาหาร</button>
                </form>


            </div>
        </div>
        <span class="openbtn" style="font-size:30px;cursor:pointer" onclick="openNav()"><ion-icon name="cart-outline"></ion-icon> </span>
        <div class="topichead">
            <label>EasyEat</label>
        </div>
    </div>


    <!-- ส่วนของแถบบนหัวสุด -->
    <div class="headbar">
        <div class="typebar">
            <a class="btn" onclick="loadallmenu()">เมนูทังหมด</a>
            <a class="btn" onclick="changeMenu('กับข้าว')">เมนูกับข้าว</a>
            <a class="btn" onclick="changeMenu('แกง')">เมนูแกง</a>
            <a class="btn" onclick="changeMenu('ทานเล่น')">ทานเล่น</a>
            <a class="btn" onclick="changeMenu('อาหารจานเดียว')">อาหารจานเดียว</a>
            <a class="btn" onclick="changeMenu('ขนมหวาน')">ขนมหวาน</a>
            <a class="btn" onclick="changeMenu('เครื่องดื่ม')">เครื่องดื่ม</a>
        </div>
    </div>
    <div class="main-menu">
        <div class="right-menu">
            <div class="smallbox" id="showmenu">






            </div>
        </div>
</body>

</html>


<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function changeMenu(parameter) {
        // Clear all content inside the div with id "showmenu"
        document.getElementById("showmenu").innerHTML = "";
        showMenu(parameter);
    }

    function Deletemenu(id) {
        // Clear all content inside the div with id "showmenu"
        var element = document.getElementById(id);
        if (element) {
            element.parentNode.removeChild(element);
        }
    }


    async function loadallmenu() {
        // Clear all content inside the div with id "showmenu"
        document.getElementById("showmenu").innerHTML = "";
        loadmenu('กับข้าว', 5, "showmenu1");
        loadmenu('แกง', 5, "showmenu2");
        loadmenu('ทานเล่น', 5, "showmenu4");
        loadmenu('อาหารจานเดียว', 5, "showmenu3");
        loadmenu('ขนมหวาน', 5, "showmenu5");
        loadmenu('เครื่องดื่ม', 5, "showmenu10");

    }

    function loadmenu(type, num, ele) {
        var myHearders = new Headers();
        myHearders.append("Content-Type", "application/json");

        var raw = JSON.stringify({
            "type": type,
            "num": num
        });

        var requestOptions = {
            method: 'POST',
            headers: myHearders,
            body: raw,
            redirect: 'follow'
        };
        var bigshow = document.getElementById("showmenu");
        var ddd = `<div class="head-line-1">
                        <h3 id="rice">` + type + `</h3>
                    </div><hr>
                    <div class="slide-one">
                    <div id="carouselExampleIndicatorsapp` + ele + `" class="carousel slide">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                        </div>
                        <div class="carousel-inner"   id = "` + ele + `" value = "5" >
                           
                        </div>
                          

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicatorsapp` + ele + `" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicatorsapp` + ele + `" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>`
        bigshow.insertAdjacentHTML('beforeend', ddd);


        var showmenu1 = document.getElementById(ele)
        showmenu1.innerHTML = "";


        fetch("backEnd/includes/api/read_menulimit.php", requestOptions)
            .then(respone => respone.text())
            .then(result => {
                var jsonObj = JSON.parse(result);
                var check = true;
                for (let menu of jsonObj) {
                    if (check) {
                        check = false;
                        var row = `<div class="carousel-item active">
                                <div class="one">
                                    <div class="card" style="width: 18rem;">
                                        <img src="backEnd/menu_img/` + menu.menu_pic + `" class="card-img-top" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">` + menu.menu_name + `</h5>
                                            <div class="back">
                                                <h5 class="card-price">ราคา฿` + menu.menu_price + `</h5>
                                                <a class="btn btn-primary" onclick="addMenu('` + menu.menu_id + `', '` + menu.menu_name + `', ` + menu.menu_price + `)">ลงกะตร้า</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> `
                        showmenu1.insertAdjacentHTML('beforeend', row);
                    } else {

                        var row = `<div class="carousel-item">
                                <div class="one">
                                    <div class="card" style="width: 18rem;">
                                        <img src="backEnd/menu_img/` + menu.menu_pic + `" class="card-img-top" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">` + menu.menu_name + `</h5>
                                            <div class="back">
                                                <h5 class="card-price">ราคา฿` + menu.menu_price + `</h5>
                                                <a class="btn btn-primary" onclick="addMenu('` + menu.menu_id + `', '` + menu.menu_name + `', ` + menu.menu_price + `)">ลงกะตร้า</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> `;
                        showmenu1.insertAdjacentHTML('beforeend', row);
                    }
                }
            })





    }



    function Ordered() {
        var nodeList = document.querySelectorAll(".menubox");
        var orderData = []; // Create an array to store order data
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        var table_id = document.getElementById("table_id").value;
        // Loop through each menu item
        nodeList.forEach(function(menuItem) {
            var menuId = menuItem.id;
            var quantityInput = menuItem.querySelector("#q");
            var menuValue = quantityInput.value;

            // Create an object for each order item
            var orderItem = {
                "table_id": table_id,
                "menu_id": menuId,
                "menu_value": menuValue
            };

            // Add the order item object to the array
            orderData.push(orderItem);

        });
        // Convert data to JSON
        var raw = JSON.stringify(orderData);
        var jsonData = JSON.stringify(orderData);

        if (!orderData || Object.keys(orderData).length === 0) {
            alert('ไม่มีอาหาร');
        } else {
            console.log(jsonData);
            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'


            };

            fetch("backEnd/includes/api/create_Billaddorder.php", requestOptions)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(result => {
                    console.log(result); // Handle successful response here
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }
        updateStatustable(table_id, "ไม่ว่าง")
    }

    function addMenu(id, name, price) {
        var menu_id = id;
        var menu_name = name;
        var menu_price = price;
        var check_menu = document.getElementById(id);

        if (check_menu !== null) {
            alert("in cart");
        } else {
            var showBill = document.getElementById("showBill");
            var row = `<div class="menubox" id = "` + menu_id + `">
                        <div class="onadd">
                            <h4>ชื่ออาหาร ` + menu_name + `</h4>
                            <label class="price">ราคา ฿` + menu_price + `</label>
                        </div>
                         <div class="add-de">
                    <label class="price">จำนวน</label>
                    <input type="text" id = "q"  value= "1">
                    <!-- สัญลักษณ์ถังขยะ ไว้ลบรายการเมนูอาหารที่กดไว้ในตะกร้า -->
                    <button style="color: black; background-color: black;" onclick="Deletemenu('` + menu_id + `')"><span class="fa fa-trash-o"></span></button>

                </div>`
            showBill.insertAdjacentHTML('beforeend', row);
        }
    }

    var showMenu = function(parameter) {
        var raw = JSON.stringify({
            "type": parameter
        });

        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
        };
        var getshowmenu = document.getElementById("showmenu");
        fetch("backEnd/includes/api/read_menutype.php", requestOptions)
            .then(respone => respone.text())
            .then(result => {
                var jsonObj = JSON.parse(result);
                for (let menu of jsonObj) {

                    var row = `<div class = "menus-1">
            <div class="card" style="width: 18rem;">
                <img alt="` + menu.menu_pic + `"
                     class="card-img-top"
                     src="backEnd/menu_img/` + menu.menu_pic + `">
                <div class="card-body">
                    <h4 class="card-title">` + menu.menu_name + `</h5>
                    <h5 class="card-price">ราคา฿` + menu.menu_price + `</h5>
                    <a class="btn btn-primary" onclick="addMenu('` + menu.menu_id + `', '` + menu.menu_name + `', ` + menu.menu_price + `)">ลงกะตร้า</a>
                </div>
            </div>
            </div>
            `;
                    console.log(menu.menu_id);
                    getshowmenu.insertAdjacentHTML('beforeend', row); // ใช้ showmenu[0] เพื่อเข้าถึงอ็อบเจกต์ Element



                }
            })
    }

    function updateStatustable(table_id, status) {
        var myHearders = new Headers();
        myHearders.append("Content-Type", "application/json");

        var raw = JSON.stringify({
            "table_id": table_id,
            "status": status
        });

        var requestOptions = {
            method: 'POST',
            headers: myHearders,
            body: raw,
            redirect: 'follow'
        };

        fetch("backEnd/includes/api/update_statustable.php", requestOptions)
            .then(respone => respone.text())
            .then(result => {
                var jsonObj = JSON.parse(result);
                if (jsonObj.status == 'ok') {
                    console.log("ok");
                } else {
                    alert('error');
                }
            })
    }
</script>