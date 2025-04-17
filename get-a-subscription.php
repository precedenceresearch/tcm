<?php
require_once("precedence/classes/cls-report.php");

$obj_report = new Report();

$_SESSION['captcha']=rand(1000,9999);

$fields_country="*";
$condition_country="";
$country_details=$obj_report->getCountryDetails($fields_country,$condition_country,'','',0);
$noindex = "noindex";
$page = "common"; 
$meta_title="Get an Annual Membership | Exclusive Reports & Insights";
$meta_keyword="";
$meta_description="Unlock premium access to our full range of chemicals and materials reports. Get an annual membership and enjoy exclusive content, industry updates, and detailed research.";
?>
<?php include("header.php")?>
<style>
    .search-btn{
        display:none!important;
    }
    .error{ color:red;}
</style>
<link rel="stylesheet" href="css/common.css">
<div class="ptb bg-yl-clr">
   <div class="container">
       <div class="row align-items-center">
           <div class="col-md-6">
               <div class="sub-hld-main">
                    <h1 class="mb-0">Subscription Plan</h1>
                    <span>From </span>
                    <h2>USD 495/Monthly<span>{Billing Annually}</span></h2>
                    <ul class="subr-list list-unstyled ps-5">
                        <li>Retrieve reports easily with the most secure payment gateway</li>
                        <li>Easy transactions with multiple secure payment choices </li>
                        <li>Effortless payments guarantee timely access to reports </li>
                    </ul>
                    <div class="">
                        <a href="#jumptoform" class="btn blck-btn bg-dark mt-3">
                            Subscribe Now
                            <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                        </a>
                    </div>
                </div>
           </div>
           <div class="col-md-6">
               <ul class="subr-list list-unstyled ps-8">
                    <li>Enjoy exclusive access to the most reliable In-house production platform to make informed decisions </li>
                    <li>Get a support team available to assist with any inquiries or custom research requests</li>
                    <li>Customizable reports for exclusive members including in-depth analysis to get key market metrics </li>
                    <li>Unlock essential insights on global market trends and shifts with our cutting-edge information </li>
                    <li>Leverage insights that span global trends and provide nuanced analysis for regional market specifics</li>
                </ul>
           </div>
       </div>
   </div>
</div>
<div class="ptb bg-dark-green position-relative d-none">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div id="app" data-state="0">
                  <div class="ui-big-images">    
                    <div class="ui-big-image" data-key="0">
                      <img src="<?php echo SITEPATH;?>images/slide1.webp" alt="" class="img-fluid"/>
                    </div>
                    <div class="ui-big-image" data-key="1">
                      <img src="<?php echo SITEPATH;?>images/slide2.webp" alt="" class="img-fluid"/>
                    </div>
                    <div class="ui-big-image" data-key="2">
                      <img src="<?php echo SITEPATH;?>images/slide3.webp" alt="" class="img-fluid"/>
                    </div>
                    <div class="ui-big-image" data-key="3">
                      <img src="<?php echo SITEPATH;?>images/slide4.webp" alt="" class="img-fluid"/>
                    </div>
                    <div class="ui-big-image" data-key="4">
                      <img src="<?php echo SITEPATH;?>images/slide5.webp" alt="" class="img-fluid"/>
                    </div>
                  </div>
                  <div class="ui-thumbnails">
                    <div class="ui-thumbnail" tabindex="-1" data-key="0">
                      <img src="<?php echo SITEPATH;?>images/slide1.webp" alt="" />
                      <div class="ui-cuticle" data-flip-key="cuticle"></div>
                    </div>
                    <div class="ui-thumbnail" tabindex="-1" data-key="1">
                      <img src="<?php echo SITEPATH;?>images/slide2.webp" alt="" />
                      <div class="ui-cuticle" data-flip-key="cuticle"></div>
                    </div>
                    <div class="ui-thumbnail" tabindex="-1" data-key="2">
                      <img src="<?php echo SITEPATH;?>images/slide3.webp" alt="" />
                      <div class="ui-cuticle" data-flip-key="cuticle"></div>
                    </div>
                    <div class="ui-thumbnail" tabindex="-1" data-key="3">
                      <img src="<?php echo SITEPATH;?>images/slide4.webp" alt=""/>
                      <div class="ui-cuticle" data-flip-key="cuticle"></div>
                    </div>
                    <div class="ui-thumbnail" tabindex="-1" data-key="4">
                      <img src="<?php echo SITEPATH;?>images/slide5.webp" alt=""/>
                      <div class="ui-cuticle" data-flip-key="cuticle"></div>
                    </div>
                  </div>
                  <div class="ui-content">
                    <nav class="ui-nav">
                      <button id="prev" tabindex="-1" class="lft-btn" title="Previous">
                          <img src="<?php echo SITEPATH;?>images/left-next-arrow.webp" alt="" class="img-fluid" width="18" height="18">
                      </button>
                      <button id="next" tabindex="-1" class="rht-btn" title="Next">
                            <img src="<?php echo SITEPATH;?>images/right-next-arrow.webp" alt="" class="img-fluid" width="18" height="18">
                      </button>
                    </nav>
                  </div>
            </div>
           </div>
       </div>
   </div>
</div>
   <div class="ptb reg-banner pb-5" id="jumptoform">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="ttl-h2 text-center fz-18 pb-4">Purchase Now: Annual Membership</h1>
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

<?php include('footer.php')?>  
<script src="https://unpkg.com/flipping@1.1.0/dist/flipping.web.js"></script>
<script>
    console.clear();

    const elPrevButton = document.querySelector('#prev');
    const elNextButton = document.querySelector('#next');
    const flipping = new Flipping();

    const elImages = Array.from(document.querySelectorAll('.ui-big-image'));
    const elThumbnails = Array.from(document.querySelectorAll('.ui-thumbnail'));
    
    let state = {
      photo: 0
    };

    function send(event) {
  // read cuticle positions
  flipping.read();
  
  const elActives = document.querySelectorAll('[data-active]');
  
  Array.from(elActives)
    .forEach(el => el.removeAttribute('data-active'));

  switch (event) {
    case 'PREV':
      state.photo--;
      // Math.max(state.photo - 1, 0);
      break;
    case 'NEXT':
      state.photo++;
      // Math.min(state.photo + 1, elImages.length - 1);
      break;
    default:
      state.photo = +event;
      break;
  }
  
  var len = elImages.length;
  // Loop Around
  //state.photo = ( ( state.photo % len) + len ) % len;
  state.photo = Math.max(0, Math.min( state.photo, len - 1) );

  Array.from(document.querySelectorAll(`[data-key="${state.photo}"]`))
    .forEach( el => {
    el.setAttribute('data-active', true);
  });
  
  // execute the FLIP animation
  flipping.flip();
}

    elThumbnails.forEach( thumb => { 
  thumb.addEventListener('click', () => {
    send(thumb.dataset.key);
  });
});

    elPrevButton.addEventListener('click', () => {
      send('PREV');
    });

    elNextButton.addEventListener('click', () => {
      send('NEXT');
    });

    send(0);
</script>
<script>
    document.querySelector('a[href="#jumptoform"]').addEventListener('click', function(e) {
    e.preventDefault();

    // Add the padding-top style to the element with the reg-banner class
    const regBannerElement = document.querySelector('.reg-banner');
    regBannerElement.style.paddingTop = '16rem';

    // Scroll smoothly to the #jumptoform element
        regBannerElement.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
});
</script>