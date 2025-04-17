<?php
require_once("precedence/classes/cls-report.php");
$obj_report = new Report();
$page = "aboutus"; 
$meta_title="About Towards Chemicals & Materials | Our Vision & Mission";
$meta_keyword="";
$meta_description="Learn about Towards Chemicals & Materials, our vision, and how we deliver high-quality research and reports for the chemicals and materials industries. Empowering informed decisions.";
?>
<link rel="stylesheet" href="css/about-us2.css">
<?php include("header.php");?>
<style>
    .about-icon {
        padding: 1rem!important;
        border-radius: 50%!important;
        text-align: center!important;
        height:auto;
        width:auto;
        border:none;
    }
    .about-icon img {
        width: 11rem!important;
    }
    .about-product-info p{
        font-size:2.2rem!important;
    }
    .about-product-info h4 {
        font-size: 4rem;
        color:#24e1b0;
    }
</style>

<div class="container-fluid about-banner ps-0">
           <div class="row">
               <div class="col-md-12">
                   <div class="abt-banner-txt">
                        <h1 class="ttl purple-txt mb-0 pb-5 text-white pt-5 report-ttl">Empowering Innovation in Chemicals & Materials</h1>
                       <p class="para">
                        With expert market analysis and forward-thinking research, we help businesses stay ahead, innovate boldly, and embrace sustainable growth. Together, we’ll explore new frontiers and drive impactful change.
                        </p>
                   </div>
               </div>
           </div>
       </div>

<div class="container-fluid abt-counterno-mob-view">
           <div class="row abt-banner-txt-counter">
                       <div class="col-md-4">
                           <div class="about-data no-mob-data">
                               <div class="icon-data-counter-counter">
                                   <img src="<?php echo SITEPATH;?>images/About-us-Page-icon-verticle.webp" alt="icon-1" class="img-fluid" width="55" height="55">
                                  
                                    <span>6<sup>+</sup></span>
                               </div>
                               
                                <p class="para">Verticals</p>
                           </div>
                       </div>
                       <div class="col-md-4">
                            <div class="about-data no-mob-data">
                               <div class="icon-data-counter">
                                   <img src="<?php echo SITEPATH;?>images/about-us-icon-2.webp" alt="icon-1" class="img-fluid" width="55" height="55">
                                      <span>500,000<sup>+</sup></span>
                               </div>
                             
                                <p class="para">Company Database</p>
                           </div>
                        </div>
                       <div class="col-md-4">
                           <div class="about-data no-mob-data">
                               <div class="icon-data-counter">
                                   <img src="<?php echo SITEPATH;?>images/about-us-icon-3.webp" alt="icon-1" class="img-fluid" width="55" height="55">
                                    <span>96<sup>+</sup></span>
                               </div>
                              <p class="para">Repeat Clients</p>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="about-data no-mob-data">
                               <div class="icon-data-counter">
                                   <img src="<?php echo SITEPATH;?>images/about-us-icon-4.webp" alt="icon-1" class="img-fluid" width="55" height="55">
                                    <span>50<sup>+</sup></span>
                               </div>
                                <p class="para">Annual Subscriptions</p>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="about-data no-mob-data mb-0">
                               <div class="icon-data-counter">
                                   <img src="<?php echo SITEPATH;?>images/about-us-icon-5.webp" alt="icon-1" class="img-fluid" width="55" height="55">
                               
                                    <span>100<sup>+</sup></span>
                               </div>
                             
                                <p class="para">Prime Clients</p>
                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="about-data no-mob-data mb-0">
                               <div class="icon-data-counter">
                                   <img src="<?php echo SITEPATH;?>images/about-us-icon-6.webp" alt="icon-1" class="img-fluid" width="55" height="55">
                                      <span>600<sup>+</sup></span>
                               </div>
                                <p class="para">KOL Interviews</p>
                           </div>
                       </div>
           </div>
       </div>

       <div class="ptb bg-light-bl">
           <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 padding-right-5">
                        <h2 class="ttl">How Do We Stand Out?</h2>
                        <p class="para">
                            What sets us apart is our deep-rooted knowledge of the chemical and materials industry. 
                            We don’t just gather data; we transform it into meaningful insights that give our clients a 
                            competitive edge. Our team’s commitment to accuracy, relevance, and forward-thinking research 
                            helps businesses make informed decisions, optimize strategies, and drive sustainable growth. 
                            Whether it’s emerging trends or market shifts, we provide the clarity you need to stay ahead.
                        </p>
                   </div>
                   <div class="col-md-6">
                       <div class="row">
                           <div class="col-md-6">
                               <div class="motivation-hld bg-light-purple">
                                  <span>Our</span>
                                  <h3>Vision</h3>
                                  <p>Our vision is to be the catalyst driving pivotal decisions that accelerate growth and innovation across chemical and materials sector.</p>
                                  <img src="<?php echo SITEPATH;?>images/about-us/About-us-vision.png" alt="our-vision" class="img-fluid">
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="motivation-hld dr-purple">
                                  <img src="<?php echo SITEPATH;?>images/about-us/About-us-Page-mission.png" alt="our-mission" class="img-fluid">
                                  <div class="content_">    
                                     <span>Our</span>
                                     <h3>Mission</h3>
                                     <p>We strive to deliver transformative results for our clients, creating long-term value, while fostering a workplace that attracts, develops, and retains remarkable individuals.</p>
                                  </div>
                               </div>
                           </div>
                           <div class="col-md-12">
                               <div class="motivation-hld drk-purple mn-auto">
                                   <div class="content_">
                                        <span>Our</span>
                                        <h3>Purpose</h3>
                                        <p>We aim to be a force for lasting, meaningful transformation that empowers global success and progress.</p>
                                    </div>
                                    <img src="<?php echo SITEPATH;?>images/about-us/About-us-Page-purpose.png" alt="our-mission" class="img-fluid">
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
       </div>
       <div class="ptb pb-0">
            <div class="container">
           <div class="row">
               <div class="col-md-12">
                    <h2 class="ttl text-center pb-5">Benefits to meet your needs</h2>
               </div>
           </div>
           <div class="row">
               <div class="col-lg-3 col-md-6 p-0">
                   <div class="benefits-hld">
                       <img src="<?php echo SITEPATH;?>images/anticipating-emerging-trends-img.webp" alt="" class="img-fluid" width="100%" height="50%">
                       <div class="benefits-cnt">
                           <h4>Anticipating Emerging Trends</h4>
                           <p class="para">Uncover upcoming trends through comprehensive research, expert analysis, and guidance from leading industry visionaries.</p>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-md-6 p-0">
                   <div class="benefits-hld mtop-1">
                       <img src="<?php echo SITEPATH;?>images/streamlined-decision-making-img.webp" alt="" class="img-fluid" width="100%" height="50%">
                       <div class="benefits-cnt">
                           <h4>Streamlined Decision-Making</h4>
                           <p class="para">
                            Leverage our customizable workflow tools and gain direct access to seasoned analysts to quickly generate and share the actionable insights needed for confident decision-making.
                            </p>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-md-6 p-0">
                   <div class="benefits-hld mtop-2">
                       <img src="<?php echo SITEPATH;?>images/create-unique-customer-offerings-img.webp" alt="" class="img-fluid" width="100%" height="50%">
                       <div class="benefits-cnt">
                           <h4>Create Unique Customer Offerings</h4>
                           <p class="para">
                               Craft outstanding go-to-market strategies by combining trusted market data with valuable insights into your competitors and customers.
                           </p>
                       </div>
                   </div>
               </div>
               <div class="col-lg-3 col-md-6 p-0">
                   <div class="benefits-hld  mtop-3">
                       <img src="<?php echo SITEPATH;?>images/pinpoint-profitable-sales-segments-img.webp" alt="" class="img-fluid" width="100%" height="50%">
                       <div class="benefits-cnt">
                           <h4>Pinpoint Profitable Sales Segments</h4>
                           <p class="para">By targeting faster-growing, more lucrative categories, you can maximize profits and speed up business growth.</p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        </div>
       <div class="ptb">
           <div class="container">
               <div class="row">
                   <div class="col-md-12 text-center">
                       <h3 class="ttl">What our team says</h3>
                   </div>
               </div>
               <div class="row">
                   <div class="col-md-4">
                       <div class="team-data">
                           <p>The quality that distinguishes outstanding people is a complete sense of goal. This is precisely why being part of a motivated company holds tremendous 
                           importance for me, and I am thrilled to emphasize that our team spirit here is truly outstanding.</p>
                           <div class="d-flex align-items-center">
                                <div class="team-user"></div>
                                <div class="ps-4">
                                    <p class="mb-0">-Asmita Singh</p>
                                    <span>Author</span>
                                </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="team-data">
                           <p>"Your passion and genuine concern for your customers and colleagues are contagious and truly inspiring. Your knowledge and support have been invaluable, 
                           and I can't praise this business enough. From the very first contact, you have been responsive and accommodating, making the entire experience delightful. 
                           The quality of your work is exceptional, and the final result has exceeded all my expectations. I will undoubtedly be availing your services again in the
                           future."</p>
                           <div class="d-flex align-items-center">
                                <div class="team-user"></div>
                                <div class="ps-4">
                                    <p class="mb-0">-Saurabh</p>
                                    <span>Author</span>
                                </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-4">
                       <div class="team-data">
                           <p>
                               I am continually inspired by the transformative impact we bring to our clients. We don't just provide solutions; we create lasting partnerships that drive success. At Towards Packaging, we're not just advisors; we're problem solvers who thrive on challenges and relish opportunities for growth.
                           </p>
                           <div class="d-flex align-items-center">
                                <div class="team-user"></div>
                                <div class="ps-4">
                                    <p class="mb-0">-Aniket</p>
                                    <span>Author</span>
                                </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="container why-choose-txt">
            <div class="row about-us-bg p-5 border-radius-top">
                <div class="col-md-12 text-center">
                    <h3 class="ttl mb-0 text-white pb-5">Why Choose Us</h3>
                </div>
                <div class="col text-center">
                    <h5 class="mb-0">20,000+<sup>+</sup></h5>
                    <span>Client Queries in 2021</span>
                </div>
                <div class="col text-center">
                    <h5 class="mb-0">5000<sup>+</sup></h5>
                    <span>Insights Published</span>
                </div>
                <div class="col text-center">
                    <h5 class="mb-0">100<sup>+</sup></h5>
                    <span>Consulting Projects Per Month</span>
                </div> 
                <div class="col text-center">
                    <h5 class="mb-0">400<sup>+</sup></h5>
                    <span>Analysts</span>
                </div>
            </div>
        </div> 
        <div class="ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <h3 class="ttl">Our Clients</h3>
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
<?php include("footer.php");?>