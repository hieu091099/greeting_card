<?php
$img = $_POST['data'];
echo $img;
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$fileData = base64_decode($img);
//saving
$fileName = 'test.gif';
file_put_contents('../uploads/card/' . $fileName, $fileData);
