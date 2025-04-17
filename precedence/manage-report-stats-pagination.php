<?php 
require_once("classes/cls-report.php");
require_once("classes/cls-category.php");
require_once("classes/cls-sample.php");

$obj_report = new Report();
$obj_category = new Category();
$obj_sample =new Sample();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$limitcond = "25";
$m="";
$page = $_GET['page'];
$condition="(`status`='Active' or status='Inactive')";
if(isset($_GET['daterange']))
{
    $daterange=$_GET['daterange'];
}
else
{
    $daterange="";
}
if(isset($_GET['repid']))
{
    $repid=$_GET['repid'];
}
else
{
    $repid="";
}
if(isset($_GET['reptitle']))
{
    $reptitle=$_GET['reptitle'];
}
else
{
    $reptitle="";
}
if(isset($_GET['repcategory']))
{
    $repcategory=$_GET['repcategory'];
}
else
{
    $repcategory="";
}

if($repid!="")
{
    $condition.=" and (`predr_q_reports`.`report_id`='".$repid."')";
}
if($reptitle!="")
{
    $condition.=" and (`predr_q_reports`.`reportSubject` like '%".$reptitle."%' or `predr_q_reports`.`reportSubject` like '%".$reptitle."' or `predr_q_reports`.`reportSubject` like '".$reptitle."%')";
}
if($repcategory!="")
{
    $condition.=" and (`predr_q_reports`.`CatId`='".$repcategory."')";
}
if($daterange!="")
{  //05/12/2022 - 06/21/2022
   $fulldate=explode("-",$daterange);
   $fromdate=$fulldate[0];
   $splitfrom=explode("/",$fromdate);
   $newfromdate=trim($splitfrom[2]).":".trim($splitfrom[0]).":".trim($splitfrom[1]);
   $todate=$fulldate[1];
   $splitto=explode("/",$todate);
   $newtodate=trim($splitto[2])."-".trim($splitto[0])."-".trim($splitto[1]);
   //echo $todat=date_create('.$newtodate.');
  // $todat=date_format($todat33,"Y:m:d");
   //die();
   $newplustodate=date('Y:m:d', strtotime($newtodate.'+1 days'));
   $condition.=" and (`predr_q_reports`.`created_at` BETWEEN '".$newfromdate."' and '".$newplustodate."')";
}
//echo $condition;
if($page=="1")
{
   $nextoffset="0";
}
else
{
   $nextoffset=($page-1) * $limitcond;  
} 
$fields = "*";
$orderbyfreshleads="`report_id` DESC";
$limit ="$nextoffset,$limitcond";
$report_details = $obj_report->getReport_q_Details($fields, $condition, $orderbyfreshleads, $limit,'', 0);
$all_report_cnt=$obj_report->getReport_q_Details($fields, $condition, $orderbyfreshleads, '', 0);
$total_records = count($all_report_cnt);  
$total = $total_records;


//////////////////////*Paging Code start*/////////////////////////

if($total>0)
{
$total_links=ceil($total/$limitcond);
$previous_link = '';
$next_link = '';
$page_link = '';

//echo $total_links;

if($total_links > 4)
{ 
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}
//print_r($page_array);
for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="pageitem" id="'.$page_array[$count].'">
      <a class="page-link active1" href="#" data-id="'.$page_array[$count].'" data-sort="'.$m.'">'.$page_array[$count].' <span class="sr-only"></span></a>
    </li>
    ';
    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="pageitem" id="'.$previous_id.'"><a class="page-link" href="javascript:void(0)" data-id="'.$previous_id.'" data-sort="'.$m.'">Previous</a></li>';
    }
    else
    {
      $previous_link = '';
    }
    $next_id = $page_array[$count] + 1;
    if($page_array[$count] >= $total_links)
    {
      $next_link = '';
    }
    else
    {
      $next_link = '<li class="pageitem" id="'.$next_id.'"><a class="page-link" href="javascript:void(0)" data-id="'.$next_id.'" data-sort="'.$m.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="pageitem disabled">
          <a class="page-link" href="#" data-sort="'.$m.'">...</a>
      </li>
      ';
    }
    else
    { 
      $page_link .= '
      <li class="pageitem" id="'.$page_array[$count].'"><a class="page-link" href="javascript:void(0)" data-id="'.$page_array[$count].'" data-sort="'.$m.'">'.$page_array[$count].'</a></li>
      ';
      
    }
  }
}

}
/*Paging Code End*/
?>
<style>
input[type="checkbox"] {
	 height: 0;
	 width: 0;
	 visibility: hidden;
}
 #toggle_label {
	 cursor: pointer;
	 text-indent: -9999px;
	 width: 45px;
	 height: 25px;
	 background: #f81708;
	 display: block;
	 border-radius: 100px;
	 position: relative;
	 content: "No";
	 color:#fff;
	 margin-top: 6px;
}
 #toggle_label:after {
	 content: "No";
	 position: absolute;
	 top: 4px;
	 left: 5px;
	 width: 18px;
	 height: 18px;
	 background: #fff;
	 border-radius: 90px;
	 transition: 0.3s;
}
 input:checked + #toggle_label {
	 background: #34a615;
	  
}
 input:checked + #toggle_label:after {
	 left: calc(100% - 5px);
	 transform: translateX(-100%);
}
 #toggle_label:active:after {
	 width: 130px;
}
.f_name{
    text-align:justify;
}
</style>
           

 <table class="table table-hover table-nowrap leadbox-listing">
    <thead class="thead-light">
        <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">Report ID</th>
            <th scope="col">Report Title</th>
            <th scope="col">Category</th>
            <th scope="col">Created Date</th>
            <th>Action</th>
        </tr>
    </thead>

<tbody>
<?php 
    if(isset($report_details) && !empty($report_details))
    {
         if($page == 1)
     {
     $counter = 1;
     }
     else
     {
         $counter = (($limitcond * ($page - 1)) + 1);
     }
    foreach ($report_details as $report_detail) {
         $catid=$report_detail['CatId'];
         $fields = "catName";
         $condition = "`predr_category`.`catId`='".$catid."'";
         $category_details = $obj_category->getCategoryDetails($fields, $condition, '', '','', 0);
         foreach($category_details as $category_detail)
         {
             $catname=$category_detail['catName'];
         }
         if (strlen($report_detail['reportSubject']) > 100)
         {
            $reporttitle = substr(str_replace("–","-",$report_detail['reportSubject']), 0, 100) . '...';
         }
         else
         {
            $reporttitle = str_replace("–","-",$report_detail['reportSubject']);
         }
         
         if(strpos($report_detail['slug'], 'market') == false){
            $repurl= SITEPATH;
         }
         else
         {
            $repurl= SITEPATH.$report_detail['slug'];
         }
         
         $fields = "*";
        $condition = "`report_id`='".$report_detail['report_id']."'";
        $segment_details = $obj_sample->getSegmentDetails($fields, $condition, '', '','', 0);
        
       // print_r($segment_details);exit;
         
?>

<tr>
   
      <td><?php echo $counter; ?></td>
      <td><?php echo $report_detail['report_id']; ?></td>
     <td class="f_name"><a href="<?php echo SITEFRONT.'outlook/'.$report_detail['slug'].'/'.$report_detail['report_type'];?>" target="_blank"><?php echo $reporttitle;?></a></td>
     <td><?php echo $catname; ?></td>

     <td><?php echo date("F d, Y",strtotime($report_detail['created_at']));?></td>
     <td class="text-end" style="width: 16%;">
        <div style="display:flex;">
            <!--<a class="m-1" title="Edit Report" href="add-report?report_id=<?php echo base64_encode($report_detail['report_id']);?>">-->
            <div style="display:flex;"><a class="m-1" title="Edit Report" href="edit-report-stats.php?report_id=<?php echo base64_encode($report_detail['report_id']);?>">
            <img src="<?php echo SITEADMIN."images/writing.png";?>" height="25" width="25"></a>
            <a class="m-1" title="Create Graph" href="<?php echo SITEADMIN; ?>create-graph.php?report_id=<?php echo base64_encode($report_detail['report_id']);?>" target="_blank"><img src="<?php echo SITEADMIN; ?>images/graph.png" height="30" width="30"></a>
           <?php if (!empty($segment_details)): ?>
        <a class="m-1" title="Edit Segment" href="<?php echo SITEADMIN; ?>edit-segments-stats.php?report_id=<?php echo base64_encode($report_detail['report_id']);?>" target="_blank">
            <img src="<?php echo SITEADMIN; ?>images/segmentation_icon.png" height="30" width="30">
        </a>
    <?php else: ?>
        <a class="m-1" title="Create Segment" href="<?php echo SITEADMIN; ?>create-segments-stats.php?report_id=<?php echo base64_encode($report_detail['report_id']);?>" target="_blank">
            <img src="<?php echo SITEADMIN; ?>images/segmentation_icon.png" height="30" width="30">
        </a>
    <?php endif; ?>
            <a class="m" title="Add Data" href="<?php echo SITEADMIN; ?>add-report-segment-value-q.php?report_id=<?php echo base64_encode($report_detail['report_id']);?>" target="_blank" style="font-size: 14px;margin-top: 10px;">Add Data</a>
             <!--<a class="m-1" title="Add regional Report" href="<?php echo SITEADMIN; ?>add-report-segment-q.php?report_id=<?php echo base64_encode($report_detail['report_id']);?>" target="_blank"><img src="<?php echo SITEADMIN; ?>images/segments.png" height="35" width="40"></a>-->

            <!--<a class="m-1" title="View Graph List" href="graph-list.php?report_id=<?php echo base64_encode($report_detail['report_id']);?>" target="_blank">-->
            <!--<img src="<?php echo SITEADMIN."images/eye.png";?>" height="30" width="30"></a>-->
            <!--<a class="m-1" title="Add FAQ" href="add-report-faq?report_id=<?php echo base64_encode($report_detail['report_id']);?>"><img src="<?php echo SITEADMIN."images/faq (1).png";?>" height="40" width="40"></a>-->
            <!--    <?php $report_detail_status = $report_detail['status']; ?>-->
            <!--    <a class="m-1" title="View FAQ" href="view-report-faq?report_id=<?php echo base64_encode($report_detail['report_id']);?>">-->
            <!--<img src="<?php echo SITEADMIN."images/eye.png";?>" height="30" width="30"></a>-->
            <!--    <input type="checkbox" name="switch_published" id="switch<?php echo $report_detail['report_id'];?>" onclick="action_published(<?php echo $report_detail['report_id'];?>)" value="<?php echo $report_detail_status; ?>" <?php echo $report_detail_status == "Active" ? "checked" : "unchecked" ?>/>-->
            <!--    <label for="switch<?php echo $report_detail['report_id'];?>" id="toggle_label" title="Change Status"></label>-->
        
    </td>
    

</tr>
<?php $counter++; } ?>
<?php } else {?>
<tr><td colspan="6" style="text-align:center;">No Records Found</td></tr>  
<?php }?>
</tbody>

</table>

<?php if($total>0){?>
<div class="pagination-main">
    <div class="offset-5">
       <nav>
            <ul class="paginationcmp" style="font-size:12px;display:flex;list-style: none;">
            <?php echo $previous_link . $page_link . $next_link;?>
			</ul>
       </nav>
    </div>
</div>           
<?php }?>    
<Style>
    .active1{
        background-color:#3d298a;
        color:#fff;
    }
</Style>
<script type="text/javascript">
	$(document).ready(function() {
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			var repid=$("#repid").val();
		    var reptitle=$("#reptitle").val();
		    var repcategory=$("#repcategory").val();
		    var daterange=$("#datetimerange-input1").val();
			$.ajax({
				url: "<?php echo SITEADMIN; ?>manage-report-pagination-q.php",
				type: "GET",
				data: {
					page : id,daterange:daterange,repid:repid,reptitle:reptitle,repcategory:repcategory
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active1");
					$("#"+select_id).addClass("active1");
					$(window).scrollTop(0);
				}
			});
		});
		
	});
	function action_published(repid)
        {
        // var chk_publish =  $('#switch'+campid).val();
            $.ajax({r
                  url : "<?php echo SITEADMIN; ?>update-report-status-published.php",
                  type : "POST",
                  data : {repid:repid},
                  success: function(data){
                     
                     
                  }
                  
            });
        }
        
        
        function loadReports(reportType) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "get_reports.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status === 200) {
            document.querySelector("tbody").innerHTML = this.responseText;
        }
    };
    xhr.send("type=" + reportType);
}
</script>