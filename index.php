<?php
require_once("precedence/classes/cls-report.php");
$obj_report = new Report();
$fields_report="report_id,meta_title,meta_description,CatId,reportDate,slug,created_at";
$condition_report="`predr_reports`.`status`='Active'";
$orderby_report="`predr_reports`.`reportDate` DESC";
$report_details=$obj_report->getReportDetails($fields_report,$condition_report,$orderby_report,4,0);
$page = "index"; 
$meta_title="Towards Chem and Materials - Expert Consulting Solutions & Research Reports";
$meta_keyword="";
$meta_description="Discover in-depth reports and insights on chemicals and materials industries. Stay ahead with the latest research, market analysis, and trends in chemicals and materials.";
$indexPage = 1;
?>
<div class="ptb bg-banner-clr">
<?php include("homeheader.php");?>
       <div class="container mt-8">
           <div class="row">
                <div class="col-lg-7 col-md-8">
                    <div class="banner-txt-new">
                        <h1>Transforming Chemicals & Materials with the Power of Insights</h1>
                        <?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
                            <p class="para space-bottom-2">
                                Turn deep insights into actionable strategies and drive success in the fast-evolving chemicals and materials industry.
                            </p>
                        <?php endif; ?>

                        <!-- <a href="<?php echo SITEPATH;?>about-us" class="btn grn-btn" rel="nofollow">Read More-->
                        <!--</a>-->
                      
                    </div>
                      <div class="serchbarict">
                         <form class="d-flex" method="GET" action="https://www.towardshealthcare.com/search.php">
                        <input class="form-control me-2" type="search" placeholder="Find Industry Insights" id="search-holder" name="q"  class="placeholdercolor">
                        <button class="btn" type="submit">Search</button>
                    </form>
                    </div>
                </div>
            </div>
       </div>
    </div>
    
    <div class="ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="ttl text-center">Our Core Expertise</h2>
                    <p class="para">
                        Transform your business with in-depth market research and trends analysis in the chemicals and materials industries. 
                        Access over 100 expertly crafted reports covering the latest advancements in chemicals and materials. From sustainable 
                        practices to cutting-edge innovations, our research delivers valuable insights and trends to keep you ahead in an ever-evolving industry. 
                        Stay informed, make smarter decisions, and lead the way. Explore now!
                    </p>
                    <p class="para">
                        Transform your business with in-depth market research and trends analysis in the chemicals and materials industries. 
                        Access over 100 expertly crafted reports covering the latest advancements in chemicals and materials. From sustainable 
                        practices to cutting-edge innovations.
                    </p>
                </div>
                <div class="col-md-7">
                    <div class="hexago hexago d-flex pb-4 pl-ls">
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/market-intelligence.webp" alt="Icon">
                            <a href="" class="fs-4">Market Intelligence</a> 
                        </div>
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/chemical-trend-analytics.webp" alt="Icon">
                            <a href="" class="fs-4">Chemical Trend Analytics </a>
                        </div>
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/sustainability-strategies.webp" alt="Icon">
                            <a href="" class="fs-4">Sustainability Strategies </a>
                        </div>
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/market-expansion.webp" alt="Icon">
                            <a href="" class="fs-4">Market Expansion </a>
                        </div>
                    </div>
                    
                    <div class="hexago hexago d-flex pl-rs">
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/custom-research.webp" alt="Icon">
                            <a href="" class="fs-4">Custom Research</a> 
                        </div>
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/supply-chain-dynamics.webp" alt="Icon">
                            <a href="" class="fs-4">Supply Chain Dynamics</a>
                        </div>
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/regulatory-compliance-analysis.webp" alt="Icon">
                            <a href="" class="fs-4">Regulatory Compliance Analysis</a>
                        </div>
                        <div class="text-center">
                            <img src="<?php echo SITEPATH; ?>images/home-page/data-optimization.webp" alt="Icon">
                            <a href="" class="fs-4">Data Optimization </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="ptb">
        <div class="container">
            <div class="row">
                 <div class="col-md-12">
                     <h2 class="ttl text-center">Latest Insights</h2>
                     <p class="para text-center pb-6">Access our leading reports, delivering valuable insights into the ever-evolving chemicals and materials landscape.</p>
                 </div>
             </div>
            <div class="row">
            <?php $count = 1; foreach($report_details as $report){ ?>    
                <div class="col-lg-3 col-md-6">
                    <img src="<?php echo SITEPATH; ?>images/report<?php echo $count; ?>.webp" alt="report-img" class="img-fluid" width="400" height="400">
                    <div class="rp-list">
                        <h3><a rel="nofollow" href="<?php echo SITEPATH.'insights/'.$report['slug']; ?>"><?php echo $report['meta_title']; ?></a></h3>
                        <p>
                            <?php echo $report['meta_description']; ?>
                        </p>
                        <a href="<?php echo SITEPATH.'insights/'.$report['slug']; ?>" class="rd-txt">Read More</a>
                    </div>
                </div>
            <?php $count++; } ?>    
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <a href="<?php echo SITEPATH;?>reports-store" class="btn grn-btn mt-5" rel="nofollow">View all Insights
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="ptb wcu-bg mt-5">
        <div class="container text-center py-5 text-dark">
        <h2 class="fw-bold ttl text-center">Why Choose Towards Chem & Materials</h2>

    <div class="row mt-4 g-4 ml-5 mr-5">
        <div class="col-md-4">
            <div class="card p-3 wcu-card">
                <div class="icon text-start"> <img src="<?php echo SITEPATH; ?>images/home-page/industry-leading-expertise-icon.webp" width="70" height="70"> </div>
                <h5 class="fw-bold mt-4 fs-3 mb-4 text-start text-dark">Industry-Leading Expertise</h5>
                <p class="para fs-4">At Towards Chem & Materials, our team brings over 10 years of combined experience, offering precise, data-driven insights tailored for the chemical and materials industry.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 wcu-card">
                <div class="icon text-start"> <img src="<?php echo SITEPATH; ?>images/home-page/cutting-edge-market-insights.webp" width="70" height="70"> </div>
                <h5 class="fw-bold mt-4 fs-3 mb-4 text-start text-dark">Cutting-Edge Market Insights</h5>
                <p class="para fs-4">Stay ahead with our in-depth reports on emerging trends, material innovations, and market shifts, shaping the global chemicals and materials industry.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 wcu-card">
                <div class="icon text-start"> <img src="<?php echo SITEPATH; ?>images/home-page/actionable-data-driven-strategie.webp" width="70" height="70"> </div>
                <h5 class="fw-bold mt-4 fs-3 mb-4 text-start text-dark">Actionable, Data-Driven Strategies</h5>
                <p class="para fs-4">Our insights aren’t just data—they guide your decisions, helping businesses in chemicals and materials optimize operations and boost profitability.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 wcu-card">
                <div class="icon text-start"> <img src="<?php echo SITEPATH; ?>images/home-page/in-depth-customized-reports.webp" width="70" height="70"> </div>
                <h5 class="fw-bold mt-4 fs-3 mb-4 text-start text-dark">In-Depth, Customized Reports</h5>
                <p class="para fs-4">Tailored to your needs, our reports dive deep into industry trends, offering actionable intelligence that empowers smarter decisions and growth.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 wcu-card">
                <div class="icon text-start"> <img src="<?php echo SITEPATH; ?>images/home-page/real-time-market-intelligence.webp" width="70" height="70"> </div>
                <h5 class="fw-bold mt-4 fs-3 mb-4 text-start text-dark">Real-Time Market Intelligence</h5>
                <p class="para fs-4">Access the latest real-time data and market updates, with 90% of our clients reporting impactful results within months of using our insights.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 wcu-card">
                <div class="icon text-start"> <img src="<?php echo SITEPATH; ?>images/home-page/empowering-business-growth.webp" width="70" height="70"> </div>
                <h5 class="fw-bold mt-4 fs-3 mb-4 text-start text-dark">Empowering Business Growth</h5>
                <p class="para fs-4">With our tools and strategies, businesses in chemicals and materials unlock growth opportunities, with 70% of clients seeing a tangible increase in market share.</p>
            </div>
        </div>
    </div>
    </div>
</div>

<div class="ptb mt-5">
    <div class="container">
        <div class="row mr-5 ml-5">
            <div class="col-md-6">
            <div class="counter-text">
                <h2 class="ttl text-start">Solutions for Efficiency</h2>
                <p class="para">Our mission is to empower small businesses with reliable, high-quality chemical solutions that ensure the operations run smoothly and efficiently, no matter the challenge. 
                high-quality chemical solutions that ensure the operations run smoothly and efficiently, no matter the challenge. high-quality chemical solutions that ensure the operations run smoothly and efficiently, no matter the challenge.</p>
               <a href="<?php echo SITEPATH; ?>about-us" rel="nofollow"> <button class="btn grn-btn">Know More</button> </a>
            </div>
        </div>
        <div class="col-md-6">
    <div class="counter-cards">
        <div class="counter-card height-16">
           <p class="para text-white counter-num1">1500<sup>+</sup> </p> 
            <p class="para text-white">Market Research Reports</p>
        </div>
        <div class="counter-card height-13 cc-25">
           <p class="para text-white counter-num2"> 30<sup>+</sup> </p> 
            <p class="para text-white">Research Analyst</p>
        </div>
        <div class="counter-card height-13">
           <p class="para text-white counter-num2"> 2000<sup>+</sup> </p> 
            <p class="para text-white">Market Competitor Data</p>
        </div>
        <div class="counter-card height-16">
           <p class="para text-white counter-num1"> 100<sup>+</sup> </p> 
            <p class="para text-white">Market Interviews</p>
        </div>
    </div>
    </div>
    </div>
</div>
</div>
    

    <?php if(!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false): ?>
        <div class="ptb d-none">
        <div class="container">
        <div class="row">
             <div class="col-md-8">
                 <h2 class="ttl">Latest Industry Datasets Collection</h2>
             </div>
         </div>
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills me-3 ind-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-ins2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ins2" type="button" role="tab"
                    aria-controls="v-pills-ins2" aria-selected="false">Corrugated</button>
                    <button class="nav-link" id="v-pills-ins3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ins3" type="button" role="tab"
                    aria-controls="v-pills-ins3" aria-selected="false">Sustainable</button>
                    <button class="nav-link" id="v-pills-ins4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ins4" type="button" role="tab" 
                    aria-controls="v-pills-ins4" aria-selected="false">Rigid</button>
                    <button class="nav-link" id="v-pills-ins5-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ins5" type="button" role="tab"
                    aria-controls="v-pills-ins5" aria-selected="true">Plastic</button>
                    <button class="nav-link" id="v-pills-ins6-tab" data-bs-toggle="pill" data-bs-target="#v-pills-ins6" type="button" role="tab" 
                    aria-controls="v-pills-ins6" aria-selected="false">Food</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-ins2" role="tabpanel" aria-labelledby="v-pills-ins2-tab">
                        <div class="ind-data">
                            <img src="<?php echo SITEPATH;?>images/corrugated.webp" alt="Corrugated" class="img-fluid no-mob-img" width="1383" height="702">
                            <div class="ind-inner-data">
                                <h3>Corrugated</h3>
                                <p class="para">Unbox excellence with our corrugated Chem and Materials solutions! Explore innovative designs, sustainable options, and expert guidance with us.</p>
                                <a href="<?php echo SITEPATH;?>corrugated" class="btn blck-btn">
                                    Know More 
                                    <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ins3" role="tabpanel" aria-labelledby="v-pills-ins3-tab">
                        <div class="ind-data">
                            <img src="<?php echo SITEPATH;?>images/sustainable.webp" alt="Sustainable" class="img-fluid no-mob-img" width="1383" height="702">
                            <div class="ind-inner-data">
                                <h3>Sustainable</h3>
                                <p class="para">Your path to sustainable Chem and Materials starts here. Find the perfect eco-friendly solutions on our site today.</p>
                                <a href="<?php echo SITEPATH;?>sustainable" class="btn blck-btn">
                                    Know More <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow" width="15" height="15">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ins4" role="tabpanel" aria-labelledby="v-pills-ins4-tab">
                        <div class="ind-data">
                            <img src="<?php echo SITEPATH;?>images/rigid.webp" alt="Rigid" class="img-fluid no-mob-img" width="1383" height="702">
                            <div class="ind-inner-data">
                                <h3>Rigid</h3>
                                <p class="para">Elevate your rigid Chem and Materials efficiency: Discover customized solutions powered by our expert data analytics.</p>
                                <a href="<?php echo SITEPATH;?>rigid" class="btn blck-btn">
                                    Know More <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow"
                                    width="15" height="15">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ins5" role="tabpanel" aria-labelledby="v-pills-ins5-tab">
                        <div class="ind-data">
                            <img src="<?php echo SITEPATH;?>images/plastic.webp" alt="Plastic" class="img-fluid no-mob-img" width="1383" height="702">
                            <div class="ind-inner-data">
                                <h3>Plastic</h3>
                                <p class="para">Revolutionize Plastic Chem and Materials: Unlock the data, discover precision-driven solutions in our expert datasets</p>
                                <a href="<?php echo SITEPATH;?>plastic" class="btn blck-btn">
                                    Know More <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow"
                                    width="15" height="15">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ins6" role="tabpanel" aria-labelledby="v-pills-ins6-tab">
                        <div class="ind-data">
                            <img src="<?php echo SITEPATH;?>images/food.webp" alt="food" class="img-fluid no-mob-img" width="1383" height="702">
                            <div class="ind-inner-data">
                                <h3>Food</h3>
                                <p class="para">Unlock optimal food Chem and Materials solutions with our data-driven insights—enhance freshness, sustainability, and efficiency.</p>
                                <a href="<?php echo SITEPATH;?>food" class="btn blck-btn">
                                    Know More <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow"
                                    width="15" height="15">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="ptb bgg-4 d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2 class="ttl">Why Choose Towards Chem and Materials</h2>
                    <a href="<?php echo SITEPATH;?>about-us" class="btn blck-btn mb-4">Learn about Towards Chem and Materials
                        <img src="<?php echo SITEPATH;?>images/home-page/Right-arrow-button.png" alt="next-arrow" class="img-fluid nxt-arrow " width="15" height="15">
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="wh-data">
                        <img src="<?php echo SITEPATH;?>images/nw-images/customer-insights.webp" alt="customer-insights" class="img-fluid pb-4" width="40" height="40">
                        <h3>Actionable Insights</h3>
                        <p class="para">
                            Gain valuable, data-driven insights backed by thorough research and market trends, empowering businesses to make informed, strategic
                            decisions for sustainable growth in Chem and Materials sector.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wh-data">
                        <img src="<?php echo SITEPATH;?>images/nw-images/market-databook.webp" alt="market-databook" class="img-fluid pb-4" width="40" height="40">
                        <h3>Market Databook</h3>
                        <p class="para">
                            Access in-depth, interactive databooks filled with essential data, trends, and forecasts, helping you analyze Chem and Materials market performance 
                            and predict future shifts with precision
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wh-data ps-0">
                        <img src="<?php echo SITEPATH;?>images/nw-images/company-profiles.webp" alt="company-profiles" class="img-fluid pb-4" width="40" height="40">
                        <h3>Competitive Landscape</h3>
                        <p class="para">
                            Explore detailed profiles of leading Chem and Materials companies, including financials, strategies, market positioning, and key innovations, to
                            benchmark competitors and identify new opportunities.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wh-data">
                        <img src="<?php echo SITEPATH;?>images/nw-images/segmental-analysis.webp" alt="segmental-analysis" class="img-fluid pb-4" width="40" height="40">
                        <h3>Segmental Analysis</h3>
                        <p class="para">
                            Gain an in-depth understanding of specific Chem and Materials market segments, uncovering key trends, consumer preferences, and growth drivers 
                            across product categories, applications, and industries.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="wh-data">
                        <img src="<?php echo SITEPATH;?>images/nw-images/market-share-analysis.webp" alt="market-share-analysis" class="img-fluid pb-4" width="40" height="40">
                        <h3>Geographical Analysis</h3>
                        <p class="para">
                            Explore regional variations in the Chem and Materials market, identifying emerging opportunities, local demand patterns, and regulatory impacts across
                            different geographies for more precise market targeting.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="ptb d-none">
            <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="ttl ft-family">
                        You’re in Good Company
                    </h2>
                </div>
                <div class="col-md-5 d-flex">
                    <div class="test-txt">
                        <p class="para">
                           Towards Chem and Materials has been an invaluable resource for our business. The in-depth market reports and data-driven insights have helped us make more
                           informed decisions about our Chem and Materials strategies. Their comprehensive analysis of industry trends, material innovations, and sustainability practices
                           has kept us ahead of the competition. We highly recommend their services to anyone looking for reliable and actionable market research in the Chem and Materials
                           industry.
                        </p>
                        <!--<p class="para"><strong>GE Healthcare</strong></p>--> 
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="test-txt">
                        <p class="para">
                            We have been consistently impressed with the quality of insights provided by Towards Chem and Materials. Their reports are detailed, up-to-date, 
                            and tailored to meet our business needs. The expert analysis has helped us understand evolving market dynamics and refine our Chem and Materials 
                            solutions for better customer engagement. A great partner for any Chem and Materials-focused company!
                        </p>
                        <!--<p class="para"> <strong>Pfizer</strong></p>-->
                    </div>
                </div>
            </div>
        </div>
        </div>
    <div class="ptb d-block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="ttl">Trusted By Industry Leaders</h2>
                    <img src="<?php echo SITEPATH;?>images/nw-images/TCM_grey_logo-01-01.webp" alt="" class="img-fluid"> 
                </div>
            </div>
        </div> 
    </div>
<?php include("footer.php");?>
<script src="<?php echo SITEPATH; ?>js/ccptlskj.js"></script>
 <?php endif; ?>