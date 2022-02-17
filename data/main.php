<?php
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
    $image = $_POST['image'];
    $year  = $_POST['year'];
    $version = $_POST['version'];
    $isDefault = $_POST['isDefault'];
    // echo $image.$year;
    $res = registerbg($_POST['year'], $_POST['version'], $_POST['image'], $_POST['isdefault']);
    echo $res;
}
