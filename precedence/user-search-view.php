<?php 
require_once("classes/cls-search.php");

$obj_search = new Search();

$searchid=$_GET['searchid'];
$fields1="*";
$condition1="`predr_search`.`search_id`='".$searchid."'";
$specific_search_details=$obj_search->getSearchDetails($fields1, $condition1, '', '', 0);
    
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
                    

                            
                            
                                <?php foreach($specific_search_details as $specific_search_detail){ ?>
                                <table class="table">
                                <tbody>
                                 
                                <tr>
                                   <th class="thleftcol">LEAD ID</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['search_id']) && !empty($specific_search_detail['search_id'])) ? $specific_search_detail['search_id'] : "-"; ?></td>
                                </tr>
                                 <tr>
                                     <th class="thleftcol">LEAD SEARCH REPORT</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['search_text']) && !empty($specific_search_detail['search_text'])) ? $specific_search_detail['search_text'] : "-"; ?></td>
                                 </tr>
                                <tr>
                                  
                                    <th class="thleftcol">LEAD Name</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['name']) && !empty($specific_search_detail['name'])) ? $specific_search_detail['name'] : "-"; ?></td>
                                 </tr>
                                <tr>
                                  
                                    <th class="thleftcol">LEAD EMAIL ID</th></thead><td class="tdrightcol"><?php echo (isset($specific_search_detail['email_id']) && !empty($specific_search_detail['email_id'])) ? $specific_search_detail['email_id'] : "-"; ?></td>
                                </tr>
                                <tr>
                                     <th class="thleftcol">LEAD PHONE NUMBER</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['phone_no']) && !empty($specific_search_detail['phone_no'])) ? $specific_search_detail['phone_no'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                     <th class="thleftcol">LEAD COUNTRY</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['country']) && !empty($specific_search_detail['country'])) ? $specific_search_detail['country'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                     <th class="thleftcol">LEAD COMPANY</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['company']) && !empty($specific_search_detail['company'])) ? $specific_search_detail['company'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                     <th class="thleftcol">LEAD DESIGNATION</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['designation']) && !empty($specific_search_detail['designation'])) ? $specific_search_detail['designation'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                     <th class="thleftcol">LEAD MESSAGE</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['message']) && !empty($specific_search_detail['message'])) ? $specific_search_detail['message'] : "-"; ?></td>
                                 </tr>
                                  <tr>
                                     <th class="thleftcol">LEAD IP ADDRESS</th><td class="tdrightcol"><?php echo (isset($specific_search_detail['ip_address']) && !empty($specific_search_detail['ip_address'])) ? $specific_search_detail['ip_address'] : "-"; ?></td>
                                 </tr>
                                </tbody>
                                 </table>
                                 
                               
                            <?php }?>
                           
