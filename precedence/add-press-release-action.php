<?php
require_once("classes/cls-press-release.php");

$obj_press = new Press();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$conn = $obj_press->getConnectionObj();

if ($_POST['update_type'] == "add") {
    $insert_data['pub_date'] = mysqli_real_escape_string($conn, $_POST['pubdate']);
    $insert_data['view_desc'] = mysqli_real_escape_string($conn, $_POST['description']);
    $insert_data['title'] = mysqli_real_escape_string($conn, $_POST['presstitle']);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $_POST['pressurl']);
    $insert_data['prmetatitle'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $insert_data['prmetadesc'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $insert_data['prmetakeywords'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $insert_data['status'] = $_POST['status'];
    $insert_data['createddate'] = date("Y-m-d h:i:s");
    $insert_data['ModifiedDate'] = date("Y-m-d h:i:s");
    $obj_press->insertPress($insert_data, 0);

    $_SESSION['success'] = "<strong>Press Release</strong> has been added successfully";
} else {
    $condition = "`id` = '" . base64_decode($_POST['press_id']) . "'";
    $update_data['pub_date'] = mysqli_real_escape_string($conn, $_POST['pubdate']);
    $update_data['view_desc'] = mysqli_real_escape_string($conn, $_POST['description']);
    $update_data['title'] = mysqli_real_escape_string($conn, $_POST['presstitle']);
    $update_data['slug'] = mysqli_real_escape_string($conn, $_POST['pressurl']);
    $update_data['prmetatitle'] = mysqli_real_escape_string($conn, $_POST['metatitle']);
    $update_data['prmetadesc'] = mysqli_real_escape_string($conn, $_POST['metadescription']);
    $update_data['prmetakeywords'] = mysqli_real_escape_string($conn, $_POST['metakeyword']);
    $update_data['status'] = $_POST['status'];
    $update_data['ModifiedDate'] = date("Y-m-d h:i:s");
    $obj_press->updatePress($update_data, $condition, 0);
    
    $_SESSION['success'] = "<strong>Press Release</strong> has been updated successfully.";
}
header("Location:manage-press-release");
exit(0);
?>