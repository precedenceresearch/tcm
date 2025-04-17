<?php 
require_once("precedence/classes/cls-report.php");

$obj_report = new Report();

$fields_report="report_id,CatId,reportSubject,reportLDesc,reportDate,toc,Price_SUL,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords,author_id";
$condition_report="`predr_reports`.`status`='Active'";
$sort_by = "`predr_reports`.`reportDate` DESC";
$report_details=$obj_report->getReportDetails($fields_report,$condition_report,$sort_by,'',0);

//print_r($report_details);
$base_url = "<?php echo SITEPATH; ?>php-sitemap/";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

foreach($report_details as $report_detailss)
{
    $modifiedDate = date('Y-m-d\TH:i:sP', strtotime($report_detailss['reportDate'])); // Format as ISO 8601
 echo '<url>' . PHP_EOL;
 echo '<loc>'.SITEPATH .'insights/'. $report_detailss['slug'] .'</loc>' . PHP_EOL;
 echo "<lastmod>" . $modifiedDate . "</lastmod>".  PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>