<?php
require_once("classes/cls-author.php");

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$obj_author = new Author();
$conn = $obj_author->getConnectionObj();

$fullname=trim($_POST['fname']);
$email=trim($_POST['email']);
$designation=trim($_POST['desig']);
$description=trim($_POST['descp']);


if ($_POST['update_type'] == "add") {
    $insert_data['author_name'] = mysqli_real_escape_string($conn, addslashes($fullname));
    $insert_data['author_email'] = mysqli_real_escape_string($conn, $email);
    $insert_data['author_designation'] = mysqli_real_escape_string($conn, addslashes($designation));
    $insert_data['author_description'] = mysqli_real_escape_string($conn, addslashes($description));
    $insert_data['status'] = $_POST['status'];
    $insert_data['created_at'] = date("Y-m-d h:i:s");
    $insert_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_author->insertAuthor($insert_data, 0);

    $_SESSION['success'] = "<strong>Author details</strong> has been added successfully";
} else {
    $condition = "`author_id` = '" . base64_decode($_POST['author_id']) . "'";
    $update_data['author_name'] = mysqli_real_escape_string($conn, addslashes($fullname));
    $update_data['author_email'] = mysqli_real_escape_string($conn, $email);
    $update_data['author_designation'] = mysqli_real_escape_string($conn, addslashes($designation));
    $update_data['author_description'] = mysqli_real_escape_string($conn, addslashes($description));
    $update_data['status'] = $_POST['status'];
    $update_data['updated_at'] = date("Y-m-d h:i:s");
    $obj_author->updateAuthor($update_data, $condition, 0);
    
    $_SESSION['success'] = "<strong>Author details</strong> has been updated successfully.";
}
header("Location:manage-author");
exit(0);
?>