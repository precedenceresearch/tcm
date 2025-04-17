<?php
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category(); 

$condition = "";

$daterange = isset($_GET['daterange']) ? $_GET['daterange'] : "";
$repid = isset($_GET['repid']) ? $_GET['repid'] : "";

if ($repid != "") {
    $condition .= " and (`predr_reports`.`report_id`='" . $repid . "')";
}

if ($daterange != "") {
    $fulldate = explode("-", $daterange);
    $fromdate = trim($fulldate[0]);
    $splitfrom = explode("/", $fromdate);
    $newfromdate = trim($splitfrom[2]) . "-" . trim($splitfrom[0]) . "-" . trim($splitfrom[1]);

    $todate = trim($fulldate[1]);
    $splitto = explode("/", $todate);
    $newtodate = trim($splitto[2]) . "-" . trim($splitto[0]) . "-" . trim($splitto[1]);

    $newplustodate = date('Y-m-d', strtotime($newtodate . '+1 days'));
    $condition .= " and (`predr_reports`.`createddate` BETWEEN '" . $newfromdate . "' and '" . $newplustodate . "')";
}

$orderbyfreshleads = "`report_id` DESC";
$fields = "`predr_reports`.report_id, `predr_reports`.reportSubject, CONCAT('https://www.towardspackaging.com/insights/', `predr_reports`.slug) AS slug, `predr_reports`.CatId, `predr_reports`.reportDate";

$report_details = $obj_report->getReportDetails($fields, $condition, $orderbyfreshleads, '', 0);

if (!empty($report_details)) {
    $delimiter = ",";
    $filename = "Reports-" . time() . ".csv";

    $f = fopen('php://memory', 'w');

    $header = array('Report ID', 'Report Title', 'Report URL', 'Category', 'Published Date');
    fputcsv($f, $header, $delimiter);

    foreach ($report_details as $lead_detail) {
        $catid = $lead_detail['CatId'];
       
        $fields = "catName";
        $condition = "`predr_category`.`catId`='" . $catid . "'";
        $category_details = $obj_category->getCategoryDetails($fields, $condition, '', '', '', 0);
        
        $catName = (!empty($category_details)) ? $category_details[0]['catName'] : "Unknown"; // Default if not found

        $csvRow = array(
            $lead_detail['report_id'],
            $lead_detail['reportSubject'],
            $lead_detail['slug'],
            $catName,
            $lead_detail['reportDate']
        );

        fputcsv($f, $csvRow, $delimiter);
    }
    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    fpassthru($f);

    fclose($f);
    exit();
} else {
    echo "No reports found.";
}
?>
