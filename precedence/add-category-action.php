<?php
require_once("classes/cls-category.php");

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$obj_category = new Category();
$conn = $obj_category->getConnectionObj();

$cattitle=strtolower(trim($_POST['cattitle']));
$slug=str_replace(' ', '-', $cattitle);

if ($_POST['update_type'] == "add") {
    $insert_data['catName'] = mysqli_real_escape_string($conn, $_POST['cattitle']);
    $insert_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_category->insertCategory($insert_data, 0);

    $_SESSION['success'] = "<strong>Category</strong> has been added successfully";
} else {
    $condition = "`catId` = '" . base64_decode($_POST['cat_id']) . "'";
    $update_data['catName'] = mysqli_real_escape_string($conn, $_POST['cattitle']);
    $update_data['slug'] = mysqli_real_escape_string($conn, $slug);
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_category->updateCategory($update_data, $condition, 0);
    
    $_SESSION['success'] = "<strong>Category</strong> has been updated successfully.";
}
header("Location:manage-category");
exit(0);
?>