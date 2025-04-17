<?php 
require_once("classes/cls-admin.php");
$obj_admin = new Admin();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}
?>
<?php include('header.php')?>
<?php include('sidebar-menu.php')?>
<div class="home-section">
   <?php include("top-bar.php"); ?>
        <section class="common-space pt-3_7">
    <div class="container">
        <div class="row d-flex align-items-center pb-3 light-bg">
            <div class="col-md-12">
                <h5 class="page-header">
                    <i class="icon-Dashboard"></i>
                    Dashboard
                </h5>
            </div>
        </div>
        
    </div>
</section>
<?php include('footer.php')?>

<script>
let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");

sidebarBtn.addEventListener("click",()=>{
  sidebar.classList.toggle("close");
});
</script>

