<?php
require_once("precedence/classes/cls-author.php");

$obj_author = new Author();

$author_id = 1;

$fields_report="*";
$condition_report="`predr_reviewedBy`.`reviewed_id`='".$author_id."'";
$report_detail_specifics=$obj_author->getReviewDetails($fields_report,$condition_report,'','',0);
$report_detail_specific=end($report_detail_specifics);

$meta_title= $report_detail_specific['reviewed_name']."- Towards Packaging";
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
    .text-black{
        color:#000 !important;
    }
</style>
<?php include("header.php");?>
 <div class="top-bgg ptb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                 <div class="text-center">
                    <img src="<?php echo SITEPATH.'author-img/'.$report_detail_specific['profile_pic']; ?>" class="img-fluid border-al me-4" width="240">
                </div>
            </div>
            <div class="col-md-9">
                <div class="author-dl-info">
                <h3 class="text-black" style=".text-black{
        color:#000 !important;
    }"><?php echo $report_detail_specific['reviewed_name']; ?></h3>
                <p class="para text-black pb-4 font-20">
                     <strong><?php echo $report_detail_specific['reviewed_designation']; ?></strong>
                </p>
                <div> 
                    <?php echo str_replace("<p","<p class='para text-black pb-3'",  str_replace("<strong", "<strong class='fw-bold'",$report_detail_specific['reviewed_description'])); ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php");?>