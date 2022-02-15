<?php 

$con = odbc_connect('EIPDB','sa','1234');
if(!isset($con)){
    echo "Connect Fail!";
}