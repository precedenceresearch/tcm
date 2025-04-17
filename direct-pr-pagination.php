<?php 
require_once("classes/cls-leads.php");

$obj_lead = new Lead();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$type = isset($_GET['type']) ? $_GET['type'] : 'manage';

$limitcond = "10";
$m="";
$page = $_GET['page'];
$condition="";
if($page=="1")
{
   $nextoffset="0";
}
else
{
   $nextoffset=($page-1) * $limitcond;  
} 
if($type == 'client'){
$fields = "A.id, A.name, A.email, A.payment_status, A.pr_status, B.company, B.file_name, B.title"; 
$orderbyfreshleads = "A.id DESC"; 
$limit ="$nextoffset,$limitcond";
$lead_details = $obj_lead->getprLeadDetails($fields, $condition, $orderbyfreshleads, $limit,'', 0);
$all_blog_cnt=$obj_lead->getprLeadDetails($fields, $condition, $orderbyfreshleads, '', 0);
$total_records = count($all_blog_cnt);  
$total = $total_records;
   
}else{
    $fields = "*"; 
    $orderbyfreshleads = ""; 
    $limit ="$nextoffset,$limitcond";
    $lead_details = $obj_lead->getpublishedprDetails($fields, $condition, $orderbyfreshleads, $limit,'', 0);
    $all_blog_cnt=$obj_lead->getpublishedprDetails($fields, $condition, $orderbyfreshleads, '', 0);
    $total_records = count($all_blog_cnt);  
    $total = $total_records;
}


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
      <li class="pageitem" id="'.$page_array[$count].'"><a class="page-link" href="javascript:void(0)" data-id="'.$page_array[$count].'" data-type="'.$type.'" data-sort="'.$m.'">'.$page_array[$count].'</a></li>
     

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
</style>
 <table class="table table-hover table-nowrap leadbox-listing">
    <thead class="thead-light">
        <tr>
            <?php if($type == "client") { ?>
            <!--<th scope="col">Sr.No</th>-->
            <!--<th scope="col">Name</th>-->
            <!--<th scope="col">Email</th>-->
            <!--<th scope="col">Company</th>-->
            <!--<th scope="col">Title</th>-->
            <!--<th scope="col">File</th>-->
            <!--<th scope="col">Payment Status</th>-->
            <!--<th>Action</th>-->
            
            <?php }else{ ?>
            
             <th scope="col">Sr.No</th>
             <th scope="col">Title</th>
             <th scope="col">Author</th>
             <th scope="col">Publish Date</th>
             <th>Action</th>
            <?php } ?>
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
    foreach ($lead_details as $blog_detail) {
         if (strlen($blog_detail['title']) > 100)
         {
            $blogtitle = substr(str_replace("–","-",$blog_detail['title']), 0, 100) . '...';
         }
         else
         {
            $blogtitle = str_replace("–","-",$blog_detail['title']);
         }
?>

<tr>
     <?php if($type == "client"){ ?>
        <!-- <td><a class="text-heading font-semibold" href="#"><?php echo $counter; ?></a></td>-->
        <!-- <td><?php echo $blog_detail['name'];?></td>-->
        <!-- <td><?php echo $blog_detail['email'];?></td>-->
        <!-- <td><?php echo $blog_detail['company'];?></td>-->
        <!-- <td><?php echo $blog_detail['title'];?></td>-->
        <!-- <td>-->
        <!--     <?php if (!empty($blog_detail['file_name'])) { ?>-->
              
        <!--        <a href="<?php echo SITEPATH; ?>press_release_docs/<?php echo urlencode($blog_detail['company']) . '/' . urlencode($blog_detail['file_name']); ?>" -->
        <!--           download="<?php echo htmlentities($blog_detail['file_name']); ?>"-->
        <!--           target="_blank">-->
        <!--           <?php echo $blog_detail['file_name'];?>   <img src="<?php echo SITEPATH; ?>precedence/images/downloadicon.png" alt="Download" style="width: 20px; height: 20px; vertical-align: middle;"> -->
        <!--        </a>-->
        <!--    <?php } ?>-->
        <!--</td>-->
        <!--<td><?php echo $blog_detail['payment_status'];?></td>-->
  
        <!--<td class="text-end">-->
        <!--    <div style="display:flex;"><a class="m-1" title="Edit Category" href="add-blog?blog_id=<?php echo base64_encode($blog_detail['id']);?>">-->
        <!--        <a href="<?php echo SITEPATH; ?>precedence/add-pr.php?id=<?php echo base64_encode($blog_detail['id']); ?>" title="Add Press Release" style="margin-left: 10px; font-size: 18px; text-decoration: none;">-->
        <!--            ➕-->
        <!--        </a>-->
        <!--        <?php $blog_detail_status = $blog_detail['pr_status']; ?>-->
        <!--            <input type="checkbox" name="switch_published" id="switch<?php echo $blog_detail['id'];?>" onclick="action_published(<?php echo $blog_detail['id'];?>)" value="<?php echo $blog_detail_status; ?>" <?php echo $blog_detail_status == "Active" ? "checked" : "unchecked" ?>/>-->
        <!--            <label for="switch<?php echo $blog_detail['id'];?>" id="toggle_label"></label> -->
        
        <!--</td>-->
    <?php } else {?>  
         <td><a class="text-heading font-semibold" href="#"><?php echo $counter; ?></a></td>
         <td><a href="<?php echo SITEPATH.'press-release/'.$blog_detail['pressurl'];?>" target="_blank"><?php echo $blog_detail['title'];?></a></td>
         
          
         <td><?php echo $blog_detail['author'];?></td>
         <td><?php echo $blog_detail['pub_date'];?></td>
         <td class="text-end">
            <div style="display:flex;">
                 <a class="m-1" title="Edit Press Release" href="edit-published-pr.php?id=<?php echo base64_encode($blog_detail['id']);?>">
                <img src="<?php echo SITEADMIN."images/writing.png";?>" height="30" width="30"></a>
                <?php $blog_detail_status = $blog_detail['status']; ?>
                    <input type="checkbox" name="switch_published" id="switch<?php echo $blog_detail['id'];?>" onclick="action_published(<?php echo $blog_detail['id'];?>)" value="<?php echo $blog_detail_status; ?>" <?php echo $blog_detail_status == "Active" ? "checked" : "unchecked" ?>/>
                    <label for="switch<?php echo $blog_detail['id'];?>" id="toggle_label"></label> 
        
        </td>
     
     <?php } ?>
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
<script type="text/javascript">
	$(document).ready(function() {
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			var type = "<?php echo $_GET['type'] ?? 'manage'; ?>";
			
			$.ajax({
				url: "<?php echo SITEADMIN; ?>direct-pr-pagination.php",
				type: "GET",
				data: {
					page : id,
					type: type 
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
	function action_published(blogid)
        {
        // var chk_publish =  $('#switch'+campid).val();
            $.ajax({
                  url : "<?php echo SITEADMIN; ?>update-pr-status-published.php",
                  type : "POST",
                  data : {blogid:blogid},
                  success: function(data){
                     
                     
                  }
                  
            });
        }
</script>