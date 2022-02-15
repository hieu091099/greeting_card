<?php
require('function.php');
unset($_SESSION['displayName']);
header('Location: login.php');
?>