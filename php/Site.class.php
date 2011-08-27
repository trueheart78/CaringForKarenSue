<?php
class Site {
	
	static function displayPageHeader($pageName="Welcome"){
		if(!defined('APP_NAME')){
			defined('APP_NAME','Application');
		}
		$pageTitle = APP_NAME.' :: '.$pageName;
		print '<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8" />
		<title>'.$pageTitle.'</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<!--iPad portrait -->
		<link href="css/ipadP.css" rel="stylesheet" media="only screen and (min-device-width:  768px) and (max-device-width: 1024px) and (orientation: portrait)">
		<!--iPad landscape -->
		<link href="css/ipadL.css" rel="stylesheet" media="only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape)">
		<!--iPhone portrait -->
		<link href="css/iphoneP.css" rel="stylesheet" media="only screen and (min-device-width: 320px) and (max-device-width: 480px) and (orientation: portrait)">
		<!--iPhone landscape -->
		<link href="css/iphoneL.css" rel="stylesheet" media="only screen and (min-device-width: 320px) and (max-device-width: 480px) and (orientation: landscape)">
		
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.css" />
		<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>
		
		<style type="text/css">
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
		</style>
		
		</head><body>
		<header><a href="index.php">
  <h1>Go Home</h1> 
  <h2>'.APP_NAME.'</h2>
  </a>
</header>
<nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="aquariums.php">Order Custom Aquariums</a></li>
      <li><a href="Mark-Loos.php">About Mark Loos</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>';
	}
	static function displayPageFooter(){
		print '<footer> <small> Copyright 2011. All rights reserved.
			Contact <a href="mailto:'.str_replace(' ','%20','mills.joshua@gmail.com?subject=The '.APP_NAME.' Site').'">JMills</a>.
		</small> </footer>
		<script>window.onload = function() {setTimeout(function(){window.scrollTo(0, 1);}, 100);}</script>
		</body></html>';
	}
	static function displayRegistrationForm(){
		print '<form name="myform" action="index.php?submit=1" method="POST">
<input type="email" id="email_address" value="What\'s your email?">
<input type="button" value="Tell me your Email!" onclick="alert(jQuery(\'#email_address\').val());">

</form>';
		
	}
}

?>