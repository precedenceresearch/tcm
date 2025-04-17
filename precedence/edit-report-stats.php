<?php
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
require_once("classes/cls-country.php");

$obj_country = new Country();
$obj_report = new Report();
$obj_category = new Category();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}
 
if (isset($_GET['report_id']) && $_GET['report_id'] != "") {
    $report_id = base64_decode($_GET['report_id']);
    $condition = "`report_id` = '" . base64_decode($_GET['report_id']) . "'";
    $report_details = $obj_report->getReport_q_Details('', $condition, '', '', 0);
    $report_details_specific = end($report_details);

 
        $pre_selected_regions = isset($report_details_specific['region_id']) ? array_filter(explode(',', trim($report_details_specific['region_id'], ',')), 'strlen') : [];

        $pre_selected_countries = isset($report_details_specific['country_id']) ? array_filter(explode(',', trim($report_details_specific['country_id'], ',')), 'strlen') : [];

        $regions = [
            1 => "North America",
            2 => "Europe",
            3 => "Asia Pacific",
            4 => "Latin America",
            5 => "Middle East-Africa"
        ];
}
else {
    $report_details_specific['status'] = ""; 
    $report_details_specific['popular'] = "";
    $report_details_specific['CatId'] = "";
    $report_details_specific['author_id'] = "";
}
$fields = "catName,catId";
$condition = "`predr_category`.`status`='Active'";
$category_details = $obj_category->getCategoryDetails($fields, $condition, '', '','', 0);

$fields_country="country, cnt_id";
$condition_author="";
$country_details=$obj_country->getCountryRegionDetails($fields_country, $condition_author, '', '', 0);

$fields = "reportSubject";
$orderbyfreshleads="`report_id` DESC";
$reportCondition ='';
$report_details = $obj_report->getReport_q_Details($fields, $reportCondition, $orderbyfreshleads, '','', 0);


// $fields = "company_id";
// $orderbyfreshleads="`report_id` DESC";
// $reportCondition ="`report_id` = '" . base64_decode($_GET['report_id']) . "'";


$fields = "company_id";
$orderbyfreshleads = "`report_id` DESC";
$reportCondition = "`report_id` = '" . base64_decode($_GET['report_id']) . "'";
$existing_comapany_ids = $obj_report->getReport_q_Details($fields, $reportCondition, $orderbyfreshleads, '', '', 0);

$company_data = []; // Initialize an empty array

if (!empty($existing_comapany_ids) && isset($existing_comapany_ids[0]['company_id']) && !empty($existing_comapany_ids[0]['company_id'])) {
    $company_id_string = $existing_comapany_ids[0]['company_id']; 
    $company_data = json_decode($company_id_string, true); 
}


$fields = "*";
$orderBy = "`country` ASC";
$condition = "region='Asia Pacific'";
$countryAPAC_details = $obj_country->getCountryDetailsAPAC($fields, $condition, $orderBy, '', 0);

$fields = "*";
$condition = "region='Europe'";

$countryEurope_details = $obj_country->getCountryDetailsEurope($fields, $condition, $orderBy, '', 0);

$fields = "*";
$condition = "region='North America'";

$countryNorthAmerica_details = $obj_country->getCountryDetailsNorthAmerica($fields, $condition, $orderBy, '', 0);

$fields = "*";
$condition = "region='South / Latin America'";

$countryLA_details = $obj_country->getCountryDetailsLAMEA($fields, $condition, $orderBy, '', 0);

$fields = "*";
$condition = "region='Middle East' OR region='Africa'";

$countryMEA_details = $obj_country->getCountryDetailsLAMEA($fields, $condition, $orderBy, '', 0);

?>
<?php include('header.php')?>
<?php include('sidebar-menu.php')?>
<style>
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
  margin-right: 0.5rem;
}
input.form-control {
    margin-right: 12px;
}
</style>

   <div class="home-section">
        <?php include("top-bar.php"); ?>
        <section class="common-space pt-3_7">
            <!-- Page Content -->
           
        <div>
            <img src="images/Top.svg" class="img-fluid top-right-pattern">
        </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row d-flex align-items-center pb-3 light-bg">
                    <div class="col-lg-7">
                        <h5 class="page-header mb-2"><i class="fa fa-user"></i> <?php echo (isset($_GET['report_id'])) ? "Edit" : "Add"; ?> Report</h5>
                    </div>
                    <?php if (isset($_GET['report_id']) && $_GET['report_id'] != "") {?>
                     <div class="col-md-3">
                         <!--<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn s-btn float-end">-->
                         <!--    View Graphs</a>-->
                         <!--<a href="graph-list.php?report_id=<?php echo $_GET['report_id'];?>" target="_blank" class="btn s-btn float-end">-->
                         <!--    View Graphs</a>-->
                    </div>
                    <div class="col-md-2">
                         <a href="<?php echo SITEADMIN; ?>manage-report-stats" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php } else {?>
                    <div class="col-md-5">
                         <a href="<?php echo SITEADMIN; ?>manage-report-stats" class="btn s-btn float-end">
                            <i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php }?>
                </div>
                
                
                <!-- /.row -->
             <div class="row">
                    <div class="col-lg-10 offset-lg-1 ft-size">
                        <div class="panel panel-default">
                            <div class="shadow-lg add-card bg-white mt-3 mb-3">
                                <!-- /.panel-heading -->
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>edit-report-stats-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="report-form" id="report-form" onsubmit="prepareJSONData()">
                                        <!-- hidden fields -->
                                        <input type="hidden" name="update_type" id="update_type" value="<?php echo (isset($_GET['report_id'])) ? "edit" : "add"; ?>">
                                        <input type="hidden" name="report_id" id="report_id" value="<?php echo (isset($_GET['report_id'])) ? $_GET['report_id'] : ""; ?>">
                                        <div class="row">
                                           <div class="col-lg-12 ">
                                                <div class="form-group d-none">
                                                    <label>Select Reports<span class="error">*</span></label>
                                                    <div class="dropdown-container" style="position: relative;">
                                                        <input type="text" id="report-search" class="dropdown-selected" 
                                                               placeholder="Search Reports" 
                                                               style="width: 100%; padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; cursor: pointer;" readonly>
                                                        
                                                        <div class="dropdown-menu" id="reports-dropdown-menu" 
                                                             style="display: none; position: absolute; top: 100%; left: 0; right: 0; max-height: 200px; overflow-y: auto; border-radius: 4px; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 100;">
                                                             
                                                            <input type="text" id="report-search-dropdown" class="dropdown-search" 
                                                                   placeholder="Search Reports" 
                                                                   style="padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; width: 100%; margin-bottom: 10px;">
                                                            
                                                            <!-- Dynamic Options Container -->
                                                            <div id="report-options-container">
                                                                <!-- Dynamic options will be inserted here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Scope</label>
                                                    <div class="d-flex align-items-center justify-content-between ps-4">
                                                        <div class="form-check me-3">
                                                            <input class="form-check-input" type="radio" name="scope" value="Global" id="globalRadio" <?php echo (isset($report_details_specific['report_type']) && $report_details_specific['report_type'] == 'Global') ? "checked" : ""; ?><?php echo !(isset($report_details_specific['report_type']) && $report_details_specific['report_type'] == 'Global') ? 'disabled' : ''; ?>>
                                                            <label class="form-check-label" for="globalRadio">
                                                                Global
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <input class="form-check-input" type="radio" name="scope" value="Regional" id="regionalRadio" <?php echo (isset($report_details_specific['report_type']) && $report_details_specific['report_type'] == 'Regional') ? "checked" : ""; ?><?php echo !(isset($report_details_specific['report_type']) && $report_details_specific['report_type'] == 'Regional') ? 'disabled' : ''; ?>>
                                                            <label class="form-check-label" for="regionalRadio">
                                                                Regional
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <input class="form-check-input" type="radio" name="scope" value="Country" id="countryWiseRadio" <?php echo (isset($report_details_specific['report_type']) && $report_details_specific['report_type'] == 'Country') ? "checked" : ""; ?><?php echo !(isset($report_details_specific['report_type']) && $report_details_specific['report_type'] == 'Country') ? 'disabled' : ''; ?>>
                                                            <label class="form-check-label" for="countryWiseRadio">
                                                                Country
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                         <!-- Global Scope Dropdown -->

                                       <div class="col-lg-12">
                                     <div class="row" id="region-country-section" style="display: none;">
                                        
                                        <div class="lg-shadow bg-white mt-3 mb-4 p-4" id="regionDivv">
                                            <div class="form-group d-flex row">
                                                <!-- Asia Pacific -->
                                                <div class="radio col">
                                                    <label class="padding-0">
                                                        <input type="checkbox" name="asiaPacificc[]" id="asiaPacificc" value="Asia Pacific"
                                                            <?php echo (isset($report_details_specific['region_APAC']) && !empty($report_details_specific['region_APAC'])) ? 'checked' : ''; ?>>
                                                        Asia Pacific
                                                    </label>
                                                    <select class="js-select2" name="asiaPacific[]" multiple="multiple">
                                                        <option value="" data-badge="">--Select Country--</option>
                                                        <?php if (isset($countryAPAC_details) && !empty($countryAPAC_details)) {
                                                            foreach ($countryAPAC_details as $countryAPAC) { ?>
                                                                <option value="<?php echo $countryAPAC['country']; ?>" data-badge=""
                                                                    <?php echo (isset($report_details_specific['country_APAC']) && strpos($report_details_specific['country_APAC'], $countryAPAC['country']) !== false) ? 'selected' : ''; ?>>
                                                                    <?php echo $countryAPAC['country']; ?>
                                                                </option>
                                                        <?php }
                                                        } ?>
                                                        <option value="Rest of Asia Pacific" data-badge="">Rest of Asia Pacific</option>
                                                    </select>
                                                </div>
                                        
                                                <!-- Europe -->
                                                <div class="radio col">
                                                    <label class="padding-0">
                                                        <input type="checkbox" name="europec[]" id="europec" value="Europe"
                                                            <?php echo (isset($report_details_specific['region_EU']) && !empty($report_details_specific['region_EU'])) ? 'checked' : ''; ?>>
                                                        Europe
                                                    </label>
                                                    <select name="europe[]" id="europe" class="form-group" multiple>
                                                        <option value="" data-badge="">--Select Country--</option>
                                                       <?php if (isset($countryEurope_details) && !empty($countryEurope_details)) {
                                                            foreach ($countryEurope_details as $countryEurope) { ?>
                                                                <option value="<?php echo $countryEurope['country']; ?>" data-badge=""
                                                                    <?php echo (isset($report_details_specific['country_EU']) && strpos($report_details_specific['country_EU'], $countryEurope['country']) !== false) ? 'selected' : ''; ?>>
                                                                    <?php echo $countryEurope['country']; ?>
                                                                </option>
                                                        <?php }
                                                        } ?>
                                        
                                                        <option value="Rest of Europe" data-badge="">Rest of Europe</option>
                                                    </select>
                                                </div>
                                        
                                                <!-- North America -->
                                                <div class="radio col">
                                                    <label class="padding-0">
                                                        <input type="checkbox" name="northAmericac[]" id="northAmericac" value="North America"
                                                            <?php echo (isset($report_details_specific['region_NA']) && !empty($report_details_specific['region_NA'])) ? 'checked' : ''; ?>>
                                                        North America
                                                    </label>
                                                    <select name="northAmerica[]" id="northAmerica" class="form-group" multiple>
                                                        <option value="" data-badge="">--Select Country--</option>
                                                        <?php if (isset($countryNorthAmerica_details) && !empty($countryNorthAmerica_details)) {
                                                            foreach ($countryNorthAmerica_details as $countryNorthA) { ?>
                                                                <option value="<?php echo $countryNorthA['country']; ?>" data-badge=""
                                                                    <?php echo (isset($report_details_specific['country_NA']) && strpos($report_details_specific['country_NA'], $countryNorthA['country']) !== false) ? 'selected' : ''; ?>>
                                                                    <?php echo $countryNorthA['country']; ?>
                                                                </option>
                                                        <?php }
                                                        } ?>
                                                        <option value="Rest of North America" data-badge="">Rest of North America</option>
                                                    </select>
                                                </div>
                                        
                                                <!-- Latin America -->
                                                <div class="radio col">
                                                    <label class="padding-0">
                                                        <input type="checkbox" name="lac[]" id="lac" value="Latin America"
                                                            <?php echo (isset($report_details_specific['region_LA']) && !empty($report_details_specific['region_LA'])) ? 'checked' : ''; ?>>
                                                        Latin America (LA)
                                                    </label>
                                                    <select name="la[]" id="la" class="form-group" multiple>
                                                        <option value="" data-badge="">--Select Country--</option>
                                                        <?php if (isset($countryLA_details) && !empty($countryLA_details)) {
                                                            foreach ($countryLA_details as $countryLA) { ?>
                                                                <option value="<?php echo $countryLA['country']; ?>" data-badge=""
                                                                    <?php echo (isset($report_details_specific['country_LA']) && strpos($report_details_specific['country_LA'], $countryLA['country']) !== false) ? 'selected' : ''; ?>>
                                                                    <?php echo $countryLA['country']; ?>
                                                                </option>
                                                        <?php }
                                                        } ?>
                                                        <option value="Rest of Latin America" data-badge="">Rest of Latin America</option>
                                                    </select>
                                                </div>
                                        
                                                <!-- Middle East Africa -->
                                                <div class="radio col">
                                                    <label class="padding-0">
                                                        <input type="checkbox" name="meac[]" id="meac" value="MEA"
                                                            <?php echo (isset($report_details_specific['region_MEA']) && !empty($report_details_specific['region_MEA'])) ? 'checked' : ''; ?>>
                                                        Middle East Africa (MEA)
                                                    </label>
                                                    <select name="mea[]" id="mea" class="form-group" multiple>
                                                        <option value="" data-badge="">--Select Country--</option>
                                                        <?php if (isset($countryMEA_details) && !empty($countryMEA_details)) {
                                                            foreach ($countryMEA_details as $countryMEA) { ?>
                                                                <option value="<?php echo $countryMEA['country']; ?>" data-badge=""
                                                                    <?php echo (isset($report_details_specific['country_MEA']) && strpos($report_details_specific['country_MEA'], $countryMEA['country']) !== false) ? 'selected' : ''; ?>>
                                                                    <?php echo $countryMEA['country']; ?>
                                                                </option>
                                                        <?php }
                                                        } ?>
                                                        <option value="Rest of Middle-East Africa" data-badge="">Rest of Middle-East Africa</option>
                                                    </select>
                                                </div>
                                                
                                                <div id="status-div"></div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                   <!-- Global Scope Dropdown Ends Here-->

                                   <!-- Region Scope Dropdown -->
                                   <div class="form-group col-md-6" id="region-dropdown-wrapper" style="display: none;">
                                        <label>Region<span class="error">*</span></label>
                                        <select class="form-select searchable-select" name="regions[]" id="region-dropdown" style="line-height: 1.9; width: 100%;">
                                            <option value="1" <?php echo in_array(1, $pre_selected_regions) ? 'selected' : ''; ?>>North America</option>
                                            <option value="2" <?php echo in_array(2, $pre_selected_regions) ? 'selected' : ''; ?>>Europe</option>
                                            <option value="3" <?php echo in_array(3, $pre_selected_regions) ? 'selected' : ''; ?>>Asia Pacific</option>
                                            <option value="4" <?php echo in_array(4, $pre_selected_regions) ? 'selected' : ''; ?>>Latin America</option>
                                            <option value="5" <?php echo in_array(5, $pre_selected_regions) ? 'selected' : ''; ?>>Middle East-Africa</option>
                                        </select>
                                    </div>

                                    
                                  <div class="form-group col-md-6" id="countries-dropdown-wrapper" style="display: none;">
                                    <label>Countries<span class="error">*</span></label>
                                    <div class="dropdown-container" style="position: relative;">
                                        <input type="text" id="country-search-input" class="dropdown-selected" placeholder="Search Countries" style="width: 100%; padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; cursor: pointer;" readonly>
                                    
                                        <div class="dropdown-menu" id="countries-dropdown-list" style="display: none; position: absolute; top: 100%; left: 0; right: 0; max-height: 200px; overflow-y: auto; border-radius: 4px; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 100; padding-left: 35px !important;">
                                            <input type="text" id="country-search-dropdown-input" class="dropdown-search" placeholder="Search Countries" style="padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; width: 100%; margin-bottom: 10px; margin-left: -23px !important;" onkeyup="filterCountryOptions()">
                                        
                                            <?php foreach ($country_details as $country): ?>
                                                <div class="form-check pl-3 country-item">
                                                    <input type="checkbox" class="form-check-input country-checkbox" name="countries[]" value="<?= $country['cnt_id']; ?>" id="country-<?= $country['cnt_id']; ?>" 
                                                    <?php echo in_array($country['cnt_id'], $pre_selected_countries) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="country-<?= $country['cnt_id']; ?>"><?= $country['country']; ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                 <!-- Region Scope Dropdown End Here -->
                                 
                                 <!-- CountryWise Scope Dropdown -->
                                 
                                
                                        <input type="hidden" name="region[]" value="">
                                
                                        <div class="form-group col-md-6" id="single-country-dropdown-container" style="display: none;">
                                            <label>Country<span class="error">*</span></label>
                                            <select class="form-select searchable-select" name="countries[]" id="country-dropdown" style="line-height: 1.9; width: 100%;">
                                                <option value="">Select Country</option>
                                                <?php foreach ($country_details as $country): ?>
                                                    <option value="<?= $country['cnt_id']; ?>" 
                                                        <?php echo in_array($country['cnt_id'], $pre_selected_countries) ? 'selected' : ''; ?>>
                                                        <?= $country['country']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                <!-- CountryWise Scope Dropdown End Here -->
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Report Title <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="reptitle" id="reptitle" placeholder="Report Title" value="<?php echo (isset($report_details_specific['reportSubject'])) ? $report_details_specific['reportSubject'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Short Description <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="short_description" id="short_description" placeholder="Short Description" value="<?php echo (isset($report_details_specific['short_description'])) ? $report_details_specific['short_description'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Report URL Keyword <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="repurl" id="repurl" placeholder="Report URL Keyword" value="<?php echo (isset($report_details_specific['slug'])) ? $report_details_specific['slug'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>Category <span class="error">*</span></label>
                                                    <select class="form-select" aria-label="Default select example" name="repcategory" id="repcategory" style="line-height:1.9;">
                                                      <option value="">Select Category</option>
                                                      <?php foreach($category_details as $category_detail){?>
                                                       <option value="<?php echo $category_detail['catId']; ?>" <?php if($category_detail['catId']==$report_details_specific['CatId']){?> selected <?php }?>><?php echo $category_detail['catName']; ?></option>
                                                      <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Publish Date <span class="error">*</span></label>
                                                    <input type="date" class="form-control" placeholder="YYYY-MM-DD" name="pubdate" id="pubdate" value="<?php echo (isset($report_details_specific['reportDate'])) ? $report_details_specific['reportDate'] : ""; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                
                                                <div class="form-group col-lg-6">
                                                    <label>Revenue</label>
                                                    <input type="text" class="form-control" placeholder="Revenue" name="revenue" id="revenue" value="<?php echo (isset($report_details_specific['revenue'])) ? $report_details_specific['revenue'] : ""; ?>">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Forecast</label>
                                                    <input type="text" class="form-control" placeholder="Forecast" name="forecast" id="forecast" value="<?php echo (isset($report_details_specific['forecast'])) ? $report_details_specific['forecast'] : ""; ?>">
                                                </div>
                                                 
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>CAGR</label>
                                                    <input type="text" class="form-control" placeholder="CAGR" name="cagr" id="cagr" value="<?php echo (isset($report_details_specific['cagr'])) ? $report_details_specific['cagr'] : ""; ?>">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Report Coverage</label>
                                                    <input type="text" class="form-control" placeholder="Coverage" name="report_coverage" id="report_coverage" value="<?php echo (isset($report_details_specific['report_coverage'])) ? $report_details_specific['report_coverage'] : "Worldwide"; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Introduction </label>
                                                 <textarea rows="7" class="form-control tinytextarea" name="intro" id="intro"><?php echo (isset($report_details_specific['intro'])) ? $report_details_specific['intro'] : ""; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Outlook </label>
                                                 <textarea rows="7" class="form-control tinytextarea" name="outlook" id="outlook" ><?php echo (isset($report_details_specific['outlook_intro'])) ? $report_details_specific['outlook_intro'] : ""; ?></textarea>
                                                 
                                            </div>
                                        </div>
                                       
                                       <div class="col-lg-12 d-none">
                                            <div class="row">
                                                <input type="hidden" name="report_id" value="<?php echo htmlspecialchars($report_id); ?>">
                                                <label>Companies<span class="error">*</span></label>
                                                <div class="dropdown-container" style="position: relative;">
                                                   
                                                    <input type="text" id="company-search" class="dropdown-selected" placeholder="Search Companies" style="width: 100%; padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; cursor: pointer;" readonly>
                                                   
                                                    <div class="dropdown-menu" id="dropdown-menu" style="display: none; position: absolute; top: 100%; padding-left: 36px; left: 0; right: 0; max-height: 200px; overflow-y: auto; border-radius: 4px; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 100;">
                                                     
                                                        <input type="text" id="company-search-dropdown" class="dropdown-search" placeholder="Search Companies" style="padding: 7px 5px; padding-left: 11px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; width: 100%; margin-bottom: 10px; margin-left: -27px;" onkeyup="filterCompanies()">
                                                        
                                                        <?php
                                                        
                                                        foreach ($company_details as $company) {
                                                          
                                                            $is_checked = in_array($company['company_id'], $selected_company_ids) ? 'checked' : '';
                                                        ?>
                                                            <div class="form-check pl-3 company-option">
                                                                <input type="checkbox" 
                                                                       class="form-check-input company-checkbox" name="companies[]" value="<?php echo $company['company_id']; ?>" id="company_<?php echo $company['company_id']; ?>" <?php echo $is_checked; ?>>
                                                                <label class="form-check-label" for="company_<?php echo $company['company_id']; ?>">
                                                                    <?php echo $company['company_title']; ?>
                                                                </label>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     <div class="col-lg-12">
                                        <div class="row" id="company-fields-container">
                                           <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 5px;">
                                                <label>Companies<span class="error">*</span></label>
                                                <button type="button" class="btn btn-success" onclick="addCompanyField()" style="line-height: 1">+</button>
                                            </div>
                                             
                                            <?php
                                         
                                            if (!empty($company_data)) { 
                                                foreach ($company_data as $company) { ?>
                                                    <div class="company-entry d-flex align-items-center mb-2">
                                                        <input type="text" name="company_title[]" class="form-control mr-2" placeholder="Company Title" value="<?php echo htmlspecialchars($company['company_title']); ?>" required>
                                                        <input type="url" name="company_url[]" class="form-control mr-2" placeholder="Company URL" value="<?php echo htmlspecialchars($company['company_url']); ?>" required>
                                                        <button type="button" class="btn btn-danger" onclick="removeCompanyField(this)" style="line-height: 1">-</button>
                                                    </div>
                                            <?php } 
                                            } else { ?>
                                                <div class="company-entry d-flex align-items-center mb-2">
                                                    <input type="text" name="company_title[]" class="form-control mr-2" placeholder="Company Title" required>
                                                    <input type="url" name="company_url[]" class="form-control mr-2" placeholder="Company URL" required>
                                                    <!--<button type="button" class="btn btn-success" onclick="addCompanyField()" style="line-height: 1">+</button>-->
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="companies_json" id="companies_json">
                                    </div>



                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>Single Price</label>
                                                    <input type="text" class="form-control" placeholder="" name="single_price" id="single_price" value="<?php echo (isset($report_details_specific['Price_SUL'])) ? $report_details_specific['Price_SUL'] : "950"; ?>">
                                                </div>
                                                 <div class="form-group col-lg-6">
                                                    <label>Corporate Price</label>
                                                    <input type="text" class="form-control" placeholder="" name="corporate_price" id="corporate_price" value="<?php echo (isset($report_details_specific['Price_CUL'])) ? $report_details_specific['Price_CUL'] : "1450"; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Meta Title <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="metatitle" id="metatitle" placeholder="Meta Title" value="<?php echo (isset($report_details_specific['meta_title'])) ? $report_details_specific['meta_title'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Meta Description </label>
                                            <input type="text" class="form-control" name="metadescription" id="metadescription" placeholder="Meta Description" value="<?php echo (isset($report_details_specific['meta_description'])) ? $report_details_specific['meta_description'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Meta Keyword </label>
                                             <input type="text" class="form-control" name="metakeyword" id="metakeyword" placeholder="Meta Keyword" value="<?php echo (isset($report_details_specific['meta_keywords'])) ? $report_details_specific['meta_keywords'] : ""; ?>">
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group d-none">
                                                <label>Author</label>
                                                <select class="form-select" aria-label="Default select example" name="repauthor" id="repauthor" style="line-height:1.9;">
                                                  <option value="">Select Author</option>
                                                  <?php foreach($author_details as $author_detail){?>
                                                   <option value="<?php echo $author_detail['author_id']; ?>" <?php if($author_detail['author_id']==$report_details_specific['author_id']){?> selected <?php }?>><?php echo $author_detail['author_name']; ?></option>
                                                  <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-2 pt-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="feature" id="feature" value="1" <?php echo (isset($report_details_specific['featured']) && $report_details_specific['featured'] == '1') ? "checked" : ""; ?>>
                                                <label for="feature">Is Featured</label> 
                                            </div>
                                        </div>
                                        <div class="col-lg-10  pt-3">
                                            <div class="form-group">
                                                <input type="checkbox" name="popular" id="popular" value="1" <?php echo (isset($report_details_specific['popular']) && $report_details_specific['popular'] == '1') ? "checked" : ""; ?>>
                                                <label for="popular">Is Popular</label> 
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (!empty($report_details_specific) && isset($report_details_specific['status']) && ($report_details_specific['status'] == 'Active' || $report_details_specific['status'] == '') ) ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Active
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="padding-0">
                                                            <input type="radio" name="status" id="status2" value="Inactive" <?php echo (isset($report_details_specific['status']) && $report_details_specific['status'] == 'Inactive') ? "checked" : ""; ?>>
                                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                    <div id="status-div"></div>
                                                </div>
                                        </div>
                                        
                                                <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <div class="text-center">
                                                            <button type="submit" class="btn s-btn col-md-4" id="btn_lead_submit" name="btn_lead_submit">Submit</button>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
       <div>
             <img src="images/Bottom.svg" class="img-fluid bottom-left-pattern">
         </div>
       </section>
   </div>

 
   
<?php include("footer.php"); ?>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.tiny.cloud/1/rq21nep9x685euodgqcz9zazuspsjti0u00fr60g5c5rlp6b/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/skins/ui/oxide/content.min.css" referrerpolicy="origin"></script>
<script src="<?php echo SITEADMIN; ?>js/regional-dropdown.js" ></script>
<script>
tinymce.init({
    selector: "textarea",
    plugins: 'advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak table paragraphgroup code',
    toolbar: 'undo redo | h1 h2 h3 h4 h5 h6 | styleselect | forecolor | bold italic | paragraphgroup | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | numlist bullist table ',
    skin: 'outside',
    forced_root_block : 'p',
	image_title: true
});
  </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
<script src="<?php echo SITEADMIN; ?>bower_components/jquery-validation/jquery.validate.js"></script>

<script>
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");

sidebarBtn.addEventListener("click",()=>{
  sidebar.classList.toggle("close");
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const dropdownContainers = document.querySelectorAll('.dropdown-container');
    
    dropdownContainers.forEach(function(dropdownContainer) {
        const dropdownSelected = dropdownContainer.querySelector('.dropdown-selected');
        const dropdownMenu = dropdownContainer.querySelector('.dropdown-menu');
        const checkboxes = dropdownMenu.querySelectorAll('.form-check-input');
        const selectedItemsDiv = dropdownContainer.querySelector('.selected-companies');
        const searchInput = dropdownContainer.querySelector('.dropdown-search');
      
        dropdownSelected.addEventListener('click', function() {
            const isVisible = dropdownMenu.style.display === 'block';
            dropdownMenu.style.display = isVisible ? 'none' : 'block';
        });

        document.addEventListener('click', function(event) {
            if (!dropdownContainer.contains(event.target)) {
                dropdownMenu.style.display = 'none';
            }
        });

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const selectedItems = Array.from(checkboxes)
                    .filter(c => c.checked)
                    .map(c => c.nextElementSibling.textContent.trim());

                dropdownSelected.value = selectedItems.length > 0 
                    ? selectedItems.join(', ') 
                    : 'Search Regions/Countries';

         
            });
        });

        searchInput.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            checkboxes.forEach(function(checkbox) {
                const label = checkbox.nextElementSibling.textContent.toLowerCase();
                const formCheck = checkbox.closest('.form-check');
                if (label.indexOf(filter) > -1) {
                    formCheck.style.display = 'block';
                } else {
                    formCheck.style.display = 'none';
                }
            });
        });
    });
});

function filterCountries() {
    var input, filter, dropdownMenu, options, i, label, checkbox;
    input = document.getElementById('country-search-dropdown');
    filter = input.value.toLowerCase();
    dropdownMenu = document.getElementById('countries-dropdown-menu');
    options = dropdownMenu.getElementsByClassName('country-option');

    for (i = 0; i < options.length; i++) {
        label = options[i].getElementsByTagName('label')[0];
        checkbox = options[i].getElementsByTagName('input')[0];
        if (label) {
            if (label.innerText.toLowerCase().indexOf(filter) > -1) {
                options[i].style.display = '';
            } else {
                options[i].style.display = 'none';
            }
        }
    }
}

</script>
<script>
    document.querySelectorAll('input[name="scope"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            var regionCountrySection = document.getElementById('region-country-section');
            if (this.value === 'Global') {
                regionCountrySection.style.display = 'block';
            } else {
                regionCountrySection.style.display = 'none';
            }
        });
    });

    window.onload = function() {
        var globalRadio = document.getElementById('globalRadio');
        if (globalRadio.checked) {
            document.getElementById('region-country-section').style.display = 'block';
        }
    };
</script>

<script>
  
    $(document).ready(function() {
        $('#country-dropdown').select2({
            placeholder: "Select Country",
            allowClear: true
        });
    });

    function toggleCountryDropdown() {
        const scope = document.querySelector('input[name="scope"]:checked').value; 
        const countryDropdownContainer = document.getElementById('single-country-dropdown-container');

        if (scope === 'Country') {
            countryDropdownContainer.style.display = 'block'; 
            $('#country-dropdown').select2(); 
        } else {
            countryDropdownContainer.style.display = 'none'; 
        }
    }

    const scopeRadios = document.querySelectorAll('input[name="scope"]');
    scopeRadios.forEach(radio => {
        radio.addEventListener('change', toggleCountryDropdown);
    });
    document.addEventListener('DOMContentLoaded', () => {
        toggleCountryDropdown();
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const scopeRadios = document.querySelectorAll('input[name="scope"]');
    const regionDropdownContainer = document.getElementById('region-dropdown-wrapper');
    const countriesDropdownContainer = document.getElementById('countries-dropdown-wrapper');

    function handleScopeChange() {
        const selectedScope = document.querySelector('input[name="scope"]:checked').value;

        // Hide both region and countries dropdown initially
        regionDropdownContainer.style.display = 'none';
        countriesDropdownContainer.style.display = 'none';

        if (selectedScope === 'Regional') {
            regionDropdownContainer.style.display = 'block';
         
            countriesDropdownContainer.style.display = 'block';
        }
    }

    scopeRadios.forEach(function(radio) {
        radio.addEventListener('change', handleScopeChange);
    });

    handleScopeChange();  // Trigger the function once on page load to set initial state
});

function filterCountryOptions() {
    var input, filter, dropdownMenu, options, i, label, checkbox;

    input = document.querySelector('#country-search-input');
    filter = input.value.toLowerCase();
    dropdownMenu = document.getElementById('countries-dropdown-list');
    options = dropdownMenu.getElementsByClassName('country-item');

    for (i = 0; i < options.length; i++) {
        label = options[i].getElementsByTagName('label')[0];
        checkbox = options[i].getElementsByTagName('input')[0];
        if (label) {
            if (label.innerText.toLowerCase().indexOf(filter) > -1) {
                options[i].style.display = '';
            } else {
                options[i].style.display = 'none';
            }
        }
    }
}


</script>
<script>
function addCompanyField() {
    let container = document.getElementById('company-fields-container');
    let div = document.createElement('div');
    div.className = 'company-entry d-flex align-items-center mb-2';
    div.innerHTML = `
        <input type="text" name="company_title[]" class="form-control mr-2" placeholder="Company Title" required>
        <input type="url" name="company_url[]" class="form-control mr-2" placeholder="Company URL" required>
        <button type="button" class="btn btn-danger" onclick="removeCompanyField(this)">-</button>
    `;
    container.appendChild(div);
}

function removeCompanyField(button) {
    button.parentElement.remove();
}

function prepareJSONData() {
    let titles = document.getElementsByName('company_title[]');
    let urls = document.getElementsByName('company_url[]');
    let companies = [];
    
    for (let i = 0; i < titles.length; i++) {
        if (titles[i].value && urls[i].value) {
            companies.push({
                "company_title": titles[i].value,
                "company_url": urls[i].value
            });
        }
    }
    
    document.getElementById('companies_json').value = JSON.stringify(companies);
}
</script>
</body>
</html>