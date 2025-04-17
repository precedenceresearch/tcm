<?php
require_once("classes/cls-paylink.php");

$obj_paylink = new Paylink();

if (!isset($_SESSION['ifg_admin']) || $_SESSION['ifg_admin']['role'] != "superadmin") {
    header("Location:login.php");
}

$conn = $obj_paylink->getConnectionObj();

if ($_POST['update_type'] == "add") {
    
    $inv = "TA-2526-" . $_POST['report_id'];
    
    $insert_data['rcode'] = mysqli_real_escape_string($conn, $_POST['rcode']);
    $insert_data['rname'] = mysqli_real_escape_string($conn, $_POST['rname']);
    $insert_data['ltype'] = mysqli_real_escape_string($conn, $_POST['lic']);
    $insert_data['amount'] = mysqli_real_escape_string($conn, $_POST['amount']);
    $insert_data['cname'] = mysqli_real_escape_string($conn, $_POST['cname']);
    $insert_data['company'] = mysqli_real_escape_string($conn, $_POST['ccompanyname']);
    $insert_data['email'] = mysqli_real_escape_string($conn, $_POST['email']);
    $insert_data['country'] = mysqli_real_escape_string($conn, $_POST['country']);
    $insert_data['phone_no'] = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $insert_data['invoicenum'] = mysqli_real_escape_string($conn, $inv);
    $insert_data['currency'] = mysqli_real_escape_string($conn, $_POST['currency']);
    $insert_data['rdesc'] = mysqli_real_escape_string($conn, $_POST['description']);
    $insert_data['adnote'] = mysqli_real_escape_string($conn, $_POST['addnote']);
    $insert_data['createddate'] = date("Y-m-d h:i:s");
    $obj_paylink->insertPaylink($insert_data, 0);

    $_SESSION['success'] = "<strong>Paylink</strong> has been added successfully";
} else {
    
    $inv = "TA-2425-" . $_POST['report_id'];
    
    $condition = "`payid` = '" . base64_decode($_POST['pay_id']) . "'";
    $update_data['rcode'] = mysqli_real_escape_string($conn, $_POST['rcode']);
    $update_data['rname'] = mysqli_real_escape_string($conn, $_POST['rname']);
    $update_data['ltype'] = mysqli_real_escape_string($conn, $_POST['lic']);
    $update_data['amount'] = mysqli_real_escape_string($conn, $_POST['amount']);
    $update_data['cname'] = mysqli_real_escape_string($conn, $_POST['cname']);
    $update_data['company'] = mysqli_real_escape_string($conn, $_POST['ccompanyname']);
    $update_data['country'] = mysqli_real_escape_string($conn, $_POST['country']);
    $update_data['phone_no'] = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $update_data['invoicenum'] = mysqli_real_escape_string($conn, $inv);
    $update_data['currency'] = mysqli_real_escape_string($conn, $_POST['currency']);
    $update_data['rdesc'] = mysqli_real_escape_string($conn, $_POST['description']);
    $update_data['adnote'] = mysqli_real_escape_string($conn, $_POST['addnote']);
    
    $obj_paylink->updatePaylink($update_data, $condition, 0);
    
    $_SESSION['success'] = "<strong>Paylink</strong> has been updated successfully.";
}
header("Location:manage-paylink");
exit(0);
?>