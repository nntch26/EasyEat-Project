<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload Form</title>
</head>

<body>
<form action="backEnd/manage_menu.php" method="post" enctype="multipart/form-data">
    <label for="menu_name">Menu Name:</label>
    <input type="hidden" name="menu_id" id="menu_id" value="51">
    <input type="text" name="menu_name" id="menu_name"><br><br>

    <label for="menu_price">Menu Price:</label>
    <input type="text" name="menu_price" id="menu_price"><br><br>

    <label for="menu_type">Menu Type:</label>
    <input type="text" name="menu_type" id="menu_type"><br><br>

    <label for="bill_img">Select Image:</label>
    <input type="file" name="bill_img" id="bill_img"><br><br>

    <button type="submit" name="sumbit_update_menu">Update Menu</button>
    <button type="submit" name="sumbit_new_menu">Insert New Menu</button>
    <button type="submit" name="sumbit_delete_menu">Delete Menu</button>
</form>
</body>