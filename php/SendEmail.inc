<?php
/**
 * Last updated 03.26.2008 by Joshua Mills [mills.joshua@gmail.com]
 *
 * 03.26.2008 - Joshua Mills:
 * Added capabilities to mail attachments.
 *
 * 07.21.2008 - Joshua Mills:
 * Added override capabilities to the constants defined at the start of the script.
 *
 * 09.09.2009 - Joshua Mills:
 * Ignores the CC & BCC address composing areas if no such addresses are passed through
 */

if(!defined('FUNC_LIBRARY_URL')){
	/**
	 * The URL for remote including - if locally including, leave empty.
	 *
	 */
	define('FUNC_LIBRARY_URL','');//'http://pinkerton.joshuamills.net');
}
if(!defined('FUNC_LIBRARY_DIR')){
	/**
	 * The directory that the file resides in, whether locally or remotely.
	 *
	 */
	define('FUNC_LIBRARY_DIR','');
}
//http://pinkerton.joshuamills.net/core_files/SendEmail.inc
/**
 * Valid email addresses must be one or more abc@wx.yz format, separated by commas - http://us2.php.net/manual/en/function.mail.php
 *
 * @param string $address
 * @return boolean
 */
function valid_email($address){
	$items = explode(",",$address);
	$invalid = 0;
	for ($x=0;$x<count($items);$x++){
		$items[$x] = trim($items[$x]);
		$invalid = (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $items[$x]));
		$x = ($invalid) ? count($items) : $x;
	}
	return $invalid;
}
/**
 * Formats an email address to fit the SendEmail() requirements. Removes spaces, items should be CSV
 *
 * @param string_csv $address
 * @param boolean $returnarray
 * @return string/array
 */
function formatEmailAddress($address,$returnarray=false){
	$items = explode(",",$address);
	for($x=0;$x<count($items);$x++){
		$items[$x] = trim($items[$x]);
	}
	return ($returnarray) ? $items : implode(",", $items);
}
/**
 * Sends an email using the class.phpmailer.php class. Returns whether it was sent successfully.
 *
 * @param string/array[Name,Email] $to_emails
 * @param string/array[Name,Email] $from_emails
 * @param string $subject
 * @param string $message
 * @param boolean $html
 * @param boolean $testing
 * @param string/array $cc_emails
 * @param string/array $bcc_emails
 * @param array $attachments
 * @param string $nonHTMLMessage
 * @param bool $utf8Encode
 * @return boolean
 */
function SendEmail($to_emails, $from_emails, $subject, $message, $html=false, $testing=false, $cc_emails="", $bcc_emails="",$attachments=array(),$nonHTMLMessage='',$utf8Encode=false){
	//if not testing & office has emails on or it's a support...
	if (!$testing){
		//Grab the EmailMessage class
		if(strlen(FUNC_LIBRARY_URL) > 0){
			require_once(FUNC_LIBRARY_URL.'/'.FUNC_LIBRARY_DIR.'phpmailer/class.phpmailer.inc');
		} else {
			require_once(FUNC_LIBRARY_DIR.'phpmailer/class.phpmailer.inc');
		}
		//instantiate the mail class
		$mailer = new PHPMailer();
		if(is_array($to_emails)){
			$to_add = formatEmailAddress($to_emails['Email'], true); //create an array from the $from variable
			$to_name = explode(",",$to_emails['Name']);
		}else{
			$to_add = formatEmailAddress($to_emails, true); //create an array from the $to variable
			$to_name = array();
		}

		if(is_array($from_emails)){
			$from_add = formatEmailAddress($from_emails['Email'], true); //create an array from the $from variable
			$from_name = explode(",",$from_emails['Name']);
		} else {
			$from_add = formatEmailAddress($from_emails, true); //create an array from the $from variable
			$from_name = array();
		}
		$addingCCs = true;
		if(is_array($cc_emails)){
			$cc_add = formatEmailAddress($cc_emails['Email'], true); //create an array from the $from variable
			$cc_name = explode(",",$cc_emails['Name']);
		} else {
			if(!empty($cc_emails)){
				$cc_add = formatEmailAddress($cc_emails, true); //create an array from the $from variable
				$cc_name = array();
			} else {
				$addingCCs = false;
				$bcc_add = array();
			}
		}
		$addingBCCs = true;
		if(is_array($bcc_emails)){
			$bcc_add = formatEmailAddress($bcc_emails['Email'], true); //create an array from the $from variable
			$bcc_name = explode(",",$bcc_emails['Name']);
		} else {
			if(!empty($bcc_emails)){
				$bcc_add = formatEmailAddress($bcc_emails, true); //create an array from the $from variable
				$bcc_name = array();
			} else {
				$addingBCCs = false;
				$bcc_add = array();
			}
		}
		if(is_array($attachments)){
			if(count($attachments)){
				foreach($attachments as $attachedFile){
					if(is_array($attachedFile)){
						$mailer->AddAttachment($attachedFile['filename'],$attachedFile['name']);
					} else {
						$mailer->AddAttachment($attachedFile);
					}
				}
			}
		}
		$mailer->FromName = (count($from_name) > 0) ? $from_name[0] : '';
		$mailer->From = $from_add[0];
		$mailer->Sender = $from_add[0];
		$mailer->AddReplyTo($from_add[0]);
		$mailer->Subject = stripslashes($subject);

		$mailer->Body = $message;
		$mailer->isHTML($html);
		if($html && empty($nonHTMLMessage)){
			$altmessage = str_replace("&nbsp;",'',$message);
			$mailer->AltBody = stripslashes(strip_tags($altmessage));
		} else {
			$mailer->AltBody = stripslashes($nonHTMLMessage);
		}
		
		for($x=0;$x<count($to_add);$x++){
			$name = (count($to_name) > $x) ? $to_name[$x] : "";
			$name = ($utf8Encode) ? utf8_encode($name) : $name;
			$mailer->AddAddress($to_add[$x],$name);
		}

		if($addingCCs){
			for($x=0;$x<count($cc_add);$x++){
				$name = (count($cc_name) > $x) ? $cc_name[$x] : "";
				$name = ($utf8Encode) ? utf8_encode($name) : $name;
				$mailer->AddCC($cc_add[$x],$name);
			}
		}
		if($addingBCCs){
			for($x=0;$x<count($bcc_add);$x++){
				$name = (count($bcc_name) > $x) ? $bcc_name[$x] : "";
				$name = ($utf8Encode) ? utf8_encode($name) : $name;
				$mailer->AddBCC($bcc_add[$x],$name);
			}
		}
		if($utf8Encode){
			//encode the message into UTF-8
			$mailer->FromName = utf8_encode($mailer->FromName);
			$mailer->Subject = utf8_encode($mailer->Subject);
			$mailer->Body = utf8_encode($mailer->Body);
			$mailer->AltBody = utf8_encode($mailer->AltBody);
		}		
		$toreturn = ($mailer->Send()); //send out the email
		//clear the settings altered
		$mailer->ClearAllRecipients();
		$mailer->ClearAttachments();
		$mailer->IsHTML(false);
		return $toreturn;
	} else {
		return true; //testing the system(no emails going out), so we are setting it to return a false success
	}
}

?>