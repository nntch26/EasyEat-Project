<?php
include('includes/connectDB.php');
session_start(); // Start the session
function gens_table() {
    $db = getDB();

    $gens_menu = $db->prepare("SELECT * from Menus");
    $gens_menu->execute();
    ?>

    <div>
        <?php
        while ($menu = $gens_menu->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="col-md-3">
                <div class="card mt-2 mb-3">
                    <div class="card-body" style="line-height: 3;">
                        <p>ID: <?php
                            echo $menu["menu_id"]; ?></p>
                        <p>Name: <?php
                            echo $menu["menu_name"]; ?></p>
                        <p>Type: <?php
                            echo $menu["menu_type"]; ?></p>
                        <p>Price: <?php
                            echo $menu["menu_price"]; ?></p>
                    </div>
                </div>
            </div>
        <?php
        endwhile ?>
    </div>

    <?php
}

// Close the connection to database
$db = null;
?>
