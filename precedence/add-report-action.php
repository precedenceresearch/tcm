<?php
require_once("classes/cls-report.php");

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

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

if(!isset($_POST['footerreport']))
{
    $footerreport="0";
}
else
{
    $footerreport=$_POST['footerreport'];
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
    $insert_data['CatId'] = mysqli_real_escape_string($conn, $_POST['repcategory']);
    $insert_data['reportSubject'] = mysqli_real_escape_string($conn, $_POST['reptitle']);
    $insert_data['shortDescription'] = mysqli_real_escape_string($conn, ($_POST['shortDescription']));
    $insert_data['reportLDesc'] = mysqli_real_escape_string($conn, ($_POST['description']));
    $insert_data['toc'] = mysqli_real_escape_string($conn, $_POST['toc']);
    $insert_data['reportDate'] = mysqli_real_escape_string($conn, $_POST['pubdate']);
    $insert_data['Price_SUL'] = mysqli_real_escape_string($conn, $_POST['singlicense']);
    $insert_data['Price_CUL'] = mysqli_real_escape_string($conn, $_POST['corplicense']);
    $insert_data['Price_Multi'] = mysqli_real_escape_string($conn, $_POST['multilicense']);
    $insert_data['No_Pages'] = mysqli_real_escape_string($conn, $_POST['pages']);
    $insert_data['meta_title'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $insert_data['meta_description'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $insert_data['meta_keywords'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['popular'] = mysqli_real_escape_string($conn, $popular);
    $insert_data['footerreport'] = mysqli_real_escape_string($conn, $footerreport);
    $insert_data['featured'] = mysqli_real_escape_string($conn, $feature);
    $insert_data['author_id'] = mysqli_real_escape_string($conn, $_POST['repauthor']);
    $insert_data['experts_opinion'] = mysqli_real_escape_string($conn, $_POST['experts_opinion']);
    $insert_data['references'] = mysqli_real_escape_string($conn, $_POST['references']);
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_report->insertReport($insert_data, 0);

    $_SESSION['success'] = "<strong>Report</strong> has been added successfully";
} else {
    $slug = str_replace(" ", "-", $_POST['repurl']);
    $slug = strtolower($slug);
    $condition = "`report_id` = '" . base64_decode($_POST['report_id']) . "'";
    $update_data['CatId'] = mysqli_real_escape_string($conn, $_POST['repcategory']);
    $update_data['reportSubject'] = mysqli_real_escape_string($conn, $_POST['reptitle']);
    $update_data['shortDescription'] = mysqli_real_escape_string($conn, ($_POST['shortDescription']));
    $update_data['reportLDesc'] = mysqli_real_escape_string($conn, ($_POST['description']));
    $update_data['toc'] = mysqli_real_escape_string($conn, $_POST['toc']);
    $update_data['reportDate'] = mysqli_real_escape_string($conn, $_POST['pubdate']);
    $update_data['Price_SUL'] = mysqli_real_escape_string($conn, $_POST['singlicense']);
    $update_data['Price_CUL'] = mysqli_real_escape_string($conn, $_POST['corplicense']);
    $update_data['Price_Multi'] = mysqli_real_escape_string($conn, $_POST['multilicense']);
    $update_data['No_Pages'] = mysqli_real_escape_string($conn, $_POST['pages']);
    $update_data['meta_title'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $update_data['meta_description'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $update_data['meta_keywords'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $update_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $update_data['popular'] = mysqli_real_escape_string($conn, $popular);
    $update_data['footerreport'] = mysqli_real_escape_string($conn, $footerreport);
    $update_data['featured'] = mysqli_real_escape_string($conn, $feature);
    $update_data['author_id'] = mysqli_real_escape_string($conn, $_POST['repauthor']);
    $update_data['experts_opinion'] = mysqli_real_escape_string($conn, $_POST['experts_opinion']);
    $update_data['references'] = mysqli_real_escape_string($conn, $_POST['references']);
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_report->updateReport($update_data, $condition, 0);
    
    $_SESSION['success'] = "<strong>Report</strong> has been updated successfully.";
}
header("Location:manage-report");
exit(0);
?>