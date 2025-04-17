<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$fields_featured_report="report_id,meta_title,CatId,reportDate,slug";
$condition_featured_report="`predr_reports`.`status`='Active' and `predr_reports`.`featured`='1'";
$orderby_featured_report="rand()";
$report_featured_detail_all=$obj_report->getReportDetails($fields_featured_report,$condition_featured_report,$orderby_featured_report,4,0);

$fields_category = "catId,catName,slug";
$condition_category="`predr_category`.`status`='Active'";
$category_details=$obj_category->getCategoryDetails($fields_category, $condition_category, '', '', 0);

$fields_report="report_id,meta_title,CatId,reportDate,popular,No_Pages,reportSubject,reportLDesc,slug";
if(isset($_GET['shortcode']))
{
    
    $condition_category_wise="`predr_category`.`slug`='".$_GET['shortcode']."'";
    $category_wises=$obj_category->getCategoryDetails($fields_category, $condition_category_wise, '', '', 0);
    $category_wise=end($category_wises);
    
    if($category_wise){
   
    $condition_report="`predr_reports`.`status`='Active' and CatId='".$category_wise['catId']."'";
    $targetpage = SITEPATH . 'industry/'.$_GET['shortcode'];
    
    $pageHeading = $category_wise['catName'];
    
        /********************************/
       $meta_title= $category_wise['catName']." Reports - In-Depth Industry Analysis";
       $meta_description="Browse reports under the ".strtolower($category_wise['catName'])." category for detailed analysis and research. Find expert insights into specific chemicals and materials sectors to make informed decisions.";
       $meta_keyword= $category_wise['catName']." Insights - Towards Chem and Materials"; 
       $canonical=SITEPATH."industry/".$category_wise['slug'];
       $short=$_GET['shortcode'];
    }else{
        header("Location: https://www.towardspackaging.com/");
        die();
         //$condition_report="`predr_reports`.`status`='Active'";
    }
}
else
{
    
    $condition_report="`predr_reports`.`status`='Active'";   
    $targetpage = SITEPATH . 'reports-store';
    $short="";
    $pageHeading = "Chemicals & Materials Report List | Research & Analysis";
        /********************************/
        $meta_title="Chemicals & Materials Report List | Research & Analysis";
        $meta_description="Explore a wide collection of research reports on chemicals and materials. Access comprehensive market insights, trends, and expert analysis to guide your business decisions.";
        $meta_keyword="";
}


$adjacents = 1;

/* Setup page vars for display. */
$total = 0;
$currentpage = 1;
$limit = 10;
$targetpage .= "/page/";

if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    
} else {
    $page = 0;
    //$targetpage .= "/page/".$page;
}


if ($page) {
    $start = ($page - 1) * $limit; //first item to display on this page
} else {
    $start = 0;
}

$orderby_report="`predr_reports`.`reportDate` DESC";
$condition_report .=" AND `predr_reports`.`status`='Active'";  
$report_details=$obj_report->getReportDetails($fields_report,$condition_report,$orderby_report,"$start, $limit",0);
$report_detail_all=$obj_report->getReportDetails($fields_report,$condition_report,$orderby_report,'',0);
#Get Total Report Count
$total = count($report_detail_all);

if ($page == 0) {
    $page = 1; //if no page var is given, default to 1.
} else {
    $currentpage = $page;    
    
}
$prev = $page - 1; //previous page is current page - 1
$next = $page + 1; //next page is current page + 1
$lastpage = ceil($total / $limit); //lastpage.
$lpm1 = $lastpage - 1; //last page minus 1

/* CREATE THE PAGINATION */
$pagination = "";
$counter = 0;
if ($lastpage > 1) {
    $pagination .= "<ul class=\"pagination\">";
    
    // Previous button logic
    if ($page > $counter + 1) {
        $pagination .= "<a class=\"page-link pre-btn\" href=\"{$targetpage}{$prev}\" rel=\"nofollow\"><li class=\"page-item\"><< Prev</li></a>"; 
    }

    // Logic for less than 5 pages or fewer
    if ($lastpage <= 5 + ($adjacents * 2)) {
        for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page) {
                $pagination .= "<a class=\"page-link active\" href='#' rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
            } else {
                $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\" rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
            }
        }
    }
    // Logic for when there are more than 5 pages
    elseif ($lastpage > 5 + ($adjacents * 2)) {
        // Case: Near the start of the pagination range (beginning)
        if ($page < 1 + ($adjacents * 2)) {
            for ($counter = 1; $counter <= 4 + ($adjacents * 2); $counter++) {
                if ($counter == $page) {
                    $pagination .= "<a class=\"page-link active\" href='#' rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
                } else {
                    $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\" rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
                }
            }
            $pagination .= "<li class=\"page-item pagedots\">...</li>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$lastpage}\" rel=\"nofollow\"><li class=\"page-item\">$lastpage</li></a>";
        }
        // Case: Somewhere in the middle
        elseif ($page > ($adjacents * 2) && $page < $lastpage - ($adjacents * 2)) {
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}1\" rel=\"nofollow\"><li class=\"page-item\">1</li></a>";
            $pagination .= "<li class=\"page-item pagedots\">...</li>";

            // Show pages around the current page
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                if ($counter == $page) {
                    $pagination .= "<a class=\"page-link active\" href='#' rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
                } else {
                    $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\" rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
                }
            }
            $pagination .= "<li class=\"page-item pagedots\">...</li>";
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$lastpage}\" rel=\"nofollow\"><li class=\"page-item\">$lastpage</li></a>";
        }
        // Case: Near the end of the pagination range (end)
        else {
            $pagination .= "<a class=\"page-link\" href=\"{$targetpage}1\" rel=\"nofollow\"><li class=\"page-item\">1</li></a>";
            $pagination .= "<li class=\"page-item pagedots\">...</li>";
            
            // Display the last few pages
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                if ($counter == $page) {
                    $pagination .= "<a class=\"page-link active\" href='#' rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
                } else {
                    $pagination .= "<a class=\"page-link\" href=\"{$targetpage}{$counter}\" rel=\"nofollow\"><li class=\"page-item\">$counter</li></a>";
                }
            }
        }
    }

    // Next button logic
    if ($page < $counter - 1) {
        $pagination .= "<a class=\"page-link nxt-btn\" href=\"{$targetpage}{$next}\" rel=\"nofollow\"><li class=\"page-item\">Next >></li></a>";
    }

    $pagination .= "</ul>\n";
}

$popcnt="3";
$fields_popular_report="report_id,meta_title,CatId,reportDate,slug";
$condition_popular_report="`predr_reports`.`status`='Active' and `predr_reports`.`popular`='1'";
$orderby_popular_report="rand()";
$report_popular_detail_all=$obj_report->getReportDetails($fields_popular_report,$condition_popular_report,$orderby_popular_report,$popcnt,0);

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
 <div class="report-banner pt-0">
    <div class="container">
        <div class="row"> 
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo SITEPATH;?>">
                          <img src="<?php echo SITEPATH;?>images/home-page/Home-light.png" alt="home-icon" class="img-fluid home-icon" width="14" height="14">
                      </a></li>
                      <?php if(isset($_GET['shortcode'])){?>
                      <li class="breadcrumb-item" aria-current="page"><a href="<?php echo SITEPATH;?>reports-store" class="text-white">Insights</a></li>
                      <li class="breadcrumb-item active text-white" aria-current="page"><?php echo ucfirst($category_wise['catName']);?></li>
                      <?php } else {?>
                      <li class="breadcrumb-item active text-white" aria-current="page">Insights</li>
                      <?php }?>
                    </ol>
                  </nav>
                 <h1 class="ttl purple-txt mb-0 pb-2 text-white pt-5 report-ttl"><?php echo $pageHeading; ?></h1>
                <p class="para text-white">Your marketplace is evolving, your competitors are readjusting – but instead of reacting you can proact</p>
            </div>
        </div>
    </div>
</div>
<div class="ptb">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!--<h2 class="ttl">Featured Post</h2>-->
                <!--<p class="para">The global dental implants market is an attractive subset of the global dental supply and equipment market. Growing -->
                <!--dental care expenditure, increasing prosperity and awareness of oral health</p>-->
                <div class="row">
                    <?php $kt=1;foreach($report_featured_detail_all as $report_featured_detail_alls){?>
                    <div class="col-md-6">
                        <div class="list-holder <?php if($kt=="1"){?>bg-light-green <?php } elseif($kt=="2"){?> bg-light-blue <?php } elseif($kt=="3"){?>bg-drk-blue <?php } elseif($kt=="4"){?>bg-dark-green <?php }?>">
                            <span>report list</span>
                            <a class="mb-0" href="<?php echo SITEPATH.'insights/'.$report_featured_detail_alls['slug'];?>"><?php echo strip_tags(trim($report_featured_detail_alls['meta_title']));?></a>
                            <p><?php echo date("F d, Y",strtotime($report_featured_detail_alls['reportDate']));?></p>
                        </div>
                    </div>
                    <?php $kt++;}?>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="container">

    <div class="row">
            <div class="col-md-9">
                <?php 
                    if(isset($report_details) && !empty($report_details))
                    {
                    foreach($report_details as $report_detail){
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
                            <?php echo $category_report_detail['catName'];?>  </li>
                      </ul>
                    <p class="para mb-0"><?php echo substr(strip_tags(trim($report_detail['reportLDesc'])), 0, 250) . "...";?></p>
                </div>
                <?php } } else {?>
                <div class="report-lists">
                   <h2 class="green-txt text-center">No insights Found</h2>
                </div>
                <?php }?>
                <?php if(isset($pagination) && $pagination != "") { ?>
                    <nav aria-label="Page navigation example">
                        <?php echo $pagination ?>
                    </nav>
                
                <?php }?>
            </div>
            <div class="col-md-3">
                <div class="gradient-bg p-4 text-white text-center mb-4">
                    <h3 class="fw-bold">For Any Query</h3>
                    <p class="para text-white">Please drop a mail to the Global 
                    PR Team for your queries</p>
                    <a href="<?php echo SITEPATH;?>contact-us" class="btn grn-btn">Contact Us
                    </a>
                </div>
                <div class="option-main">
                    <h3 class="purple-txt pb-3 mb-0 mt-5">Categories</h3>
                    <div class="outer-main bg-dark-yl w-100">
                    <ul class="list-unstyled">
                        <?php foreach($category_details as $category_detail){?>
                        <li <?php if($category_detail['slug']==$short){?>class="list-active" <?php }?>>
                            <a href="<?php echo SITEPATH;?>industry/<?php echo $category_detail['slug'];?>"><?php echo $category_detail['catName'];?></a>
                        </li>
                        <?php }?>
                    </ul>
                    </div>
                </div>
                <div class="option-main mb-4">
                    <h3 class="purple-txt pb-3 mb-0 mt-5">Quick Contact</h3>
                    <div class="outer-main bg-dark-yl w-100 cnt-outer">
                        <a href="tel:+1 804 441 9344" class="p-0">
                            <img src="<?php echo SITEPATH;?>images/call-icon.webp" alt="call" class="img-fluid activity-icon">
                            +1 804 441 9344
                        </a>
                        <a href="tel:+44 7782 560 738" class="p-0">
                            <img src="<?php echo SITEPATH;?>images/call-icon.webp" alt="call" class="img-fluid activity-icon">
                            +44 7782 560 738
                        </a>
                        <a href="mailto:<?php echo SITEEMAIL; ?>" class="p-0">
                            <img src="<?php echo SITEPATH;?>images/mail-icon.webp" alt="location" class="img-fluid activity-icon">
                             <?php echo SITEEMAIL; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php include("footer.php");?>