<?php

require_once("classes/cls-report.php");
require_once("classes/cls-sample.php");

$obj_report = new Report();
$obj_sample = new Sample();

$conn = $obj_report->getConnectionObj();
if(!isset($_POST['popular']))
{
    $popular="0";
}
else
{
    $popular=$_POST['popular'];
}
if(!isset($_POST['feature']))
{
    $feature="0";
}
else
{
    $feature=$_POST['feature'];
}

if ($_POST['update_type'] == "add") {
    
   
    $slug = str_replace(" ", "-", $_POST['repurl']);
    $slug = strtolower($slug);
    
    $regions = $_POST['regions'];
       
    if (
    (isset($_POST['europec']) && !empty($_POST['europec'])) ||
    (isset($_POST['northAmericac']) && !empty($_POST['northAmericac'])) ||
    (isset($_POST['lac']) && !empty($_POST['lac'])) ||
    (isset($_POST['meac']) && !empty($_POST['meac'])) ||
    (isset($_POST['asiaPacificc']) && !empty($_POST['asiaPacificc'])) ||
    (isset($_POST['countrySpecific']) && !empty($_POST['countrySpecific']))
    ) {
    
    $selectedColors_1 = $_POST['europec'] ?? [];
    $selectedColors_2 = $_POST['northAmericac'] ?? [];
    $selectedColors_3 = $_POST['lac'] ?? [];
    $selectedColors_4 = $_POST['asiaPacificc'] ?? [];
    $selectedColors_5 = $_POST['meac'] ?? [];
    
    $asia = $_POST['asiaPacific'] ?? [];
    $europe = $_POST['europe'] ?? [];
    $amerca = $_POST['northAmerica'] ?? [];
    $la = $_POST['la'] ?? [];
    $mea = $_POST['mea'] ?? [];
    $countrySpecific = $_POST['countrySpecific'] ?? 0;
    
     $insert_data['region_APAC'] = implode(', ', $selectedColors_4);
     $insert_data['region_EU'] = implode(', ', $selectedColors_1);
     $insert_data['region_NA'] = implode(', ', $selectedColors_2);
     $insert_data['region_LA'] = implode(', ', $selectedColors_3);
     $insert_data['region_MEA'] = implode(', ', $selectedColors_5);
    
    $insert_data['country_APAC'] = implode(', ', $asia);
    $insert_data['country_EU'] = implode(', ', $europe);
    $insert_data['country_NA'] = implode(', ', $amerca);
    $insert_data['country_LA'] = implode(', ', $la);
    $insert_data['country_MEA'] = implode(', ', $mea);
  
}    
    
    foreach ($regions as $region) {
        $escaped_region[] = mysqli_real_escape_string($conn, $region);
    }

    $regions_string = implode(',', $escaped_region);
   
    $countries = $_POST['countries'];
    $escaped_countries = [];
 
    foreach ($countries as $country) {
        $escaped_countries[] = mysqli_real_escape_string($conn, $country);
    }

$company_titles = isset($_POST['company_title']) ? $_POST['company_title'] : [];
$company_urls = isset($_POST['company_url']) ? $_POST['company_url'] : [];

$companies = [];

if (!empty($company_titles) && !empty($company_urls)) {
    for ($i = 0; $i < count($company_titles); $i++) {
        if (!empty($company_titles[$i]) && !empty($company_urls[$i])) {
            $companies[] = [
                "company_title" => $company_titles[$i],
                "company_url" => $company_urls[$i]
            ];
        }
    }
}

$companies_json = json_encode($companies, JSON_UNESCAPED_SLASHES);
  
    $insert_data['CatId'] = mysqli_real_escape_string($conn, $_POST['repcategory']);
    $insert_data['report_type'] = mysqli_real_escape_string($conn, $_POST['scope']);
    if ($_POST['scope'] != 'Country') {
        $insert_data['region_id'] = $regions_string;
    } else {
        $insert_data['region_id'] = null; 
    }
    $insert_data['country_id'] = $countries_string;
    $insert_data['reportSubject'] = mysqli_real_escape_string($conn, $_POST['reptitle']);
    $insert_data['reportDate'] = mysqli_real_escape_string($conn, $_POST['pubdate']);
    $insert_data['intro'] = mysqli_real_escape_string($conn, $_POST['intro']);
    $insert_data['outlook_intro'] = mysqli_real_escape_string($conn, $_POST['outlook']);
    $insert_data['company_id'] = mysqli_real_escape_string($conn, $companies_json);
    $insert_data['revenue'] = mysqli_real_escape_string($conn, $_POST['revenue']);
    $insert_data['forecast'] = mysqli_real_escape_string($conn, $_POST['forecast']);
    $insert_data['cagr'] = mysqli_real_escape_string($conn, ($_POST['cagr']));
    $insert_data['short_description'] = mysqli_real_escape_string($conn, ($_POST['short_description']));
    $insert_data['meta_title'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $insert_data['Price_SUL'] = mysqli_real_escape_string($conn, $_POST['single_price']);
    $insert_data['Price_CUL'] = mysqli_real_escape_string($conn, $_POST['corporate_price']);
    $insert_data['report_coverage'] = mysqli_real_escape_string($conn, $_POST['report_coverage']);
    $insert_data['meta_description'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $insert_data['meta_keywords'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $insert_data['meta_title'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $insert_data['meta_description'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $insert_data['meta_keywords'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['popular'] = mysqli_real_escape_string($conn, $popular);
    $insert_data['featured'] = mysqli_real_escape_string($conn, $feature);
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] =date("Y-m-d h:i:s");
    $obj_report->insertReport_q($insert_data, 0);
    
    
    $_SESSION['success'] = "<strong>Report</strong> has been added successfully";
    } 
header("Location:manage-report-stats");
exit(0);
?>