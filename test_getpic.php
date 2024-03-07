<?php
include('backEnd/includes/connectDB.php');
$stmt = $db->prepare("SELECT * FROM Menus");
$stmt->execute();
// SQL query to fetch menu data
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Menu Information</h2>

    <table>
        <tr>
            <th>Menu ID</th>
            <th>Menu Name</th>
            <th>Price</th>
            <th>Type</th>
            <th>Picture</th>
        </tr>
        <?php
        // Output data of each row
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["menu_id"] . "</td>";
            echo "<td>" . $row["menu_name"] . "</td>";
            echo "<td>" . $row["menu_price"] . "</td>";
            echo "<td>" . $row["menu_type"] . "</td>";
            echo "<td><img src='backEnd/menu_img/" . $row["menu_pic"] . "' style='max-width: 100px; max-height: 100px;'></td>";
            echo "</tr>";
        }

        ?>
    </table>

    <?php
    // Close connection
    $db = null;
    ?>

</body>

</html>