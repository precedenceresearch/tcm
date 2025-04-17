<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-category.php");

$obj_report = new Report();
$obj_category = new Category();

$fields_featured_report="*";
$condition_featured_report="`predr_topCompanies`.`status`='Active'";
$orderby_featured_report="`id` DESC";
$report_featured_detail_all=$obj_report->getCompanyDetails($fields_featured_report,$condition_featured_report,$orderby_featured_report,'',0);

$meta_title="Companies Listing | Leading Players in Chemicals & Materials";
$meta_description="Explore a curated list of companies within the chemicals and materials industry. Discover detailed profiles, products, and services offered by top industry players.";
$meta_keyword="";


?>
<?php
$page= "report-list"; 
?>
<?php include("header.php");?>
 <div class="companies-banner pt-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo SITEPATH;?>">
                          <img src="<?php echo SITEPATH;?>images/home-page/Home-light.png" alt="home-icon" class="img-fluid home-icon" width="14" height="14">
                      </a></li>
                      <li class="breadcrumb-item active text-white" aria-current="page">Top Companies</li>
                    </ol>
                  </nav>
                <h1 class="ttl purple-txt mb-0 pb-2 text-white pt-5 report-ttl">Top Companies</h1>
                <p class="para text-white">
                    Your marketplace is evolving, your competitors are readjusting – but instead of reacting you can proact
                </p>
            </div>
        </div>
    </div>
</div>
<div class="ptb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php if(isset($report_featured_detail_all) && !empty($report_featured_detail_all)){ foreach($report_featured_detail_all as $company){ ?>  
                <div class="report-lists">
                    <h3>
                        <a href="<?php echo SITEPATH.'companies/'.$company['slug']; ?>" target="_blank"><?php echo $company['title']; ?></a>
                    </h3>
                    <p class="para mb-0">
                        <?php echo $company['prmetadesc']; ?>
                    </p>
                </div>
            <?php } }else{ echo "<p class='para'>No Result Found</p>"; } ?>  
            </div>
        </div>
    </div>
</div>
<?php include("footer.php");?>