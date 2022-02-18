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
    $check = "SELECT [password], displayName, isAdmin, username FROM GC_Users WHERE username = '$username'";
    $rs_check = odbc_exec($con, $check);
    if (odbc_num_rows($rs_check) > 0) {
        $password_hash = odbc_result($rs_check, 1);
        if (password_verify($password, $password_hash)) {
            $displayName = odbc_result($rs_check, 2);
            $isAdmin = odbc_result($rs_check, 3);
            $username = odbc_result($rs_check, 4);
            $_SESSION['displayName'] = $displayName;
            $_SESSION['username'] = $username;
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
    $createdBy = $_SESSION['username'];
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
            '$createdBy',
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
        createdAt,
        isDefault
        
    )
    VALUES
    (
        '$year',
        '$verion',
        '$content',
        '$mailsj',
        '$box',
        'nam',
       GETDATE(),
       '0'
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


/** customer */
function getCustomer()
{
    global $con;
    $result = array();
    $select = "SELECT id, fullName, birthday, email, timezone, nameTimezone, relatedDepartment, departmentName, createdBy, createdAt, jobLevel,
    CASE WHEN gender = 0 THEN 'Female' ELSE 'Male' END gender, 
    CASE WHEN [status] = 1 THEN 'Active' ELSE 'Quit' END [status],
    CONVERT(VARCHAR, birthday,111) birthdayCus
     FROM GC_Customer ";
    $rs = odbc_exec($con, $select);
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    };
    return json_encode($result);
}

function addCustomer($fullName, $birthday, $email, $gender, $timezone, $nameTimezone, $jobLevel, $relatedDepartment, $departmentName)
{
    global $con;
    $createdBy = $_SESSION['username'];
    $sql_check = "SELECT * FROM GC_Customer WHERE fullName = '$fullName' AND birthday = '$birthday'";
    $rs_check  = odbc_exec($con, $sql_check);
    if (odbc_num_rows($rs_check) > 0) {
        return  json_encode(array('status' => false, 'msg' => 'Customer already exists!'));
    } else {
        $insert = "INSERT INTO GC_Customer
        (
            [fullName],
            [birthday],
            [email],
            gender,
            timezone,
            nameTimezone,
            status,
            jobLevel,
            relatedDepartment,
            departmentName,
            createdBy,
            createdAt
        )
        VALUES
        (
            N'$fullName',
            '$birthday',
            '$email',
            '$gender',
            '$timezone',
            '$nameTimezone',
            '1',
            '$jobLevel',
            '$relatedDepartment',
            '$departmentName',
            '$createdBy',
            GETDATE()
        )";
        $rs = odbc_exec($con, $insert);
        if (odbc_num_rows($rs) > 0) {
            return  json_encode(array('status' => true, 'msg' => 'Add success!'));
        } else {
            return  json_encode(array('status' => false, 'msg' => 'Data error!'));
        }
    }
}

function editCustomer($fullName, $birthday, $email, $gender, $timezone, $nameTimezone, $jobLevel, $relatedDepartment, $departmentName, $id)
{
    global $con;
    $createdBy = $_SESSION['username'];
    $sql_check = "SELECT * FROM GC_Customer WHERE fullName = '$fullName' AND birthday = '$birthday'";
    $rs_check  = odbc_exec($con, $sql_check);
    if (odbc_num_rows($rs_check) > 0) {
        return  json_encode(array('status' => false, 'msg' => 'Customer already exists, cannnot modify!'));
    }else{
        $insert = "UPDATE GC_Customer 
                    SET 
                        fullName = '$fullName', 
                        birthday = '$birthday', 
                        email = '$email', 
                        gender = '$gender', 
                        timezone = '$timezone', 
                        nameTimezone = '$nameTimezone',
                        jobLevel = '$jobLevel',
                        relatedDepartment = '$relatedDepartment',
                        departmentName = '$departmentName'
                    WHERE id = '$id' ";
        $rs = odbc_exec($con, $insert); //echo $insert;
        if (odbc_num_rows($rs) > 0) {
            return  json_encode(array('status' => true, 'msg' => 'Edit success!'));
        } else {
            return  json_encode(array('status' => false, 'msg' => 'Data error!'));
        }
    }
    
}

function removeCustomer($fullName, $birthday, $email)
{
    global $con;
    $delete = "DELETE  FROM GC_Customer WHERE fullName = '$fullName' AND birthday = '$birthday' and email = '$email'";
    $rs = odbc_exec($con, $delete);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Delete success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}
    // return $result;


    //Manager
function getManager() {
    global $con;
    $select = "SELECT * FROM GC_Manager";
    $result = array();
    $rs = odbc_exec($con, $select);
    while(@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    }
    return json_encode($result);
}


function addManager($fullName, $displayName, $email, $department) {
    global $con;
    $check_exist = "SELECT * FROM GC_Manager WHERE email = '$email'";
    $rs_check = odbc_exec($con, $check_exist);
    if (odbc_num_rows($rs_check) > 0) {
        return  json_encode(array('status' => false, 'msg' => 'Email already exist!'));
    } else {
         $insert = "INSERT INTO GC_Manager
            (
                fullName,
                displayName,
                email,
                department,
                createdBy,
                createdAt
            )
            VALUES
            (
                N'$fullName',
                N'$displayName',
                '$email',
                '$department',
                '',
                GETDATE()
            )";
            $rs = odbc_exec($con, $insert);
            if (odbc_num_rows($rs) > 0) {
                return  json_encode(array('status' => true, 'msg' => 'Add success!'));
            } else {
                return  json_encode(array('status' => false, 'msg' => 'Data error!'));
            }
    }
}

function editManager($fullName, $displayName, $email, $department) {
    global $con;
    $update = " UPDATE GC_Manager
    SET 
        fullName = '$fullName',
        displayName = '$displayName',
        email = '$email',
        department = '$department',
        createdBy = '',
        createdAt = GETDATE()
        WHERE email = '$email'
    ";
    // echo $update;
    $rs = odbc_exec($con, $update);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Edit success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}

function removeManager($email)
{
    global $con;
    $delete = "DELETE FROM GC_Manager WHERE email = '$email'";
    // echo $delete;
    $rs = odbc_exec($con, $delete);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Delete success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}
// return $result;
function updatedefaultbg($id, $year)
{
    global $con;
    $sql = "UPDATE GC_Background SET isDefault = 0 WHERE year= $year;UPDATE GC_Background SET isDefault = 1 WHERE id= $id";
    // echo $sql;
    $rs = odbc_exec($con, $sql);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Update success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}

function getversion($year, $db)
{
    global $con;
    $sql = "SELECT MAX(version)+1 FROM $db WHERE YEAR = '$year'";
    $rs = odbc_exec($con, $sql);
    $rs = odbc_result($rs, 1);
    if ($rs == null) {
        $rs = 1;
    }
    return $rs;
}

function getyearhavecard()
{

    global $con;
    $result = [];
    $sql = "SELECT year FROM GC_Background GROUP BY year";
    $rs = odbc_exec($con, $sql);
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    };
    return json_encode($result);
}

function updatedefaultcontent($id, $year)
{
    global $con;
    $sql = "UPDATE GC_CardContent SET isDefault = 0 WHERE year= $year;UPDATE GC_CardContent SET isDefault = 1 WHERE id= $id";
    // echo $sql;
    $rs = odbc_exec($con, $sql);
    if (odbc_num_rows($rs) > 0) {
        return  json_encode(array('status' => true, 'msg' => 'Update success!'));
    } else {
        return  json_encode(array('status' => false, 'msg' => 'Data error!'));
    }
}
function getContentDefault($year)
{
    global $con;
    $result = array();
    $sql = "SELECT TOP 1 * FROM GC_CardContent WHERE YEAR = '$year' AND isDefault = '1'";
    $rs = odbc_exec($con, $sql);
    while (@$row = odbc_fetch_object($rs)) {
        array_push($result, $row);
    };
    return json_encode($result);
}
