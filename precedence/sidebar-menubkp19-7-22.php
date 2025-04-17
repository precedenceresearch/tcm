<?php
$pageurl=$_SERVER['SCRIPT_URL'];
//print_r($_SERVER);
//die();
$explodepgname=explode("/precedence/",$pageurl);
$pagename=$explodepgname[1];

//print_r($_SESSION);die();
$userrole=$_SESSION['ifg_admin']['role'];
?> 
<!-- Box icon CSS   -->
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<!-- End -->
<div class="sidebar">
    <div class="logo-details">
      <!--<i class='bx bxl-bitcoin'></i>-->
      <!--<a href="<?php echo SITEADMIN;?>dashboard"><img src="images/Avira_Favicon_W.svg" class="img-fluid top-left-icon small-icon mt-3" id="favimg"></a>-->
      <!--<span class="logo_name" id="bigimg">-->
      <!--    <a href="<?php echo SITEADMIN;?>dashboard"><img src="images/AviraLead_light_logo.svg" class="img-fluid c_logo"></a>-->
      <!--</span>-->
    </div>
    <ul class="nav-links">
        <li <?php if($pagename=="dashboard"){?> class="sidebar-active" <?php }?>>
            <a href="<?php echo SITEADMIN; ?>dashboard">
              <i class='icon-Dashboard' ></i>
              <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?php echo SITEADMIN;?>dashboard.php">Dashboard</a></li>
            </ul>
        </li>
        <!--<li>-->
        <!--    <div class="icon-links">-->
        <!--      <a href="#">-->
        <!--        <i class='icon-Lead-Box'></i>-->
        <!--        <span class="link_name">Reports</span>-->
        <!--      </a>-->
        <!--      <i class='bx bxs-chevron-down arrow'></i>-->
        <!--    </div>-->
        <!--    <ul class="sub-menu">-->
        <!--      <li><a class="link_name" href="#">Reports</a></li>-->
        <!--      <li><a>Add Report</a></li>-->
        <!--      <li><a>Manage Report</a></li>-->
        <!--    </ul>-->
        <!--</li>-->
          <li <?php if($pagename=="manage-category" || $pagename=="add-category"){?> class="sidebar-active" <?php }?>>
            <a href="<?php echo SITEADMIN; ?>manage-category">
              <i class='icon-Manage-User'></i>
              <span class="link_name">Manage Category</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?php echo SITEADMIN; ?>manage-category">Manage Category</a></li>
            </ul>
          </li>
          <li <?php if($pagename=="add-report-faq" || $pagename=="manage-report" || $pagename=="add-report" || $pagename=="edit-report-faq" || $pagename=="view-report-faq"){?> class="sidebar-active" <?php }?>>
            <a href="<?php echo SITEADMIN; ?>manage-report">
              <i class='icon-Manage-User'></i>
              <span class="link_name">Manage Report</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?php echo SITEADMIN; ?>manage-report">Manage Report</a></li>
            </ul>
          </li>
        <?php if($userrole=="superadmin"){?>
          <li <?php if($pagename=="manage-user" || $pagename=="add-user"){?> class="sidebar-active" <?php }?>>
            <a href="<?php echo SITEADMIN; ?>manage-user">
              <i class='icon-Manage-User'></i>
              <span class="link_name">Manage User</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?php echo SITEADMIN; ?>manage-user">Manage User</a></li>
            </ul>
          </li>
        <?php }?>
        
        <li>
            <a href="<?php echo SITEADMIN; ?>logout">
              <i class='fa fa-sign-out '></i>
              <span class="link_name">Logout</span>
            </a>
            <ul class="sub-menu blank">
              <li><a class="link_name" href="<?php echo SITEADMIN; ?>logout.php">Logout</a></li>
            </ul>
        </li>
    
    </ul>
  </div>
<?php include('footer.php')?>