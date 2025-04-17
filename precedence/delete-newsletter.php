<?php
require_once("classes/cls-newsletter.php");


$obj_newsletter = new Newsletter();


$newsid=base64_decode($_GET['newsletter_id']);
$condition= "`news_id` = '" . $newsid . "'";
$obj_newsletter->deleteNewsletter($condition, 0);

header("Location:manage-newsletter");
exit(0);

?>