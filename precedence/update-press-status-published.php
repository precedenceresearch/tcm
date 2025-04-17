<?php
require_once("classes/cls-press-release.php");

$obj_press = new Press();
$conn = $obj_press->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$pressid=$_POST['pressid'];


$fields = "*";
$condition = "`predr_news`.`id`='".$pressid."'";
$press_details = $obj_press->getPressDetails($fields, $condition, '', '', 0);

foreach($press_details as $press_detail)
{
    $pressstatus=$press_detail['status'];
}
    if($pressstatus=='Active')
    {
        $pressstatus1='Inactive';
    }
    if($pressstatus=='Inactive')
    {
        $pressstatus1='Active';
    }
        $update_data['status'] = $pressstatus1;
        $update_data['ModifiedDate'] = date("Y-m-d h:i:s");
        $condition = "`predr_news`.`id` = '" . $pressid . "'";
        $lastupdateid = $obj_press->updatePress($update_data,$condition, 0);
        echo $lastupdateid;
//echo $lastupdateid;
?>
