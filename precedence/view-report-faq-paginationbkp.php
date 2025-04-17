<?php 
require_once("classes/cls-report.php");

$obj_report = new Report();

if (!isset($_SESSION['ifg_admin'])) {
    header("Location:login");
}

$condition="`predr_mrfaq`.`rid`='".$_GET['report_id']."'";
$fields = "*";
$report_faq_details = $obj_report->getReportFAQDetails($fields, $condition, '','', 0);

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
            <th scope="col">Question</th>
            <th scope="col">Answer</th>
            <th>Action</th>
        </tr>
    </thead>

<tbody>
<?php 
    if(isset($report_faq_details) && !empty($report_faq_details))
    {
       
    foreach ($report_faq_details as $report_faq_detail) {
         $qcnt=$report_faq_detail['qcnt'];
    }
    for($k=1;$k<=$qcnt;$k++)
    {
?>

<tr>
    <td><?php echo $k; ?></td>
    <td><?php echo $report_faq_detail['q'.$k]; ?></td>
    <td><?php echo $report_faq_detail['a'.$k]; ?></td>
    <td class="text-end">
        <div style="display:flex;"><a class="m-1" title="Edit Report" href="edit-report-faq?report_id=<?php echo base64_encode($report_faq_detail['rid']);?>&editq=<?php echo base64_encode($k);?>">
            <img src="<?php echo SITEADMIN."images/writing.png";?>" height="30" width="30"></a>
            <a class="m-1" title="Delete FAQ" href="delete-faq.php?faq_id=<?php echo base64_encode($report_faq_detail['rid'])."*".$report_faq_detail['fid']."*".$k."*".$qcnt;?>">
            <img src="<?php echo SITEADMIN."images/delete.png";?>" height="30" width="30"></a><?php //echo $report_faq_detail['fid'];?><?php //echo $report_faq_detail['q'.$k]; ?>
    </td>
</tr>
<?php  } ?>
<?php } ?>
<?php if($qcnt=="0" || empty($qcnt)){ ?>
<tr><td colspan="6" style="text-align:center;">No FAQ Found</td></tr>  
<?php }	?>
</tbody>

</table>

<style>
    .active1{
        background-color:#3d298a;
        color:#fff;
    }
</style>
