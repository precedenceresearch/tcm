<?php
require_once("classes/cls-report.php");

$obj_report = new Report();
$conn = $obj_report->getConnectionObj();

$faq=base64_decode($_GET['faq_id']);


$condition= "`faq_id` = '" . $faq . "'";
$obj_report->deleteReportFAQNew($condition, 0);


header("Location:view-report-faq?report_id=".$_GET['report_id']);
exit(0);

?>