<?php
class Auth {
	static function generateSalt($length=40){
		//generate a random salt code
		$code = hash('sha1',uniqid(rand(), true));
		//and return the requested length of the salt code
		return substr($code, 0, $length);
	}
	static function hashPassword($username,$newPassword){
		$toReturn = array('salt'=>'','hashed_password'=>'');
		//$username = $formData['username'];
		//$newPassword = $formData['new_password'];
		$toReturn['salt'] = self::generateSalt();
		$toReturn['hashed_password'] = self::doubleSalt($newPassword,$username,$toReturn['salt']);
		//print_r($toReturn);
		return $toReturn;
	}
	static function doubleSalt($passwordToHash,$username,$centerSalt){
		$password = str_split($passwordToHash,(strlen($passwordToHash)/2)+1);
		//var_dump($password);
		$hash = hash('sha1', $username.$password[0].$centerSalt.$password[1]);
		return $hash;
	}
	static function validateClientUser($username,$password,$clientID=0){
		//remove the potential white-space from the username and password
		$username = trim($username);
		$password = trim($password);
		
		$userToReturn = false;
		if(!empty($username) && !empty($password)){
			//find the user by username and (optionally) the client id
			//make sure to select all data, not just the salt and hashed_password - returns this data for use
			$dbQueryUser = "SELECT * FROM intranet_client_side.users_client WHERE username = '$username'";
			if($clientID){
				$dbQueryUser .= " AND clientid = '$clientID'";
			}
			$userResult = myQuery($dbQueryUser,'validateClientUser() Q1');
			//then of the users found, check them 1 by 1 for salt / hashed_password match
			if(mysql_num_rows($userResult)){
				while(($data = mysql_fetch_assoc($userResult)) != false){
					$dbQueryClient = "SELECT COUNT(*) AS num_active FROM intranet.clients
						WHERE clientid = '$data[clientid]' AND status <> 'inactive'";
					$clientResult = myQuery($dbQueryClient,'validateClientUser() Q1');
					$clientData = mysql_fetch_assoc($clientResult);
					if(!$userToReturn){
//						print "[$password]:[$username]:[$data[salt]]<br/>";
//						die($data['hashed_password'].' vs '.self::doubleSalt($password,$username,$data['salt']));
						if($clientData['num_active'] &&
							$data['hashed_password'] == self::doubleSalt($password,$username,$data['salt'])
						){
							$userToReturn = $data;
						}
					}
				}
			}
		}
		//finally, whichever user was found, return the relevant info
		return $userToReturn;
	}
	static function validateGatewayUser($username,$password){
		//find the user by username
		//make sure to select all data, not just the salt and hashed_password - returns this data for use
		$dbQuery = "SELECT * FROM intranet.users WHERE username = '$username' AND active = '1' AND deleted = '0'";
		$userToReturn = false;
		$result = myQuery($dbQuery,'validateGatewayUser() Q1');
		//then of the users found, check them 1 by 1 for salt / hashed_password match
		if(mysql_num_rows($result)){
			while(($data = mysql_fetch_assoc($result)) != false){
				if(!$userToReturn){
					//die($data['hashed_password'].' vs '.self::doubleSalt($password,$username,$data['salt']));
					//print $data['hashed_password'].' = '.self::doubleSalt($password,$username,$data['salt']);
					if($data['hashed_password'] == self::doubleSalt($password,$username,$data['salt'])){
						$userToReturn = $data;
					}
				}
			}
		}
		//finally, whichever user was found, return the relevant info
		return $userToReturn;
	}
	static function destroyClientSession(){
		if(!isset($_SESSION)){
			session_start();
		}
		// kill session variables - non-gateway and non-protected only
		//unset($_SESSION['username'],$_SESSION['password'],$_SESSION['userkey'],$_SESSION['clientkey']);
		if(count($_SESSION)){
			foreach($_SESSION as $key=>$val){
				if(strpos($key,'gateway_') !== 0 && strpos($key,'protected_') !== 0){
					//print $key.' => '.$_SESSION[$key].'<br/>';
					unset($_SESSION[$key]);
				}
			}
		}
	}
	static function destroyGatewaySession(){
		if(!isset($_SESSION)){
			session_start();
		}
		// kill session variables - gateway only
		if(count($_SESSION)){
			foreach($_SESSION as $key=>$val){
				if(strpos($key,'gateway_') === 0){
					//print $key.' => '.$_SESSION[$key].'<br/>';
					unset($_SESSION[$key]);
				}
			}
		}
	}
	static function destroyProtectedSession(){
		if(!isset($_SESSION)){
			session_start();
		}
		// kill session variables - gateway only
		if(count($_SESSION)){
			foreach($_SESSION as $key=>$val){
				if(strpos($key,'protected_') === 0){
					//print $key.' => '.$_SESSION[$key].'<br/>';
					unset($_SESSION[$key]);
				}
			}
		}
	}

}
?>