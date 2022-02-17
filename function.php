<?php
require('connect.php');

session_start();
function checkLogin()
{
    if (isset($_SESSION['displayName'])) {
        return true;
    }
    return false;
}
function fetchObject($query)
{
    global $con;
    $rs = odbc_exec($con, $query);
    $result = [];
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    }
    return json_encode($result);
}
function register($username, $password, $fullName, $email)
{
    global $con;
    /** $2y$10$MHvNRd7DQW.b/nNpBxpCLuiT7otwaD8pInyPL1SuYCoGOLa3bgHQ6 => abc123 */
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $check_exist = "SELECT * FROM GC_Users WHERE username = '$username'";
    $rs_check = odbc_exec($con, $check_exist);
    if (odbc_num_rows($rs_check) > 0) {
        return  json_encode(array('status' => false, 'msg' => 'Username already exist!'));
    } else {
        $insert = "INSERT INTO GC_Users (username, password, displayName, email, isAdmin, createdAt ) VALUES ('$username', '$hashed_password', '$fullName',  '$email', 0, getdate())";
        // echo $insert;
        $rs = odbc_exec($con, $insert);
        if (odbc_num_rows($rs) > 0) {
            return  json_encode(array('status' => true, 'msg' => 'Register success!'));
        } else {
            return  json_encode(array('status' => false, 'msg' => 'Data error!'));
        }
    }
}

function login($username, $password)
{
    global $con;
    $check = "SELECT [password], displayName, isAdmin FROM GC_Users WHERE username = '$username'";
    $rs_check = odbc_exec($con, $check);
    if (odbc_num_rows($rs_check) > 0) {
        $password_hash = odbc_result($rs_check, 1);
        if (password_verify($password, $password_hash)) {
            $displayName = odbc_result($rs_check, 2);
            $isAdmin = odbc_result($rs_check, 3);
            $_SESSION['displayName'] = $displayName;
            $_SESSION['isAdmin'] = $isAdmin;
            return  json_encode(array('status' => true, 'msg' => 'Login success!'));
        }
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Username does not exist!'));
    }
}

function removeUser($username)
{
    global $con;
    $delete = "DELETE  FROM GC_Users WHERE username = '$username'";
    $rs = odbc_exec($con, $delete);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Delete success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}
function getUser()
{
    global $con;
    $result = array();
    $select = "SELECT * FROM GC_Users ";
    $rs = odbc_exec($con, $select);
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    };
    return json_encode($result);
}

function getBg()
{
    global $con;
    $result = array();
    $select = "SELECT * FROM GC_BackGround";
    $rs = odbc_exec($con, $select);
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    };
    return json_encode($result);
    // return $result;
}

function removeBg($idbg)
{
    global $con;
    $delete = "DELETE  FROM GC_BackGround WHERE id = $idbg";
    $rs = odbc_exec($con, $delete);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Delete success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}

function registerbg($year, $verion, $image, $default)
{
    global $con;
    $insert = "INSERT INTO GC_Background
        (
            [year],
            version,
            [image],
            isDefault,
            createdBy,
            createdAt
        )
        VALUES
        (
            '$year',
            '$verion',
            '$image',
            '$default',
            '',
            GETDATE()
        )";
    $rs = odbc_exec($con, $insert);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Register success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}
function addcontent($year, $verion, $content, $mailsj, $box)
{
    global $con;
    $content = htmlspecialchars($content);
    $content =  str_replace("'", '"', $content);
    $box = htmlspecialchars($box);
    $box =  str_replace("'", '"', $box);
    $sql = "INSERT INTO GC_CardContent
    (
        [year],
        version,
        [content],
        mailSubject,
        box,
        createdBy,
        createdAt
        
    )
    VALUES
    (
        '$year',
        '$verion',
        '$content',
        '$mailsj',
        '$box',
        'nam',
       GETDATE()
    )";
    $rs = odbc_exec($con, $sql);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Register success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}

function getContent()
{
    global $con;
    $result = array();
    $select = "SELECT * FROM GC_CardContent";
    $rs = odbc_exec($con, $select);
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    };
    return json_encode($result);
    // return $result;
}

function editcontent($id, $year, $verion, $content, $mailsj, $box)
{
    global $con;
    $content = htmlspecialchars($content);
    $content =  str_replace("'", '"', $content);
    $box = htmlspecialchars($box);
    $box =  str_replace("'", '"', $box);
    $sql = "UPDATE GC_CardContent
    SET
        -- id -- this column value is auto-generated
        [year] ='$year',
        version = '$verion',
        [content] = '$content',
        mailSubject = '$mailsj',
        box = '$box'
    WHERE id = $id ";
    $rs = odbc_exec($con, $sql);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Register success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}

function getImageDefault($year)
{
    global $con;
    $result = array();
    $sql = "SELECT TOP 1 * FROM GC_Background WHERE YEAR = '$year' AND isDefault = '1'";
    $rs = odbc_exec($con, $sql);
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    };
    return json_encode($result);
}
