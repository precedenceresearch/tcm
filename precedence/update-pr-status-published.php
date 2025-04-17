<?php
require_once("classes/cls-leads.php");

$obj_lead = new Lead();

//$conn = $obj_lead->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$blogid=$_POST['blogid'];


$fields = "*";
$condition = "`predr_pr_press_release`.`id`='".$blogid."'";
$blog_details = $obj_lead->getpublishedprDetails($fields, $condition, '','', 0);

foreach($blog_details as $blog_detail)
{
    $blogstatus=$blog_detail['status'];
}
    if($blogstatus=='Active')
    {
        $blogstatus1='Inactive';
    }
    if($blogstatus=='Inactive')
    {
        $blogstatus1='Active';
    }
    
        $update_data['status'] = $blogstatus1;
        $condition = "`predr_pr_press_release`.`id` = '" . $blogid . "'";
        $lastupdateid = $obj_lead->updatepressrelease($update_data,$condition, 0);
        echo $lastupdateid;
//echo $lastupdateid;
?>
