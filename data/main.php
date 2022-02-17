<?php
ob_start();
require('../function.php');
// require('../connect.php');
$action = $_GET['action'];
if ($action == "register") {
    $username    = $_POST['username'];
    $password    = $_POST['password'];
    $displayName = $_POST['displayName'];
    $email       = $_POST['email'];

    $res = register($username, $password, $displayName, $email);
    echo $res;
}
if ($action == "login") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $res = login($username, $password);
    echo $res;
}
if ($action == "removeUser") {
    $username = $_POST['username'];

    $res = removeUser($username);
    echo $res;
}
if ($action == "getUser") {
    $res = getUser();
    echo $res;
}

// card background
if ($action == "showbg") {
    $res = getBg();
    echo $res;
}
// 

if ($action == "removeBg") {
    $idbg = $_POST['idbg'];

    $res = removeBg($idbg);
    echo $res;
}

if ($action == "registerbg") {
    $file = $_FILES['filebg']['tmp_name'];
    $path = "../uploads/" . $_FILES['filebg']['name'];
    move_uploaded_file($file, $path);
    $res = registerbg($_POST['year'], $_POST['version'],  $_FILES['filebg']['name'], $_POST['isdefault']);
    header('Location: ../modules/card.php');
}
