<?php
require_once("classes/cls-leads.php");

$obj_lead = new Lead();

$condition="(`predr_formdetails`.`status`='Active')";
if(isset($_GET['daterange']))
{
    $daterange=$_GET['daterange'];
}
else
{
    $daterange="";
}
if(isset($_GET['repid']))
{
    $repid=$_GET['repid'];
}
else
{
    $repid="";
}

if(isset($_GET['formtype']))
{
    $formtype=$_GET['formtype'];
}
else
{
    $formtype="";
}

if($repid!="")
{
    $condition.=" and (`predr_formdetails`.`report_id`='".$repid."')";
}
if($formtype!="")
{
    $condition.=" and (`predr_formdetails`.`formname`='".$formtype."')";
}
if($daterange!="")
{  //05/12/2022 - 06/21/2022
   $fulldate=explode("-",$daterange);
   $fromdate=$fulldate[0];
   $splitfrom=explode("/",$fromdate);
   $newfromdate=trim($splitfrom[2]).":".trim($splitfrom[0]).":".trim($splitfrom[1]);
   $todate=$fulldate[1];
   $splitto=explode("/",$todate);
   $newtodate=trim($splitto[2])."-".trim($splitto[0])."-".trim($splitto[1]);
   //echo $todat=date_create('.$newtodate.');
  // $todat=date_format($todat33,"Y:m:d");
   //die();
   $newplustodate=date('Y:m:d', strtotime($newtodate.'+1 days'));
   $condition.=" and (`predr_formdetails`.`createddate` BETWEEN '".$newfromdate."' and '".$newplustodate."')";
}
$orderbyfreshleads="`report_id` DESC";
$fields = "`predr_formdetails`.id,`predr_formdetails`.report_id,`predr_formdetails`.formname,`predr_formdetails`.firstname,`predr_formdetails`.email,`predr_formdetails`.designation,`predr_formdetails`.phone,`predr_formdetails`.address,`predr_formdetails`.state,`predr_formdetails`.city,`predr_formdetails`.country,`predr_formdetails`.zipcode,`predr_formdetails`.company,`predr_formdetails`.comments,`predr_formdetails`.createddate";
$lead_details = $obj_lead->getLeadDetails($fields, $condition, $orderbyfreshleads,'', 0);

if (isset($lead_details) && !empty($lead_details)) {
    $delimiter = ",";
    $filename = "leads-" . time() . ".csv";

    $f = fopen('php://memory', 'w');

    $header = array('Lead ID', 'Report ID','Form Name','Firstname','Email','Designation', 'Phone','Address','State' ,'City' ,'Country', 'Zipcode', 'Company','Message', 'Created Date');
    fputcsv($f, $header, $delimiter);

    foreach ($lead_details as $lead_detail) {
        fputcsv($f, $lead_detail, $delimiter);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
?>
