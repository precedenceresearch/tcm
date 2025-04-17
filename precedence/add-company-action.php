<?php
require_once("classes/cls-report.php");

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$obj_report = new Report();
$conn = $obj_report->getConnectionObj();


if ($_POST['update_type'] == "add") {
    $slug = str_replace(" ", "-", $_POST['slug']);
    $slug = strtolower($slug);
    
    $insert_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $insert_data['title'] = mysqli_real_escape_string($conn, $_POST['title']);
    $insert_data['view_desc'] = mysqli_real_escape_string($conn, ($_POST['view_desc']));
    $insert_data['pub_date'] = mysqli_real_escape_string($conn, $_POST['pub_date']);
    
    $insert_data['prmetatitle'] = mysqli_real_escape_string($conn, $_POST['prmetatitle']);
    $insert_data['prmetadesc'] = mysqli_real_escape_string($conn, $_POST['prmetadesc']);
    $insert_data['prmetakeywords'] = mysqli_real_escape_string($conn, $_POST['prmetakeywords']);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
  
    $insert_data['status'] = $_POST['status'];
    $insert_data['createddate'] = date("Y-m-d h:i:s");
    $insert_data['ModifiedDate'] = date("Y-m-d h:i:s");
    $obj_report->insertCompany($insert_data, 0);

    $_SESSION['success'] = "<strong>Companies</strong> has been added successfully";
} else {
    $slug = str_replace(" ", "-", $_POST['slug']);
    $slug = strtolower($slug);
    $condition = "`id` = '" . base64_decode($_POST['id']) . "'";
    
    $update_data['report_id'] = mysqli_real_escape_string($conn, $_POST['report_id']);
    $update_data['title'] = mysqli_real_escape_string($conn, $_POST['title']);
    $update_data['view_desc'] = mysqli_real_escape_string($conn, ($_POST['view_desc']));
    $update_data['pub_date'] = mysqli_real_escape_string($conn, $_POST['pub_date']);
    
    $update_data['prmetatitle'] = mysqli_real_escape_string($conn, $_POST['prmetatitle']);
    $update_data['prmetadesc'] = mysqli_real_escape_string($conn, $_POST['prmetadesc']);
    $update_data['prmetakeywords'] = mysqli_real_escape_string($conn, $_POST['prmetakeywords']);
    $update_data['slug'] = mysqli_real_escape_string($conn, $slug);
  
    $update_data['status'] = $_POST['status'];
    $update_data['ModifiedDate'] = date("Y-m-d h:i:s");
    $update_data['status'] = $_POST['status'];
    $obj_report->updateCompanies($update_data, $condition, 0);
    
    $_SESSION['success'] = "<strong>Companies</strong> has been updated successfully.";
}
header("Location:manage-companies");
exit(0);
?>