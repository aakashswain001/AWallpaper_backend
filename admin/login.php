<?php
include_once '../includes/database.php';
include_once '../includes/user.php';

session_start();
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    die();
}

if (isset($_POST['login'])) {
    login();
}
function login()
{
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);


    $user->username = $_POST['username'];
    $user->password = $_POST['password'];

    if ($user->login()) {
        $_SESSION['user'] = 'user';
        header("Location: index.php");
        die();
    } else {
        echo 'Login Failed';
    }

}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>

<body>

<form method="post" action="login.php">
    Email<input type="text" name="username" id="username" required></td>
    Password<input type="password" name="password" id="password" required></td>
    <button type="submit" name="login">Login</button>
</form>

</body>
</html>
