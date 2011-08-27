<!DOCTYPE html>
<html lang="en">
<head><title>Caring For Karen Sue</title>
<style>
html, body {
	background-color: #f287b7;
	color: #000000;
	font-size: 12pt;
	font-family: 'Arial';
	margin: 0;
}
a:link { color:red; text-decoration:underline; }
a:visited { color:red; text-decoration:underline; }
a:hover { color:red; text-decoration:underline; }
a:active { color:red; text-decoration:underline; }

a.footerLink:link    { color: #FFFFFF; text-decoration: underline; }
a.footerLink:visited { color: #FFFFFF; text-decoration: underline; }
a.footerLink:hover   { color: #FF0000; text-decoration: underline; }
a.footerLink:active  { color: #FFFFFF; text-decoration: underline; }
    
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
#header {
	width:974px;
}
#body {
	border: 0px black solid;
	padding-left:27px;
}
#footerImage {
	width:974px;
	padding: 0;
	margin: 0;
}
#footerContent {
	width:974px;
	padding-left: 37px;
	margin: 0;
	color: #FFFFFF;
	text-align: center;
}
#formContentLinks {
	padding-left:27px;
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
	height: 400px;
	width: 714px;
	margin-left:10px;
	padding: 5px;
	margin-bottom: 5px;
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
</script>
<div align="center">
	<div style="width:974px;background-color:#FFFFFF;color:#000000;">
		<div id="header">
			<img src="images/Banner.png" width="974" height="165" border="0" alt="">
		</div>
		<div id="formContentLinks">
			<div class="sponsorLink" onclick="displayFormContent('');">Read Her Story</div>
			<div class="sponsorLink" onclick="displayFormContent('Register');">Register to Play</div>
			<div class="sponsorLink" onclick="displayFormContent('Sponsor');">Sponsor a Hole</div>
			<div class="sponsorLink" onclick="displayFormContent('Donate');">Make a Donation</div>
			
			
			<div style="clear:both;"></div>
		</div>
	</div>
	<div style="width:974px;background-color:#FFFFFF;color:#000000;">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr><td id="body" valign="top">
			<div id="formContentColumns" style="display:none;">
				<table  style="margin-left:10px;" width="714" cellspacing="0" cellpadding="0">
					<tr>
						<td id="formContentColumnDonate" width="33%" valign="top" align="center">			
							<span class="title">Donate</span><br>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</td>
					
						<td id="formContentColumnSponsor" width="33%" valign="top" align="center">
							<span class="title">Sponsor</span><br>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</td>
						
						<td id="formContentColumnRegister" width="33%" valign="top" align="center">
							<span class="title">Register</span><br>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_s-xclick">
							<table>
							<tr><td><input type="hidden" name="on0" value="# Registrants">Number of Registrants</td></tr><tr><td><select name="os0">
							<option value="1 Registrant">1 Registrant $100.00</option>
							<option value="2 Registrants">2 Registrants $200.00</option>
							<option value="3 Registrants">3 Registrants $300.00</option>
							<option value="4 Registrants">4 Registrants $400.00</option>
							<option value="5 Registrants">5 Registrants $500.00</option>
							<option value="6 Registrants">6 Registrants $600.00</option>
							<option value="7 Registrants">7 Registrants $700.00</option>
							<option value="8 Registrants">8 Registrants $800.00</option>
							<option value="9 Registrants">9 Registrants $900.00</option>
							<option value="10 Registrants">10 Registrants $1,000.00</option>
							</select> </td></tr>
							</table>
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
							</form>
						</td>
					</tr>
				</table>
			</div>
		
<!--		<div id="body" align="left">-->
			<div id="formContentDonate">
<!--				<span class="title">Donate</span><br>-->
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
			<div id="formContentSponsor">
<!--				<span class="title">Sponsor</span><br>-->
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
			<div id="formContentRegister">
				<span class="title">Register</span><br>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<table>
				<tr><td><input type="hidden" name="on0" value="# Registrants"># Registrants</td></tr><tr><td><select name="os0">
				<option value="1 Registrant">1 Registrant $100.00</option>
				<option value="2 Registrants">2 Registrants $200.00</option>
				<option value="3 Registrants">3 Registrants $300.00</option>
				<option value="4 Registrants">4 Registrants $400.00</option>
				<option value="5 Registrants">5 Registrants $500.00</option>
				<option value="6 Registrants">6 Registrants $600.00</option>
				<option value="7 Registrants">7 Registrants $700.00</option>
				<option value="8 Registrants">8 Registrants $800.00</option>
				<option value="9 Registrants">9 Registrants $900.00</option>
				<option value="10 Registrants">10 Registrants $1,000.00</option>
				</select> </td></tr>
				</table>
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
			<div id="content">
<!--				<span class="title">Story</span><br>-->
				In July of 2009 our Mother was diagnosed with Stage 3B Inflammatory Breast Cancer (IBC). 	 
				IBC is not detectable on Mammograms, so usually by the time it is diagnosed, as with our Mother, it has 	 
				already spread. When cancer has spread the doctors are not blessed with protocols that give you hope. 	 
				In August of 2010 we found out it had spread to her liver and lungs and she was given less than a year 	 
				to live. At that time she made the decision to go to Mexico for an experimental treatment that combined 	 
				lower doses of chemo/radiation with a cancer vaccine. We have been blessed with great friends and fam-	 
				ily that have helped us over the year to raise money for that treatment. Last year's golf tournament was a 	 
				huge success thanks to a lot of people it helped our family give our Mother 10 months under the treatment 	 
				in Mexico, but unfortunately not being able to have immediate access to doctors while at home and the 	 
				increasing expenses we were unable to continue that treatment. Our Mother has now chosen to see a 	 
				naturopathic doctor here in the US that gives her high dose vitamin C two times a week. This treatment, 	 
				like the experimental vaccine, is not covered under insurance. Our mom’s will is incredible and we want 	 
				to be able to help her continue this type of treatment. Our family would like to express our deepest thanks 	 
				and gratitude for all of your prayers and support through these trying times. We know it is in God's hands 	 
				and we appreciate that He gave us this opportunity to help our mom. 
			</div>
		</td><td id="nav" valign="top">
			<div>
				<div>
				<span class="title">WHEN:</span><br>
				Saturday, October 8, 2011<br>
				8:30 am Shot Gun Start
<!--				To play is $100 (Price includes greens fees, cart, prizes and lunch) Hole Sponsors start at $200-->
				</div>
				
				<div style='margin-top:20px;'>
				<span class="title">WHERE:</span><br>
				Foothills Golf Course<br> 	 
				3901 South Carr Street<br>
				Denver, CO 80235-1807<br>
				<a href="http://maps.google.com/maps?q=foothills+golf+course+colorado&daddr=3901+South+Carr+Street,+Denver,+CO+80235-1807+(Foothills+Golf+Course)&hl=en&fb=1&gl=us&view=map&geocode=CTpNu4bD0IF8FT7tXAId4V-8-SGlkrjRBC2qxw&z=6&vpsrc=0">Map</a>
				</div>
			</div>
		</td>
<!--			<div style="clear:both;"></div>-->
<!--		</div>-->
</tr>
		</table>
	</div>
		
	<div style="width:974px;background-color: #f287b7;;color:#000000;">
		<div id="footerImage"><img src="images/bubbles.png" width="974" height="77" border="0" alt=""></div>
		<div id="footerContent">
			Contact <a class="footerLink" href="mailto:daveydan21@yahoo.com?subject=Caring+For+Karen+Sue">Dave Danielson</a>
			or <a class="footerLink" href="mailto:kandi3109@yahoo.com?subject=Caring+For+Karen+Sue">Kandi O'Connor</a>
			to learn more.
			
		
			<!--<div class="sponsorLink" onclick="displayFormContent('Donate');">Donate</div>
			<div class="sponsorLink" onclick="displayFormContent('Sponsor');">Sponsor</div>
			<div class="sponsorLink" onclick="displayFormContent('Register');">Register</div>
			<div class="sponsorLink" onclick="displayFormContent('');">Cancel</div>
			<div style="clear:both;"></div>
		--></div>
	</div>
</div>

<!--<div align='center'>-->
<!--<h1 style='color:#FFFFFF;'>Coming Soon!</h1>-->
<!--<img src='images/Gloves.png' width='660' height='474' alt='Fighting the fight'>-->
<!--</div>-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
<script>window.onload = function() {setTimeout(function(){window.scrollTo(0, 1);}, 100);}</script>
</body>
</html>