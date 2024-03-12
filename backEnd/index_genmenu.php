<?php
include('includes/connectDB.php');

$menu_types = array("แกง", "กับข้าว", "อาหารจานเดียว", "ขนมหวาน", "ทานเล่น");

foreach ($menu_types as $menu_type) {
    $limit = ($menu_type === "ทานเล่น") ? 2 : 1; // ถ้าเป็นทานเล่นให้เลือก 2 รายการ ไม่เช่นนั้นให้เลือก 1 รายการ
    $get_menuinfo = $db->prepare("SELECT menu_name, menu_type, menu_price, menu_pic FROM Menus WHERE menu_type = :menu_type LIMIT $limit");
    $get_menuinfo->bindParam(":menu_type", $menu_type);
    $get_menuinfo->execute();
    $menu_info = $get_menuinfo->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($menu_info as $menu_item) {
?>
        <div class="col-md-6">
            <div class="card con-card">
                <img src="backEnd/menu_img/<?php echo $menu_item['menu_pic'] ?>" class="card-img-top" alt="server iserv กาก">
                <div class="card-body">
                    <div class="text-section">
                        <h3 class="card-title1"><?php echo $menu_item['menu_name']; ?></h3>
                        <p class="card-text1">ประเภทเมนูอาหาร : <?php echo $menu_item['menu_type']; ?></p>
                        <h5 class="text-price">ราคา : <?php echo $menu_item['menu_price']; ?> บาท</h5>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>