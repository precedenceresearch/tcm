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
<link rel="stylesheet" href="css/common.css">
<div class="ptb bg-yl-clr">
   <div class="container">
       <div class="row align-items-center">
           <div class="col-md-6">
               <div class="sub-hld-main">
                    <h1 class="mb-0">Subscription Plan</h1>
                    <span>From USD</span>
                    <h2>$ 9990/ Year</h2>
                    <ul class="subr-list list-unstyled ps-5">
                        <li>Retrieve reports easily with the most secure payment gateway</li>
                        <li>Easy transactions with multiple secure payment choices </li>
                        <li>Effortless payments guarantee timely access to reports </li>
                    </ul>
                    <div class="">
                        <a href="" class="btn blck-btn bg-dark mt-3">
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
<div class="ptb bg-dark-green position-relative">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <a href="https://youtu.be/DbwdbNi_QUk" target="_blank" data-keyframers-credit style="color: #FFF;"></a>
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
<div class="ptb reg-banner pb-5">
    <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="ttl-h2 text-center fz-18">Request for BI Tool Demo : Your Path to Success</h1>
                    <div class="reg-form bg-white box-shadow">
                      <form class="request-form mt-5" method="POST" action="" enctype="">
                            <input type="hidden" name="form_type" id="form_type" value="Request Subscription">
                            <input type="hidden" name="capsess" id="capsess" value="6844">
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
                                    <select class="form-control form-select valid" id="country" name="country" data-gtm-form-interact-field-id="0" aria-required="true" aria-invalid="false" required="">
                                        <option value="">--Select Country--</option>
                                                                                    <option value="Afghanistan"> Afghanistan  (+93)</option>
                                                                                    <option value="Albania"> Albania  (+355)</option>
                                                                                    <option value="Algeria"> Algeria  (+213)</option>
                                                                                    <option value="American Samoa"> American Samoa  (+1684)</option>
                                                                                    <option value="Andorra"> Andorra  (+376)</option>
                                                                                    <option value="Angola"> Angola  (+244)</option>
                                                                                    <option value="Anguilla"> Anguilla  (+1264)</option>
                                                                                    <option value="Antarctica"> Antarctica  (+0)</option>
                                                                                    <option value="Antigua And Barbuda"> Antigua And Barbuda  (+1268)</option>
                                                                                    <option value="Argentina"> Argentina  (+54)</option>
                                                                                    <option value="Armenia"> Armenia  (+374)</option>
                                                                                    <option value="Aruba"> Aruba  (+297)</option>
                                                                                    <option value="Australia"> Australia  (+61)</option>
                                                                                    <option value="Austria"> Austria  (+43)</option>
                                                                                    <option value="Azerbaijan"> Azerbaijan  (+994)</option>
                                                                                    <option value="Bahamas The"> Bahamas The  (+1242)</option>
                                                                                    <option value="Bahrain"> Bahrain  (+973)</option>
                                                                                    <option value="Bangladesh"> Bangladesh  (+880)</option>
                                                                                    <option value="Barbados"> Barbados  (+1246)</option>
                                                                                    <option value="Belarus"> Belarus  (+375)</option>
                                                                                    <option value="Belgium"> Belgium  (+32)</option>
                                                                                    <option value="Belize"> Belize  (+501)</option>
                                                                                    <option value="Benin"> Benin  (+229)</option>
                                                                                    <option value="Bermuda"> Bermuda  (+1441)</option>
                                                                                    <option value="Bhutan"> Bhutan  (+975)</option>
                                                                                    <option value="Bolivia"> Bolivia  (+591)</option>
                                                                                    <option value="Bosnia and Herzegovina"> Bosnia and Herzegovina  (+387)</option>
                                                                                    <option value="Botswana"> Botswana  (+267)</option>
                                                                                    <option value="Bouvet Island"> Bouvet Island  (+0)</option>
                                                                                    <option value="Brazil"> Brazil  (+55)</option>
                                                                                    <option value="British Indian Ocean Territory"> British Indian Ocean Territory  (+246)</option>
                                                                                    <option value="Brunei"> Brunei  (+673)</option>
                                                                                    <option value="Bulgaria"> Bulgaria  (+359)</option>
                                                                                    <option value="Burkina Faso"> Burkina Faso  (+226)</option>
                                                                                    <option value="Burundi"> Burundi  (+257)</option>
                                                                                    <option value="Cambodia"> Cambodia  (+855)</option>
                                                                                    <option value="Cameroon"> Cameroon  (+237)</option>
                                                                                    <option value="Canada"> Canada  (+1)</option>
                                                                                    <option value="Cape Verde"> Cape Verde  (+238)</option>
                                                                                    <option value="Cayman Islands"> Cayman Islands  (+1345)</option>
                                                                                    <option value="Central African Republic"> Central African Republic  (+236)</option>
                                                                                    <option value="Chad"> Chad  (+235)</option>
                                                                                    <option value="Chile"> Chile  (+56)</option>
                                                                                    <option value="China"> China  (+86)</option>
                                                                                    <option value="Christmas Island"> Christmas Island  (+61)</option>
                                                                                    <option value="Cocos (Keeling) Islands"> Cocos (Keeling) Islands  (+672)</option>
                                                                                    <option value="Colombia"> Colombia  (+57)</option>
                                                                                    <option value="Comoros"> Comoros  (+269)</option>
                                                                                    <option value="Republic Of The Congo"> Republic Of The Congo  (+242)</option>
                                                                                    <option value="Democratic Republic Of The Congo"> Democratic Republic Of The Congo  (+242)</option>
                                                                                    <option value="Cook Islands"> Cook Islands  (+682)</option>
                                                                                    <option value="Costa Rica"> Costa Rica  (+506)</option>
                                                                                    <option value="Cote D'Ivoire (Ivory Coast)"> Cote D'Ivoire (Ivory Coast)  (+225)</option>
                                                                                    <option value="Croatia (Hrvatska)"> Croatia (Hrvatska)  (+385)</option>
                                                                                    <option value="Cuba"> Cuba  (+53)</option>
                                                                                    <option value="Cyprus"> Cyprus  (+357)</option>
                                                                                    <option value="Czech Republic"> Czech Republic  (+420)</option>
                                                                                    <option value="Denmark"> Denmark  (+45)</option>
                                                                                    <option value="Djibouti"> Djibouti  (+253)</option>
                                                                                    <option value="Dominica"> Dominica  (+1767)</option>
                                                                                    <option value="Dominican Republic"> Dominican Republic  (+1809)</option>
                                                                                    <option value="East Timor"> East Timor  (+670)</option>
                                                                                    <option value="Ecuador"> Ecuador  (+593)</option>
                                                                                    <option value="Egypt"> Egypt  (+20)</option>
                                                                                    <option value="El Salvador"> El Salvador  (+503)</option>
                                                                                    <option value="Equatorial Guinea"> Equatorial Guinea  (+240)</option>
                                                                                    <option value="Eritrea"> Eritrea  (+291)</option>
                                                                                    <option value="Estonia"> Estonia  (+372)</option>
                                                                                    <option value="Ethiopia"> Ethiopia  (+251)</option>
                                                                                    <option value="External Territories of Australia"> External Territories of Australia  (+61)</option>
                                                                                    <option value="Falkland Islands"> Falkland Islands  (+500)</option>
                                                                                    <option value="Faroe Islands"> Faroe Islands  (+298)</option>
                                                                                    <option value="Fiji Islands"> Fiji Islands  (+679)</option>
                                                                                    <option value="Finland"> Finland  (+358)</option>
                                                                                    <option value="France"> France  (+33)</option>
                                                                                    <option value="French Guiana"> French Guiana  (+594)</option>
                                                                                    <option value="French Polynesia"> French Polynesia  (+689)</option>
                                                                                    <option value="French Southern Territories"> French Southern Territories  (+0)</option>
                                                                                    <option value="Gabon"> Gabon  (+241)</option>
                                                                                    <option value="Gambia The"> Gambia The  (+220)</option>
                                                                                    <option value="Georgia"> Georgia  (+995)</option>
                                                                                    <option value="Germany"> Germany  (+49)</option>
                                                                                    <option value="Ghana"> Ghana  (+233)</option>
                                                                                    <option value="Gibraltar"> Gibraltar  (+350)</option>
                                                                                    <option value="Greece"> Greece  (+30)</option>
                                                                                    <option value="Greenland"> Greenland  (+299)</option>
                                                                                    <option value="Grenada"> Grenada  (+1473)</option>
                                                                                    <option value="Guadeloupe"> Guadeloupe  (+590)</option>
                                                                                    <option value="Guam"> Guam  (+1671)</option>
                                                                                    <option value="Guatemala"> Guatemala  (+502)</option>
                                                                                    <option value="Guernsey and Alderney"> Guernsey and Alderney  (+44)</option>
                                                                                    <option value="Guinea"> Guinea  (+224)</option>
                                                                                    <option value="Guinea-Bissau"> Guinea-Bissau  (+245)</option>
                                                                                    <option value="Guyana"> Guyana  (+592)</option>
                                                                                    <option value="Haiti"> Haiti  (+509)</option>
                                                                                    <option value="Heard and McDonald Islands"> Heard and McDonald Islands  (+0)</option>
                                                                                    <option value="Honduras"> Honduras  (+504)</option>
                                                                                    <option value="Hong Kong S.A.R."> Hong Kong S.A.R.  (+852)</option>
                                                                                    <option value="Hungary"> Hungary  (+36)</option>
                                                                                    <option value="Iceland"> Iceland  (+354)</option>
                                                                                    <option value="India"> India  (+91)</option>
                                                                                    <option value="Indonesia"> Indonesia  (+62)</option>
                                                                                    <option value="Iran"> Iran  (+98)</option>
                                                                                    <option value="Iraq"> Iraq  (+964)</option>
                                                                                    <option value="Ireland"> Ireland  (+353)</option>
                                                                                    <option value="Israel"> Israel  (+972)</option>
                                                                                    <option value="Italy"> Italy  (+39)</option>
                                                                                    <option value="Jamaica"> Jamaica  (+1876)</option>
                                                                                    <option value="Japan"> Japan  (+81)</option>
                                                                                    <option value="Jersey"> Jersey  (+44)</option>
                                                                                    <option value="Jordan"> Jordan  (+962)</option>
                                                                                    <option value="Kazakhstan"> Kazakhstan  (+7)</option>
                                                                                    <option value="Kenya"> Kenya  (+254)</option>
                                                                                    <option value="Kiribati"> Kiribati  (+686)</option>
                                                                                    <option value="Korea North"> Korea North  (+850)</option>
                                                                                    <option value="Korea South"> Korea South  (+82)</option>
                                                                                    <option value="Kuwait"> Kuwait  (+965)</option>
                                                                                    <option value="Kyrgyzstan"> Kyrgyzstan  (+996)</option>
                                                                                    <option value="Laos"> Laos  (+856)</option>
                                                                                    <option value="Latvia"> Latvia  (+371)</option>
                                                                                    <option value="Lebanon"> Lebanon  (+961)</option>
                                                                                    <option value="Lesotho"> Lesotho  (+266)</option>
                                                                                    <option value="Liberia"> Liberia  (+231)</option>
                                                                                    <option value="Libya"> Libya  (+218)</option>
                                                                                    <option value="Liechtenstein"> Liechtenstein  (+423)</option>
                                                                                    <option value="Lithuania"> Lithuania  (+370)</option>
                                                                                    <option value="Luxembourg"> Luxembourg  (+352)</option>
                                                                                    <option value="Macau S.A.R."> Macau S.A.R.  (+853)</option>
                                                                                    <option value="Macedonia"> Macedonia  (+389)</option>
                                                                                    <option value="Madagascar"> Madagascar  (+261)</option>
                                                                                    <option value="Malawi"> Malawi  (+265)</option>
                                                                                    <option value="Malaysia"> Malaysia  (+60)</option>
                                                                                    <option value="Maldives"> Maldives  (+960)</option>
                                                                                    <option value="Mali"> Mali  (+223)</option>
                                                                                    <option value="Malta"> Malta  (+356)</option>
                                                                                    <option value="Man (Isle of)"> Man (Isle of)  (+44)</option>
                                                                                    <option value="Marshall Islands"> Marshall Islands  (+692)</option>
                                                                                    <option value="Martinique"> Martinique  (+596)</option>
                                                                                    <option value="Mauritania"> Mauritania  (+222)</option>
                                                                                    <option value="Mauritius"> Mauritius  (+230)</option>
                                                                                    <option value="Mayotte"> Mayotte  (+269)</option>
                                                                                    <option value="Mexico"> Mexico  (+52)</option>
                                                                                    <option value="Micronesia"> Micronesia  (+691)</option>
                                                                                    <option value="Moldova"> Moldova  (+373)</option>
                                                                                    <option value="Monaco"> Monaco  (+377)</option>
                                                                                    <option value="Mongolia"> Mongolia  (+976)</option>
                                                                                    <option value="Montserrat"> Montserrat  (+1664)</option>
                                                                                    <option value="Morocco"> Morocco  (+212)</option>
                                                                                    <option value="Mozambique"> Mozambique  (+258)</option>
                                                                                    <option value="Myanmar"> Myanmar  (+95)</option>
                                                                                    <option value="Namibia"> Namibia  (+264)</option>
                                                                                    <option value="Nauru"> Nauru  (+674)</option>
                                                                                    <option value="Nepal"> Nepal  (+977)</option>
                                                                                    <option value="Netherlands Antilles"> Netherlands Antilles  (+599)</option>
                                                                                    <option value="Netherlands The"> Netherlands The  (+31)</option>
                                                                                    <option value="New Caledonia"> New Caledonia  (+687)</option>
                                                                                    <option value="New Zealand"> New Zealand  (+64)</option>
                                                                                    <option value="Nicaragua"> Nicaragua  (+505)</option>
                                                                                    <option value="Niger"> Niger  (+227)</option>
                                                                                    <option value="Nigeria"> Nigeria  (+234)</option>
                                                                                    <option value="Niue"> Niue  (+683)</option>
                                                                                    <option value="Norfolk Island"> Norfolk Island  (+672)</option>
                                                                                    <option value="Northern Mariana Islands"> Northern Mariana Islands  (+1670)</option>
                                                                                    <option value="Norway"> Norway  (+47)</option>
                                                                                    <option value="Oman"> Oman  (+968)</option>
                                                                                    <option value="Pakistan"> Pakistan  (+92)</option>
                                                                                    <option value="Palau"> Palau  (+680)</option>
                                                                                    <option value="Palestinian Territory Occupied"> Palestinian Territory Occupied  (+970)</option>
                                                                                    <option value="Panama"> Panama  (+507)</option>
                                                                                    <option value="Papua new Guinea"> Papua new Guinea  (+675)</option>
                                                                                    <option value="Paraguay"> Paraguay  (+595)</option>
                                                                                    <option value="Peru"> Peru  (+51)</option>
                                                                                    <option value="Philippines"> Philippines  (+63)</option>
                                                                                    <option value="Pitcairn Island"> Pitcairn Island  (+0)</option>
                                                                                    <option value="Poland"> Poland  (+48)</option>
                                                                                    <option value="Portugal"> Portugal  (+351)</option>
                                                                                    <option value="Puerto Rico"> Puerto Rico  (+1787)</option>
                                                                                    <option value="Qatar"> Qatar  (+974)</option>
                                                                                    <option value="Reunion"> Reunion  (+262)</option>
                                                                                    <option value="Romania"> Romania  (+40)</option>
                                                                                    <option value="Russia"> Russia  (+70)</option>
                                                                                    <option value="Rwanda"> Rwanda  (+250)</option>
                                                                                    <option value="Saint Helena"> Saint Helena  (+290)</option>
                                                                                    <option value="Saint Kitts And Nevis"> Saint Kitts And Nevis  (+1869)</option>
                                                                                    <option value="Saint Lucia"> Saint Lucia  (+1758)</option>
                                                                                    <option value="Saint Pierre and Miquelon"> Saint Pierre and Miquelon  (+508)</option>
                                                                                    <option value="Saint Vincent And The Grenadines"> Saint Vincent And The Grenadines  (+1784)</option>
                                                                                    <option value="Samoa"> Samoa  (+684)</option>
                                                                                    <option value="San Marino"> San Marino  (+378)</option>
                                                                                    <option value="Sao Tome and Principe"> Sao Tome and Principe  (+239)</option>
                                                                                    <option value="Saudi Arabia"> Saudi Arabia  (+966)</option>
                                                                                    <option value="Senegal"> Senegal  (+221)</option>
                                                                                    <option value="Serbia"> Serbia  (+381)</option>
                                                                                    <option value="Seychelles"> Seychelles  (+248)</option>
                                                                                    <option value="Sierra Leone"> Sierra Leone  (+232)</option>
                                                                                    <option value="Singapore"> Singapore  (+65)</option>
                                                                                    <option value="Slovakia"> Slovakia  (+421)</option>
                                                                                    <option value="Slovenia"> Slovenia  (+386)</option>
                                                                                    <option value="Smaller Territories of the UK"> Smaller Territories of the UK  (+44)</option>
                                                                                    <option value="Solomon Islands"> Solomon Islands  (+677)</option>
                                                                                    <option value="Somalia"> Somalia  (+252)</option>
                                                                                    <option value="South Africa"> South Africa  (+27)</option>
                                                                                    <option value="South Georgia"> South Georgia  (+0)</option>
                                                                                    <option value="South Sudan"> South Sudan  (+211)</option>
                                                                                    <option value="Spain"> Spain  (+34)</option>
                                                                                    <option value="Sri Lanka"> Sri Lanka  (+94)</option>
                                                                                    <option value="Sudan"> Sudan  (+249)</option>
                                                                                    <option value="Suriname"> Suriname  (+597)</option>
                                                                                    <option value="Svalbard And Jan Mayen Islands"> Svalbard And Jan Mayen Islands  (+47)</option>
                                                                                    <option value="Swaziland"> Swaziland  (+268)</option>
                                                                                    <option value="Sweden"> Sweden  (+46)</option>
                                                                                    <option value="Switzerland"> Switzerland  (+41)</option>
                                                                                    <option value="Syria"> Syria  (+963)</option>
                                                                                    <option value="Taiwan"> Taiwan  (+886)</option>
                                                                                    <option value="Tajikistan"> Tajikistan  (+992)</option>
                                                                                    <option value="Tanzania"> Tanzania  (+255)</option>
                                                                                    <option value="Thailand"> Thailand  (+66)</option>
                                                                                    <option value="Togo"> Togo  (+228)</option>
                                                                                    <option value="Tokelau"> Tokelau  (+690)</option>
                                                                                    <option value="Tonga"> Tonga  (+676)</option>
                                                                                    <option value="Trinidad And Tobago"> Trinidad And Tobago  (+1868)</option>
                                                                                    <option value="Tunisia"> Tunisia  (+216)</option>
                                                                                    <option value="Turkey"> Turkey  (+90)</option>
                                                                                    <option value="Turkmenistan"> Turkmenistan  (+7370)</option>
                                                                                    <option value="Turks And Caicos Islands"> Turks And Caicos Islands  (+1649)</option>
                                                                                    <option value="Tuvalu"> Tuvalu  (+688)</option>
                                                                                    <option value="Uganda"> Uganda  (+256)</option>
                                                                                    <option value="Ukraine"> Ukraine  (+380)</option>
                                                                                    <option value="United Arab Emirates"> United Arab Emirates  (+971)</option>
                                                                                    <option value="United Kingdom"> United Kingdom  (+44)</option>
                                                                                    <option value="United States"> United States  (+1)</option>
                                                                                    <option value="United States Minor Outlying Islands"> United States Minor Outlying Islands  (+1)</option>
                                                                                    <option value="Uruguay"> Uruguay  (+598)</option>
                                                                                    <option value="Uzbekistan"> Uzbekistan  (+998)</option>
                                                                                    <option value="Vanuatu"> Vanuatu  (+678)</option>
                                                                                    <option value="Vatican City State (Holy See)"> Vatican City State (Holy See)  (+39)</option>
                                                                                    <option value="Venezuela"> Venezuela  (+58)</option>
                                                                                    <option value="Vietnam"> Vietnam  (+84)</option>
                                                                                    <option value="Virgin Islands (British)"> Virgin Islands (British)  (+1284)</option>
                                                                                    <option value="Virgin Islands (US)"> Virgin Islands (US)  (+1340)</option>
                                                                                    <option value="Wallis And Futuna Islands"> Wallis And Futuna Islands  (+681)</option>
                                                                                    <option value="Western Sahara"> Western Sahara  (+212)</option>
                                                                                    <option value="Yemen"> Yemen  (+967)</option>
                                                                                    <option value="Yugoslavia"> Yugoslavia  (+38)</option>
                                                                                    <option value="Zambia"> Zambia  (+260)</option>
                                                                                    <option value="Zimbabwe"> Zimbabwe  (+263)</option>
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
                                <textarea row="5" col="15" class="form-control" id="message" name="message" required="" data-error-msg="Write your message" data-gramm="false" wt-ignore-input="true"></textarea>
                                <div class="invalid-feedback">Message field cannot be blank!</div>
                            </div>
                            <div class="s-code d-flex">
                                <div class="code-holder me-5">
                                    <span>6844</span>
                                </div>
                                <input type="text" class="w-50 mb-0 form-control" name="captchatxt" id="captchatxt" placeholder="Security code" maxlength="4" required="">
                                <div class="invalid-feedback">Security Code field cannot be blank!</div>
                                <div class="invalid-feedback" id="invalid-captcha" style="display:none;">Invalid Captcha!</div>
                            </div>
                            <div class="text-center pt-4">
                                <button type="submit" class="btn blck-btn">Submit
                                    <img src="https://www.towardspackaging.com/images/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow">
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