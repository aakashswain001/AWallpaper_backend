<?php
include_once '../includes/database.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}
?>
<html>

<head>
</head>
<body>
WELCOME ADMIN
<a href="logout.php">LOGOUT</a>
<a href="upload.php">Upload</a>
</body>

</html>
