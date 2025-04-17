<?php 
//require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-media.php");
//$obj_report = new Report();
$obj_images = new Media();

$fields = "*";
$condition = "status='Active'";
$all_image_details = $obj_images->getMediaDetails($fields, $condition, '', '', 0);
$total = count($all_image_details);
$sort_by = "created_at ASC";
//$fields = "*";
$image_details = $obj_images->getMediaDetails($fields, $condition, $sort_by, '', 0);
// echo "<pre>";
// print_r($image_details);
// echo "</pre>";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

foreach($image_details as $image_detailss)
{
 echo '<url>' . PHP_EOL;
 echo '<loc>'. str_replace("&", "and", $image_detailss['imagepath']) .'</loc>' . PHP_EOL;
 echo '<priority>1.0</priority>';
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>