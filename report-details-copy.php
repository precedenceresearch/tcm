<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");
require_once("precedence/classes/cls-author.php");

$obj_author = new Author();
$obj_report = new Report();
$obj_category = new Category();
 
if(isset($_GET['slug']))
{
    $slug=$_GET['slug'];
    $fields_report="report_id,CatId,reportSubject,shortDescription,reportLDesc,toc,Price_SUL,reportDate,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords,author_id";
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
    $fields_report="report_id,CatId,reportSubject,shortDescription,reportLDesc,toc,Price_SUL,reportDate,Price_CUL,Price_Multi,No_Pages,slug,meta_title,meta_description,meta_keywords";
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
<style>
    .nt-modal .modal-dialog {
        max-width: 1240px!important;
        margin:17rem auto!important;
    }
    .cnt-hld{
        padding:1rem;
        text-align:center;
    }
    .cnt-hld p{
        font-weight:500;
        font-size: 2.2rem;
        color: #dc8b08;
        text-align:center; 
        margin-bottom: 0;
    }
    .cnt-hld span{font-size:1.4rem;}
    .modal-not-popup{padding:0 3rem;}
    .modal-not-popup h3{ color: #dc8b08;text-transform:uppercase;font-size:1.6rem;margin-bottom:0;padding-bottom:.5rem;}
    .modal-not-popup h2{font-size:2.4rem;font-weight:500;padding-bottom:.7rem;}
    .modal-backdrop.show {opacity: .75!important;}
    .nt-modal .modal-header{justify-content:end;}
    .nt-modal .modal-header button{border:none;background:transparent;font-size:20px;}
</style>
<?php include("header.php");?>
<div class="progress-bar-container">
    <div class="progress-bar"></div>
</div>
<div class="sticky-option" id="detail-sticky">
    <div class="container">
        <div class="row pt-4 pb-4 align-items-center">
            <div class="col-md-2">
                <a class="no-mob-view" href="<?php echo SITEPATH;?>" >
                     <img src="<?php echo SITEPATH;?>images/towards-packaging-svg-logo.svg" alt="Towards Packaging" title="Towards Packaging" class="img-fluid company-logo" width="141" height="41">
                </a>     
            </div>
            <div class="col-md-5">
                <div class="report-sticky-ttl">
                    <h5 class="mb-0" title="<?php echo strip_tags(trim($report_detail_specific['meta_title']));?>"><?php if(strlen($report_detail_specific['meta_title'])>80) { echo substr(strip_tags(trim($report_detail_specific['meta_title'])), 0, 78) . "..."; } else { echo strip_tags(trim($report_detail_specific['meta_title']));}?></h5>
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
            <a href="<?php echo SITEPATH.'table-of-content/'.$report_detail_specific['slug']; ?>" class="btn yl-btn mt-0 bg-light-gr-dl" rel="nofollow">Table of Content
                <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
            </a>
            <a href="<?php echo SITEPATH."personalized-scope/".$report_detail_specific['report_id'];?>" class="btn yl-btn me-4 mt-0">Get a Sample
                <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow bg-dr-yl" width="15" height="15">
            </a>
         </div>
        </div>
        </div>
    </div>
</div>

<div id="jumptomob" class="sticky-popup">
    <button type="button" class="btn ind-btn btn-2 modal-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <img src="<?php echo SITEPATH;?>images/hamburger.webp" alt="Jump to Menu" class="img-fluid hamb-btn" width="25" height="25">
      <img src="<?php echo SITEPATH;?>images/cross.webp" alt="Close" title="Close" style="display:none;" class="img-fluid cross-btn" width="25" height="25">
    </button>
</div>

<div class="modal fade jumptopopup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div id="navLeft2" class="list-group h2_tags thr-scroll">
                    <?php // Create a DOMDocument object
                     $html = stripslashes($report_detail_specific['reportLDesc']);
                    $dom = new DOMDocument();
                    
                    // Load HTML content
                    $dom->loadHTML($html);
                    
                    // Get all <h2> tags
                    $h2_tags = $dom->getElementsByTagName('h2');
                    
                    // Iterate through each <h2> tag and print its content
                    foreach ($h2_tags as $tag) {
                    ?>
                    <a class="list-group-item list-group-item-action" href="#<?php echo preg_replace('/[^a-zA-Z0-9\-]/', '', strtolower(str_replace(' ', '-', strip_tags(strtolower($tag->textContent))))); ?>"> <?php echo $tag->textContent . "\n"; ?></a>
                    
                    <?php  } ?>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="<?php echo SITEPATH.'table-of-content/'.$report_detail_specific['slug']; ?>" class="btn blck-btn" rel="nofollow">Table of Content
                    <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                </a>
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
                 <div class="r-banner-txt shortD">
                    <h1 class="mb-0 text-white"><?php echo $report_detail_specific['reportSubject'];?></h1>
                    <?php if(isset($report_detail_specific['shortDescription']) && !empty($report_detail_specific['shortDescription'])){ ?>
                    
                        <?php echo preg_replace('/<p([^>]*)>/', '<p$1 class="short-description">', $report_detail_specific['shortDescription']); ?>  
                        
                    <?php }else{ ?>
                        <strong class="text-white">Status: <span class="fw-normal border-end pe-4">Published</span></strong>
                        <strong class="ps-4 text-white">Category: <span class="fw-normal"><?php echo $category_detail['catName'];?></span></strong>
                        <span class="d-block pb-3"></span>
                        <strong class="text-white">Insight Code: <span class="fw-normal border-end pe-4"><?php echo $report_detail_specific['report_id'];?></span></strong>
                        <strong class="ps-4 text-white">Format: <span class="fw-bold">PDF / PPT / Excel</span></strong>
                   <?php } ?>
                 </div>
                 <div class="banner-btn">
                     <a href="<?php echo SITEPATH."personalized-scope/".$report_detail_specific['report_id'];?>" class="btn blck-btn bg-white text-dark me-4">Get a Sample
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                    </a>
                     <?php if(isset($report_detail_specific['toc']) || !empty($report_detail_specific['toc'])){ ?>
                        <a href="<?php echo SITEPATH.'table-of-content/'.$report_detail_specific['slug']; ?>" class="btn yl-btn" rel="nofollow">Table of Content
                            <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                        </a>
                    <?php } ?>
                 </div>
             </div>
         </div>
     </div>
 </div>
<div class="container-fluid space-right-left-3">
     <div class="row ptb">
         <div class="col-md-2">
             <div class="sticky-holder left-data">  
                    <h2 class="f-20">Content</h2>
                    <div id="navLeft" class="list-group h2_tags thr-scroll" id="style-11">
                        <?php // Create a DOMDocument object
                         $html = stripslashes($report_detail_specific['reportLDesc']);
                        $dom = new DOMDocument();
                        
                        // Load HTML content
                        $dom->loadHTML($html);
                        
                        // Get all <h2> tags
                        $h2_tags = $dom->getElementsByTagName('h2');
                        
                        // Iterate through each <h2> tag and print its content
                        foreach ($h2_tags as $tag) {
                        ?>
                        <a class="list-group-item list-group-item-action" href="#<?php echo preg_replace('/[^a-zA-Z0-9\-]/', '', strtolower(str_replace(' ', '-', strip_tags(strtolower($tag->textContent))))); ?>"> <?php echo $tag->textContent . "\n"; ?></a>
                        
                        <?php  } ?>
                    </div>
                </div>
         </div>
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
                $newContent->loadHTML('<p style="text-align: center;margin-top: 20px;"><strong>Unlock Infinite Advantages: <a href="https://www.towardspackaging.com/get-an-annual-membership" target="_blank" style="color: #b5793a; text-decoration: auto;">Subscribe to Annual Membership</a></strong></p>');
                
                // Import the new content into the main document
                $newContent = $doc->importNode($newContent->documentElement, true);
                if(isset($imgTag)){
                // Insert the new content after the first img tag
                $imgTag->parentNode->insertBefore($newContent, $imgTag->nextSibling);
                
                // Get the updated HTML content
                $updatedHTML = $doc->saveHTML();
                
                // Print or use $updatedHTML as needed
                //echo $updatedHTML;
                
                // Regular expression pattern to match <h2> tags
                $pattern = '/<h2[^>]*>(.*?)<\/h2>/si';
                
                // Replace <h2> tags with ID attribute containing the title
                $updatedHTML = preg_replace_callback($pattern, function($match) {
                    $title = $match[1]; // Get the content of the <h2> tag
                    $id = strtolower(str_replace(' ', '-', strip_tags($title))); // Create ID from the title without <strong> tag
                    $id = preg_replace('/[^a-zA-Z0-9\-]/', '', strtolower(str_replace(' ', '-', strip_tags($title))));
                    $id = strtolower(str_replace('amp', 'and', $id));
                    return '<h2 id="' . $id . '">' . $title . '</h2>'; // Replace with ID attribute
                }, $updatedHTML);
                
                echo $updatedHTML;
                
                }else{
                    echo $output;
                }
                ?> 
             </div>
         </div>
<?php // Define a regular expression pattern to match the src attribute of the first image tag
$pattern = '/<img[^>]+src="([^">]+)"/';

// Perform the pattern matching
if (preg_match($pattern, $report_detail_specific['reportLDesc'], $matches)) {
    // The first match is the entire img tag, the second match is the src attribute value
    $firstImageSrc = str_replace('../','https://www.towardspackaging.com/', $matches[1]);
    }else{ $firstImageSrc = ""; }  ?>         
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "<?php echo $report_detail_specific['meta_title']; ?>",
  "description": "<?php echo $report_detail_specific['meta_description']; ?>",
  "imageUrl": "<?php echo $firstImageSrc; ?>",
  "author": {
    "@type": "Organization",
    "name": "Towards Packaging"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Towards Packaging",
    "logo": {
      "@type": "ImageObject",
      "url": "https://www.towardspackaging.com/images/towards-packaging-svg-logo.svg"
    }
  },
  "datePublished": "<?php echo $report_detail_specific['reportDate']; ?>",
  "dateModified": "<?php echo $report_detail_specific['reportDate']; ?>"
}
</script>
         <div class="col-md-3">
             <div class="right-side-content shadow-common">
                <ul class="list-unstyled">
                    <li>
                        <strong>Insight Code:</strong> <?php echo $report_detail_specific['report_id'];?>                            
                    </li>
                    <li>
                        <strong>No. of Pages:</strong> <?php echo $report_detail_specific['No_Pages'];?>+                       
                    </li>
                    <li>
                        <strong>Format:</strong> PDF/PPT/Excel
                    </li>                            
                    <li>
                        <strong>Published:</strong> <?php echo date("F Y", strtotime($report_detail_specific['reportDate'])); ?>                        
                    </li>
                    <li co=""><strong>Report Covered:</strong> [<span style="color:red;">Revenue + Volume</span>]</li> 
                    <li><strong>Historical Year:</strong> 2021-2022 </li>
                    <li><strong>Base Year:</strong> 2023 </li>
                    <li><strong>Estimated Years:</strong> 2024-2033 </li>
                </ul>
            </div>
            <div class="price-hld mt-4" id="right-sidebar-info">
                 <h2 class="font-18 pb-3">Proceed To Buy</h2>
                <form method="POST" action="<?php echo SITEPATH; ?>price/<?php echo $report_detail_specific['report_id']; ?>">
                    <input type="hidden" name="licen_type" id="licen_type" value="Single User License">
                            <div id="single_table">
                                <div class="d-flex justify-content-between space-top-bottom ">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" id="rad02" name="lty" value="5400" checked>
                                      <label class="form-check-label" for="rad02">
                                            Global Deep Dive Analysis  
                                      </label>
                                    </div>
                                    <span>USD 5400</span>
                                </div>
                                <div class="d-flex justify-content-between space-top-bottom">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" id="rad03" name="lty" value="3800">
                                      <label class="form-check-label" for="rad03">
                                        Single Region
                                      </label>
                                    </div>
                                    <span>USD 3800</span>
                                </div>
                                <div class="d-flex justify-content-between space-top-bottom">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" id="rad04" name="lty" value="2100">
                                      <label class="form-check-label" for="rad04">
                                        Databook  
                                      </label>
                                    </div>
                                    <span>USD 2100</span>
                                </div>
                                <div class="d-flex justify-content-between space-top-bottom">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" id="rad06" name="lty" value="7500">
                                      <label class="form-check-label" for="rad06">
                                        Cross-Sectional Analysis 
                                      </label>
                                    </div>
                                    <span>USD 7500</span>
                                </div>
                            </div> 
                    	  <!--<div class="blink_me text-center"> <span style="color:#9804d7;"> Immediate Delivery Available<span> </span></span></div>-->
                        <button type="submit" class="btn blck-btn d-block m-auto mt-3">
                            Proceed to Checkout
                            <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                        </button>
                    </form>
                <h2 class="font-18 pb-3">Annual Subscription</h2>
                <div class="sub-hld">
                    <h2>USD 990/ Monthly</h2>
                    <ul class="subr-list list-unstyled">
                        <li>Market Research Reports</li>
                        <li>Packaging Statistics</li>
                        <li>Whitepapers</li>
                    </ul>
                    <div class="text-center">
                        <a href="<?php echo SITEPATH; ?>get-an-annual-membership" class="btn blck-btn bg-dark mt-3">
                            Subscribe Now
                            <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                        </a>
                    </div>
                </div>
                    
            </div>
            
            <!--<h2 class="font-18 txt-blue ">Ask For Sample</h2>-->
            <!--<div class="shadow-box">-->
            <!--    <p class="para">-->
            <!--        No cookie-cutter, only authentic analysis – take the 1st step to become a Precedence Research client-->
            <!--    </p>-->
            <!--    <div class="text-center">-->
            <!--        <a href="#" class="btn green-btn ">Get a Sample-->
            <!--         <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">-->
            <!--        </a>-->
            <!--    </div>-->
            <!--</div>-->
         </div>
     </div>
     
<!-- Related Reports-->

<?php
    $searchKey = str_replace("Market", "", $report_detail_specific['meta_title']);
    $catId = $report_detail_specific['CatId'];
    $words = explode(' ', $searchKey);
    $searchTerms = array_slice($words, 0, 4); // Take the first 4 words
    $searchConditionParts = [];

foreach ($searchTerms as $word) {
    $word = trim($word);
    if (!empty($word)) {
        $searchConditionParts[] = "`meta_title` LIKE '%$word%'";
    }
}

$searchCondition = implode(' OR ', $searchConditionParts);

$fields_report = "report_id, meta_title, CatId, reportDate, reportSubject, slug";
$condition_report = "`predr_reports`.`status`='Active' AND ($searchCondition) AND report_id!=".$report_detail_specific['report_id']."";
$orderby_report = "`predr_reports`.`report_id` DESC";
$report_details = $obj_report->getReportDetails($fields_report, $condition_report, $orderby_report, 4, 0);
    
?>
    <?php if(isset($report_details) && !empty($report_details)){ ?>    
      <div class="bg-light-gr ptb pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="r-ttl space-bottom-7">Related Insights</h2>
                </div>
            </div>
            <div class="row">
                <?php $i=1; foreach($report_details as $report){ ?>
                    <div class="col-lg-3 col-md-6 border-top-bottom">
                    <div class="main-pr <?php if($i!=4){ ?> border-yes <?php } ?>">
                        <div class="related-pr">
                            <h3>
                                <a class="txt-blue" target="_blank" href="<?php echo SITEPATH."insights/".$report['slug']; ?>">
                                    <?php echo $report['reportSubject']; ?>                         
                                </a>
                            </h3>
                        </div>
                        <p class="para"><?php echo date("F Y", strtotime($report['reportDate'])); ?> </p>
                    </div>
                </div>
                <?php $i++; } ?>
            </div>
        </div>
    </div>
  <?php } ?>   
    
     <?php if(isset($author_details) && !empty($author_details)){?>
     <div class="row ptb pb-4" id="about-author">
         <div class="col-md-10 offset-md-1">
            <h4 class="r-ttl text-center">
                About The Author
            </h4>
            <p class="para">
                <?php echo $author_detail['author_description'];?>
            </p>
            <div class="text-center">
                <a href="<?php echo SITEPATH."customization/".$report_detail_specific['report_id'];?>" class="btn blck-btn">Talk to us
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
                    <a href="<?php echo SITEPATH."customization/".$report_detail_specific['report_id'];?>" class="btn blck-btn faq-purple-btn">Any Questions</a>
                </div>
             </div>
         </div>
     </div>
     <?php }?>
 </div>
 
<div class="modal fade nt-modal" tabindex="-1" id="notification-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header border-0">
        <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">
            <img src="<?php echo SITEPATH;?>images/cross-icon.webp" class="img-fluid" width="16" height="16">
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo SITEPATH;?>images/annual-subcription-popup-tp.webp" alt="" class="img-fluid">
            </div>
            <div class="col-md-8">
                <div class="modal-not-popup">
                    <h3 class="para">Consumer Insights</h3>
                    <h2>Unlock Yearly Subscription Today</h2>
                    <p class="para">
                        Annual Access, Limitless Research! Unlock all market research reports with our annual subscription. Stay on top of market trends and crucial
                        insights year-round! 
                    </p>
                    <div class="d-flex justify-content-around mt-5">
                        <div class="cnt-hld shadow w-100">
                            <p>2500+</p>
                            <span>Client Queries in 2023</span>
                        </div>
                        <div class="cnt-hld shadow w-100">
                            <p>5000+</p>
                            <span>Insights Published</span>
                        </div>
                        <div class="cnt-hld shadow w-100">
                            <p>40+</p>
                            <span>Consulting Projects Per Year</span>
                        </div>
                        <div class="cnt-hld shadow w-100">
                            <p>25+</p>
                            <span>Analysts</span>
                        </div>
                    </div>
                    <a href="<?php echo SITEPATH;?>get-an-annual-membership" class="btn blck-btn me-4 mb-5">
                        Annual Membership
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow"
                        width="15" height="15">
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include("footer.php");?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
    var rightBox1 = $("#right-sidebar-info");
    var isSticky1 = false;
    $(window).scroll(function() {
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var documentHeight = $(document).height();
        // Calculate the position for the sticky div to move up with the page when scrolled to the end
        var topPosition = documentHeight - windowHeight - rightBox1.outerHeight();
        // Toggle sticky class based on scroll position
        if (scrollTop > 1130 && !isSticky1) {
            rightBox1.addClass("sticky-s");
            isSticky1 = true;
        } else if (scrollTop <= 1130 && isSticky1) {
            rightBox1.removeClass("sticky-s");
            isSticky1 = false;
        } else if (scrollTop >= topPosition) {
           // rightBox1.css("top", topPosition - scrollTop);
        } else {
            rightBox1.css("top", "");
        }
    });
});
</script>
<script>
      $(document).ready(function() {
    // Smooth scrolling when clicking on the links inside the ul
    $('.h2_tags a').on('click', function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        var headerHeight = $('header').outerHeight(); // Get the height of the header
        var offset = headerHeight + 20; // Add a buffer if needed
        $('html, body').animate({
            scrollTop: $(target).offset().top - offset
        }, 200); // Adjust the duration (200 milliseconds) as needed
    });
});
  </script>
<script>
    $(document).ready(function() {
    var lastId,
        topMenu = $("#navLeft"),
        topMenuHeight = $('header').outerHeight(); // Get the height of the header
       // topMenuHeight = topMenu.outerHeight(),
        menuItems = topMenu.find("a"),
        scrollItems = menuItems.map(function() {
            var item = $($(this).attr("href"));
            if (item.length) {
                return item;
            }
        });

    $(window).scroll(function() {
        var fromTop = $(this).scrollTop() + topMenuHeight + 50;

        var current = scrollItems.map(function() {
            if ($(this).offset().top < fromTop)
                return this;
        });

        current = current[current.length - 1];
        var id = current && current.length ? current[0].id : "";

        if (lastId !== id) {
            lastId = id;
            menuItems.removeClass("active");
            menuItems.filter("[href='#" + id + "']").addClass("active");
        }
    });

    // Trigger the scroll event to initialize the active menu item
    $(window).trigger('scroll');
});
</script>
<script>
        window.onscroll = function() {myFunction()};
        function myFunction() 
        {
            var header = document.getElementById("myHeader");
            var detail_sticky = document.getElementById("detail-sticky")
            var sticky = header.offsetTop;
            if (window.pageYOffset > 1080) 
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
    <script>
    window.onscroll = function() { myFunction() };
    function myFunction() {
    var header = document.getElementById("myHeader");
    var detail_sticky = document.getElementById("detail-sticky");
    var sticky_popup = document.getElementById("jumptomob");
    var sticky = header.offsetTop;

    if (window.pageYOffset > 780) {
        // Check if the view is mobile
        if (window.matchMedia("(max-width: 510px)").matches) { // Adjust the max-width as per your breakpoint
            sticky_popup.style.setProperty("display", "block", "important");
        }
        detail_sticky.style.display = "block";
        detail_sticky.classList.add("sticky");
    } else {
        header.style.position = "unset";
        detail_sticky.classList.remove("sticky");
        detail_sticky.style.display = "none";
        
        // Check if the view is mobile
        if (window.matchMedia("(max-width: 510px)").matches) { // Adjust the max-width as per your breakpoint
            sticky_popup.style.setProperty("display", "none", "important");
        }
    }
}
</script>
<script>
    $(document).ready(function(){
       $(".hamb-btn").click(function(){
         $(".cross-btn").show();
         $(".hamb-btn").hide();
       });
       $(".cross-btn").click(function(){
         $(".hamb-btn").show();
         $(".cross-btn").hide();
       });
       $(document).on('click', '.list-group-item', function() {
            $('#exampleModal').modal('hide');
            $(".hamb-btn").show();
            $(".cross-btn").hide();
          });
    }); 
</script> 

<script>
    $(window).on('load', function() {
    setTimeout(function() {
        $('#notification-modal').modal('show');
    }, 2000); // 20000 milliseconds = 20 seconds 
});
</script>