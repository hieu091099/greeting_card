<?php 
require('connect.php');

session_start();
function checkLogin(){
    if(isset($_SESSION['displayName'])){
        return true;
    }
    return false;
}
function fetchObject($query){
    $rs = odbc_exec($con, $query);
    $result = [];
    while(@$row = odbc_fetch_object($rs)){
        array_push($result, $row);
    }
    return json_encode($result);
}
function register($username, $password, $fullName, $email ){
    global $con;
    /** $2y$10$MHvNRd7DQW.b/nNpBxpCLuiT7otwaD8pInyPL1SuYCoGOLa3bgHQ6 => abc123 */
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $check_exist = "SELECT * FROM GC_Users WHERE username = '$username'";
    $rs_check = odbc_exec($con, $check_exist);
    if(odbc_num_rows($rs_check) > 0){
        return  json_encode(array('status'=>false, 'msg' => 'Username already exist!'));
    }else{
        $insert = "INSERT INTO GC_Users (username, password, displayName, email, isAdmin, createdAt ) VALUES ('$username', '$hashed_password', '$fullName',  '$email', 0, getdate())";
        // echo $insert;
        $rs = odbc_exec($con, $insert);
        if(odbc_num_rows($rs) > 0){
            return  json_encode(array('status'=>true, 'msg' => 'Register success!'));
        }else{
            return  json_encode(array('status'=>false, 'msg' => 'Data error!')); 
        }
    }
}

function login($username, $password){
    global $con;
    $check = "SELECT [password], displayName, isAdmin FROM GC_Users WHERE username = '$username'";
    $rs_check = odbc_exec($con, $check);
    if(odbc_num_rows($rs_check) > 0){
        $password_hash = odbc_result($rs_check, 1);
        if(password_verify($password, $password_hash)){
            $displayName = odbc_result($rs_check, 2);
            $isAdmin = odbc_result($rs_check, 3);
            $_SESSION['displayName'] = $displayName;
            $_SESSION['isAdmin'] = $isAdmin;
            return  json_encode(array('status'=>true, 'msg' => 'Login success!'));
        }
    }else{
        return  json_encode(array('status'=>false, 'msg' => 'Username does not exist!'));
    }
}

function removeUser($username){
    global $con;
    $delete = "DELETE  FROM GC_Users WHERE username = '$username'";
    $rs= odbc_exec($con, $delete);
    if(odbc_num_rows($rs) > 0){
        return  json_encode(array('status'=>true, 'msg' => 'Delete success!'));
    }else{
        return  json_encode(array('status'=>false, 'msg' => 'Data error!'));
    }
}
function getUser(){
    global $con;
    $result = array();
    $select = "SELECT * FROM GC_Users ";
    $rs= odbc_exec($con, $select);
    while(@$row = odbc_fetch_object($rs)){
        array_push($result, $row);
    };
    return json_encode($result);
}