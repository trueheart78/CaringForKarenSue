<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED); //show the errors but ignore notices and deprecations
ini_set('display_errors',1); //show the errors
define('REGEXP_EMAIL_ADDRESS',"^[a-zA-Z0-9_\.\'\!\#\$\%&\*+\/\=\?\^`\{\|\}\~\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\.\-]+$");
if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
	define("CONNECTING_IP_ADDRESS",$_SERVER['HTTP_X_FORWARDED_FOR']);
} else {
	define("CONNECTING_IP_ADDRESS",$_SERVER['REMOTE_ADDR']);
}
if($_SERVER["HTTP_HOST"] == "localhost" || stristr($_SERVER["HTTP_HOST"],"test.")){
	$testSite = true;
	$emailFrom = array("Name"=>"CaringForKarenSue (test)","Email"=>"auto@test.caringforkarensue.com");
	$emailTo = array("Name"=>"Josh Mills","Email"=>"mills.joshua@gmail.com");
	$emailCC = "";
	$emailBCC = "";
	$smptAvailable = ($_SERVER["HTTP_HOST"] != "localhost");
} else {
	$testSite = false;
	$emailFrom = array("Name"=>"CaringForKarenSue","Email"=>"auto@caringforkarensue.com");
	$emailTo = array("Name"=>"Kandi O'Connor","Email"=>"kandi3109@yahoo.com");
	$emailCC = array("Name"=>"Dave Danielson","Email"=>"daveydan21@yahoo.com");
	$emailBCC = array("Name"=>"Josh Mills","Email"=>"mills.joshua@gmail.com");
	$smptAvailable = true;
}
function cleanArray($uncleanArray){
	$newArray = array();
	if(count($uncleanArray)){
		foreach($uncleanArray as $key=>$val){
			if(!is_array($val)){
				$newArray[$key] = trim(stripslashes($val));
			} else {
				$newArray[$key] = cleanPostArray($val);
			}
		}
	}
	return $newArray;
}
function validateEmailAddress($email){
	global $userkey, $clientObject;
	$email = strtolower($email);
	$returnValue=false;
    if (eregi(REGEXP_EMAIL_ADDRESS, $email)){
       $returnValue = true;
    }
    return $returnValue;
}
	
//print ($testSite) ? "TEST":"LIVE";
//print ($smptAvailable) ? ":YES":":NO";
if(strstr($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"])){
	require "php/SendEmail.inc";
	if(!empty($_GET['test_email'])){
		if($_GET['test_email'] == "mills.joshua@gmail.com"){
			$emailSubject = "Test Email from ".$_SERVER["HTTP_HOST"];
			$emailMessageHTML = "HTML";
			$emailMessageText = "Text";
			print "...";
			if(SendEmail($emailTo, $emailFrom, $emailSubject, $emailMessageHTML, false, $emailCC,$emailBCC,"",$emailMessageText)){
				print "Sent!";
			} else {
				print "There's an error!";
			}
		}
	} else {
		if(count($_POST)){
			$formData = cleanArray($_POST);
			$missingData = false;
			foreach($formData as $key=>$val){
				if(!$missingData && empty($val)){
					$missingData = true;
				}
			}
			if(!$missingData){
				$submittedName = $formData[$formData["formType"]."Name"];
				$submittedEmail = $formData[$formData["formType"]."Email"];
				$submittedType = $formData[$formData["formType"]."Submission"];
				$submittedRegistrants = "";
				$hasRegistrants = ($formData["formType"] == "registration");
				$submittedFor = ($formData["formType"] == "registration") ? "Player Registration" : "Hole Sponsor";
				if($hasRegistrants){
					$submittedRegistrants = $formData[$formData["formType"]."Selection"];
				}
				//defulat hole sponsor cost
				$amountDue = 250;
				if($hasRegistrants){
					$numRegistrants = explode(" ",$submittedRegistrants);
					$amountDue = $numRegistrants[0] * 100;
				}
				if(validateEmailAddress($submittedEmail)){
					//print $submittedName."\n".$submittedEmail."\n".$submittedFor."\n".$hasRegistrants."\n".$submittedRegistrants;
					$emailSubject = "New ".$submittedFor." from CaringForKarenSue.com";
					if($testSite){
						$emailSubject = "(test) ".$emailSubject;
					}
					$emailMessageHTML = "<div style='font-type:Arial;font-size:10pt;color:#000000;'>
					You have just received a {$submittedFor} for the CaringForKarenSue.com 2nd Annual Golf Classic<br>
					<br>
					Name: {$submittedName}<br> 
					Email: {$submittedEmail}<br>
					Paying: {$submittedType}<br>
					Amount Due: \${$amountDue}<br>
					".(($hasRegistrants)?"Selected: {$submittedRegistrants}<br>":"")."
					<br>
					<span style='font-type:Courier New;font-size: 8pt;'>This request was received from IP address ".CONNECTING_IP_ADDRESS." at ".date("m.d.Y H:i:s")." using ".$_SERVER["HTTP_HOST"]."</span>
					</div>";
					$emailMessageText = "You have just received a {$submittedFor} for the CaringForKarenSue.com 2nd Annual Golf Classic
					Name: {$submittedName}
					Email: {$submittedEmail}
					Paying: {$submittedType}
					Amount Due: \${$amountDue}".(($hasRegistrants)?"\nSelected: {$submittedRegistrants}":"")."
					
					This request was received from IP address ".CONNECTING_IP_ADDRESS." at ".date("m.d.Y H:i:s")." using ".$_SERVER["HTTP_HOST"]."";
					if($smptAvailable){
						SendEmail($emailTo, $emailFrom, $emailSubject, $emailMessageHTML, true, false,$emailCC,$emailBCC,"",$emailMessageText);
					}
					if(strpos($submittedType,"PayPal") === 0){
						print "success_paypal";
					} else {
						$emailSubject = "Your ".$submittedFor." from CaringForKarenSue.com";
						if($testSite){
							$emailSubject = "(test) ".$emailSubject;
						}
						$emailMessageHTML = "<div style='font-type:Arial;font-size:10pt;color:#000000;'>
						You have just submitted a {$submittedFor} for the CaringForKarenSue.com 3rd Annual Golf Classic on Saturday, October 8th, 2011.<br>
						<br>
						Please send a check or money order in the amount of \${$amountDue} to:<br>
						<blockquote>1st Bank<br>
							PO Box 507<br>
							Arvada, CO 80001<br>
							<br>
							<i>Make your check or money order payable to:</i> Karen Sue Benefit Fund<br>
						</blockquote>
						<br>
						Name: {$submittedName}<br> 
						Email: {$submittedEmail}<br>
						Amount Due: \${$amountDue}<br>
						".(($hasRegistrants)?"Selected: {$submittedRegistrants}<br>":"")."
						<br>
						</div>";
						$emailMessageText = "You have just submitted a {$submittedFor} for the CaringForKarenSue.com 3rd Annual Golf Classic on Saturday, October 8th, 2011.

						Please send a check or money order in the amount of \${$amountDue} to:
						1st Bank
						PO Box 507
						Arvada, CO 80001
						
						Make your check or money order payable to: Karen Sue Benefit Fund
						
						Name: {$submittedName}
						Email: {$submittedEmail}
						Amount Due: \${$amountDue}
						".(($hasRegistrants)?"\nSelected: {$submittedRegistrants}":"")."";
						$emailTo = array("Name"=>$submittedName,"Email"=>$submittedEmail);
						if($smptAvailable){
							SendEmail($emailTo, $emailFrom, $emailSubject, $emailMessageHTML, true, false,"",$emailBCC,"",$emailMessageText);
						}
						print "success_check";
					}
				} else {
					print "invalid";
				}
			} else {
				print "missing";
			}
		} else {
			print "error";
		}
	}
}
?>