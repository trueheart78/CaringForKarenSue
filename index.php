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
								<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
								<img style="cursor:pointer;" id="sponsorPaypalButtonImage" onclick="submitForm('sponsor');" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">
								<img src="images/ajax-loader.gif" id="sponsorPaypalSpinnerImage" style="display:none;">
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
								<form id="registrationForm" action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="on0" value="# Registrants">
								<input type="hidden" name="os0" id="paypalRegistrationSelection" value="1 Registrant">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
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
				Saturday, September 8, 2012<br>
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