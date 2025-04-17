<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

    $slug=$_GET['slug'];
    $fields_report="*";
    $condition_report="`predr_topCompanies`.`slug`='".$slug."'";
    $report_detail_specifics=$obj_report->getCompanyDetails($fields_report,$condition_report,'','',0);
    $report_detail_specific=end($report_detail_specifics);
    
    if(empty($report_detail_specific)){
        header("Location: " . SITEPATH);
        exit;
    }

    $meta_title=$report_detail_specific['prmetatitle'];
    $meta_description=strip_tags($report_detail_specific['prmetadesc']);
    $meta_keyword=strip_tags($report_detail_specific['prmetakeywords']); 
    $canonical= SITEPATH.$report_detail_specific['slug'];
?>
<?php
$page = "report-list"; 
?>
<?php include("header.php");?>
 <div class="companies-banner pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo SITEPATH;?>">
                          <img src="<?php echo SITEPATH;?>images/home-page/Home-light.png" alt="home-icon" class="img-fluid home-icon" width="14" height="14">
                      </a></li>
                      <li class="breadcrumb-item active text-white" aria-current="page">Top Companies</li>
                    </ol>
                  </nav>
                <h1 class=" mb-0 pb-2 text-white pt-5 report-ttl"><?php echo $report_detail_specific['title']; ?></h1>
                <p class="para text-white">Date: <?php echo date("F Y", strtotime($report_detail_specific['pub_date'])); ?></p>
            </div>
        </div>
    </div>
</div>
<div class="ptb">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="company-listing-details">
                        <?php 
                $output = stripslashes($report_detail_specific['view_desc']);
                // Load the HTML content into a DOMDocument
                $doc = new DOMDocument();
               
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
                }, $output);
                
                echo str_replace("<table ", "<table class='table table-bordered'", $output);
              
                ?> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="price-hld mt-4" id="right-sidebar-info">
                    <h2 class="font-18 pb-3">Keypoints</h2>
                    <div class="right-side-content k-points">
                        <ul>
                            <li>
                                Company Overview
                            </li>
                            <li>
                                Locations & Subsidiaries/Geographic reach
                            </li>
                            <li>
                                Key Executives
                            </li>
                            <li>
                                Company Financials
                            </li>
                            <li>
                                Patents registered
                            </li>
                            <li>
                                SWOT Analysis
                            </li>
                            <li>
                                Applications Catered
                            </li>
                            <li>
                                Strategic collaborations
                            </li>
                            <li>
                                Recent Developments
                            </li>
                            <li>
                                Competitive Benchmarking
                            </li>
                        </ul>
                    </div>
                    <h2 class="font-18 pb-3">Proceed To Buy</h2>
                    <form method="POST" class="bg-clr" action="<?php echo SITEPATH.'price/'.$report_detail_specific['report_id']; ?>">
                        <input type="hidden" name="company_title" id="company_title" value="<?php echo $report_detail_specific['title']; ?>">
                        <input type="hidden" name="slug" id="slug" value="<?php echo $report_detail_specific['slug']; ?>">
                            <div id="single_table">
                                <div class="d-flex justify-content-between space-top-bottom ">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" id="rad02" name="lty" value="2100" checked="">
                                      <label class="form-check-label" for="rad02">
                                            Competitive Intelligence
                                      </label>
                                    </div>
                                    <span>USD 2100</span>
                                </div>
                            </div> 
                    	  <!--<div class="blink_me text-center"> <span style="color:#9804d7;"> Immediate Delivery Available<span> </span></span></div>-->
                        <button type="submit" class="btn blck-btn d-block m-auto mt-3">
                            Proceed to Checkout
                            <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php");?>