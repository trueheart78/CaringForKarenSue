<?php
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
	$emailBCC = "";
	$smptAvailable = ($_SERVER["HTTP_HOST"] != "localhost");
} else {
	$testSite = true;
	$emailFrom = array("Name"=>"CaringForKarenSue","Email"=>"auto@caringforkarensue.com");
	$emailTo = array("Name"=>"Kandi O'Connor","Email"=>"kandi3109@yahoo.com");
	$emailBCC = array("Name"=>"Josh Mills","Email"=>"mills.joshua@gmail.com");
	$smptAvailable = true;
}
//print ($testSite) ? "TEST":"LIVE";
//print ($smptAvailable) ? ":YES":":NO";
if(strstr($_SERVER["HTTP_REFERER"],$_SERVER["HTTP_HOST"])){
	require "php/SendEmail.inc";
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
	if(!empty($_GET['test_email'])){
		if($_GET['test_email'] == "mills.joshua@gmail.com"){
			$emailSubject = "Test Email from ".$_SERVER["HTTP_HOST"];
			$emailMessageHTML = "HTML";
			$emailMessageText = "Text";
			print "...";
			if(SendEmail($emailTo, $emailFrom, $emailSubject, $emailMessageHTML, false, "",$emailBCC,"",$emailMessageText)){
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
				$submittedRegistrants = "";
				$hasRegistrants = ($formData["formType"] == "registration");
				$submittedFor = ($formData["formType"] == "registration") ? "Player Registration" : "Hole Sponsor";
				if($hasRegistrants){
					$submittedRegistrants = $formData[$formData["formType"]."Selection"];
				}
				if(validateEmailAddress($submittedEmail)){
					//print $submittedName."\n".$submittedEmail."\n".$submittedFor."\n".$hasRegistrants."\n".$submittedRegistrants;
					$emailSubject = "New ".$submittedFor." from CaringForKarenSue.com";
					if($testSite){
						$emailSubject = "(test) ".$emailSubject;
					}
					$emailMessageHTML = "<div style='font-type:Arial;font-size:10pt;color:#000000;'>
					You have just received a {$submittedFor} from CaringForKarenSue.com<br>
					<br>
					Name: {$submittedName}<br> 
					Email: {$submittedEmail}<br>
					".(($hasRegistrants)?"Selected: {$submittedRegistrants}<br>":"")."
					<br>
					<span style='font-type:Courier New;font-size: 8pt;'>This request was received from IP address ".CONNECTING_IP_ADDRESS." at ".date("m.d.Y H:i:s")." using ".$_SERVER["HTTP_HOST"]."</span>
					</div>";
					$emailMessageText = "You have just received a {$submittedFor} from CaringForKarenSue.com
					Name: {$submittedName}
					Email: {$submittedEmail}".(($hasRegistrants)?"\nSelected: {$submittedRegistrants}":"")."
					
					This request was received from IP address ".CONNECTING_IP_ADDRESS." at ".date("m.d.Y H:i:s")." using ".$_SERVER["HTTP_HOST"]."";
					if($smptAvailable){
						SendEmail($emailTo, $emailFrom, $emailSubject, $emailMessageHTML, true, false,"",$emailBCC,"",$emailMessageText);
					}
					print "success";
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