<?php
require_once("classes/cls-report.php");

$obj_report = new Report();

$reportid=base64_decode($_GET['report_id']);
$condition= "`report_id` = '" . $reportid . "'";
$obj_report->deleteReport($condition, 0);

header("Location:manage-report");
exit(0);

?>