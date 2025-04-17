<?php error_reporting(E_ALL);ini_set("display_errors", 0);
$PrdH = "localhost";$PrdUsr = "thealthc_usr382";$PrdPss = "M*kb!#!$1Vtt}"; $PrdDB = "thealthc_hcare6382";
$db = mysqli_connect($PrdH, $PrdUsr, $PrdPss,$PrdDB) or die("Error in database connection");
$prdurl="https://www.towardshealthcare.com/";
$webheading = 'Towards Healthcare';
$leadmail = "sales@towardshealthcare.com";
$shortname = 'Towards Healthcare';
$inner = 1; $activecls1 = ''; $activecls2 = ''; $activecls3 = ''; $activecls4 = ''; $activecls5 = '';$activecls6 = '';
$act7 = ''; $premdt= ""; $predricp = ""; $predkeym ="";
$dbprefix = 'predr_'; $tomail="sales@towardshealthcare.com"; 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); ?>