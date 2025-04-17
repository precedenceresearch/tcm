<?php
require_once("classes/cls-category.php");

$obj_category = new Category();
$conn = $obj_category->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$catid=$_POST['catid'];


$fields = "*";
$condition = "`predr_category`.`catId`='".$catid."'";
$category_details = $obj_category->getCategoryDetails($fields, $condition, '', '', 0);

foreach($category_details as $category_detail)
{
    $categorystatus=$category_detail['status'];
}
    if($categorystatus=='Active')
    {
        $categorystatus1='Inactive';
    }
    if($categorystatus=='Inactive')
    {
        $categorystatus1='Active';
    }
        $update_data['status'] = $categorystatus1;
        $update_data['updated_at'] = date("Y-m-d h:i:s");
        $condition = "`predr_category`.`catId` = '" . $catid . "'";
        $lastupdateid = $obj_category->updateCategory($update_data,$condition, 0);
        echo $lastupdateid;
//echo $lastupdateid;
?>
