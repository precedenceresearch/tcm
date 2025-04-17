<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");
require_once("precedence/classes/cls-author.php");

$obj_author = new Author();
$obj_report = new Report();
$obj_category = new Category();

//print_r($_SERVER);
 
if(isset($_GET['slug']))
{
    $slug=$_GET['slug'];
    $fields_report="report_id,CatId,reportSubject,reportLDesc,toc,Price_SUL,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords,author_id";
    $condition_report="`predr_reports`.`slug`='".$slug."'";
    $report_detail_specifics=$obj_report->getReportDetails($fields_report,$condition_report,'','',0);
    $report_detail_specific=end($report_detail_specifics);
    
    if(empty($report_detail_specific)){
    header('Location: '.SITEPATH);
    die();
}
    
    $fields_category = "catId,catName,slug";
    $condition_category="`predr_category`.`catId`='".$report_detail_specific['CatId']."'";
    $category_details=$obj_category->getCategoryDetails($fields_category, $condition_category, '', '', 0);
    $category_detail=end($category_details);
    
    $fields_faq="*";
    $condition_faq="`predr_faq`.`report_id`='".$report_detail_specific['report_id']."'";
    $faq_details=$obj_report->getReportFAQNewDetails($fields_faq, $condition_faq, '', '', 0);
    //$faq_detail=end($faq_details);
    
    $fields_author="*";
    $condition_author="`predr_author`.`author_id`='".$report_detail_specific['author_id']."'";
    $author_details=$obj_author->getAuthorDetails($fields_author, $condition_author, '', '', 0);
    $author_detail=end($author_details);
    
    $fields_popular_report="report_id,meta_title,CatId,reportDate,slug";
    $condition_popular_report="`predr_reports`.`status`='Active'";
    $orderby_popular_report="rand()";
    $report_popular_detail_all=$obj_report->getReportDetails($fields_popular_report,$condition_popular_report,$orderby_popular_report,5,0);

    $meta_title=$report_detail_specific['meta_title'];
    $meta_description=strip_tags($report_detail_specific['meta_description']);
    $meta_keyword=strip_tags($report_detail_specific['meta_keywords']); 
    $canonical= SITEPATH.$report_detail_specific['slug'];
}
if(isset($_GET['reportid']))
{
    $reportid=$_GET['reportid'];
    $fields_report="report_id,CatId,reportSubject,reportLDesc,toc,Price_SUL,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords";
    $condition_report="`predr_reports`.`report_id`='".$reportid."'";
    $report_detail_specifics=$obj_report->getReportDetails($fields_report,$condition_report,'','',0);
    $report_detail_specific=end($report_detail_specifics);
    
    $fields_category = "catId,catName,slug";
    $condition_category="`predr_category`.`catId`='".$report_detail_specific['CatId']."'";
    $category_details=$obj_category->getCategoryDetails($fields_category, $condition_category, '', '', 0);
    $category_detail=end($category_details);
    
    $fields_faq="*";
    $condition_faq="`predr_faq`.`report_id`='".$report_detail_specific['report_id']."'";
    $faq_details=$obj_report->getReportFAQNewDetails($fields_faq, $condition_faq, '', '', 0);
    
    $fields_author="*";
    $condition_author="`predr_author`.`author_id`='".$report_detail_specific['author_id']."'";
    $author_details=$obj_author->getAuthorDetails($fields_author, $condition_author, '', '', 0);
    $author_detail=end($author_details);
    
    $fields_popular_report="report_id,meta_title,CatId,reportDate,slug";
    $condition_popular_report="`predr_reports`.`status`='Active' and `predr_reports`.`popular`='1'";
    $orderby_popular_report="rand()";
    $report_popular_detail_all=$obj_report->getReportDetails($fields_popular_report,$condition_popular_report,$orderby_popular_report,5,0);

    $meta_title=$report_detail_specific['meta_title'];
    $meta_description=strip_tags($report_detail_specific['meta_description']);
    $meta_keyword=strip_tags($report_detail_specific['meta_keywords']); 
    $canonical= SITEPATH.$report_detail_specific['slug'];
}

$page = "report-detail";
$meta_title=$meta_title;
$meta_keyword=$meta_keyword;
$meta_description=$meta_description;
$canonical= SITEPATH.'insights/'.$report_detail_specific['slug'];

?>

<?php include("header.php");?>

<div class="bg-dark-blue sticky-option" id="detail-sticky">
    <div class="container">
        <div class="row pt-4 pb-4 align-items-center">
            <div class="col-md-1">
                <a class="" href="<?php echo SITEPATH;?>" >
                     <img src="<?php echo SITEPATH;?>images/towards-packaging-logo.png" alt="Towards Packaging" title="Towards Packaging" class="img-fluid company-logo" width="141" height="41">
                </a>     
            </div>
            <div class="col-md-6">
                <div class="report-sticky-ttl">
                    <h5 class="mb-0 text-white" title="<?php echo strip_tags(trim($report_detail_specific['meta_title']));?>"><?php if(strlen($report_detail_specific['meta_title'])>80) { echo substr(strip_tags(trim($report_detail_specific['meta_title'])), 0, 78) . "..."; } else { echo strip_tags(trim($report_detail_specific['meta_title']));}?></h5>
                </div>
            </div>
            <div class="col-md-5">
                <div class="banner-btn text-end">
            <?php 
            $message1_c = '<table>';
            $message1_c .= '<tr><td>Dear,</td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= "<tr><td>Thank you for your inquiry on <b> ".$report_detail_specific['meta_title']."</b>. Soon our sales team will be sharing a sample of the report. Meanwhile, it would be great if you can answer the following questions:</td></tr>";
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td>1. Do you have any specific requirements? </td></tr>';
            $message1_c .= '<tr><td>Ans: </td></tr>';
            $message1_c .= '<tr><td>2. How soon do you want to purchase the project?</td></tr>';
            $message1_c .= '<tr><td>Ans: </td></tr>';
            $message1_c .= '<tr><td>3. Do you have any budget in your mind for the project</td></tr>';
            $message1_c .= '<tr><td>Ans: </td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td>We look forward to hearing from you.</td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '<tr><td>Regards,</td></tr>';
            $message1_c .= '<tr><td></td></tr>';
            $message1_c .= '</table>';
            ?>         
                     <a href="<?php echo SITEPATH."personalized-scope/".$report_detail_specific['report_id'];?>" class="btn purple-btn bg-white text-dark me-4 mt-0">Personalized Scope
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </a>
                    <!--<a href="mailto:<?php echo SITEEMAIL; ?>?subject=Sales Enquiry - <?php echo $report_detail_specific['reportSubject'];?>&body=Dear Towards Packaging Team, %0D%0A %0D%0A -->
                    <!--1 Do you have any specific requirements%3F %0D%0A-->
                    <!--Ans: %0D%0A-->
                    <!--2 How soon do you want to purchase the project%3F %0D%0A-->
                    <!--Ans: %0D%0A-->
                    <!--3 Do you have any budget in your mind for the project%3F %0D%0A %0D%0A-->
                    <!--Ans: %0D%0A-->
                    <!--We look forward to hearing from you. %0D%0A %0D%0A %0D%0A %0D%0A-->
                    <!--Regards, %0D%0A-->
                    <!--" class="btn mt-0 green-btn">Ask to Expert-->
                    <!--    <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">-->
                    <!--</a>-->
                   <a href="<?php echo SITEPATH.'price/'.$report_detail_specific['report_id']; ?>" class="btn green-btn mt-0">Order Now
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </a>
                 </div>
            </div>
        </div>
    </div>
</div>
 <div class="report-banner ptb pt-0 report-banner-bg">
     <div class="container">
         <div class="row pb-5">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo SITEPATH;?>" rel="nofollow">
                            <img src="<?php echo SITEPATH;?>images/home-page/Home-light.png" alt="home-icon" class="img-fluid home-icon" width="14" height="14">
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?php echo SITEPATH;?>reports-store" class="text-white" rel="nofollow">Insights</a></li>
                    <!--<li class="breadcrumb-item"><a href="<?php echo SITEPATH."industry/".$category_detail['slug'];?>" class="text-white"><?php echo $category_detail['catName'];?></a></li>-->
                    <li class="breadcrumb-item active text-white" aria-current="page"><?php echo ucwords(str_replace("-"," ",$report_detail_specific['slug']));?></li>
                  </ol>
                </nav>
            </div>
        </div>
         <div class="row align-items-center">
             <div class="col-md-7">
                 <div class="r-banner-txt">
                    <h1 class="mb-0 text-white"><?php echo $report_detail_specific['reportSubject'];?></h1>
                    <strong class="text-white">Status: <span class="fw-normal border-end pe-4">Published</span></strong>
                    <strong class="ps-4 text-white">Category: <span class="fw-normal"><?php echo $category_detail['catName'];?></span></strong>
                    <span class="d-block pb-3"></span>
                    <strong class="text-white">Insight Code: <span class="fw-normal border-end pe-4"><?php echo $report_detail_specific['report_id'];?></span></strong>
                    <strong class="ps-4 text-white">Format: <span class="fw-bold">PDF / PPT / Excel</span></strong>
                 </div>
                 <div class="banner-btn">
                     <a href="<?php echo SITEPATH."personalized-scope/".$report_detail_specific['report_id'];?>" class="btn purple-btn bg-white text-dark me-4">Personalized Scope
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </a>
                    <a href="<?php echo SITEPATH.'price/'.$report_detail_specific['report_id']; ?>" class="btn green-btn">Order Now
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 
 <div class="container">
     <div class="row ptb">
         <div class="col-md-2"></div>
         <div class="col-md-7">
             <div class="report-details-data-info">
                <?php 
                $output = stripslashes($report_detail_specific['reportLDesc']);
                // Load the HTML content into a DOMDocument
                $doc = new DOMDocument();
                $doc->loadHTML($output);
                
                // Find the first img tag
                $imgTag = $doc->getElementsByTagName('img')->item(0);
                
                // Create a new DOMDocument for your HTML content
                $newContent = new DOMDocument();
                $newContent->loadHTML('<p style="text-align: center;margin-top: 20px;"><strong>Unlock Infinite Advantages: <a href="https://www.towardspackaging.com/get-an-annual-membership" target="_blank" style="color: #9804d7; text-decoration: auto;">Subscribe to Annual Membership</a></strong></p>');
                
                // Import the new content into the main document
                $newContent = $doc->importNode($newContent->documentElement, true);
                if(isset($imgTag)){
                // Insert the new content after the first img tag
                $imgTag->parentNode->insertBefore($newContent, $imgTag->nextSibling);
                
                // Get the updated HTML content
                $updatedHTML = $doc->saveHTML();
                
                // Print or use $updatedHTML as needed
                echo $updatedHTML;
                }else{
                    echo $output;
                }
                ?> 
             </div>
         </div>
         <div class="col-md-3">
             <!--<div class="feature-post">-->
             <!--    <?php //include("popular-post.php");?>-->
             <!--</div>-->
             <div class="sticky-holder popular-data">
                 <div class="bg-gray p-4">
                    <h3 class="r-ttl">Popular Insights</h3>
                    <ul class="r-details-list list-unstyled ps-4">
                        <?php if(isset($report_popular_detail_all) && !empty($report_popular_detail_all)){
                          foreach($report_popular_detail_all as $report_popular_detail_alls){?>
                         <li>
                             <!--<img src="images/home-page/Insights.png" alt="" class="img-fluid">-->
                             <a href="<?php echo SITEPATH.'insights/'.$report_popular_detail_alls['slug'];?>"><?php if(strlen($report_popular_detail_alls['meta_title'])>120) { echo substr(strip_tags(trim($report_popular_detail_alls['meta_title'])), 0, 120) . "..."; } else { echo strip_tags(trim($report_popular_detail_alls['meta_title']));}?></a>
                         </li>
                         <?php } }?>
                    </ul>
                </div>
                <div class="order-hld mt-3">
                    <p>
                        Unlock a Year of Exclusive Perks: Join Our Membership Today.                
                    </p>
                    <a href="<?php echo SITEPATH;?>get-an-annual-membership" class="btn green-btn mt-0" target="_blank">Annual Membership
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </a>
                </div>
             </div>
             <div class="right-side-content shadow-common" id="right-sidebar-info">
                <ul class="list-unstyled">
                    <li>
                        <strong>Report Code:</strong>3931                            
                    </li>
                    <li>
                        <strong>No. of Pages:</strong>150+                           
                    </li>
                    <li>
                        <strong>Format:</strong>PDF/PPT/Excel
                    </li>                            <li>
                        <strong>Published:</strong>March 2024                            
                    </li>
                    <li co=""><strong>Report Covered:</strong>[<span style="color:red;">Revenue + Volume</span>]</li> 
                    <li><strong>Historical Year:</strong>2021-2022</li>
                    <li><strong>Base Year:</strong>2023</li>
                    <li><strong>Estimated Years:</strong>2024-2033</li>
                </ul>
                <div class="text-center" id="sticky-toc">
                        <a href="https://www.precedencechecker.com/table-of-content/3931" class="btn ind-link w-50">Access TOC</a>
                </div>
            </div>
         </div>
     </div>
     
     <?php if(isset($author_details) && !empty($author_details)){?>
     <div class="row ptb pb-4 pt-0">
         <div class="col-md-12">
            <h4 class="r-ttl text-center">
                About The Author
            </h4>
            <p class="para">
                <?php echo $author_detail['author_description'];?>
            </p>
            <div class="text-center">
                <a href="<?php echo SITEPATH."customization/".$report_detail_specific['report_id'];?>" class="btn purple-btn">Talk to us
                    <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow"
                    width="15" height="15">
                </a>
            </div>
         </div>
     </div>
     <?php }?>
     
<?php if(isset($faq_details) && !empty($faq_details)){?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
<?php

    $finalCount = count($faq_details);
    $i=1;
     foreach($faq_details as $faq_detail){
	 ?>{
		"@type": "Question",
		"name": "<?php echo trim($faq_detail['question']); ?>",
		"acceptedAnswer": {
		  "@type": "Answer",
		  "text": "<?php echo trim($faq_detail['answer']); ?>"
		}
    }<?php if($i!=$finalCount){ echo ","; } ?><?php $i++; } ?>
]}
</script>
<?php } ?>
     
     <?php if(isset($faq_details) && !empty($faq_details)){?>
     <div class="row ptb">
         <div class="col-md-10 offset-md-1">
             <h5 class="text-center r-ttl border-bottom pb-4"> FAQ's</h5>
             <div class="faq-holder">
                 <div class="accordion accordion-flush" id="accordionFlushExample">
                    <?php $i=0;foreach($faq_details as $faq_detail){?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $i;?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $i;?>">
                            <?php echo $faq_detail['question'];?>
                          </button>
                        </h2>
                        <div id="flush-collapse<?php echo $i;?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $i;?>" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body"><?php echo $faq_detail['answer'];?></div>
                        </div>
                    </div>
                    <?php $i++;}?>
                </div>
                <div class="text-center">
                    <a href="<?php echo SITEPATH."customization/".$report_detail_specific['report_id'];?>" class="btn purple-btn faq-purple-btn">Any Questions</a>
                </div>
             </div>
         </div>
     </div>
     <?php }?>
     <!--<div class="row ptb pt-0">-->
     <!--    <div class="col-md-12">-->
     <!--        <h5 class="r-ttl text-center">Related Articles</h5>-->
     <!--    </div>-->
     <!--    <div class="col-md-4">-->
     <!--        <div class="article-holder">-->
     <!--            <img src="">-->
     <!--            <div class="article-content">-->
     <!--                <p class="para">At a time when more students are-->
     <!--                   learning remotely and many office spaces -->
     <!--                   have remained close-->
     <!--                </p>-->
     <!--               <a href="#">Read More</a>-->
     <!--            </div>-->
     <!--        </div>-->
     <!--    </div>-->
     <!--    <div class="col-md-4">-->
     <!--        <div class="article-holder">-->
     <!--            <img src="">-->
     <!--            <div class="article-content">-->
     <!--                <p class="para">At a time when more students are-->
     <!--                   learning remotely and many office spaces -->
     <!--                   have remained close-->
     <!--                </p>-->
     <!--               <a href="#">Read More</a>-->
     <!--            </div>-->
     <!--        </div>-->
     <!--    </div>-->
     <!--    <div class="col-md-4">-->
     <!--        <div class="article-holder">-->
     <!--            <img src="">-->
     <!--            <div class="article-content">-->
     <!--                <p class="para">At a time when more students are-->
     <!--                   learning remotely and many office spaces -->
     <!--                   have remained close-->
     <!--                </p>-->
     <!--               <a href="#">Read More</a>-->
     <!--            </div>-->
     <!--        </div>-->
     <!--    </div>-->
     <!--</div>-->
 </div>

<?php include("footer.php");?>
<?php include("report-detail-graphs.php");?>
<script>
        window.onscroll = function() {myFunction()};
        function myFunction() 
        {
            var header = document.getElementById("myHeader");
            var detail_sticky = document.getElementById("detail-sticky")
            var sticky = header.offsetTop;
            if (window.pageYOffset > 320) 
            {   
                //header.classList.add("sticky");
                detail_sticky.style.display = "block";
                 detail_sticky.classList.add("sticky");
                 
                //document.getElementById("myHeader").style.display = "block";
            } 
            else 
            {   //alert("dd");
                detail_sticky.classList.remove("sticky");
                detail_sticky.style.display = "none";
             // detail_sticky.classList.add("sticky");
               // document.getElementById("stickyheader").style.display = "none";
                
            }
        }
    </script> 