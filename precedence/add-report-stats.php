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
    $report_details = $obj_report->getReportDetails('', $condition, '', '', 0);
    $report_details_specific = end($report_details);
}
else {
    $report_details_specific['status'] = ""; 
    //$report_details_specific['popular'] = "";
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
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
 .region-item {
    flex-direction: column;
    align-items: flex-start;
    position: relative;
}

.country-list {
    position: absolute;
    top: 100%;
    left: 0;
    width: 150px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    padding: 10px;
    display: none;
    z-index: 10;
  
    max-height: 150px; 
    overflow-y: auto;
}

.form-check-input {
    margin-left: 5px;
}

.form-check-label {
    margin-left: 5px;
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
                                <form role="form" method="POST" action="<?php echo SITEADMIN; ?>add-report-stats-action.php" class="lead-info-form support-box-form p-0" enctype="multipart/form-data" name="report-form" id="report-form" onsubmit="handleFormSubmission()">
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
                                                            <input class="form-check-input" type="radio" name="scope" value="Global" id="globalRadio" checked>
                                                            <label class="form-check-label" for="globalRadio">
                                                                Global
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <input class="form-check-input" type="radio" name="scope" value="Regional" id="regionalRadio"<?php echo (isset($report_details_specific['scope']) && $report_details_specific['scope'] == 'Regional') ? "checked" : ""; ?>>
                                                            <label class="form-check-label" for="regionalRadio">
                                                                Regional
                                                            </label>
                                                        </div>
                                                        <div class="form-check me-3">
                                                            <input class="form-check-input" type="radio" name="scope" value="Country" id="countryWiseRadio" <?php echo (isset($report_details_specific['scope']) && $report_details_specific['scope'] == 'Country') ? "checked" : ""; ?>>
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
                                        <div class="form-group col-md-6 d-none">
                                          
                                            <label>Regions<span class="error">*</span></label>
                                            <div class="dropdown-container" style="position: relative;">
                                                <input type="text" id="region-search" class="dropdown-selected" placeholder="Search Regions" style="width: 100%; padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; cursor: pointer;" readonly>
                                    
                                                <div class="dropdown-menu" id="regions-dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; right: 0; max-height: 200px; overflow-y: auto; border-radius: 4px; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 100;">
                                                    <!-- Searchable input field inside the dropdown -->
                                                    <input type="text" id="region-search-dropdown" class="dropdown-search" placeholder="Search Regions" style="padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; width: 100%; margin-bottom: 10px;" onkeyup="filterRegions()">
                                                    
                                                    <div class="form-check pl-3 region-option">
                                                        <input type="checkbox" class="form-check-input region-checkbox" name="regions[]" value="1" id="region_NorthAmerica">
                                                        <label class="form-check-label" for="region_NorthAmerica">North America</label>
                                                    </div>
                                                    <div class="form-check pl-3 region-option">
                                                        <input type="checkbox" class="form-check-input region-checkbox" name="regions[]" value="2" id="region_Europe">
                                                        <label class="form-check-label" for="region_Europe">Europe</label>
                                                    </div>
                                                    <div class="form-check pl-3 region-option">
                                                        <input type="checkbox" class="form-check-input region-checkbox" name="regions[]" value="3" id="region_AsiaPacific">
                                                        <label class="form-check-label" for="region_AsiaPacific">Asia Pacific</label>
                                                    </div>
                                                     <div class="form-check pl-3 region-option">
                                                        <input type="checkbox" class="form-check-input region-checkbox" name="regions[]" value="4" id="region_LatinAmerica">
                                                        <label class="form-check-label" for="region_LatinAmerica">Latin America</label>
                                                    </div>
                                                     <div class="form-check pl-3 region-option">
                                                        <input type="checkbox" class="form-check-input region-checkbox" name="regions[]" value="5" id="region_MiddleEastAfrica">
                                                        <label class="form-check-label" for="region_MiddleEastAfrica">Middle East-Africa</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="lg-shadow bg-white mt-3 mb-4 p-4 " id="regionDivv">
                               
                       
                                <div class="form-group d-flex row">
                                    <div class="radio col">
                                            <label class="padding-0">
                                                <input type="checkbox" name="asiaPacificc[]" id="asiaPacificc" value="Asia Pacific">
                                                Asia Pacific
                                            </label>
                                            <select class="js-select2" name="asiaPacific[]" multiple="multiple">
                                				<option value="" data-badge="">--Select Country--</option>
                                				<?php if(isset($countryAPAC_details) && !empty($countryAPAC_details)){ foreach($countryAPAC_details as $countryAPAC){ ?>
                                				    <option value="<?php echo $countryAPAC['country'] ?>" data-badge=""><?php echo $countryAPAC['country'] ?></option>
                                				<?php } } ?>
                                				<option value="Rest of Asia Pacific" data-badge="">Rest of Asia Pacific</option>
                                			</select>
                                        </div>
                                    <div class="radio col">
                                                <label class="padding-0" >
                                                <input type="checkbox" name="europec[]" id="europec" value="Europe">
                                                    Europe
                                                </label>
                                                <select name="europe[]" id="europe" class="form-group" multiple>
                                                   <option value="" data-badge="">--Select Country--</option>
                                    				<?php if(isset($countryEurope_details) && !empty($countryEurope_details)){ foreach($countryEurope_details as $countryEurope){ ?>
                                    				    <option value="<?php echo $countryEurope['country'] ?>" data-badge=""><?php echo $countryEurope['country'] ?></option>
                                    				<?php } } ?>
                                    				<option value="Rest of Europe" data-badge="">Rest of Europe</option>
                                                </select>   
                                            </div>
                                    <div class="radio col">
                                                <label class="padding-0" >
                                                    <input type="checkbox" name="northAmericac[]" id="northAmericac" value="North America">
                                                    North America
                                                </label>
                                                <select name="northAmerica[]" id="northAmerica" class="form-group" multiple>
                                                    <option value="" data-badge="">--Select Country--</option>
                                    				<?php if(isset($countryNorthAmerica_details) && !empty($countryNorthAmerica_details)){ foreach($countryNorthAmerica_details as $countryNorthA){ ?>
                                    				    <option value="<?php echo $countryNorthA['country'] ?>" data-badge=""><?php echo $countryNorthA['country'] ?></option>
                                    				<?php } } ?>
                                    				<option value="Rest of North America" data-badge="">Rest of North America</option>
                                                </select>   
                                    </div>
                                    
                                    <div class="radio col">
                                                <label class="padding-0" >
                                                    <input type="checkbox" name="lac[]" id="lac" value="Latin America">
                                                    Latin America (LA)
                                                </label>
                                                <select name="la[]" id="la" class="form-group" multiple>
                                                    <option value="" data-badge="">--Select Country--</option>
                                    				<?php if(isset($countryLA_details) && !empty($countryLA_details)){ foreach($countryLA_details as $countryLA){ ?>
                                    				    <option value="<?php echo $countryLA['country'] ?>" data-badge=""><?php echo $countryLA['country'] ?></option>
                                    				<?php } } ?>
                                    				<option value="Rest of Latin America" data-badge="">Rest of Latin America</option>
                                                </select>   
                                    </div>
                                    
                                    <div class="radio col">
                                            <label class="padding-0" >
                                                <input type="checkbox" name="meac[]" id="meac" value="MEA">
                                                Middle East Africa (MEA)
                                            </label>
                                            <select name="mea[]" id="mea" class="form-group" multiple>
                                                <option value="" data-badge="">--Select Country--</option>
                                				<?php if(isset($countryMEA_details) && !empty($countryMEA_details)){ foreach($countryMEA_details as $countryMEA){ ?>
                                				    <option value="<?php echo $countryMEA['country'] ?>" data-badge=""><?php echo $countryMEA['country'] ?></option>
                                				<?php } } ?>
                                				<option value="Rest of Middle-East Africa" data-badge="">Rest of Middle-East Africa</option>
                                            </select>   
                                            </div>
                                        <div id="status-div"></div>
                                    </div>
                                        
                                        
                                        
                                        <!-- Container for dynamically loaded country dropdowns -->
                                        <div id="country-dropdown-container"></div>

                                        <div class="form-group col-md-6 d-none">
                                            <label>Countries<span class="error">*</span></label>
                                            <div class="dropdown-container" style="position: relative;">
                                                <input type="text" id="country-search" class="dropdown-selected" placeholder="Search Countries" style="width: 100%; padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; cursor: pointer;" readonly>
                                        
                                                <div class="dropdown-menu" id="countries-dropdown-menu" style="display: none; position: absolute; top: 100%; left: 0; right: 0; max-height: 200px; overflow-y: auto; border-radius: 4px; background-color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); z-index: 100; padding-left: 5px !important;">
                                                    <input type="text" id="country-search-dropdown" class="dropdown-search" placeholder="Search Countries" style="padding: 7px 5px; border-radius: 4px; border: 0.1px solid #c4c4c4; background-color: white; width: 100%; margin-bottom: 10px;" onkeyup="filterCountries()">
                                                    
                                                    <?php foreach ($country_details as $country): ?>
                                                        <div class="form-check pl-3 country-option">
                                                            <input type="checkbox" class="form-check-input country-checkbox" name="countries[]" value="<?= $country['cnt_id']; ?>" id="country_<?= $country['cnt_id']; ?>">
                                                            <label class="form-check-label" for="country_<?= $country['cnt_id']; ?>"><?= $country['country']; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                   <!-- Global Scope Dropdown Ends Here-->

                                   <!-- Region Scope Dropdown -->
                                    <div class="form-group col-md-6" id="region-dropdown-wrapper" style="display: none;">
                                        <label>Region<span class="error">*</span></label>
                                        <select class="form-select searchable-select" name="regions[]" id="region-dropdown" style="line-height: 1.9; width: 100%;">
                                            <option value="">Select Region</option>
                                            <option value="1">North America</option>
                                            <option value="2">Europe</option>
                                            <option value="3">Asia Pacific</option>
                                            <option value="4">Latin America</option>
                                            <option value="5">Middle East-Africa</option>
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
                                                        <input type="checkbox" class="form-check-input country-checkbox" name="countries[]" value="<?= $country['cnt_id']; ?>" id="country-<?= $country['cnt_id']; ?>">
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
                                                    <option value="<?= $country['cnt_id']; ?>"><?= $country['country']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                <!-- CountryWise Scope Dropdown End Here -->
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Report Title <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="reptitle" id="reptitle" placeholder="Report Title" value="<?php echo (isset($report_details_specific['reportSubject'])) ? $report_details_specific['reportSubject'] : ""; ?>" required>
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Short Description <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="short_description" id="short_description" placeholder="Short Description" value="<?php echo (isset($report_details_specific['short_description'])) ? $report_details_specific['short_description'] : ""; ?>" required>
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Report URL Keyword <span class="error">*</span></label>
                                            <input type="text" class="form-control" name="repurl" id="repurl" placeholder="Report URL Keyword" value="<?php echo (isset($report_details_specific['slug'])) ? $report_details_specific['slug'] : ""; ?>" required>
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>Category <span class="error">*</span></label>
                                                    <select class="form-select" aria-label="Default select example" name="repcategory" id="repcategory" style="line-height:1.9;" required>
                                                      <option value="">Select Category</option>
                                                      <?php foreach($category_details as $category_detail){?>
                                                       <option value="<?php echo $category_detail['catId']; ?>" <?php if($category_detail['catId']==$report_details_specific['CatId']){?> selected <?php }?>><?php echo $category_detail['catName']; ?></option>
                                                      <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Publish Date <span class="error">*</span></label>
                                                    <input type="date" class="form-control" placeholder="YYYY-MM-DD" name="pubdate" id="pubdate" value="<?php echo (isset($report_details_specific['reportDate'])) ? $report_details_specific['reportDate'] : ""; ?>" required>
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
                                                 <textarea rows="7" class="form-control tinytextarea" name="intro" id="intro"></textarea>
                                                 <!--<textarea class="form-control tinytextarea" name="description" id="description" placeholder="Description"></textarea>-->
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                 <label>Outlook </label>
                                                 <textarea rows="7" class="form-control tinytextarea" name="outlook" id="outlook"><?php echo (isset($report_details_specific['reportLDesc'])) ? stripslashes($report_details_specific['outlook']) : ""; ?></textarea>
                                                 
                                            </div>
                                     
                                         <div class="col-lg-12">
                                            <div class="row" id="company-fields-container">
                                                <label>Companies<span class="error">*</span></label>
                                                <div class="company-entry d-flex align-items-center mb-2">
                                                    <input type="text" name="company_title[]" class="form-control" placeholder="Company Title" required>
                                                    <input type="url" name="company_url[]" class="form-control ml-2" placeholder="Company URL" required>
                                                    <button type="button" class="btn btn-success ml-1" onclick="addCompanyField()" style="line-height: 1">+</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="companies_json" id="companies_json">
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>Single Price</label>
                                                    <input type="text" class="form-control" placeholder="" name="single_price" id="single_price" value="<?php echo (isset($report_details_specific['single_price'])) ? $report_details_specific['single_price'] : "950"; ?>">
                                                </div>
                                                 <div class="form-group col-lg-6">
                                                    <label>Corporate Price</label>
                                                    <input type="text" class="form-control" placeholder="" name="corporate_price" id="corporate_price" value="<?php echo (isset($report_details_specific['corporate_price'])) ? $report_details_specific['corporate_price'] : "1450"; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                        <div class="form-group">
                                             <label>Meta Title <span class="error">*</span></label>
                                             <input type="text" class="form-control" name="metatitle" id="metatitle" placeholder="Meta Title" value="<?php echo (isset($report_details_specific['meta_title'])) ? $report_details_specific['meta_title'] : ""; ?>" required>
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
                                                            <input type="radio" name="status" id="status1" value="Active" <?php echo (isset($report_details_specific['status']) && $report_details_specific['status'] == 'Active'|| $report_details_specific['status'] == '' ) ? "checked" : ""; ?>>
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
document.addEventListener('DOMContentLoaded', function() {
    const dropdownContainer = document.querySelector('.dropdown-container');
    const dropdownSelected = dropdownContainer.querySelector('#company-search');
    const dropdownMenu = dropdownContainer.querySelector('.dropdown-menu');
    const checkboxes = dropdownMenu.querySelectorAll('.company-checkbox');
    const selectedCompaniesDiv = document.getElementById('selected-companies');
    
    // Toggle dropdown visibility
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
            const selectedCompanies = Array.from(checkboxes)
                .filter(c => c.checked)
                .map(c => c.nextElementSibling.textContent.trim());

            // Update the search input with the selected companies
            dropdownSelected.value = selectedCompanies.length > 0 
                ? selectedCompanies.join(', ') 
                : 'Search Companies';

            // Update the selected companies div above the dropdown
            selectedCompaniesDiv.innerHTML = selectedCompanies.length > 0
                ? 'Selected: ' + selectedCompanies.join(', ')
                : '';
        });
    });

    document.getElementById('company-search-dropdown').addEventListener('input', function() {
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

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function addCompanyField() {
            let container = document.getElementById('company-fields-container');
            let div = document.createElement('div');
            div.className = 'company-entry d-flex align-items-center mb-2';
            div.innerHTML = `
                <input type="text" name="company_title[]" class="form-control mr-2" placeholder="Company Title" required>
                <input type="url" name="company_url[]" class="form-control mr-2" placeholder="Company URL" required>
                <button type="button" class="btn btn-danger ml-2" onclick="removeCompanyField(this)" style="line-height: 1">-</button>
            `;
            container.appendChild(div);
        }

        function removeCompanyField(button) {
            button.parentElement.remove();
        }
        
        window.addCompanyField = addCompanyField;
        window.removeCompanyField = removeCompanyField;
    });
</script>
<script>
function prepareJSONData() {
    var titles = document.getElementsByName('company_title[]');
    var urls = document.getElementsByName('company_url[]');
    console.log(titles);
    
    var companies = [];
    
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


$(document).ready(function () {
    const countryData = <?php echo json_encode($countryData); ?>;
    console.log(countryData);

    $('.region-checkbox').change(function () {
        let region = $(this).data('region');
        let countryList = $('#country_' + region);

        if ($(this).is(':checked')) {
            countryList.empty().hide(); // Clear previous entries

            if (countryData[region] && countryData[region].length > 0) {
                countryData[region].forEach(country => {
                    countryList.append(`
                        <div class="form-check">
                            <input class="form-check-input country-checkbox" type="checkbox" 
                                   id="${region}_${country.id}" value="${country.name}" 
                                   data-region="${region}">
                            <label class="form-check-label" for="${region}_${country.id}">${country.name}</label>
                        </div>
                    `);
                });
                countryList.slideDown();
            } else {
                countryList.append("<p>No countries available</p>").slideDown();
            }
        } else {
            countryList.slideUp().empty(); // Hide and clear when unchecked
        }
    });

    function prepareRegionCountryData() {
        
         var region_NA = document.getElementsByName('region_NA');
         var region_EU = document.getElementsByName('region_EU');
          var region_APAC = document.getElementsByName('region_APAC');
         var region_LA = document.getElementsByName('region_LA');
          var region_MEA = document.getElementsByName('region_MEA');
          
          
        var country_NA = document.getElementsByName('country_NA[]');
         var country_EU = document.getElementsByName('country_EU[]');
          var country_APAC = document.getElementsByName('country_APAC[]');
         var country_LA = document.getElementsByName('country_LA[]');
          var country_MEA = document.getElementsByName('country_MEA[]');
        
        let selectedRegions = [];
        let selectedCountries = {};

        $(".region-checkbox:checked").each(function () {
            let region = $(this).data("region");
            selectedRegions.push(region);
            selectedCountries[region] = [];
        });

        $(".country-checkbox:checked").each(function () {
            let region = $(this).data("region");
            let countryName = $(this).val();
            if (selectedCountries[region]) {
                selectedCountries[region].push(countryName);
            }
        });

        console.log("Selected Regions:", selectedRegions);
        console.log("Selected Countries:", selectedCountries);

        return true; 
    }

    function handleFormSubmission() {
       return prepareJSONData();
        return prepareRegionCountryData(); // Ensure data is processed before submitting
    }
});


</script>
</body>
</html>