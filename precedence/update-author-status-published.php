<?php
require_once("classes/cls-author.php");

$obj_author = new Author();
$conn = $obj_author->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$author_id=$_POST['author_id'];


$fields = "*";
$condition = "`predr_author`.`author_id`='".$author_id."'";
$author_details = $obj_author->getAuthorDetails($fields, $condition, '', '', 0);

foreach($author_details as $author_detail)
{
    $authorstatus=$author_detail['status'];
}
    if($authorstatus=='Active')
    {
        $authorstatus1='Inactive';
    }
    if($authorstatus=='Inactive')
    {
        $authorstatus1='Active';
    }
        $update_data['status'] = $authorstatus1;
        $update_data['updated_at'] = date("Y-m-d h:i:s");
        $condition = "`predr_author`.`author_id` = '" . $author_id . "'";
        $lastupdateid = $obj_author->updateAuthor($update_data,$condition, 0);
        echo $lastupdateid;
//echo $lastupdateid;
?>
