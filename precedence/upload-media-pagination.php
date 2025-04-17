<?php 
require_once("classes/cls-media.php");

$obj_media = new Media();


if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$limitcond = "10";
$m="";
$page = $_GET['page'];

if($page=="1")
{
   $nextoffset="0";
}
else
{
   $nextoffset=($page-1) * $limitcond;  
} 

$fields="*";
$condition = "`predr_media`.`status`='Active'";
$orderby = "`id` DESC";
$limit ="$nextoffset,$limitcond";
$media_details = $obj_media->getMediaDetails($fields, $condition, $orderby, $limit, 0);
$all_media_cnt= $obj_media->getMediaDetails($fields, $condition, $orderby, '', 0);
$total_records = count($all_media_cnt);  
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
 <table class="table table-hover table-nowrap leadbox-listing" id="mytable">
    <thead class="thead-light">
        <tr>
            <th>Sr.No</th>
            <th scope="col">Images</th>
            <th>Image Link</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
     <?php  
        $sno=1;
        
      if(isset($media_details)){
        
         if($page == 1)
         {
            $counter = 1;
         }
         else
         {
             $counter = (($limitcond * ($page - 1)) + 1);
         }
         foreach($media_details as $media_detail){
         $today=strtotime(date('Y-m-d h:i:sa'));
         ?> 
    
    <tr>
        <td class="f_name"><?php echo $counter;?></td>
        <td><a class="example-image-link" href="<?php echo $media_detail['imagepath']; ?>?img=<?php echo $media_detail['id'].$today;?>" data-lightbox="image-<?php echo $sno;?>"><img src="<?php echo $media_detail['imagepath'];?>?img=<?php echo $media_detail['id'].$today;?>" height="100" width="100" /></a></td>
        <td><div class="clipboard">
                <input onclick="copy('<?php echo $sno;?>')" class="copy-input" value="<?php echo $media_detail['imagepath']; ?>" id="copyClipboard<?php echo $sno;?>" readonly>
                <button class="copy-btn" id="copyButton" onclick="copy('<?php echo $sno;?>')">Copy Link <i class="fa fa-copy"></i></button>
                <div id="copied-success<?php echo $sno;?>" class="copied">
                    <span>Copied!</span>
                </div>
            </div>
        </td>
        <td class="text-end">
            <div style="display:flex;">
                <a class="m-1" title="Edit Image" href="<?php echo SITEADMIN?>upload-media?editimgid=<?php echo $media_detail['id'];?>">
                <img src="<?php echo SITEADMIN."images/writing.png";?>" height="30" width="30"></a>
                <a class="m-1" title="Delete Image" href="<?php echo SITEADMIN?>delete-image.php?imgid=<?php echo $media_detail['id'];?>">
                <img src="<?php echo SITEADMIN."images/delete.png";?>" height="30" width="30"></a>
            </div>
        </td>
    </tr>
    <?php $counter++; $sno++;} } else {?>
    <tr>
        <td class="f_name text-center" colspan="4">No Image Found</td>
        
    </tr>
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
				url: "<?php echo SITEADMIN; ?>upload-media-pagination.php",
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
            $.ajax({
                  url : "<?php echo SITEADMIN; ?>update-report-status-published.php",
                  type : "POST",
                  data : {repid:repid},
                  success: function(data){
                     
                     
                  }
                  
            });
        }
</script>