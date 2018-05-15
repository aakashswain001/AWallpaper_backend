<?php
/**
 * Created by PhpStorm.
 * User: aakas
 * Date: 5/15/2018
 * Time: 5:10 PM
 */
session_start();
session_destroy();
header("Location: login.php");
die();
?>