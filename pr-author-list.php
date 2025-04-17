<?php 
require_once("precedence/classes/cls-report.php");
require_once("precedence/classes/cls-leads.php");

$obj_report = new Report();
$obj_lead = new Lead();

$author_name = isset($_GET['author_name']) ? $_GET['author_name'] : '';
$author_name = str_replace('-', ' ', trim($author_name));

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 50;
$offset = ($page - 1) * $limit;

$fields = "id, title, pub_date, pressurl, meta_description, meta_title, meta_keyword";
$condition = "LOWER(TRIM(`predr_pr_press_release`.`author`)) = LOWER(TRIM('$author_name'))";

$pr_author_list = $obj_lead->getpublishedprDetails($fields, $condition, "`pub_date` DESC", "$offset,$limit", '', 0);

$total_records = count($obj_lead->getpublishedprDetails($fields, $condition, '', '', 0));
$total_pages = ceil($total_records / $limit);

$meta_title="Stay Ahead: Explore Our Latest Automotive Press Release";
$meta_description="Stay informed with our latest press releases on automotive trends, market dynamics, and industry innovations, empowering your business to thrive in a competitive landscape.";
$meta_keyword="";
?>

<?php include("header.php"); ?>

<style>
    .report-lists {
    background: #f5eeff;
    padding: 2.4rem;
    border-radius: .5rem;
    margin-bottom: 1.5rem
}

.report-lists h2,.report-lists h3 {
    line-height: 1.4;
    font-size: 1.4rem
}

.report-lists h3 a {
    color: #000;
    font-weight: 600;
    font-size: 1.8re
}
.para {
    text-align:  justify;
    line-height:  1.5;
    color:  #333;
    font-weight: 300;
}

</style>

<div class="report-banner pt-0">
    <div class="container">
       <h1 class="ttl purple-txt text-white pt-5 text-center">Author : <?php echo htmlspecialchars(ucwords($author_name)); ?></h1>
    </div>
</div>

<div class="ptb">
    <div class="container">
        <div class="row">
            <div class="row">
                <div id="loader1" style="text-align:center; display:none;">
                    <img src="<?php echo SITEPATH; ?>images/loading.gif" width="10%">
                </div>
               
                
                <div class="table-responsive bg-white" id="target-contentt">
                    <div class="row">
                        <?php if (!empty($pr_author_list)) { ?>
                            <?php foreach ($pr_author_list as $report) { ?>
                            <div class="col-md-6">
                                <div class="report-lists">
                                    <p class="date-data"><?php echo date("F d, Y", strtotime($report['pub_date'])); ?></p>
                                    <h3>
                                        <a href="<?php echo SITEPATH . 'press-release/' . $report['pressurl']; ?>" >
                                            <?php echo htmlspecialchars($report['title']); ?>
                                        </a>
                                    </h3>
                                    <p class="para mb-0">
                                        <?php echo substr(strip_tags(trim($report['meta_description'])), 0, 150) . "..."; ?>
                                    </p>
                                    
                                </div>
                                </div>
    
                            <?php } ?>
                        <?php } else { ?>
                            <h2 class="text-center text-danger">No Reports Found</h2>
                        <?php } ?>
                    </div>
                      
                </div>
      
                <?php if ($total_pages > 1) { ?>
                    <div class="pagination-main">
                        <nav>
                            <ul class="paginationcmp d-flex justify-content-end">
                                <?php if ($page > 1) { ?>
                                    <li class="pageitem">
                                        <a class="page-link" href="?author_name=<?php echo urlencode($author_name); ?>&page=<?php echo $page - 1; ?>">Previous</a>
                                    </li>
                                <?php } ?>

                                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                    <li class="pageitem <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?author_name=<?php echo urlencode($author_name); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>

                                <?php if ($page < $total_pages) { ?>
                                    <li class="pageitem">
                                        <a class="page-link" href="?author_name=<?php echo urlencode($author_name); ?>&page=<?php echo $page + 1; ?>">Next</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
