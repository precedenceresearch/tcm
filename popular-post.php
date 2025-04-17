<?php
require_once("precedence/classes/cls-report.php");

$obj_report = new Report();


// $condition_featured_report="`predr_reports`.`status`='Active' and `predr_reports`.`popular`='1'";
// $orderby_featured_report="rand()";
// $report_featured_details=$obj_report->getReportDetails($fields_report,$condition_featured_report,$orderby_featured_report,3,0);

if($page=="report-list")
{
    $popcnt="3";
}
else
{
    $popcnt="3";
}
$fields_popular_report="report_id,meta_title,CatId,reportDate,slug";
$condition_popular_report="`predr_reports`.`status`='Active' and `predr_reports`.`popular`='1'";
$orderby_popular_report="rand()";
$report_popular_detail_all=$obj_report->getReportDetails($fields_popular_report,$condition_popular_report,$orderby_popular_report,$popcnt,0);
?>
                <h3 class="ttl green-txt pt-3 mb-0">Popular Post</h3>
                  <ul class="list-unstyled">
                      <?php if(isset($report_popular_detail_all) && !empty($report_popular_detail_all)){
                      foreach($report_popular_detail_all as $report_popular_detail_alls){?>
                      <li>
                        <a href="<?php echo SITEPATH.'insights/'.$report_popular_detail_alls['slug'];?>"><?php if(strlen($report_popular_detail_alls['meta_title'])>60) { echo substr(strip_tags(trim($report_popular_detail_alls['meta_title'])), 0, 60) . "..."; } else { echo strip_tags(trim($report_popular_detail_alls['meta_title']));}?></a>
                        <p class="mb-0"><?php echo date("F d, Y",strtotime($report_popular_detail_alls['reportDate']));?></p>
                        <a href="<?php echo SITEPATH.'insights/'.$report_popular_detail_alls['slug'];?>" class="btn read-btn text-dark">Read More</a>
                      </li>
                      <?php } } else {?>
                      <li>No Post Found</li>
                      <?php }?>
                  </ul>