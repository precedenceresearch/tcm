<?php 
require_once("classes/cls-leads.php");
require_once("classes/cls-report.php");

$obj_report = new Report();
$obj_lead = new Lead();

$leadid=$_GET['leadid'];
$fields1="*";
$condition1="`predr_formdetails`.`id`='".$leadid."'";
$specific_lead_details=$obj_lead->getLeadDetails($fields1, $condition1, '', '', 0);
    
?>
<style>
   
.thleftcol { 
	background: #3498db!important; 
	color: white!important;
	font-weight: bold!important;
	padding: 10px!important;
	border: 1px solid #ccc!important;
	text-align: left!important;
	font-size: 14px!important;
	width:20%;
	}

.tdrightcol { 
	padding: 10px!important;
	border: 1px solid #ccc!important;
	text-align: left!important;
	font-size: 14px!important;
	}

</style>
                    

                            
                            
                                <?php foreach($specific_lead_details as $specific_lead_detail){ 
                                    if(isset($specific_lead_detail['report_id'])){
                                    $fields_report="report_id,slug,reportSubject,reportLDesc,meta_title";
                                    $condition_report="`predr_reports`.`report_id`='".$specific_lead_detail['report_id']."'";
                                    $report_detail_specifics=$obj_report->getReportDetails($fields_report,$condition_report,'','',0);
                                    $report_detail_specific=end($report_detail_specifics);
                                    }
                                    
                                ?>
                                <table class="table">
                                <tbody>
                                 <tr>
                                  
                                    <th class="thleftcol">Form Name</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['formname']) && !empty($specific_lead_detail['formname'])) ? $specific_lead_detail['formname'] : "-"; ?></td>
                                 </tr>
                               <tr>
                                  
                                    <th class="thleftcol">LEAD ID</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['id']) && !empty($specific_lead_detail['id'])) ? $specific_lead_detail['id'] : "-"; ?></td>
                                </tr>
                                <tr>
                                  
                                    <th class="thleftcol">Report ID</th></thead><td class="tdrightcol"><?php echo (isset($specific_lead_detail['report_id']) && !empty($specific_lead_detail['report_id'])) ? $specific_lead_detail['report_id'] : "-"; ?></td>
                                </tr>
                                 <tr>
                                    <th class="thleftcol">Report Title</th></thead><td class="tdrightcol"> <a href="<?php echo SITEPATH.'insights/'.$report_detail_specific['slug'];?>" target="_blank"> <?php echo (isset($report_detail_specific['reportSubject']) && !empty($report_detail_specific['reportSubject'])) ? $report_detail_specific['reportSubject'] : "-"; ?> </a></td>
                                </tr>
                                <tr>
                                     <th class="thleftcol">Lead IP Address</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['IPAddr']) && !empty($specific_lead_detail['IPAddr'])) ? $specific_lead_detail['IPAddr'] : "-"; ?></td>
                                 </tr>
                                </tbody>
                                 </table>
                                 
                                <table class="table">
                                <tbody>
                                 
                                <tr>
                                    <th class="thleftcol">Lead Name</th></thead><td class="tdrightcol"><?php echo (isset($specific_lead_detail['firstname']) && !empty($specific_lead_detail['firstname'])) ? $specific_lead_detail['firstname'] : "-"; ?></td>
                                </tr>
                                <tr>
                                    <th class="thleftcol">Email</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['email']) && !empty($specific_lead_detail['email'])) ? $specific_lead_detail['email'] : "-"; ?></td>
                                </tr>
                                <tr>
                                    <th class="thleftcol">Company</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['company']) && !empty($specific_lead_detail['company'])) ? $specific_lead_detail['company'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                    <th class="thleftcol">Designation</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['designation']) && !empty($specific_lead_detail['designation'])) ? $specific_lead_detail['designation'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                    <th class="thleftcol">Phone</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['phone']) && !empty($specific_lead_detail['phone'])) ? $specific_lead_detail['phone'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                    <th class="thleftcol">Address</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['address']) && !empty($specific_lead_detail['address'])) ? $specific_lead_detail['address'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                    <th class="thleftcol">City</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['city']) && !empty($specific_lead_detail['city'])) ? $specific_lead_detail['city'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                    <th class="thleftcol">State</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['state']) && !empty($specific_lead_detail['state'])) ? $specific_lead_detail['state'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                   <th class="thleftcol">Country</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['country']) && !empty($specific_lead_detail['country'])) ? $specific_lead_detail['country'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                   <th class="thleftcol">Zipcode</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['zipcode']) && !empty($specific_lead_detail['zipcode'])) ? $specific_lead_detail['zipcode'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                   <th class="thleftcol">Message</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['comments']) && !empty($specific_lead_detail['comments'])) ? $specific_lead_detail['comments'] : "-"; ?></td>
                                 </tr>
                                 </tbody>
                                 </table>
                                 <table class="table">
                                 <tbody>
                                 <tr>
                                   <th class="thleftcol">Price</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['price']) && !empty($specific_lead_detail['price'])) ? $specific_lead_detail['price'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                   <th class="thleftcol">Licence</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['licence']) && !empty($specific_lead_detail['licence'])) ? $specific_lead_detail['licence'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                   <th class="thleftcol">Payment Status</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['payment_status']) && !empty($specific_lead_detail['payment_status'])) ? $specific_lead_detail['payment_status'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                     <th class="thleftcol">Created Date</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['createddate']) && !empty($specific_lead_detail['createddate'])) ? date("F d, Y",strtotime($specific_lead_detail['createddate'])) : "-"; ?></td>
                                 </tr>
                                 <tr>
                                    <th class="thleftcol">Modified Date</th><td class="tdrightcol"><?php echo (isset($specific_lead_detail['modified_date']) && !empty($specific_lead_detail['modified_date'])) ? date("F d, Y",strtotime($specific_lead_detail['modified_date'])) : "-"; ?></td>
                                 </tr>
                                  </tbody>
                            </table>
                            <?php }?>
                           
