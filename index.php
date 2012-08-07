<!DOCTYPE html>
<html lang="en">
<head><title>Caring For Karen Sue</title>
<style>
html, body {
	background-color: #975371; /*#f287b7;*/
	color: #000000;
	font-size: 12pt;
	font-family: 'Arial';
	margin: 0;
}
/* Portrait */
@media screen and (max-width: 320px)
{
	h1 { font-size: 1.2em; line-height: 1.2em; }
}
/* Landscape */
@media screen and (min-width: 321px)
{
	h1 { font-size: 1.4em; line-height: 1.4em; }
}
@media screen and (min-device-width: 320px) and (max-device-width: 480px) and (orientation: portrait) {
	/* iPhone portrait targeted */
	aside {
		display: table-row;
		float: left;
		width: 90%;
	}
}
@media screen and (min-device-width: 320px) and (max-device-width: 480px) and (orientation: landscape) {
/* iPhone landscape targeted */
	aside {
		float: right;
		display: table-column;
		width: 100px;
	}
}
form { margin: 0; }
a:link { color:red; text-decoration:underline; }
a:visited { color:red; text-decoration:underline; }
a:hover { color:red; text-decoration:underline; }
a:active { color:red; text-decoration:underline; }

a.footerLink:link    { color: #FFFFFF; text-decoration: underline; }
a.footerLink:visited { color: #FFFFFF; text-decoration: underline; }
a.footerLink:hover   { color: #FF0000; text-decoration: underline; }
a.footerLink:active  { color: #FFFFFF; text-decoration: underline; }

a.pink:link    { color: #f287b7; text-decoration: underline; }
a.pink:visited { color: #f287b7; text-decoration: underline; }
a.pink:hover   { color: #f287b7; text-decoration: underline; }
a.pink:active  { color: #f287b7; text-decoration: underline; }

.sponsorLink{
	float: left;
	margin-left: 10px;
	margin-right: 5px;
	cursor: pointer;
	font-weight: bold;
	color: #f287b7;
	font-size: 14pt;
	text-decoration: underline;
}
.title {
	font-weight: bold;
	color: #f287b7;
	font-size: 14pt;
}
.pink {
	color: #f287b7;
}
.link {
	text-decoration: underline;
	cursor: pointer;
}
#header {
	width:994px;
}
#body {
	border: 0px black solid;
	padding-left:27px;
}
#footerImage {
	width:994px;
	padding: 0;
	margin: 0;
}
#footerContent {
	width:994px;
	padding-left: 37px;
	padding-bottom: 20px;
	margin: 0;
	color: #FFFFFF;
	text-align: center;
}
#formContentLinks {
	padding-left:23.5px;
}
#content {
	padding:10px;	
	width:724px;
	border: 0px red solid;
	text-align: justify;
	background-color: #FFFFFF;
}
#nav {
	padding:10px 5px 5px 5px;	
	width:192px;/*remember the 27px padding above for the #body the 10px for #content*/
	border: 0px green solid;
	background-color: #FFFFFF;
	text-align: left;
}
#formContentDonate, #formContentSponsor, #formContentRegister {
	display: none;
	background-color: #FFFFFF; /*#854f67;*/
	height: 250px;
	width: 714px;
	margin-left:10px;
	padding: 5px;
	margin-bottom: 5px;
	border: 1px pink solid;
	text-align: center;
	z-index: -10;
}
.button {
	background-image: url('images/button.png');
	padding: 6px 0px 6px 0px;
	margin: 0 14.5px;
	color: #ffffff;
	width: 160px;
	height: 19px;
	background-repeat: no-repeat;
	text-align: center;
	float: left;
	font-weight: 600;
	cursor:pointer;
	border: 0px black solid;
}
.pinkBanner {
	background-image: url('images/PinkBanner_80px.png');
	background-repeat: no-repeat;
	width: 696px;
	height: 70px;
	color: #ffffff;
	padding: 11px 15px 5px;
	margin: 10px 10px 2px;
	text-align:left;
	border: 0px black solid;
}

.pinkBanner_ {
	background-color: #f287b7;
	color: #ffffff;
	padding: 5px 10px;
	margin: 5px 10px;
}
.formInput {
	border: 1px #f287b7 solid;
	color: #000000;
	padding: 2px;
	width: 200px;
}
</style>
</head>
<body>
<script>
function displayFormContent(contentToShow){
	switch(contentToShow){
		case "Donate":
			if ( !$('#formContentDonate').is(':visible')){
				$('#content').slideUp();
				$('#formContentDonate').slideDown();
				$('#formContentSponsor').slideUp();
				$('#formContentRegister').slideUp();
			}
			break;
		case "Sponsor":
			if ( !$('#formContentSponsor').is(':visible')){
				$('#content').slideUp();
				$('#formContentDonate').slideUp();
				$('#formContentSponsor').slideDown();
				$('#formContentRegister').slideUp();
			}
			break;
		case "Register":
			if ( !$('#formContentRegister').is(':visible')){
				$('#content').slideUp();
				$('#formContentDonate').slideUp();
				$('#formContentSponsor').slideUp();
				$('#formContentRegister').slideDown();
			}
			break;
		default:
			$('#formContentDonate').slideUp();
			$('#formContentSponsor').slideUp();
			$('#formContentRegister').slideUp();
			$('#content').slideDown();
			break
	}
}
function syncRegistrationValues(){
	$('#paypalRegistrationSelection').val($('#registrationSelection').val());
}
function displaySubmissionButtons(){
	changeSubmissionButton("registration");
	changeSubmissionButton("sponsor");
}
function changeSubmissionButton(formType){
	var formInputClass = formType+"Input";
	var formID = formType+"Form";
	switch($('#'+formType+'Submission').val()){
		case "PayPal/CC":
			$('#'+formType+'PayPalDiv').slideDown();
			$('#'+formType+'CheckDiv').slideUp();
			break;
		case "Check/MoneyOrder":
			$('#'+formType+'PayPalDiv').slideUp();
			$('#'+formType+'CheckDiv').slideDown();
			break;
		default:
			$('#'+formType+'PayPalDiv').slideUp();
			$('#'+formType+'CheckDiv').slideUp();
			break;
	}
}
function submitForm(formType){
	var formInputClass = formType+"Input";
	var formID = formType+"Form";
	var formSubmissionID = formType+"Submission";
	if($("#"+formSubmissionID).val() == ""){
		alert("Please select your intended payment type.");
	} else {
		$.ajax({
			url: "form_handler.php",
			global: false,
			type: "POST",
			data: $("."+formInputClass).serialize(),
			async: false,
			beforeSend: function(){
				jQuery("#"+formType+"PaypalButtonImage").hide();
				jQuery("#"+formType+"PaypalSpinnerImage").show();
			},
			complete: function(){
				//alert("done!")
			},
			success: function(responseText){
				if(responseText.indexOf('success_paypal') == 0){
					$('#'+formID).submit();
				} else if(responseText.indexOf('success_check') == 0){
					$('#'+formType+'PayPalDiv').slideUp();
					$('#'+formType+'CheckDiv').slideUp();
					$('#'+formType+'CheckDivResponse').slideDown();
				} else if(responseText == 'missing'){
					alert("Please fill out all fields on the form.");
					jQuery("#"+formType+"PaypalButtonImage").show();
					jQuery("#"+formType+"PaypalSpinnerImage").hide();
				} else if(responseText == 'invalid'){
					alert("Please enter a valid email address.");
					jQuery("#"+formType+"PaypalButtonImage").show();
					jQuery("#"+formType+"PaypalSpinnerImage").hide();
				} else if(responseText == 'error'){
					alert("There was an error submitting your request\\n\\nPlease try again shortly.");
					jQuery("#"+formType+"PaypalButtonImage").show();
					jQuery("#"+formType+"PaypalSpinnerImage").hide();
				} else {
					alert(responseText);
					jQuery("#"+formType+"PaypalButtonImage").show();
					jQuery("#"+formType+"PaypalSpinnerImage").hide();
				}
			},
			error: function(){
				alert("There was an error submitting your request - please try again shortly.");
			}
		});
	}
}
</script>
<div align="center">
	<div style="width:994px;background-color:#FFFFFF;color:#000000;">
		<div id="header">
			<img src="images/Banner.png" width="974" height="165" border="0" alt="">
		</div>
		<div id="formContentLinks">
			<div class="button" onclick="displayFormContent('Register');">Register to Play</div>
			<div class="button" onclick="displayFormContent('Sponsor');">Sponsor a Hole</div>
			<div class="button" onclick="displayFormContent('Donate');">Make a Donation</div>
			<div class="button" onclick="displayFormContent('');">Read Her Story</div>
			<div style="clear:both;"></div>
		</div>
	</div>
	<div style="width:994px;background-color:#FFFFFF;color:#000000;">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr><td id="body" valign="top">
			<div class="pinkBanner">
				Please join us for the 3rd annual Caring for Karen Sue Golf Classic. A four man best
				ball/scramble type tournament.  There will be competitions for: the longest putt, and
				the closest to pin, a par three challenge and the longest drive.  Enjoy prizes, food, and a raffle/silent auction!
			</div>

			<div id="formContentDonate">
				<span class="title">Make a Donation</span><br>
				<br>
				Every little bit helps, and we can't thank you enough for your generosity.<br>
				<br>
				<form id="donationForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
				
				<div id="donationCheckDivResponse" style="display:none;">
					<span class="title">Thank You</span><br>
					An email has been sent to you with details on mailing in your donation.
				</div>
			</div>
			<div id="formContentSponsor" >
				<span class="title">Sponsor a Hole</span><br>
				<br>
				For a $250 donation, you can sponsor a hole.<br>
				<br>
				<input type="hidden" class="sponsorInput" name="formType" value="sponsor">
				<div align="center">
					<table style="width:300px;" cellspacing="0">
					<tr>
						<td align="right">Name:&nbsp;</td>
						<td align="left"><input type="input" class="formInput sponsorInput" name="sponsorName" value=""></td>
					</tr>
					<tr>
						<td align="right">Email:&nbsp;</td>
						<td align="left"><input type="email" class="formInput sponsorInput" name="sponsorEmail" value=""></td>
					</tr>
					<tr>
						<td align="right">Pay Using:&nbsp;</td>
						<td align="left"><select name="sponsorSubmission" id="sponsorSubmission"  class="formInput sponsorInput" onchange="changeSubmissionButton('sponsor');" onblur="changeSubmissionButton('sponsor');">
							<option value="">-- Select Payment Method --</option>
							<option value="PayPal/CC">PayPal or Credit Card</option>
							<option value="Check/MoneyOrder">Check or Money Order</option>
							</select></td>
					</tr>
					<tr>
						<td align="right">&nbsp;</td>
						<td align="left">
							<div id="sponsorPayPalDiv" style="display:none;margin-top:8px;">
								<form id="sponsorForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
								">
								<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
								</form>
							</div>
							<div id="sponsorCheckDiv" style="display:none;margin-top:8px;">
								<div class="button" onclick="submitForm('sponsor');">Sponsor a Hole</div>
							</div>
						</td>
					</tr>
					</table>
					<div id="sponsorCheckDivResponse" style="display:none;">
						<span class="title">Thank You</span><br>
						An email has been sent to you with details on mailing in your sponsorship donation.
					</div>
				</div>
			</div>
			<div id="formContentRegister">
				<span class="title">Register to Play</span><br>
				<br>
				Registration is $100 per player.<br>
				<br>
				<input type="hidden" class="registrationInput" name="formType" value="registration">
				<div align="center">
					<table style="width:350px;" cellspacing="0">
					<tr>
						<td align="right">Name:&nbsp;</td>
						<td align="left"><input type="input" class="formInput registrationInput" name="registrationName" value=""></td>
					</tr>
					<tr>
						<td align="right">Email:&nbsp;</td>
						<td align="left"><input type="email" class="formInput registrationInput" name="registrationEmail" value=""></td>
					</tr>
					<tr>
						<td align="right">Players:&nbsp;</td>
						<td align="left"><select name="registrationSelection" id="registrationSelection"  class="formInput registrationInput" onchange="syncRegistrationValues();" onblur="syncRegistrationValues();">
							<option value="1 Registrant">1 Registrant - $100.00</option>
							<option value="2 Registrants">2 Registrants - $200.00</option>
							<option value="3 Registrants">3 Registrants - $300.00</option>
							<option value="4 Registrants">4 Registrants - $400.00</option>
							<option value="5 Registrants">5 Registrants - $500.00</option>
							<option value="6 Registrants">6 Registrants - $600.00</option>
							<option value="7 Registrants">7 Registrants - $700.00</option>
							<option value="8 Registrants">8 Registrants - $800.00</option>
							<option value="9 Registrants">9 Registrants - $900.00</option>
							<option value="10 Registrants">10 Registrants - $1,000.00</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="right">Pay Using:&nbsp;</td>
						<td align="left"><select name="registrationSubmission" id="registrationSubmission"  class="formInput registrationInput" onchange="changeSubmissionButton('registration');" onblur="changeSubmissionButton('registration');">
							<option value="">-- Select Payment Method --</option>
							<option value="PayPal/CC">PayPal or Credit Card</option>
							<option value="Check/MoneyOrder">Check or Money Order</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
							<div id="registrationPayPalDiv" style="display:none;margin-top:8px;">
								<form  id="registrationForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="on0" value="# Registrants">
								<input type="hidden" name="os0" id="paypalRegistrationSelection" value="1 Registrant">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
								">
								<img style="cursor:pointer;" id="registrationPaypalButtonImage" onclick="syncRegistrationValues();submitForm('registration');" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">
								<img src="images/ajax-loader.gif" id="registrationPaypalSpinnerImage" style="display:none;">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
								</form>
							</div>
							<div id="registrationCheckDiv" style="display:none;margin-top:8px;">
								<div class="button" onclick="syncRegistrationValues();submitForm('registration');">Register to Play</div>
							</div>
						</td>
					</tr>
					</table>
					<div id="registrationCheckDivResponse" style="display:none;">
						<span class="title">Thank You</span><br>
						An email has been sent to you with details on mailing in your registration.
					</div>
				</div>
			</div>
			<div id="content">
				<span class="title">About Karen Sue</span><br>
				Three years ago in July of 2009 Karen Danielson (our Mother) was diagnosed with Stage 3B Inflammatory Breast Cancer (IBC).  IBC is not detectable on Mammograms, so usually by the time it is diagnosed, as with our Mother, it has already spread.  When cancer has spread the doctors are not blessed with protocols that give you hope.
				<br>
				<br> 
				However, many of you helped us to provide our Mother hope with alternative treatments. For 2 years our Mother fought for her life in the most humble way that it was hard to understand at times. She never doubted her faith that God was in control and that she wanted to live. She lost her battle to cancer in September of 2011. 
				<br>
				<br>
				We used to think we were helping her by giving her hope, but after she passed we realized that she was helping us.  She was teaching us a lesson in life and love that we will never forget.  She would not let the cancer define her and write her story for her.  She spoke of what her future would hold up until the day she closed her eyes to never open them again.  Although, she couldn’t mask the pain we would all feel from losing her, but to understand and be proud of how she fought was the best type of healing we could have received.
				<br>
				<br> 
				We are working to get her treatment bills paid off and we want to continue this benefit in her honor and support something very close to her heart and that is kids in need.  Our family has been very involved in the Social Services and both our parents and grandparents were foster parents to many children.  We want to continue that legacy in our Mother’s name to help these children.
			</div>
		</td><td id="nav" valign="top">
			<div>
				<div>
				<span class="title">WHEN:</span><br>
				Saturday, Sept 8, 2012<br>
				7:30 am Shot Gun Start
				</div>
				
				<div style='margin-top:20px;'>
				<span class="title">WHERE:</span><br>
				Applewood Golf Course<br> 	 
				14001 W. 32<sup>nd</sup> Avenue<br>
				Golden, CO 80401<br>
				<!-- <a href="http://applewoodgc.com/" target="_blank">Visit Website</a><br> -->
				<a href="https://maps.google.com/maps?q=applewood+golf+course,+Golden,+CO+80401&hl=en&sll=40.365277,-82.669252&sspn=6.30214,10.535889&hq=applewood+golf+course,+Golden,+CO+80401&t=m&z=16">View on Map</a>
				</div>
				
				<div style='margin-top:20px;'>
				<span class="title">YOU CAN HELP BY:</span><br>
				<span class="pink link" onclick="displayFormContent('Register');">Registering to Play</span><br> 	 
				<span class="pink link" onclick="displayFormContent('Sponsor');">Sponsoring a Hole</span><br> 	 
				<span class="pink link" onclick="displayFormContent('Donate');">Making a Donation</span>
				</div>
				
				<div style='margin-top:20px;'>
				<span class="title">MAILING ADDRESS:</span><br>
				1st Bank<br>
				PO Box 507<br>
				Arvada, CO 80001<br>
				<br>
				<i>Make checks payable to:</i><br>
				Karen Sue Benefit Fund<br>
				
				</div>
				
			</div>
		</td>
</tr>
		</table>
	</div>
		
	<div style="width:994px;background-color: #f287b7;;color:#000000;">
		<div id="footerImage"><img src="images/bubbles.png" width="994" height="77" border="0" alt=""></div>
		<div id="footerContent">
			Contact <a class="footerLink" href="mailto:daveydan21@yahoo.com?subject=Caring+For+Karen+Sue">Dave Danielson</a>
			or <a class="footerLink" href="mailto:kandi3109@yahoo.com?subject=Caring+For+Karen+Sue">Kandi O'Connor</a>
			to learn more.
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
<script>
window.onload = function(){setTimeout(function(){window.scrollTo(0, 1);}, 100);}
function(){
	syncRegistrationValues();
	displaySubmissionButtons();
}
</script>
</body>
</html>