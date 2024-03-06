<?php
include('includes/connectDB.php');
$db = getDB();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['sumbit_new_menu'])) {
        $menu_name = $_POST['menu_name'];
        $menu_price = $_POST['menu_price'];
        $menu_type = $_POST['menu_type'];
        //ช่อง input แรก คือ ชื่อ ID, NAME ของที่เราตั้งใน FORM
        $uploadedFilename = handleImageUpload("bill_img", __DIR__ . "/menu_img");

        if ($uploadedFilename) {
            // ถ้าไฟล์ถูกอัปโหลดสำเร็จ
            echo "File uploaded successfully: " . $uploadedFilename;
            // Insert ชื่อไฟล์ลง Database
            $insert_menu = $db->prepare("INSERT INTO Menus (menu_name, menu_price, menu_type, menu_pic) 
                                        VALUES (:name, :price, :type, :img_name)");
            $insert_menu->bindParam(':name', $menu_name);
            $insert_menu->bindParam(':price', $menu_price);
            $insert_menu->bindParam(':type', $menu_type);
            $insert_menu->bindParam(':img_name', $uploadedFilename);
            $insert_menu->execute();
            header('location: ../index.html');
        } else {
            // ถ้ามีข้อผิดพลาดในการอัปโหลดไฟล์
            echo "Error uploading file!";
        }

        $db = null;  // Close database connection
    } else if (isset($_POST['sumbit_update_menu'])) {
        $menu_id = $_POST['menu_id'];
        $menu_name = $_POST['menu_name'];
        $menu_price = $_POST['menu_price'];
        $menu_type = $_POST['menu_type'];
        //ช่อง input แรก คือ ชื่อ ID, NAME ของที่เราตั้งใน FORM
        $uploadedFilename = handleImageUpload("bill_img", __DIR__ . "/menu_img");

        if ($uploadedFilename) {
            // ถ้าไฟล์ถูกอัปโหลดสำเร็จ
            echo "File uploaded successfully: " . $uploadedFilename;
            // Update รายการอาหาร
            $update_menu = $db->prepare("UPDATE Menus 
                             SET menu_name = :name, 
                                 menu_price = :price, 
                                 menu_type = :type, 
                                 menu_pic = :img_name 
                             WHERE menu_id = :menu_id");
            $update_menu->bindParam(':name', $menu_name);
            $update_menu->bindParam(':price', $menu_price);
            $update_menu->bindParam(':type', $menu_type);
            $update_menu->bindParam(':img_name', $uploadedFilename);
            $update_menu->bindParam(':menu_id', $menu_id);
            $update_menu->execute();
            header('location: ../index.html');
        } else {
            echo "Error uploading file!";
        }
        $db = null;  // Close database connection
    }
}

function handleImageUpload($fileInputName, $destinationDirectory)
{
    // Check if it's a POST request
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        exit('POST request method required');
    }

    // Check if $_FILES is empty
    if (empty($_FILES)) {
        exit('$_FILES is empty - is file_uploads set to "Off" in php.ini?');
    }

    // Check for upload errors
    if ($_FILES[$fileInputName]["error"] !== UPLOAD_ERR_OK) {
        switch ($_FILES[$fileInputName]["error"]) {
            case UPLOAD_ERR_PARTIAL:
                exit('File only partially uploaded');
            case UPLOAD_ERR_NO_FILE:
                exit('No file was uploaded');
            case UPLOAD_ERR_EXTENSION:
                exit('File upload stopped by a PHP extension');
            case UPLOAD_ERR_FORM_SIZE:
                exit('File exceeds MAX_FILE_SIZE in the HTML form');
            case UPLOAD_ERR_INI_SIZE:
                exit('File exceeds upload_max_filesize in php.ini');
            case UPLOAD_ERR_NO_TMP_DIR:
                exit('Temporary folder not found');
            case UPLOAD_ERR_CANT_WRITE:
                exit('Failed to write file');
            default:
                exit('Unknown upload error');
        }
    }

    // Check MIME type
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES[$fileInputName]["tmp_name"]);
    $mime_types = ["image/gif", "image/png", "image/jpeg"];

    if (!in_array($mime_type, $mime_types)) {
        exit("Invalid file type");
    }

    // Sanitize filename
    $pathinfo = pathinfo($_FILES[$fileInputName]["name"]);
    $base = $pathinfo["filename"];
    $base = preg_replace("/[^\w-]/", "_", $base);
    $filename = $base . "." . $pathinfo["extension"];

    // Check for existing filename and make it unique
    $i = 1;
    $destination = $destinationDirectory . "/" . $filename;

    while (file_exists($destination)) {
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = $destinationDirectory . "/" . $filename;
        $i++;
    }

    // Move uploaded file to destination directory
    if (!move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $destination)) {
        exit("Can't move uploaded file");
    }

    return $filename;
}
