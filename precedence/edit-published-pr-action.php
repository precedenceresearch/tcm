<?php
require_once("classes/cls-leads.php");

$obj_lead = new Lead();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$conn = $obj_lead->getConnectionObj();

    $condition = "`id` = '" . base64_decode($_POST['id']) . "'";
      
    $update_data['doc_id'] = mysqli_real_escape_string($conn, $_POST['doc_id']);
    $update_data['title'] = mysqli_real_escape_string($conn, $_POST['presstitle']);
    $update_data['pressurl'] = mysqli_real_escape_string($conn, strtolower(str_replace(' ', '_', $_POST['pressurl'])));
    $update_data['pub_date'] = mysqli_real_escape_string($conn, $_POST['pubdate']);
    $update_data['author'] = mysqli_real_escape_string($conn, $_POST['author']);
    $update_data['description'] = mysqli_real_escape_string($conn, $_POST['description']);
    $update_data['meta_title'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $update_data['meta_description'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $update_data['meta_keyword'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $update_data['status'] = $_POST['status'];
    $update_data['modified_at'] = date("Y-m-d h:i:s");
    
    $obj_lead->updatepressrelease($update_data, $condition, 0);
    
    $_SESSION['success'] = "<strong>Published Press Release</strong> has been Updated successfully.";

header("Location:direct-press-release");
exit(0);
?>