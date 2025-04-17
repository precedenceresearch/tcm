<?php
require_once("classes/cls-report.php");

$obj_report = new Report();
$conn = $obj_report->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$repid=$_POST['repid'];


$fields = "*";
$condition = "`predr_topCompanies`.`id`='".$repid."'";
$report_details = $obj_report->getCompanyDetails($fields, $condition, '', '', 0);

foreach($report_details as $report_detail)
{
    $reportstatus=$report_detail['status'];
}
    if($reportstatus=='Active')
    {
        $reportstatus1='Inactive';
    }
    if($reportstatus=='Inactive')
    {
        $reportstatus1='Active';
    }
        $update_data['status'] = $reportstatus1;
        $update_data['ModifiedDate'] = date("Y-m-d h:i:s");
        $condition = "`predr_topCompanies`.`id` = '" . $repid . "'";
        $lastupdateid = $obj_report->updateCompany($update_data,$condition, 0);
        echo $lastupdateid;
//echo $lastupdateid;
?>
