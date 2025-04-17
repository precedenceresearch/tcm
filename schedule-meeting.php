 <?php
 require_once("precedence/classes/cls-report.php");

$obj_report = new Report();
$page = "aboutus"; 
$meta_title="Schedule a Meeting | Book Appointments Effortlessly";
$meta_keyword="";
$meta_description="Easily schedule a meeting with our online booking system. Select a convenient time, receive instant confirmations, and streamline your appointments hassle-free.";
?>

<link rel="stylesheet" href="css/about-us2.css">
<?php include("header.php");?>

<style>
    .caln{
        height: 100rem;
    }
</style>

<div class="ptb bg-light-bl pb-0">
    <div class="container-flued">
      <iframe src='https://outlook.office365.com/book/SheduleaCall@precedenceresearch.com/' 
        width='100%' height='100%' scrolling='yes' style='border:0'></iframe>
        </div>
        
       
    </div>
</div>

<?php include("footer.php");?>