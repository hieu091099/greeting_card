<?php 
    require('../function.php');
    // require('../connect.php');
    $action = $_GET['action'];
    if($action == "register"){
        $username    = $_POST['username'];
        $password    = $_POST['password'];
        $displayName = $_POST['displayName'];
        $email       = $_POST['email'];

        $res = register($username, $password, $displayName , $email);
        echo $res;
    }
    if($action == "login"){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $res = login($username, $password);
        echo $res;
    }
    if($action == "removeUser"){
        $username = $_POST['username'];
        
        $res = removeUser($username);
        echo $res;
    }
    if($action == "getUser"){
        $res = getUser();
        echo $res;
    }
?>