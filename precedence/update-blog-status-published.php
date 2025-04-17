<?php
require_once("classes/cls-blog.php");

$obj_blog = new Blog();
$conn = $obj_blog->getConnectionObj();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login.php");
}

$blogid=$_POST['blogid'];


$fields = "*";
$condition = "`predr_blogs`.`id`='".$blogid."'";
$blog_details = $obj_blog->getBlogDetails($fields, $condition, '', '', 0);

foreach($blog_details as $blog_detail)
{
    $blogstatus=$blog_detail['status'];
}
    if($blogstatus=='Active')
    {
        $blogstatus1='Inactive';
    }
    if($blogstatus=='Inactive')
    {
        $blogstatus1='Active';
    }
        $update_data['status'] = $blogstatus1;
        $update_data['ModifiedDate'] = date("Y-m-d h:i:s");
        $condition = "`predr_blogs`.`id` = '" . $blogid . "'";
        $lastupdateid = $obj_blog->updateBlog($update_data,$condition, 0);
        echo $lastupdateid;
//echo $lastupdateid;
?>
