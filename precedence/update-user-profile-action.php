<?php
require_once("classes/cls-admin.php");
$obj_admin = new Admin();
if($_POST['fname'] == NULL || $_POST['fname'] == "") {
    header("Location:update-user-profile.php");
} 
else
{
    $fname = $_POST['fname'];
}
if($_POST['lname'] == NULL || $_POST['lname'] == "") {
    $_SESSION['error'] = "Please enter Last Name";
    header("Location:update-user-profile.php");
} 
else
{
    $lname = $_POST['lname'];
}
if($_POST['email'] == NULL || $_POST['email'] == "") {
    $_SESSION['error'] = "Please enter Email Id";
    header("Location:update-user-profile.php");
} 
else
{
    $email = $_POST['email'];
}
if($_POST['client_pass'] == NULL || $_POST['client_pass'] == "") {
    $_SESSION['error'] = "Please enter Password";
    header("Location:update-user-profile.php");
} 
// else
// {
//     $pass = $_POST['client_pass'];
// }
if ($fname != "" && $lname != "") {
    $ret=0;
    if(($_POST['password'] != "") && ($_POST['npassword'] != ""))
    {
        $condition = "`predr_backusers`.`admin_id` = '" . $_POST['user_id'] . "'";
        $admin_details = $obj_admin->getAdminDetails('', $condition, '', '', 0);
        foreach($admin_details as $admin_detail)
        {
           $pass= base64_decode($admin_detail['password']);
        }
        
        if($pass == $_POST['password'])
        {
            $update_data['password'] = base64_encode($_POST['npassword']);
        }
        else
        {
              $ret=1;
              echo $ret;
              exit();
        }
    }
   
    $condition = "`predr_backusers`.`admin_id` = '" . $_POST['user_id'] . "'";
    $update_data['f_name'] = htmlspecialchars($_POST['fname']);
    $update_data['lname'] = htmlspecialchars($_POST['lname']);
    //$update_data['email_id'] = htmlspecialchars($_POST['email']);
    $ret_upd = $obj_admin->updateAdmin($update_data, $condition, 0);
    echo $ret;
}
else{
       echo "in else action"; 
       exit;
}
?>