<?php 
require_once("classes/cls-paylink.php");


$obj_paylink = new Paylink();


$payid=$_GET['payid'];
$fields1="*";
$condition1="`predr_paylinkspr`.`payid`='".$payid."'";
$specific_pay_details=$obj_paylink->getPaylinkDetails($fields1, $condition1, '', '', 0);
    
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
                    

                            
                            
                                <?php foreach($specific_pay_details as $specific_pay_detail){ 
                                    if($specific_pay_detail['currency']=="USD")
                                    {
                                        $currency="$";
                                    }
                                    if($specific_pay_detail['currency']=="INR")
                                    {
                                        $currency="₹";
                                    }
                                ?>
                                <table class="table">
                                <tbody>
                                 <tr>
                                  
                                    <th class="thleftcol">Report Code</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['rcode']) && !empty($specific_pay_detail['rcode'])) ? $specific_pay_detail['rcode'] : "-"; ?></td>
                                 </tr>
                               <tr>
                                  
                                    <th class="thleftcol">Report Name</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['rname']) && !empty($specific_pay_detail['rname'])) ? $specific_pay_detail['rname'] : "-"; ?></td>
                                </tr>
                                
                                </tbody>
                                 </table>
                                 
                                <table class="table">
                                <tbody>
                                <tr>
                                    <th class="thleftcol">Client Name</th></thead><td class="tdrightcol"><?php echo (isset($specific_pay_detail['cname']) && !empty($specific_pay_detail['cname'])) ? $specific_pay_detail['cname'] : "-"; ?></td>
                                </tr>
                                <tr>
                                    <th class="thleftcol">Invoice</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['invoicenum']) && !empty($specific_pay_detail['invoicenum'])) ? $specific_pay_detail['invoicenum'] : "-"; ?></td>
                                </tr>
                                <tr>
                                    <th class="thleftcol">Client Company Name</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['company']) && !empty($specific_pay_detail['company'])) ? $specific_pay_detail['company'] : "-"; ?></td>
                                 </tr>
                                 </tbody>
                                 </table>
                                 <table class="table">
                                 <tbody>
                                <tr>
                                   <th class="thleftcol">Licence Type</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['ltype']) && !empty($specific_pay_detail['ltype'])) ? $specific_pay_detail['ltype'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                   <th class="thleftcol">Amount</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['amount']) && !empty($specific_pay_detail['amount'])) ? $currency.$specific_pay_detail['amount'] : "-"; ?></td>
                                 </tr>
                                 </tbody>
                                  <table class="table">
                                 <tbody>
                                 <tr>
                                   <th class="thleftcol">Description</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['rdesc']) && !empty($specific_pay_detail['rdesc'])) ? $specific_pay_detail['rdesc'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                   <th class="thleftcol">Additional Note</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['adnote']) && !empty($specific_pay_detail['adnote'])) ? $specific_pay_detail['adnote'] : "-"; ?></td>
                                 </tr>
                                 <tr>
                                     <th class="thleftcol">Created Date</th><td class="tdrightcol"><?php echo (isset($specific_pay_detail['createddate']) && !empty($specific_pay_detail['createddate'])) ? date("F d, Y",strtotime($specific_pay_detail['createddate'])) : "-"; ?></td>
                                 </tr>
                                  </tbody>
                            </table>
                            <?php }?>
                           
