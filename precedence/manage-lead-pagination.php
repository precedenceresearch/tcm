<?php 
require_once("classes/cls-leads.php");

$obj_lead = new Lead();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$limitcond = "20";
$m="";
$page = $_GET['page'];
$condition="(`predr_formdetails`.`status`='Active')";
if(isset($_GET['daterange']))
{
    $daterange=$_GET['daterange'];
}
else
{
    $daterange="";
}

if(isset($_GET['email']))
{
    $email=$_GET['email'];
}
else
{
    $email="";
}
if(isset($_GET['repid']))
{
    $repid=$_GET['repid'];
}
else
{
    $repid="";
}

if(isset($_GET['formtype']))
{
    $formtype=$_GET['formtype'];
}
else
{
    $formtype="";
}

if($repid!="")
{
    $condition.=" and (`predr_formdetails`.`report_id`='".$repid."')";
}
if($email!="")
{
    $condition.=" and (`predr_formdetails`.`email`='".$email."')";
}
if($formtype!="")
{
    $condition.=" and (`predr_formdetails`.`formname`='".$formtype."')";
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
   $condition.=" and (`predr_formdetails`.`createddate` BETWEEN '".$newfromdate."' and '".$newplustodate."')";
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
//echo $condition;
$fields = "*";
$orderbyfreshleads="`id` DESC";
$limit ="$nextoffset,$limitcond";
$lead_details = $obj_lead->getLeadDetails($fields, $condition, $orderbyfreshleads, $limit,'', 0);
$all_lead_cnt=$obj_lead->getLeadDetails($fields, $condition, $orderbyfreshleads, '', 0);
$total_records = count($all_lead_cnt);  
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
            <th scope="col">Lead ID</th>
            <th scope="col">Report ID</th>
            <th scope="col">Lead Name</th>
            <th scope="col">Form Type</th>
            <th scope="col">Payment Status</th>
            <th scope="col">Created Date</th>
            <th>Action</th>
        </tr>
    </thead>

<tbody>
<?php 
    if(isset($lead_details) && !empty($lead_details))
    {
         if($page == 1)
     {
     $counter = 1;
     }
     else
     {
         $counter = (($limitcond * ($page - 1)) + 1);
     }
    foreach ($lead_details as $lead_detail) {
?>

<tr>
     <td><?php echo $counter; ?></td>
     <td><?php echo $lead_detail['id']; ?></td>
     <td><?php if($lead_detail['report_id']==""){ echo "-";}else { echo $lead_detail['report_id'];} ?></td>
     <td class="f_name"><?php echo $lead_detail['firstname']; ?></td>
     <td><?php echo $lead_detail['formname']; ?></td>
     <td><?php echo $lead_detail['payment_status'];?></td>
     <td><?php echo date("F d, Y",strtotime($lead_detail['createddate']));?></td>
    
    <td class="text-end">
        <div style="display:flex;">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#viewLead" onclick="viewlead('<?php echo $lead_detail['id'];?>');">
            <img src="<?php echo SITEADMIN."images/eye.png";?>" height="30" width="30"></a>
        </div>
        
    </td>
</tr>
<?php $counter++; } ?>
<?php } else {?>
<tr><td colspan="6" style="text-align:center;">No Records Found</td></tr>  
<?php }	?>
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
<!--Lead Details View Modal HTML -->
<div class="modal fade" id="viewLead" aria-labelledby="leadsLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lead Detail</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" id="lead_close"></button>
      </div>
      <div class="modal-body">
          
               <div class="bg-white position-relative" id="lead-content">
                   
                </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn reset-btn" data-dismiss="modal" id="lead_close1">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $("#lead_close").click(function(){
         $('#viewLead').modal('hide');  
    });
      $("#lead_close1").click(function(){
         $('#viewLead').modal('hide');  
    });
	$(document).ready(function() {
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			var repid=$("#repid").val();
		    var formtype=$("#formtype").val();
		    var daterange=$("#datetimerange-input1").val();
			$.ajax({
				url: "<?php echo SITEADMIN; ?>manage-lead-pagination.php",
				type: "GET",
				data: {
					page : id,daterange:daterange,repid:repid,formtype:formtype
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
	function viewlead(leadid)
        {
                  $.ajax({
        				url: "<?php echo SITEADMIN; ?>user-lead-view.php",
        				type: "GET",
        				data: {
        					leadid : leadid
        				},
        				cache: false,
        				success: function(leadData){
        				    $('#viewLead').modal('show');
        					$("#lead-content").html(leadData);
        				}
        			});
        }
</script>