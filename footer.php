<footer class="ptb pb-0 footer-banner">
    <style>
        .footer-down{
            text-align: inherit;
        }
        .quick-legal ul li a:hover{
            color:#fff;
        }
    </style>
      <?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): 
      ?>
        <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-6 no-mob-data">
                  <div class="footer-list no-mob-txt ">
                      <h4>About Us</h4>
                      <p class="para footer-">
                         Towards Chem and Materials is a leading global consulting firm specializing in providing comprehensive and strategic research solutions across the chemical and materials industries.
With a highly skilled and experienced consultant team, we offer a wide range of services designed to empower businesses with valuable insights and actionable recommendations.
                      </p>
                  </div>
              </div>
              <div class="col-lg-3 col-md-6">
                  <div class="footer-list no-mob-txt">
                      <h4>Connect with Us</h4>
                      <ul class="list-unstyled">
                          <li>
                              <!--<img src="<?php echo SITEPATH;?>images/footer-images/location-icon.png" alt="location" class="img-fluid" width="30" height="30">-->
                                <div>
                                    <h5 class="">Canada Office</h5>
                                    <p class="footer-down">Apt 1408 1785 Riverside<span class="d-block"></span> 
                                    Drive Ottawa, ON, K1G 3T</p>
                                </div>
                          </li>
                        
                          <li>
                              <!--<img src="<?php echo SITEPATH;?>images/footer-images/mail-icon.png" alt="mail" class="img-fluid" width="24" height="24">-->
                              <a href="mailto:<?php echo SITEEMAIL;?>">sales@towardschemandmaterials.com</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-2 col-md-6">
                   <div class="footer-list footer_web_list quick-legal">
                      <h4>Quick Links</h4>
                      <ul class="ps-0">
                           <!--<li><a href="<?php echo SITEPATH;?>companies" rel="nofollow">Companies</a></li>-->
                          <li><a href="<?php echo SITEPATH;?>about-us" rel="nofollow">About us</a></li>
                          <li><a href="<?php echo SITEPATH;?>contact-us" rel="nofollow">Contact Us</a></li>
                      </ul>
                  </div>
                  <div class="footer-list footer_web_list pt-4 quick-legal">
                      <h4>Legal</h4>
                      <ul class="ps-0">
                          <li><a href="<?php echo SITEPATH;?>privacy-policy" rel="nofollow">Privacy Policy</a></li>
                          <li><a href="<?php echo SITEPATH;?>return-policy" rel="nofollow">Return Policy</a></li>
                          <li><a href="<?php echo SITEPATH;?>terms-and-conditions" rel="nofollow">Terms and Conditions</a></li>
                      </ul>
                  </div>
                 
              </div>
              <div class="col-lg-4 col-md-6">
                  <?php
                    $fields_report="report_id,meta_title,meta_description,footerreport,CatId,reportDate,slug,created_at";
                    $condition_report="`predr_reports`.`status`='Active' AND `predr_reports`.`popular`='1'";
                    $orderby_report="`predr_reports`.`reportDate` DESC";
                    $report_details=$obj_report->getReportDetails($fields_report,$condition_report,$orderby_report,5,0);
                  ?>
                  <div class="footer-list footer_web_list">
                      <h4 class="Top-Selling-Insights">Top Selling Insights</h4>
                      <ul class="ps-0">
                        <?php foreach($report_details as $top){ ?>  
                            <li><a href="<?php echo SITEPATH.'insights/'.$top['slug']; ?>" rel="dofollow" target="_blank" class="footertopselling"><?php echo $top['meta_title']; ?></a></li>
                        <?php } ?>  
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <?php endif;?>
      
      <div class="gradient-bg pt-4 pb-4">
        <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-8">
              <p class="copy-right mb-0 text-white">© Copyright 2025, All rights reserved. Towards Chem and Materials</p>
          </div>
          <?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
                <div class="col-md-4 no-mob-data">
              <div class="social-link no-mob-txt">
                  <ul class="list-unstyled d-flex justify-content-end mb-0">
                      <!--<li>-->
                      <!--    <a href="#">-->
                      <!--        <img src="<?php echo SITEPATH;?>images/footer-images/facebook.png" alt="facebook" class="img-fluid" width="30" height="30">-->
                      <!--    </a>-->
                      <!--</li>-->
                      <li>
                          <a href="https://www.linkedin.com/company/towards-packaging/" rel="nofollow" target="_blank">
                              <img src="<?php echo SITEPATH;?>images/footer-images/linkedin.png" alt="linnkedin" class="img-fluid" width="40" height="40">
                          </a>
                      </li> 
                      <li>
                          <a href="https://x.com/TowardsPack" rel="nofollow" target="_blank">
                              <img src="<?php echo SITEPATH;?>images/twitter.webp" alt="twitter" class="img-fluid" width="40" height="40">
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
          <?php endif;?>
        </div> 
        </div>
       </div> 
    </footer>
          <?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="<?php echo SITEPATH;?>js/bootstrap.min.js" crossorigin="anonymous" defer></script>
            <script src="<?php echo SITEPATH; ?>js/ccptlskj.js"></script>
           <?php endif;?>
           
<script>
$(document).ready(function() {
    function search_buttonMob() {
        var selkeyword = searchHolderMob ? searchHolderMob.value : ''; // Ensure element exists
        var format = /[#%.?\/\\']/;
        var isSplChar = selkeyword;

        if (!selkeyword) {
            alert("Please enter a keyword");
            window.stop();
        } else {
            var url = "https://www.towardspackaging.com/search/" + isSplChar;
            window.location.href = url;
        }
    }
});
</script>

<script>
    $(document).ready(function() {
    $(window).on('scroll', function() {
        var header = $("#myHeader");
        var sticky = header.offset().top;

        if ($(window).scrollTop() > 270) {
            header.addClass("sticky");
            $('.popular-data').css('padding-top', '0rem');
        } else {
            header.removeClass("sticky");
            $('.popular-data').css('padding-top', '0rem');
            $("#stickyheader").hide();
        }
    });
});
</script>


<?php if(isset($indexPage) && !empty($indexPage)){ ?>
<script>
    $(document).ready(function() {
    $(window).on('scroll', function() {
        var header = $("#myHeader");
        var sticky = header.offset().top;

        if ($(window).scrollTop() > 270) {
            header.addClass("sticky");
            $('.popular-data').css('padding-top', '0rem');
            $("#tcm-logo-wt").hide();
            $("#tcm-logo-og").show();
        } else {
            header.removeClass("sticky");
            $('.popular-data').css('padding-top', '0rem');
            $("#stickyheader").hide();
            
             $("#tcm-logo-wt").show();
             $("#tcm-logo-og").hide();
        }
    });
});
</script>

<?php } ?>
    <script>
        $(document).ready(function(){
        $(function() { 
             
            $('.search-menu').removeClass('toggled');
        
            $('.search-icon').click(function(e) {
                e.stopPropagation();
                $('.search-menu').toggleClass('toggled');
                $('.popup-search').focus();
            });
        
            $('.search-menu input').click(function(e) {
                e.stopPropagation();
            });
            $('.search-bar-close').click(function() {
                $("#popupsearch").val("");
                $("#searchpopup").fadeOut();
                $("#searchpopup").html("");
                $('.search-menu').removeClass('toggled');
            });
        });
        });
    </script>

<script>
    $(document).ready(function() {
        // Event listener for the enter key in the search input
        $('#search-holder').on('keypress', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault(); // Prevent default form submission behavior
                search_button(); // Call the search function
            }
        });

        // Add click event listeners to all <a> tags within the list items
        $('.tagList-item .tags').on('click', function(event) {
            event.preventDefault(); // Prevent the default action (navigation)
            var text = $(this).text().trim().replace(/\s+/g, '-').toLowerCase();
            var url = "<?php echo SITEPATH;?>" + text;
            window.location.href = url;
        });
    });

    // Define the search_button function globally
    function search_button() {
        var searchInput = document.getElementById('search-holder').value;
        if (searchInput.trim() !== '') {
            // Redirect to search results page with query parameter
            window.location.href = '/search.php?q=' + encodeURIComponent(searchInput);
        }
    }
</script>

  </body>
</html>