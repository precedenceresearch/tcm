<?php

require_once("classes/cls-report.php");

$obj_report = new Report();

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
$report_id=($_POST['report_id']);

    $regions = $_POST['regions'];
    
    $escaped_region = [];
    
    foreach ($regions as $region) {
        $escaped_region[] = mysqli_real_escape_string($conn, $region);
    }
    
    $regions_string = implode(',', $escaped_region);
   
   
    $countries = $_POST['countries'];
    $escaped_countries = [];
 
    foreach ($countries as $country) {
        $escaped_countries[] = mysqli_real_escape_string($conn, $country);
    }

    $countries_string = implode(',', $escaped_countries);
    

    $slug = str_replace(" ", "-", $_POST['repurl']);
    $slug = strtolower($slug);
    $condition = "`report_id` = '" . $report_id . "'";
    $update_data['CatId'] = mysqli_real_escape_string($conn, $_POST['repcategory']);
    $update_data['report_type'] = mysqli_real_escape_string($conn, $_POST['scope']);
    if ($_POST['scope'] != 'Country') {
        $update_data['region_id'] = $regions_string;
    } else {
        $update_data['region_id'] = null; 
    }
    
 $selectedCompaniesJson = $_POST['companies_json'];
    $selectedCompaniesArray = json_decode($selectedCompaniesJson, true);
 //  echo "hiii"; print_r($selectedCompaniesJson);exit;

    // Escape and re-encode for database storage
    $escapedCompaniesArray = [];
    foreach ($selectedCompaniesArray as $company) {
        $escapedCompaniesArray[] = [
            "company_title" => mysqli_real_escape_string($conn, $company['company_title']),
            "company_url" => mysqli_real_escape_string($conn, $company['company_url'])
        ];
    }

    $escapedCompaniesJson = json_encode($escapedCompaniesArray, JSON_UNESCAPED_SLASHES);
    
    
    
    
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
    
     $update_data['region_APAC'] = implode(', ', $selectedColors_4);
     $update_data['region_EU'] = implode(', ', $selectedColors_1);
     $update_data['region_NA'] = implode(', ', $selectedColors_2);
     $update_data['region_LA'] = implode(', ', $selectedColors_3);
     $update_data['region_MEA'] = implode(', ', $selectedColors_5);
    
    $update_data['country_APAC'] = implode(', ', $asia);
    $update_data['country_EU'] = implode(', ', $europe);
    $update_data['country_NA'] = implode(', ', $amerca);
    $update_data['country_LA'] = implode(', ', $la);
    $update_data['country_MEA'] = implode(', ', $mea);
  
}   
    
    


          
    $update_data['country_id'] = $countries_string;
    $update_data['reportSubject'] = mysqli_real_escape_string($conn, $_POST['reptitle']);
    $update_data['reportDate'] = mysqli_real_escape_string($conn, $_POST['pubdate']);
    $update_data['intro'] = mysqli_real_escape_string($conn, addslashes($_POST['intro']));
    $update_data['outlook_intro'] = mysqli_real_escape_string($conn, addslashes($_POST['outlook']));
    $update_data['company_id'] = $escapedCompaniesJson;
    $update_data['revenue'] = !empty($_POST['revenue']) ? mysqli_real_escape_string($conn, $_POST['revenue']) : NULL;
    $update_data['forecast'] = !empty($_POST['forecast']) ? mysqli_real_escape_string($conn, $_POST['forecast']) : NULL;
    $update_data['cagr'] = !empty($_POST['cagr']) ? mysqli_real_escape_string($conn, $_POST['cagr']) : NULL;
    $update_data['short_description'] = mysqli_real_escape_string($conn, $_POST['short_description']);
    $update_data['meta_title'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $update_data['Price_SUL'] = !empty($_POST['single_price']) ? mysqli_real_escape_string($conn, $_POST['single_price']) : NULL;
    $update_data['Price_CUL'] = !empty($_POST['corporate_price']) ? mysqli_real_escape_string($conn, $_POST['corporate_price']) : NULL;
    $update_data['report_coverage'] = mysqli_real_escape_string($conn, $_POST['report_coverage']);
    $update_data['meta_description'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $update_data['meta_keywords'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $update_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $update_data['popular'] = mysqli_real_escape_string($conn, $popular);
    $update_data['featured'] = mysqli_real_escape_string($conn, $feature);
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_report->updateReport_q($update_data, $condition, 0);
          
    $_SESSION['success'] = "<strong>Report</strong> has been updated successfully.";
            
            
header("Location:manage-report-stats");
exit(0);
?>