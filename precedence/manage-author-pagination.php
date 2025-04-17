<?php 
require_once("classes/cls-author.php");

$obj_author = new Author();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

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
$fields = "*";
$orderbyfreshleads="`author_id` DESC";
$limit ="$nextoffset,$limitcond";
$author_details = $obj_author->getAuthorDetails($fields, $condition, $orderbyfreshleads, $limit,'', 0);
$all_author_cnt=$obj_author->getAuthorDetails($fields, $condition, $orderbyfreshleads, '', 0);
$total_records = count($all_author_cnt);  
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
</style>
 <table class="table table-hover table-nowrap leadbox-listing">
    <thead class="thead-light">
        <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Designation</th>
            <th scope="col">Description</th>
            <th scope="col">Created Date</th>
            <th>Action</th>
        </tr>
    </thead>

<tbody>
<?php 
    if(isset($author_details) && !empty($author_details))
    {
         if($page == 1)
     {
     $counter = 1;
     }
     else
     {
         $counter = (($limitcond * ($page - 1)) + 1);
     }
    foreach ($author_details as $author_detail) {
         
?>

<tr>
     <td><?php echo $counter; ?></td>
     <td><?php echo stripslashes($author_detail['author_name']);?></td>
     <td class="f_name">
        <?php echo $author_detail['author_email'];?></td>
    <td><?php echo stripslashes($author_detail['author_designation']);?></td>
    <td><?php echo stripslashes($author_detail['author_description']);?></td>
     <td>
        <?php echo date("F d, Y",strtotime($author_detail['created_at']));?>
     </td>
    
    <td class="text-end">
        <div style="display:flex;"><a class="m-1" title="Edit Author" href="add-author?author_id=<?php echo base64_encode($author_detail['author_id']);?>">
            <img src="<?php echo SITEADMIN."images/writing.png";?>" height="30" width="30"></a>
                <?php $author_detail_status = $author_detail['status']; ?>
                <input type="checkbox" name="switch_published" id="switch<?php echo $author_detail['author_id'];?>" onclick="action_published(<?php echo $author_detail['author_id'];?>)" value="<?php echo $author_detail_status; ?>" <?php echo $author_detail_status == "Active" ? "checked" : "unchecked" ?>/>
                <label for="switch<?php echo $author_detail['author_id'];?>" id="toggle_label"></label>
        
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
<script type="text/javascript">
	$(document).ready(function() {
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			
			$.ajax({
				url: "<?php echo SITEADMIN; ?>manage-author-pagination.php",
				type: "GET",
				data: {
					page : id
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
	function action_published(author_id)
        {
        // var chk_publish =  $('#switch'+campid).val();
            $.ajax({
                  url : "<?php echo SITEADMIN; ?>update-author-status-published.php",
                  type : "POST",
                  data : {author_id:author_id},
                  success: function(data){
                     
                     
                  }
                  
            });
        }
</script>