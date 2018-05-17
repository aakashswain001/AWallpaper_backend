<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../includes/database.php';
include_once '../../includes/images.php';
$get_category = "";
if (isset($_GET['category'])) {
    $get_category = $_GET['category'];
}
$database = new Database();
$db = $database->getConnection();

$images = new Image($db);

$stmt = $images->read($get_category);
$num = $stmt->rowCount();

if ($num > 0) {

    $images_arr = array();
    $images_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $image_item = array(
            "id" => $id,
            "image" => $image,
            "category" => $category,
            "tag" => html_entity_decode($tag),
            "source" => $source,
            "downloads" => $downloads,
            "likes" => $likes,
        );

        array_push($images_arr["records"], $image_item);
    }

    echo json_encode($images_arr);
} else {
    echo json_encode(
        array("message" => "No images found.")
    );
}
?>