<?php
require_once("classes/cls-report.php");

$obj_report = new Report();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$conn = $obj_report->getConnectionObj();
$faqid=$_POST['editq'];

$condition="`predr_faq`.`report_id`='".$_POST['report_id']."' and `predr_faq`.`faq_id`='".$faqid."'";
$update_data['question'] = mysqli_real_escape_string($conn, addslashes($_POST['question']));
$update_data['answer'] = mysqli_real_escape_string($conn, addslashes($_POST['answer']));
$obj_report->updateReportFAQNew($update_data, $condition, 0);
    
$_SESSION['success'] = "<strong>FAQ</strong> has been updated successfully.";
$encid=base64_encode($_POST['report_id']);
header("Location:view-report-faq?report_id=$encid");
exit(0);
?>