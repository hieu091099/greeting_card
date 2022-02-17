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

/** customer */
if ($action == "getCus") {
    $res = getCustomer();
    echo $res;
}

if ($action == "addCus") {
    $fullName = $_POST['fullName'];
    $birthday = $_POST['birthday'];
    $email    = $_POST['email'];
    $gender   = $_POST['gender'];
    $jobLevel = $_POST['jobPositionLevel'];
    $timezone = $_POST['timezone'];
    $nameTimezone = $_POST['nameTimezone'];
    $relatedDepartment = $_POST['relatedDepartment'];
    $departmentName = $_POST['departmentName'];

    $res = addCustomer($fullName, $birthday, $email, $gender, $timezone, $nameTimezone, $jobLevel, $relatedDepartment, $departmentName);
    echo $res;
}

if ($action == "removeCus") {
    $fullName = $_POST['fullName'];
    $birthday = $_POST['birthday'];
    $email    = $_POST['email'];

    $res = removeCustomer($fullName, $birthday, $email);
    echo $res;
}
if ($action == "addcontent") {
    // echo $_POST['mailsj'];
    $res = addcontent($_POST['year'], $_POST['version'], $_POST['content'], $_POST['mailsj'], $_POST['box']);
    echo $res;
}

if ($action == "showcontentcard") {
    $res = getContent();
    echo $res;
}
if ($action == "editcontent") {
    // echo $_POST['mailsj'];
    $res = editcontent($_POST['id'], $_POST['year'], $_POST['version'], $_POST['content'], $_POST['mailsj'], $_POST['box']);
    echo $res;
}

if ($action == "getImageDefault") {
    // echo $_POST['mailsj'];
    $res = getImageDefault($_POST['year']);
    print_r($res);
}
