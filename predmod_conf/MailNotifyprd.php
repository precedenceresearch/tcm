<?php set_time_limit(0);
class userinfo{
    function userLogin($data) {
		global $db,$dbprefix;
		$userdata = array();
		$selQry = "SELECT UserId, Email_ID, FirstName FROM ".$dbprefix."users WHERE Email_ID = '". $data['email'] ."' AND Password = '" . $data['pass'] . "'";
		$rowqry = mysqli_query($db,$selQry) or die(mysqli_error($db));
		$userdata = mysqli_fetch_assoc($rowqry);
		return $userdata;
    }
	
    function isExistsEmail($email) {
		global $db,$dbprefix;
		$selQry = "SELECT Email_ID FROM ".$dbprefix."users WHERE Email_ID = '". $email ."'";
		$rowqry = mysqli_query($db,$selQry) or die(mysqli_error($db));
		$result = mysqli_fetch_row($rowqry);
		if($result) return true;
		return false;
    }
	
    function RegisterUserInfo($data) {
		global $db,$dbprefix;
		$saveQry = "INSERT INTO ".$dbprefix."users (Email_ID, FirstName, Password, CreatedDate) VALUES ('". $data['email'] ."','". $data['name'] ."','". $data['password'] ."', NOW())";
			$saveUser = mysqli_query($db,$saveQry) or die(mysqli_error($db));
		if($saveUser) return true;
		return false;
    }
	
	function SaveLeads($data=Array()) 
	{ 		     
		global $db,$dbprefix,$webheading,$shortname;
		global $prdurl,$leadmail,$tomail;
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone_no']) && ($_POST['email'] != ""))
		{
			 $formname = $_POST['formname'];
			 $userIP=$_SERVER['REMOTE_ADDR'];
			 mysqli_query($db,"SET NAMES utf8");
			 $qry = "INSERT INTO ".$dbprefix."formdetails(firstname,email,company,phone,designation,comments,formname,createddate,IPAddr) VALUES('".addslashes($_POST['name'])."','".$_POST['email']."','".$_POST['company']."','".$_POST['phone_no']."','".$_POST['desig']."','".addslashes($_POST['message'])."','".$formname."',NOW(),'$userIP')";
			 
			$result = @mysqli_query($db,$qry) or die(mysqli_error($db));
			
			if($result) 
			{														
				$from = "alex@towardshealthcare.com";
				$to = $tomail;
				
				$subject = $webheading."  :  ".ucfirst($formname)." Request";

				$message = '<TABLE  style="border:5px solid #222d65;  font-family: calibri; font-size:14px;"   border="1"  WIDTH="80%" CELLPADDING="8" CELLSPACING="0.1">
				<TR>
				<TH COLSPAN="2" style=" color:#FFF; background-color:#222d65;">Dear Team, You have a <H3> new Contact Query..</H3></TH>

				<TR>
				<TD style="padding-left:50px; width:30%;">Contact Person</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['name'].'</TD>
				</TR>
				<TR>
				<TD style="padding-left:50px; width:30%;">Email ID</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['email'].'</TD>
				</TR>
				<TR>
				<TD style="padding-left:50px; width:30%;">Phone No</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['phone_no'].'</TD>
				</TR>
				<TR>
				<TD style="padding-left:50px; width:30%;">Country</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['country'].'</TD>
				</TR>
				<TR>
				<TD style="padding-left:50px; width:30%;">Message</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold; text-align:justify;">'.$_POST['message'].'</TD>
				</TR> 

				</TABLE>';				
				
				$fnm = $_POST['name'];

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers .= 'From: '.$fnm.' <'.$from.'>'. "\r\n" .
						'Reply-To: '.$to. "\r\n" .
						'X-Mailer: PHP/' . phpversion();
				
				$this->SendMail($to,$message,$subject,$fnm);
				
				// mail($to, $subject, $message, $headers);
				
				$subject1= $formname." query at ".$webheading;
				$message1 = '<html><body>';
				$message1 .= '<table>';
				$message1 .= '<tr><td>Dear '.$fnm.',</td></tr>';
				
				$message1 .= "<tr>Hope you're doing well and thank you for showing interest in our report.</td></tr>";
				
				$message1 .= "<tr>I will be your single point of contact for all your queries relating to the </td></tr>";
				
				$message1 .= "<tr><td>Thank you for showing interest in Towards Healthcare. Your query has been successfully submitted and our Client Relations Manager will get in touch with you shortly.</td></tr>";
				
				$message1 .= '<tr><td></td></tr>';
				$message1 .= '<tr><td></td></tr>';
				
				$message1 .= '<tr><td>Alex Thomas</td></tr>';
				$message1 .= '<tr><td>Sales Manager | Towards Healthcare</td></tr>';
				$message1 .= '<tr><td>Email: Alex@towardshealthcare.com</td></tr>';
				$message1 .= '<tr><td>Contact: +1 774 402 6168 </td></tr>';
				$message1 .= '<tr><td>Alex Thomas</td></tr>';				
				$message1 .= '<tr><td>https://www.towardshealthcare.com</td></tr>';
				
				$message1 .= "</table>";
				$message1 .= "</body></html>";
				
				$headers1 = "MIME-Version: 1.0" . "\r\n";
				$headers1 .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers1 .= 'From: '.$from. "\r\n" .
				'Reply-To: '.$from. "\r\n" .
				'X-Mailer: PHP/' . phpversion();		
			
			 mail($_POST['email'], $subject1, $message1, $headers1);
			return true;
				
		}else {
			return false;
		}
	  
	}else{ return false; }		
  }
  
  	function SaveLeadsReport($data=Array()) 
	{ 		     
		global $db,$dbprefix,$webheading,$shortname;
		global $prdurl,$leadmail,$tomail;
		$ChkCorprateEmail = $this->FreeEmails($_POST['email']);
		if($ChkCorprateEmail==1){ return '33'; }
			
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone_no']) && ($_POST['email'] != ""))
		{	 if(isset($_POST['popup'])){  $formname = "Popup ".$_POST['formname']; }else{ $formname = $_POST['formname']; }
			 $userIP=$_SERVER['REMOTE_ADDR']; mysqli_query($db,"SET NAMES utf8");
			 $qry = "INSERT INTO ".$dbprefix."formdetails(report_id,firstname,email,phone,price,country,comments,formname,createddate,IPAddr) VALUES('".$_POST['prid']."','".addslashes($_POST['name'])."','".$_POST['email']."','".$_POST['phone_no']."','".$_POST['rprice']."','".$_POST['country']."','".addslashes($_POST['message'])."','".$formname."',NOW(),'".$userIP."')";			 
			 $result = @mysqli_query($db,$qry) or die(mysqli_error($db));			 
			if($result) 
			{														
				$from = "alex@towardshealthcare.com";
				$to = "alex@towardshealthcare.com";
				
				$subject = ucfirst($formname)." Request : ".$_POST['rname'];
				$rlink = $this->novalink($_POST['prid']); 
				$message = '<html><body>';
				
				$message = '<TABLE  style="border:5px solid #222d65;  font-family: calibri; font-size:14px;"   border="1"  WIDTH="80%" CELLPADDING="8" CELLSPACING="0.1">
				<TR>
				<TH COLSPAN="2" style=" color:#FFF; background-color:#222d65;">Dear Admin,You have a
				<H3> new Contact Query..</H3></TH>

				<TR>
				<TD style="padding-left:50px; width:30%;">Client Name</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['name'].'</TD>
				</TR>
				<TR>
				<TD style="padding-left:50px; width:30%;">Email ID</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['email'].'</TD>
				</TR>
				<TR>
				<TD style="padding-left:50px; width:30%;">Phone No</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['phone_no'].'</TD>
				</TR>

				<TR>
				<TD style="padding-left:50px; width:30%;">Country</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold;">'.$_POST['country'].'</TD>
				</TR>
				<TR>
				<TD style="padding-left:50px; width:30%;">Message</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold; text-align:justify;">'.$_POST['message'].'</TD>
				</TR>
				
				<TR>
				<TD style="padding-left:50px; width:30%;">Report Title :</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold; text-align:justify;">'.$_POST['rname'].'</TD>
				</TR>
				
				<TR>
				<TD style="padding-left:50px; width:30%;">Report Link :</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold; text-align:justify;"><a href='.$rlink.'>'.$rlink.'</a></TD>
				</TR>
				</TABLE>';
				$message .= "</body></html>";
				
				
				$msg = '<TABLE  style="border:5px solid #222d65;  font-family: calibri; font-size:14px;"   border="1"  WIDTH="80%" CELLPADDING="8" CELLSPACING="0.1">
				<TR>
				<TH COLSPAN="2" style=" color:#FFF; background-color:#222d65;">Dear team,You have a <H3> new Contact Query..</H3></TH>
				
				<TR>
				<TD style="padding-left:50px; width:30%;">Message</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold; text-align:justify;">'.$_POST['message'].'</TD>
				</TR>
				
				<TR>
				<TD style="padding-left:50px; width:30%;">Report Title :</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold; text-align:justify;">'.$_POST['rname'].'</TD>
				</TR>
				
				<TR>
				<TD style="padding-left:50px; width:30%;">Report Link :</TD>
				<TD style="padding-left:50px; width:70%; font-weight:bold; text-align:justify;"><a href='.$rlink.'>'.$rlink.'</a></TD>
				</TR>
				</TABLE>';
				
				$msg .= "</body></html>";
				
				$fnm = $_POST['name'];

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers .= 'From: '.$fnm.' <'.$from.'>'. "\r\n" .
						'Reply-To: '.$to. "\r\n" .
						'X-Mailer: PHP/' . phpversion();
				
				$this->SendMail($to,$message,$subject,$fnm);
				
				/* $toa="garima@towardshealthcare.com";
				
				$this->SendMail($toa,$msg,$subject,$fnm); */
				
				$subject1= $formname." Request at ".$_POST['rname'];
				$message1 = '<html><body>';
				$message1 .= '<table>';
				$message1 .= '<tr><td>Dear '.$fnm.',</td></tr>';
				$message1 .= '<tr><td></td></tr>';
				$message1 .= "<tr>Hope you're doing well and thank you for showing interest in our report.</td></tr>";
				$message1 .= '<tr><td></td></tr>';
				$message1 .= "<tr>I will be your single point of contact for all your queries relating to the ".$_POST['rname']."</td></tr>";
				$message1 .= '<tr><td></td></tr>';
				$message1 .= "<tr><td>My research team is working on your request and I shall share a sample with you very shortly for the same.</td></tr>";
				$message1 .= '<tr><td></td></tr>';
				$message1 .= "<tr><td>Request you to allow me a few hours and I shall respond to you at the earliest.</td></tr>";
				
				$message1 .= '<tr><td></td></tr>';
				$message1 .= '<tr><td></td></tr>';
				
				$message1 .= '<tr><td>Alex Thomas</td></tr>';
				$message1 .= '<tr><td>Sales Manager | Towards Healthcare</td></tr>';
				$message1 .= '<tr><td>Email: Alex@towardshealthcare.com</td></tr>';
				$message1 .= '<tr><td>Contact: +1 774 402 6168 </td></tr>';
				$message1 .= '<tr><td>Alex Thomas</td></tr>';				
				$message1 .= '<tr><td>https://www.towardshealthcare.com</td></tr>';
				
				$message1 .= "</table>";
				$message1 .= "</body></html>";
				
				$headers1 = "MIME-Version: 1.0" . "\r\n";
				$headers1 .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers1 .= 'From: '.$from. "\r\n" .
				'Reply-To: '.$from. "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				mail($_POST['email'], $subject1, $message1, $headers1);
			    return '11';
		}else{ return true; }
	}else{ return false; }	
  }
  
  function buynowreport($data=Array()) 
  { 		     
	 global $db,$dbprefix,$webheading;
	 global $prdurl,$leadmail,$tomail;
	 if(isset($_POST['phone_no']) && isset($_POST['email']) && isset($_POST['name']) && ($_POST['email'] != ""))
	 {
		 $formname = 'Buy Now ';
		 $userIP=$_SERVER['REMOTE_ADDR'];
		 mysqli_query($db,"SET NAMES utf8");	
	
		$qry = "INSERT INTO ".$dbprefix."formdetails(report_id,firstname,email,phone,designation,zipcode,city,price,licence,country,formname,createddate,IPAddr) VALUES('".$_POST['prid']."','".addslashes($_POST['name'])."','".$_POST['email']."','".$_POST['phone_no']."','".$_POST['desig']."','".$_POST['zipcode']."','".$_POST['city']."','".$_POST['rprice']."','".$_POST['ltype']."','".$_POST['country']."','".$formname."',NOW(),'$userIP')";

		 $result = @mysqli_query($db,$qry) or die(mysqli_error($db));
			
		  if($result) 
		  {		
				$from = "sales@towardshealthcare.com";
				$to = "alex@towardshealthcare.com";
				
				$subject = $formname.$_POST['rname'];
				$rlink = $this->novalink($_POST['prid']); 
				$paymethod = ucfirst($_POST['pay_method']);
				
				$message = '<html><body>';
				$message .= '<table>';
				$message .= '<tr><td width="100px"><b>Name : </b></td><td><b>'.$_POST['name'].'</b></td></tr>';
				$message .= '<tr><td width="100px">Email : </td><td>'.$_POST['email'].'</td></tr>';
				$message .= '<tr><td width="100px">Phone : </td><td>'.$_POST['phone_no'].'</td></tr>';
				$message .= '<tr><td width="100px">Designation : </td><td>'.$_POST['desig'].'</td></tr>';
				$message .= '<tr><td width="100px">City : </td><td>'.$_POST['city'].'</td></tr>';					
				$message .= '<tr><td width="100px">Zipcode : </td><td>'.$_POST['zipcode'].'</td></tr>';
				$message .= '<tr><td width="100px">Country : </td><td>'.$_POST['country'].'</td></tr>';
				$message .= '<tr><td width="100px">Report Title : </td><td>'.$_POST['rname'].'</td></tr>';
				$message .= '<tr><td width="100px">Report Price : </td><td>$'.$_POST['rprice'].'</td></tr>';
				$message .= '<tr><td width="100px">Licence Type : </td><td>'.$_POST['ltype'].'</td></tr>';
				$message .= '<tr><td width="100px">Payment Method : </td><td>'.$paymethod.'</td></tr>';
				$message .= '<tr><td width="100px">Report Link : </td><td><a href='.$rlink.'>'.$rlink.'</a></td></tr>';
					
				$message .= "<tr><td></td></tr>";
				$message .= "<tr><td></td></tr>";
				$message .= "<tr><td><strong>Regards,</strong></td></tr>";
				$message .= "<tr><td><strong>Towards Healthcare</strong></td></tr>";
				$message .= "</table>";
				$message .= "</body></html>";
				
				$msg = '<html><body>';
				$msg .= '<table>';
				$msg .= '<tr><td width="100px">City : </td><td>'.$_POST['city'].'</td></tr>';					
				$msg .= '<tr><td width="100px">Zipcode : </td><td>'.$_POST['zipcode'].'</td></tr>';
				$msg .= '<tr><td width="100px">Country : </td><td>'.$_POST['country'].'</td></tr>';
				$msg .= '<tr><td width="100px">Report Title : </td><td>'.$_POST['rname'].'</td></tr>';
				$msg .= '<tr><td width="100px">Report Price : </td><td>$'.$_POST['rprice'].'</td></tr>';
				$msg .= '<tr><td width="100px">Licence Type : </td><td>'.$_POST['ltype'].'</td></tr>';
				$msg .= '<tr><td width="100px">Report Link : </td><td><a href='.$rlink.'>'.$rlink.'</a></td></tr>';
					
				$msg .= "<tr><td></td></tr>";
				$msg .= "<tr><td></td></tr>";
				$msg .= "<tr><td><strong>Regards,</strong></td></tr>";
				$msg .= "<tr><td><strong>Towards Healthcare</strong></td></tr>";
				$msg .= "</table>";
				$msg .= "</body></html>";
				
				
				$fnm = $_POST['name'];

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=utf-8" . "\r\n";
				$headers .= 'From: '.$fnm.' <'.$from.'>'. "\r\n" .
						'Reply-To: '.$from. "\r\n" .
						'X-Mailer: PHP/' . phpversion();
				
				$this->SendMail($to,$message,$subject,$fnm);
				
				//$toa="lalit@towardshealthcare.com";				
				//$this->SendMail($toa,$msg,$subject,$fnm);
				
				/* $subject1= $formname." Request at ".$webheading;
				$message1 = '<html><body>';
				$message1 .= '<table>';
				$message1 .= '<tr><td>Dear '.$fnm.',</td></tr>';
				$message1 .= "<tr><td>Thank you for showing interest in Towards Healthcare. Your query has been successfully submitted and our Client Relations Manager will get in touch with you shortly.</td></tr>";
				$message1 .= '<tr><td></td></tr>';
				$message1 .= '<tr><td></td></tr>';

				$message1 .= '<tr><td>Alex Thomas</td></tr>';
				$message1 .= '<tr><td>Sales Manager | Towards Healthcare</td></tr>';
				$message1 .= '<tr><td>Email: Alex@towardshealthcare.com</td></tr>';
				$message1 .= '<tr><td>Contact: +1 774 402 6168 </td></tr>';
				$message1 .= '<tr><td>Alex Thomas</td></tr>';				
				$message1 .= '<tr><td>https://www.towardshealthcare.com</td></tr>';
				
				$message1 .= "</table>";
				$message1 .= "</body></html>";
					
				 $headers1 = "MIME-Version: 1.0" . "\r\n";
				 $headers1 .= "Content-type:text/html;charset=utf-8" . "\r\n";
				 $headers1 .= 'From: '.$from. "\r\n" .
				 'Reply-To: '.$from. "\r\n" .
				 'X-Mailer: PHP/' . phpversion();		
				
				 mail($_POST['email'], $subject1, $message1, $headers1); */
				 
				return $_POST['rprice'];
				
			}else{ return false; }
		  
		}else{ return false; }		
	}
	 
  	function novalink($newsId){
		global $db,$dbprefix,$prdurl;
		$sql = "select customName,newsId from ".$dbprefix."reports where IsActive=1 and newsId=".$newsId;
		$result = mysqli_query($db,$sql) or die(mysqli_error($db));
		$row = mysqli_fetch_array($result);
		if(!empty($row)){
			$link=$prdurl.$row['customName'];
		}
		return $link;
	}
	
   function SendMail($to,$msg,$subject,$name){
	require_once('mailer/PHPMailerAutoload.php');
	$from = 'alex@towardshealthcare.com';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtpout.secureserver.net';
	$mail->SMTPAuth = true;
	$mail->Username = "sean.keenan@towardshealthcare.com";
	$mail->Password = "amrutapred@#11990";
	$mail->SMTPSecure = 'tls';
	$mail->Port = 3535;
	$mail->setFrom('alex@towardshealthcare.com', $name);
	$mail->addAddress($to);
	$mail->AddReplyTo($from);
	$mail->isHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $msg;	
	$mail->send();
  }
  
  function FreeEmails($email){
	  $Domain = explode("@",trim($email)); 
	  $DomainEmail = trim($Domain[1]);
	  $EmailArr = array("spam.com", "junk.com","gmail.com","yahoo.com","hotmail.com","aol.com","hotmail.co.uk","hotmail.fr","msn.com","yahoo.fr","wanadoo.fr","orange.fr","comcast.net","yahoo.co.uk","yahoo.com.br","yahoo.co.in","live.com","rediffmail.com","free.fr","gmx.de","web.de","yandex.ru","ymail.com","libero.it","outlook.com","uol.com.br","bol.com.br","mail.ru","cox.net","hotmail.it","sbcglobal.net","sfr.fr","live.fr","verizon.net","live.co.uk","googlemail.com","yahoo.es","ig.com.br","live.nl","bigpond.com","terra.com.br","yahoo.it","neuf.fr","yahoo.de","alice.it","rocketmail.com","att.net","laposte.net","facebook.com","bellsouth.net","yahoo.in","hotmail.es","charter.net","yahoo.ca","yahoo.com.au","rambler.ru","hotmail.de","tiscali.it","shaw.ca","yahoo.co.jp","sky.com","earthlink.net","optonline.net","freenet.de","t-online.de","aliceadsl.fr","virgilio.it","home.nl","qq.com","telenet.be","me.com","yahoo.com.ar","tiscali.co.uk","yahoo.com.mx","voila.fr","gmx.net","mail.com","planet.nl","tin.it","live.it","ntlworld.com","arcor.de","yahoo.co.id","frontiernet.net","hetnet.nl","live.com.au","yahoo.com.sg","zonnet.nl","club-internet.fr","juno.com","optusnet.com.au","blueyonder.co.uk","bluewin.ch","skynet.be","sympatico.ca","windstream.net","mac.com","centurytel.net","chello.nl","live.ca","aim.com","bigpond.net.au",".edu","test.com","test.in");
	  if(in_array($DomainEmail, $EmailArr)){
		  return '1';
	  }
  }
  
}