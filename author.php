<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-author.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_author = new Author();
$obj_category = new Category();

$author_id = $_GET['id'];

$fields_report="*";
$condition_report="`predr_author`.`author_id`='".$author_id."'";
$report_detail_specifics=$obj_author->getAuthorDetails($fields_report,$condition_report,'','',0);
$report_detail_specific=end($report_detail_specifics);

    $fields_reportAA="report_id,CatId,reportSubject,shortDescription,reportLDesc,toc,Price_SUL,reportDate,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords,author_id";
    $condition_reportAA="`predr_reports`.`author_id`='".$author_id."'";
    $report_detail_specificsAA=$obj_report->getReportDetails($fields_reportAA,$condition_reportAA,'','',0);

$meta_title= $report_detail_specific['author_name']."- Towards Packaging";
$meta_description=$report_detail_specific['meta_description'];
$meta_keyword="";

?>
<?php
$page= "report-list"; 
?>
<style> 
    .pagedots{
        font-size: 1.2rem;
        color: #000;
        padding: 0.7rem 1.2rem;
        border-radius: 0.5rem;
    }
</style>
<?php include("header.php");?>
 <div class="top-bgg-1 ptb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                 <div class="text-center">
                    <img src="<?php echo SITEPATH.'author-img/'.$report_detail_specific['profile_pic']; ?>" class="img-fluid border-al me-4" width="240">
                </div>
            </div>
            <div class="col-md-9">
                <div class="author-dl-info">
                <h3><?php echo $report_detail_specific['author_name']; ?></h3>
                <p class="para text-white pb-4 font-20">
                     <strong><?php echo $report_detail_specific['author_designation']; ?></strong>
                </p>
                <div> 
                    <?php echo str_replace("<p","<p class='para text-white pb-3'",  str_replace("<strong", "<strong class='fw-bold'",$report_detail_specific['author_description'])); ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ptb">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h2 class="ttl">Market Research Reports</h2>
            <?php foreach($report_detail_specificsAA as $report_detail){
            
                $condition_report_category="`predr_category`.`catId`='".$report_detail['CatId']."'";
                    $category_report_details=$obj_category->getCategoryDetails($fields_category, $condition_report_category, '', '', 0);
                    $category_report_detail=end($category_report_details);
            ?>   
                <div class="report-lists">
                    <p class="mb-0 date-data"><?php echo date("F d, Y",strtotime($report_detail['reportDate']));?></p>
                    <h3>
                        <a href="<?php echo SITEPATH.'insights/'.$report_detail['slug'];?>" target="_blank">
                            <?php echo str_replace("-","-",$report_detail['reportSubject']);?>
                        </a>
                    </h3>
                    <ul class="list-unstyled d-flex mb-0 pb-4">
                        <li class="ps-0">
                          <strong>Status :</strong>
                            Published
                        </li>
                        <li>
                          <strong>No. of Pages:</strong>
                            <?php echo $report_detail['No_Pages'];?></li>
                        <li class="remrightborder">
                          <strong>Category :</strong>
                            <?php echo $category_report_detail['catName'];?>   </li>
                      </ul>
                    <p class="para mb-0"><?php echo substr(strip_tags(trim($report_detail['reportLDesc'])), 0, 250) . "...";?> </p> 
                    </div>
            <?php } ?>    
               
            </div>
        </div>
    </div>
</div>

<?php include("footer.php");?>