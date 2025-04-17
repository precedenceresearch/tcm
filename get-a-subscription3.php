<?php
require_once("precedence/classes/cls-report.php");

$obj_report = new Report();

$_SESSION['captcha']=rand(1000,9999);

$fields_country="*";
$condition_country="";
$country_details=$obj_report->getCountryDetails($fields_country,$condition_country,'','',0);
$noindex = "noindex";
$page = "common"; 
$meta_title="Get a Subscription - Towards Packaging ";
$meta_keyword="";
$meta_description="With our commitment to delivering accurate and up-to-date data, our annual packages ensure continuous access to a wealth of valuable information.";
?>
<?php include("header.php")?>
<style>
    .search-btn{
        display:none!important;
    }
</style>
<link rel="stylesheet" href="css/common.css">
    <div class="pb-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 reg-bg">
                <div class="reg-right-space">
                    <h1 class="ttl-h2">Why settle for less? Our demo holds the key!</h1>
                    <p class="para">
                        In the fast-paced world of business, precision is non-negotiable. Our demo is crafted with cutting-edge methodologies and technologies, ensuring 
                        that the data you receive is not just comprehensive but accurate. We pride ourselves on delivering insights that you can trust, forming the bedrock 
                        of your strategic decisions.
                    </p>
                    <h2></h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="banner-cnt">
                                <p class="mb-0">60,000<sup>+</sup></p>
                                <span>Company database</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="banner-cnt">
                                <p class="mb-0">4,000<sup>+</sup></p>
                                <span>Ready Insights</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="banner-cnt">
                                <p class="mb-0">10<sup>+</sup></p>
                                <span>Industry Verticals</span>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <div class="banner-cnt">
                                <p class="mb-0 text-center">40<sup>+</sup></p>
                                <span>Annual Subscription</span>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <div class="banner-cnt">
                                <p class="mb-0 text-center">80<sup>+</sup></p>
                                <span>Hours KOL Interviews</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="row cnt-space">
                    <div class="col-md-6">
                        <div class="reg-data-hld">
                            <img src="<?php echo SITEPATH; ?>images/One-stop-platform-for-integrated-solutions.webp" alt="unique-data" class="img-fluid" width="40px" height="40px">
                            <div class="reg-data">
                                <h5> One-stop platform for integrated solutions</h5>
                                <p>
                                    We take pride in simplifying your market research needs by offering a single, comprehensive platform for integrated solutions.                                      </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="reg-data-hld">
                            <img src="<?php echo SITEPATH; ?>images/Incomparable-data.webp" alt="unique-data" class="img-fluid" width="40px" height="40px">
                            <div class="reg-data">
                                <h5> Incomparable data</h5>
                                <p>
                                    Our commitment to precision and accuracy is second to none, and we are dedicated to delivering comprehensive and incomparable insights.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="reg-data-hld">
                            <img src="<?php echo SITEPATH;?>images/Company-database.webp" alt="unique-data" class="img-fluid" width="40px" height="40px">
                            <div class="reg-data">
                                <h5>Company database</h5>
                                <p>
                                    Our database is the key to unlocking the wealth of information you need to thrive in today's dynamic marketplace.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="reg-data-hld">
                            <img src="<?php echo SITEPATH;?>images/Visionary-solutions.webp" alt="unique-data" class="img-fluid" width="40px" height="40px">
                            <div class="reg-data">
                                <h5> Visionary solutions</h5>
                                <p>Our mission is to provide visionary solutions that go beyond the ordinary, empowering businesses with the knowledge and insights.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="reg-data-hld">
                            <img src="<?php echo SITEPATH;?>images/Profound-analysis.webp" alt="unique-data" class="img-fluid" width="40px" height="40px">
                            <div class="reg-data">
                                <h5> Profound analysis</h5>
                                <p>
                                With our meticulous research team and keen market intelligence, we transform data into actionable strategies to transform your business strategy.                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="reg-data-hld">
                            <img src="<?php echo SITEPATH; ?>images/Annual-subscriptions.webp" alt="unique-data" class="img-fluid" width="40px" height="40px">
                            <div class="reg-data">
                                <h5> Annual subscriptions</h5>
                                <p>With our commitment to delivering accurate and up-to-date data, our annual packages ensure continuous access to a wealth of valuable information.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
   <div class="ptb reg-banner pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="ttl-h2 text-center fz-18">Request for BI Tool Demo : Your Path to Success</h1>
                    <div class="reg-form bg-white box-shadow">
                      <form class="request-form mt-5" method="POST" action="<?php echo SITEPATH; ?>subscription-action.php" enctype="multipart/form-data">
                            <input type="hidden" name="form_type" id="form_type" value="Request Subscription">
                            <input type="hidden" name="capsess" id="capsess" value="<?php echo $_SESSION['captcha'];?>">
                            <?php if(isset($_SESSION['caperr'])) { ?>
                                    <div class="error">
                                        <?php
                                        echo $_SESSION['caperr'];
                                        unset($_SESSION['caperr']);
                                        ?>
                                    </div> 
                                <?php } ?>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>First Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required="" data-error-msg="Please enter your name" id="fname" name="fname" value="">
                                    <div class="invalid-feedback">First Name field cannot be blank!</div>
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required="" data-error-msg="Please enter your name" id="lname" name="lname" value="">
                                    <div class="invalid-feedback">Last Name field cannot be blank!</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" required="" data-error-msg="Please enter your Email" value="">
                                <div class="invalid-feedback">Email field cannot be blank!(Use email format)</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label">Country<span class="text-danger">*</span></label>
                                    <select class="form-control form-select valid" id="country" name="country" data-gtm-form-interact-field-id="0" aria-required="true" aria-invalid="false" required>
                                        <option value="">--Select Country--</option>
                                        <?php foreach($country_details as $country){ ?>
                                            <option value="<?php echo $country['name']; ?>"> <?php echo $country['name']; ?>  (+<?php echo $country['phonecode']; ?>)</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                  <label>Contact No<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="phone" id="phone" required="" data-error-msg="Please enter your phone number" maxlength="12" value="" onkeypress="return isNumber(event)">
                                  <div class="invalid-feedback">Contact No field cannot be blank!</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                  <label>Company<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="company" id="company" required="" value="">
                                  <div class="invalid-feedback">Company field cannot be blank!</div>
                                </div>
                                <div class="col-md-6">
                                  <label>Designation<span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="designation" id="designation" required="" value="">
                                  <div class="invalid-feedback">Designation field cannot be blank!</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Message<span class="text-danger">*</span></label>
                                <textarea row="5" col="15" class="form-control" id="message" name="message" required="" data-error-msg="Write your message"
                                data-gramm="false" wt-ignore-input="true"></textarea>
                                <div class="invalid-feedback">Message field cannot be blank!</div>
                            </div>
                            <div class="s-code d-flex">
                                <div class="code-holder me-5">
                                    <span><?php echo $_SESSION['captcha'];?></span>
                                </div>
                                <input type="text" class="w-50 mb-0 form-control" name="captchatxt" id="captchatxt" placeholder="Security code" maxlength="4" 
                                required="">
                                <div class="invalid-feedback">Security Code field cannot be blank!</div>
                                <div class="invalid-feedback" id="invalid-captcha" style="display:none;">Invalid Captcha!</div>
                            </div>
                            <div class="text-center pt-4">
                                <button type="submit" class="btn blck-btn">Submit
                                    <img src="<?php echo SITEPATH; ?>images/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   <!--<div class="container pb-4">-->
   <!--    <div class="row">-->
   <!--         <div class="col-md-8 offset-md-2">-->
   <!--             <h2 class="ttl-h2 text-center">Trusted By Those Who Demand the Best</h2>-->
   <!--             <img src="<?php echo SITEPATH;?>images/precedence-statistics-homepage-client-logos.webp" alt="clinet-images" class="img-fluid">-->
   <!--         </div>-->
   <!--    </div>-->
   <!--</div>-->
   <div class="ptb pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1 text-center">
                    <h2 class="ttl-h2 fz-18">Trusted By Those Who Demand the Best</h2>
                    <ul class="list-unstyled client-list">
                        <li class="icn_1"></li>
                        <li class="icn_2"></li>
                        <li class="icn_3"></li>
                        <li class="icn_4"></li>
                        <li class="icn_5"></li>
                        <li class="icn_6"></li>
                        <li class="icn_7"></li>
                        <li class="icn_8"></li>
                        <li class="icn_9"></li>
                        <li class="icn_10"></li>
                        <li class="icn_11"></li>
                        <li class="icn_12"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php include('footer.php')?> 