<?php
require_once("classes/cls-media.php");

$obj_media = new Media();


$mediaid=$_GET['imgid'];
$condition= "`id` = '" . $mediaid . "'";
$obj_media->deleteMedia($condition, 0);

//deleteMedia
// $imgname=base64_decode($_GET['delimgname']);
// unlink($imgname);
header("location:upload-media");
exit();
?>