<?php
require_once("precedence/classes/cls-category.php");
$obj_category = new Category();
require_once("precedence/classes/cls-report.php");
$obj_report = new Report();
if(isset($_GET['searchkeyword']))
{
    $srchkeyword=$_GET['searchkeyword'];
}
else
{
    $srchkeyword="";
}
$fields_category = "catId,catName,slug";
$condition_category="`predr_category`.`status`='Active'";
$category_details=$obj_category->getCategoryDetails($fields_category, $condition_category, '', '', 0);
?>
<!doctype html>
<html lang="en">
  <head>
<!-- Required meta tags -->
<title><?php echo $meta_title; ?></title>
<link rel="icon" type="image/png" sizes="20x20" href="<?php echo SITEPATH;?>favicon.ico">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $meta_description; ?>" />
<meta name="keywords" content="<?php echo $meta_keyword; ?>" />

<meta name="robots" content="noindex">
<meta name="googlebot" content="noindex">

<!-- Bootstrap CSS -->
<?php if(isset($canonical)){ ?>
<link rel="canonical" href="<?php echo $canonical; ?>">
<?php } ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/style.css" type="text/css">
<?php if($page=="index"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/home.css" type="text/css">
<?php }?>
<?php if($page=="aboutus"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/about-us.css" type="text/css">
<?php }?>
<?php if($page=="pricing"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/pricing.css" type="text/css">
<?php }?>
<?php if($page=="common"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/common.css" type="text/css">
<?php }?>
<?php if($page=="services"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/services.css" type="text/css">
<?php }?>
<?php if($page=="thank-you"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/thank-you.css" type="text/css">
<?php }?>
<?php if($page=="report-list"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/report-list.css" type="text/css">
<?php }?>
<?php if($page=="report-detail"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/report-details.css" type="text/css">
<?php }?>
<?php if($page=="search"){ ?>
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/search.css" type="text/css">
<?php }?>
<?php if(isset($meta_title)){ ?>
<meta name="title" content="<?php echo $meta_title;?>">
<?php } ?>
<?php if(isset($meta_keyword)){ ?>
<meta name="keywords" content="<?php echo $meta_keyword;?>">
<?php } ?>
<?php if(isset($meta_description)){ ?>
<meta name="description" content="<?php echo $meta_description;?>">
<?php } ?>

<?php if(isset($RDSocial) && !empty($RDSocial)){ ?>
<meta property="og:title" content="<?php echo htmlspecialchars($meta_title, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:description" content="<?php echo htmlspecialchars(strip_tags($meta_description), ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:url" content="<?php echo htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo htmlspecialchars(str_replace("../insightimg", "https://www.towardspackaging.com/insightimg", $firstImageSrc), ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:image:secure_url" content="<?php echo htmlspecialchars(str_replace("../insightimg", "https://www.towardspackaging.com/insightimg", $firstImageSrc), ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:image:width" content="1900" />
<meta property="og:image:height" content="1000" />
<meta property="og:image:alt" content="<?php echo htmlspecialchars($meta_title, ENT_QUOTES, 'UTF-8'); ?>" />
<meta property="og:image:type" content="image/jpeg/webp" />

<meta content="summary_large_image" name="twitter:card"/>
<meta content="@TowardsPackaging" name="twitter:site"/>
<meta content="<?php echo $meta_title; ?>" name="twitter:title" />
<meta content="<?php echo strip_tags($meta_description); ?>" name="twitter:description" /> 
<meta content="<?php echo htmlspecialchars(str_replace("../insightimg", "https://www.towardspackaging.com/insightimg", $firstImageSrc), ENT_QUOTES, 'UTF-8'); ?>" />
<meta name="twitter:image:alt" content="<?php echo $meta_title; ?>" />

<?php } ?>

<?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
    <meta name="google-site-verification" content="PXEwLCBNpxknsOiKE3hy7BiOGyyGrdMA2NXKePIhM7g" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-8RGK8VDDJJ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      
      gtag('config', 'G-8RGK8VDDJJ');
    </script>
<?php endif; ?>
<style>
    #search-holder::placeholder {
        color: #fff9;
        opacity: 1; /* Ensures full opacity of the color */
    }
  /* For Internet Explorer */
  #search-holder:-ms-input-placeholder {
    color: #fff9;
  }
  /* For older versions of Microsoft Edge */
  #search-holder::-ms-input-placeholder {
    color:#fff9;
  }
  .home-navbar .navbar-light .navbar-nav .nav-link {
    font-size: 1.3rem;
    padding: 1rem 2rem;
    color: #000;
    font-weight: 500;
    text-transform: uppercase;
}
</style>
  </head>
  <body>
    <?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>   
    <div id="cookieConsent" style="display:none;">
        <div class="cookiesDiv">
            <p class="para text-white cookiesP">We collect cookies to enhance your browsing experience<a href="<?php echo SITEPATH;?>privacy-policy" target="_blank"> Learn more </a> <button id="acceptCookies">X</button></p>
        </div>
    </div>
    <?php endif; ?>
    <header class="top-navbar home-navbar" id="myHeader">
        <nav class="navbar navbar-expand-lg navbar-light navbar-full">
            <div class="container">
              <a class="navbar-brand" href="<?php echo SITEPATH;?>">
                <img src="<?php echo SITEPATH;?>images/tcm-logo.webp" alt="Towards Chem and Materials" title="Towards Chem and Materials" class="img-fluid company-logo" width="140" height="90">
              </a>
              <img src="<?php echo SITEPATH;?>images/search-icon.png" alt="search-icon" class="img-fluid search-tab-logo search-icon search-bar-mob" width="24" height="24"
                data-bs-toggle="modal" data-bs-target="#exampleModal1">
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" href="#offcanvasnavmenu" role="button" aria-controls="offcanvasnavmenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" href="<?php echo SITEPATH;?>">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEPATH;?>insights">Insights</a>
                  </li>
                   <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="submenu-list">
                                <ul class="list-unstyled category-submenu-list">
                                <?php foreach($category_details as $cat) {?>    
                                    <li>
                                        <a href="<?php echo SITEPATH; ?>industry/<?php echo $cat['slug']; ?>"><?php echo $cat['catName']; ?></a>
                                    </li>
                                <?php } ?>     
                                </ul>
                            </div>
                        </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEPATH;?>about-us">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEPATH;?>contact-us">Contact Us</a>
                  </li>
                  <li class="">
                    <a href="<?php echo SITEPATH;?>get-an-annual-membership" class="btn purple-btn mt-3 me-3 blinking-button">Annual Membership
                    </a>
                  </li>
                   <li class="search-btn">
                        <div class="search-menu">
                            <div class="site-mobile-menu-close mt-3">
                                <span class="js-menu-toggle text-white search-bar-close">
                                    <img src="<?php echo SITEPATH;?>images/close-icon.png" alt="Towards Chem and Materials" class="img-fluid"
                                    width="15" height="15">
                                </span>
                            </div>
                            <div class="wrapper">
                                <div class="text-center">
                                    <a class="navbar-brand" href="<?php echo SITEPATH;?>">
                                        <img src="<?php echo SITEPATH;?>images/tcm-logo.webp" alt="Towards Chem and Materials" class="img-fluid company-logo" width="150" height="44">
                                    </a>
                                </div>
                                <div id="form">
                                    <button class="popup-search-button" type="button" id="header_search">
                                        <img src="<?php echo SITEPATH;?>images/search-inner-icon.png" alt="search-icon" class="img-fluid search-tab-logo search-icon" width="30" height="30">
                                    </button>
                                    <input class="popup-search" type="search" placeholder="Find Industry Insights" id="search-holder" name="search" autofocus>
                                    <!--<button id="start-record-btn" title="Search by voice" class="sp-icon">-->
                                    <!--    <img src="<?php echo SITEPATH;?>images/voice.png" id="voiceSpeak" class="img-fluid voice-icon">-->
                                    <!--    <img src="<?php echo SITEPATH;?>images/voice-search.gif" id="voiceGif" style="display:none;" class="img-fluid voice-icon">-->
                                    <!--</button>-->
                                    <div class="searchrow">
                                        <div class="col-md-12">
                                            <div id="searchpopup" style="display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="<?php echo SITEPATH;?>images/search-icon.png" alt="search-icon" class="img-fluid search-tab-logo search-icon" width="24" height="24">
                    </li>
                </ul>
                <!--<form class="d-flex search-btn mb-0">-->
                    <!--<input class="form-control text-dark" type="search" placeholder="Search" aria-label="Search" required>-->
                    <!--<a class="btn" href="" onclick="">-->
                    <!--  <img src="<?php echo SITEPATH;?>images/search-icon.png" alt="search-icon" class="img-fluid" width="16" height="16">-->
                    <!--</a>-->
                <!--    <input class="form-control text-dark" type="search" placeholder="Search" aria-label="Search" id="search-holder" required>-->
                <!--    <a class="btn" id="header-search" href="javascript:void(0);" onclick="search_button();" rel="nofollow">-->
                <!--      <img src="<?php echo SITEPATH;?>images/search-icon.png" alt="search-icon" class="img-fluid" width="16" height="16">-->
                <!--    </a>-->
                <!--  </form>-->
              </div>
            </div>
          </nav>
    </header>
  
    <div class="modal fade mobile-modal-new" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="site-mobile-menu-close mt-3">
                <span class="js-menu-toggle text-white search-bar-close">
                    <img src="<?php echo SITEPATH;?>images/close-icon.png" alt="Towards packaging" class="img-fluid"
                    width="15" height="15" data-bs-dismiss="modal" aria-label="Close">
                </span>
            </div>
            <div class="wrapper">
                <div class="text-center">
                    <a class="navbar-brand" href="<?php echo SITEPATH;?>">
                        <img src="<?php echo SITEPATH;?>images/towards-packaging-svg-logo.svg" alt="Towards packaging" class="img-fluid company-logo" width="150" height="44">
                    </a>
                </div>
                <div id="form">
                    <img src="<?php echo SITEPATH;?>images/search-inner-icon.png" alt="search-icon" class="img-fluid search-tab-logo search-icon search-icon-mob" width="30" height="30">
                    <input class="popup-search1" type="search" placeholder="Find Industry Insights" id="search-holder" name="search" autofocus>
                    <!--<button id="start-record-btn1" title="Search by voice" class="sp-icon">-->
                    <!--    <img src="<?php echo SITEPATH;?>images/voice.png" id="voiceSpeakMob" class="img-fluid voice-icon">-->
                    <!--    <img src="<?php echo SITEPATH;?>images/voice-search.gif" id="voiceGifMob" style="display:none;" class="img-fluid voice-icon">-->
                    <!--</button>-->
                    <div class="searchrow">
                        <div class="col-md-12">
                            <div id="searchpopup" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasnavmenu" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
          <a class="navbar-brand" href="<?php echo SITEPATH;?>">
            <img src="<?php echo SITEPATH;?>images/towards-packaging-svg-logo.svg" alt="Towards Packaging" title="Towards Packaging" class="img-fluid company-logo" width="140" height="90">
          </a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="dropdown mt-3">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo SITEPATH;?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEPATH;?>insights">Insights</a>
              </li>
              <li class="mob-dropdown accordion">
                <div class="accordion-item"> 
                    <p class="accordion-header" id="headingThree"> 
                        <button class="accordion-button MobSlide hide collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"> 
                            Categories
                        </button> 
                    </p> 
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style=""> 
                        <div class="accordion-body"> 
                            <ul class="list-unstyled p-0" aria-labelledby="navbarDropdown">
                                <?php foreach($category_details as $cat) {?>    
                                    <li>
                                        <a href="<?php echo SITEPATH; ?>industry/<?php echo $cat['slug']; ?>"><?php echo $cat['catName']; ?></a>
                                    </li>
                                <?php } ?>     
                            </ul>
                        </div> 
                    </div> 
                </div> 
            </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEPATH;?>about-us">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo SITEPATH;?>contact-us">Contact Us</a>
              </li>
            </ul>
        </div>
      </div>
    </div>