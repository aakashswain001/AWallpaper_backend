<?php
include_once '../includes/database.php';
include_once '../includes/category.php';
include_once '../includes/images.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}

if (isset($_POST['submit'])) {
    if (count($_FILES['upload']['name']) > 0) {
        //Loop through each file
        for ($i = 0; $i < count($_FILES['upload']['name']); $i++) {
            //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if ($tmpFilePath != "") {

                //save the filename
                $shortname = $_FILES['upload']['name'][$i];
                $imageFileType = strtolower(pathinfo($shortname, PATHINFO_EXTENSION));
                $finalPath = round(microtime(true) * 1000).'.'.$imageFileType;
                //save the url and the file
                $filePath = "../uploads/" . $finalPath;

                //Upload the file into the temp dir
                if (move_uploaded_file($tmpFilePath, $filePath)) {

                    $files[] = $shortname;
                    AddImage($finalPath);
                }
            }
        }
    }

    //show success message
    echo "<h1>Uploaded:</h1>";
    if (is_array($files)) {
        echo "<ul>";
        foreach ($files as $file) {
            echo "<li>$file</li>";
        }
        echo "</ul>";
    }
}
function addImage($path)
{
    $database = new Database();
    $db = $database->getConnection();
    $image = new Image($db);

    $image->image = $path;
    $image->category = $_POST['category'];
    $image->tag = $_POST['tag'];

    if ($image->create()) {
        echo "<br><br>Image successfully stored";
    } else {
        echo '<br><br>Failed';
    }
}

?>


<html>
<body>
<form action="" enctype="multipart/form-data" method="post">
    <div>
        <label for='category'>Category:</label>
        <select name="category">
            <?php
            $database = new Database();
            $db = $database->getConnection();
            $category = new Category($db);

            $stmt = $category->read();
            $num = $stmt->rowCount();

            if ($num > 0) {

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo ' <option value="' . $category . '">' . $category . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div>
        <label for='tag'>Tags: (must be space separated)</label>
        <input type="text" name="tag"/>
    </div>
    <div>
        <label for='upload'>Add Attachments:</label>
        <input id='upload' name="upload[]" type="file" multiple="multiple"/>
    </div>

    <p><input type="submit" name="submit" value="Submit"></p>

</form>

</body>
</html>