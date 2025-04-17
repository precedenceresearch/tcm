<?php
require_once("classes/cls-paylink.php");


$obj_paylink = new Paylink();



$payid=base64_decode($_GET['pay_id']);
$condition= "`payid` = '" . $payid . "'";
$obj_paylink->deletePaylink($condition, 0);

header("Location:manage-paylink");
exit(0);

?>