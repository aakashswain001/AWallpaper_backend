<?php
include_once '../includes/database.php';
include_once '../includes/category.php';


if (isset($_POST["submit"])) {
    $target_dir = "../uploads/category_images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            addCategory(basename($_FILES["fileToUpload"]["name"]));
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function addCategory($category_url)
{
    $database = new Database();
    $db = $database->getConnection();
    $category = new Category($db);


    $category->category = $_POST['category'];
    $category->category_url = $category_url;

    if ($category->create()) {
        echo "<br><br>Category successfully created";
    } else {
        echo '<br><br>Failed';
    }

}

?>
<!DOCTYPE html>
<html>
<body>

<form action="category.php" method="post" enctype="multipart/form-data">
    Category Name
    <input type="text" name="category" required>
    <br>
    Select image to upload:
    <br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>