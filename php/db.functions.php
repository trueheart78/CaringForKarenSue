<?php
function db_NumRows($result){
	return mysql_num_rows($result);
}
/**
 * Strips slashes and then uses mysql_real_escape_string() and wildcard checking (if req)
 *
 * @param string $string
 * @param bool[opt] $cleanWildCards
 * @return string
 */
function db_EscapeString($string,$cleanWildCards=false){
	//safer than addslashes due to oddball character encoding concerns.
	//Google addslashes vs mysql_real_escape_string for more info.
	$string = mysql_real_escape_string(stripslashes($string));
	if($string && $cleanWildCards){
		$charactersToEscape = array("%","_");
		foreach($charactersToEscape as $characterToEscape){
			$string = str_replace($characterToEscape,"\\".$characterToEscape,$string);
		}
	}
	return $string;
	/*
	\0	An ASCII NUL (0x00) character.
	\'	A single quote (“'”) character.
	\"	A double quote (“"”) character.
	\b	A backspace character.
	\n	A newline (linefeed) character.
	\r	A carriage return character.
	\t	A tab character.
	\Z	ASCII 26 (Control+Z). See note following the table.
	\\	A backslash (“\”) character.
	\%	A “%” character. See note following the table.
	\_
	*/
}
function db_AffectedRows(){
	if($linkIdentifier){
		return mysql_affected_rows($linkIdentifier);
	} else {
		return mysql_affected_rows();
	}

}
function db_NextRecord($result){
	if(!is_bool($result)){
		$returnValue = mysql_fetch_assoc($result);
		return (is_array($returnValue)) ? $returnValue : false;
	} else {
		return false;
	}
}

function db_InsertID($linkIdentifier=null){
	if($linkIdentifier){
		return mysql_insert_id($linkIdentifier);
	} else {
		return mysql_insert_id();
	}
}
/**
 * Performs the database query
 *
 * @param string $query
 * @param string $errorCode
 * @param int $linkIdentifier
 * @param bool $dieOnError
 * @return result
 */
function db_Query($query,$errorCode='',$linkIdentifier=null,$dieOnError=true){
	if($linkIdentifier){
		$result = @mysql_query($query,$linkIdentifier);
	} else {
		$result = @mysql_query($query);
	}
	if(!$result){
		if(MYSQL_DEBUG === true){
			die("<br><b>Debug: </b>MySQL Error # ".mysql_errno()." - ".mysql_error()."<br/>Database Error : Unable to query. [id $idForError]<br/><br/>$query\n");
		}
		if(MYSQL_DEBUG_BY_EMAIL === true){
			db_SendDatabaseErrorEmail('myQuery()',$idForError,mysql_errno(),mysql_error(),$query);
		}
		if($dieOnError){
			die(MYSQL_ERROR_MESSAGE."\n<!--Debug: MySQL Error # ".mysql_errno()." - ".mysql_error()."\nDatabase Error : Unable to query. [id $idForError]\n\n$query\n-->");
		}
	}
	return $result;
}
function db_Connect($idForError=''){
	$tempLink = @mysql_connect(DB_HOST,DB_USER,DB_PASS);
	if(mysql_errno()){
		if(MYSQL_DEBUG === true){
			die(MYSQL_ERROR_MESSAGE."<br>
			Debug: Error connecting to host [".DB_HOST."] as [".DB_USER."]. [id $idForError]<br/>
			Debug: MySQL Error # ".mysql_errno()." - ".mysql_error()."");
		}
		if(MYSQL_DEBUG_BY_EMAIL === true){
			sendDatabaseErrorEmail('dbConnect()',$idForError,mysql_errno(),mysql_error());
		}
		die(MYSQL_ERROR_MESSAGE."\n<!--
			 Debug: Error connecting to host [".DB_HOST."] as [".DB_USER."]. [id $idForError]
			 Debug: MySQL Error # ".mysql_errno()." - ".mysql_error()."
			 -->");
	}

	@mysql_select_db(DB_DEFAULT,$tempLink);
	if(mysql_errno()){
		if(MYSQL_DEBUG === true){
			die("<br>\n<b>Debug:</b> Error selecting database [".DB_DEFAULT."] on host [".DB_HOST."] as [".DB_USER."]. [id $idForError]<br>
				Debug: MySQL Error # ".mysql_errno()." - ".mysql_error()."");
		}
		if(MYSQL_DEBUG_BY_EMAIL === true){
			db_SendDatabaseErrorEmail('db_Connect()',$idForError,mysql_errno(),mysql_error());
		}
		die(MYSQL_ERROR_MESSAGE."\n<!--
			 Debug: Error selectiong database [".DB_DEFAULT."] on host [".DB_HOST."] as [".DB_USER."]. [id $idForError]
			 Debug: MySQL Error # ".mysql_errno()." - ".mysql_error()."
			 -->");
	}
	@mysql_query('SET NAMES utf8');
	return $tempLink;
}
function db_Disconnect($linkToClose=null){
	if($linkToClose){
		mysql_close($linkToClose);
	} else {
		mysql_close();
	}
}
/**
 * Disconnects until no connections are detected
 *
 */
function db_DisconnectAll(){
	while (@mysql_close());
}
/**
 * Connects if necessary
 *
 * @param string[optional] $idForError
 */
function db_ConnectIfNeeded($idForError=''){
	if(!@mysql_ping()){
		return db_Connect($idForError);
	} else {
		return false;
	}
}

/**
 * Sends the email that includes database error information.
 *
 * @param string $functionOrigination
 * @param string $customErrorCode
 * @param string $errorNumber
 * @param string $errorString
 * @param string $failedQuery
 * @param string $selectedDatabase
 */
function db_SendDatabaseErrorEmail($functionOrigination,$customErrorCode,$errorNumber,$errorString,$failedQuery='',$selectedDatabase=''){
	global $clientkey, $userkey;

	if(empty($selectedDatabase)){
		$selectedDatabase = DB_DEFAULT;
	}
	if(!stristr($functionOrigination,'connect')){
		$connectionIssue = false;
	} else {
		$connectionIssue = true;
	}
	//Send $_POST vars
	//Send $_GET vars
	//Send full URL
	$postData = array();
	if(count($_POST)){
		foreach($_POST as $key=>$val){
			if(is_array($val)){
				$postData[] = $key.' = '.implode(', ',$val);
			} else {
				if(strpos($key,'cc_') === 0){
					$tempVal = $val;
					$val = '';
					for($i=0;$i<strlen($tempVal);$i++){
						$val .= 'x';
					}
					unset($tempVal);
				}
				$postData[] = $key.' = '.$val;
			}
		}
	}
	$getData = array();
	if(count($_GET)){
		foreach($_GET as $key=>$val){
			if(is_array($val)){
				$getData[] = $key.' = '.implode(', ',$val);
			} else {
				if(strpos($key,'cc_') === 0){
					$tempVal = $val;
					$val = '';
					for($i=0;$i<strlen($tempVal);$i++){
						$val .= 'x';
					}
					unset($tempVal);
				}
				$getData[] = $key.' = '.$val;
			}
		}
	}
	$url = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$fullURL = HTTP_LEAD.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$subject = 'MySQL Error ('.$errorNumber.'): '.SERVER_NAME.' - '.$functionOrigination;
	$message = "<table width='100%' border='0' cellspacing='0' style='font-family:Arial;font-size:10pt;color:black;'>
	<tr style='background-color:#3D7CDF;color:white;font-weight:bold;'>
		<td>&nbsp;</td>
		<td align='left'>Information</td>
	</tr><tr>
		<td align='right' style='font-weight:bold' width='30%'>Server:&nbsp;</td>
		<td align='left' width='80%'>".SERVER_NAME." ($_SERVER[SERVER_ADDR])</td>
	</tr><tr>
		<td align='right' style='font-weight:bold'>Connecting IP:&nbsp;</td>
		<td align='left'>$_SERVER[REMOTE_ADDR]</td>
	</tr><tr>
		<td align='right' style='font-weight:bold'>Function:&nbsp;</td>
		<td align='left'>$functionOrigination</td>
	</tr><tr>
		<td align='right' style='font-weight:bold'>Connection Issue?&nbsp;</td>
		<td align='left'>".( ($connectionIssue) ? 'Yes' : 'No')."</td>
	</tr><tr>
		<td align='right' style='font-weight:bold'>Custom Error Code:&nbsp;</td>
		<td align='left'>$customErrorCode</td>
	</tr><tr>
		<td align='right' style='font-weight:bold'>MySQL Error #:&nbsp;</td>
		<td align='left'>$errorNumber</td>
	</tr><tr>
		<td align='right' style='font-weight:bold' valign='top'>MySQL Error:&nbsp;</td>
		<td align='left'>$errorString</td>
	</tr>";

	if(!empty($failedQuery)){
		$message .= "<tr style='background-color:#3D7CDF;color:white;font-weight:bold;'>
			<td>&nbsp;</td>
		<td align='left'>Variables</td>
		</tr><tr>
			<td align='right' style='font-weight:bold' valign='top'>Database:&nbsp;</td>
			<td align='left'>$selectedDatabase</td>
		</tr><tr>
			<td align='right' style='font-weight:bold' valign='top'>Query:&nbsp;</td>
			<td align='left'>$failedQuery</td>
		</tr><tr>";
	}
	if(!$connectionIssue){
		$message .= "<td align='right' style='font-weight:bold'>URL:&nbsp;</td>
			<td align='left'><a href='$fullURL' target='_blank'>$url</a></td>
		</tr><tr>
			<td align='right' style='font-weight:bold' valign='top'>\$_GET:&nbsp;</td>
			<td align='left'>".implode('<br/>',$getData)."</td>
		</tr><tr>
			<td align='right' style='font-weight:bold' valign='top'>\$_POST:&nbsp;</td>
			<td align='left'>".implode('<br/>',$postData)."</td>
		</tr>
		<table>";
	}
	SendEmail(MYSQL_DEBUG_EMAIL_TO,MYSQL_DEBUG_EMAIL_FROM,$subject,$message,true);
}

/**
 * Converts the array to update form "SET '' = '',"
 *
 * @param array[mixed] $associativeArray
 * @param bool[optional] $withSet
 * @return string
 */
function db_ConvertArrayToUpdateForm($associativeArray=array(),$withSet=true){
	if(count($associativeArray)){
		$updateFieldList = array();
		foreach($associativeArray as $key=>$value){
			if(strlen($value) > 2){
				if(substr($value,-2) == '()'){
					$valueToSet = $value;
				} else {
					$valueToSet = "'".db_EscapeString($value)."'";
				}
			} else {
				$valueToSet = "'".db_EscapeString($value)."'";
			}
			$updateFieldList[] = "$key = $valueToSet";
		}
		$returnString = ($withSet) ? "\nSET\n" : "\n";
		return $returnString.implode(",\n",$updateFieldList)."\n";
	} else {
		return false;
	}
}
/**
 * Converts the array to insert form ('') VALUES ('')
 *
 * @param array[mixed] $associativeArray
 * @param bool[optional] $valuesOnly
 * @param bool[optional] $keysOnly
 * @return string
 */
function db_ConvertArrayToInsertForm($associativeArray=array(),$valuesOnly=false,$keysOnly=false){
	if(count($associativeArray)){
		$fieldList = array();
		$valueList = array();
		if(!$valuesOnly && !$keysOnly){
			foreach($associativeArray as $key=>$value){
				$fieldList[] = $key;
				if(strlen($value) > 2){
					if(substr($value,-2) == '()'){
						$valueList[] = $value;
					} else {
						$valueList[] = "'".db_EscapeString($value)."'";
					}
				} else {
					$valueList[] = "'".db_EscapeString($value)."'";
				}
			}
			return "(".implode(",",$fieldList).") VALUES (".implode(",",$valueList).")";
		} else if ($valuesOnly){
			foreach($associativeArray as $key=>$value){
				if(strlen($value) > 2){
					if(substr($value,-2) == '()'){
						$valueList[] = $value;
					} else {
						$valueList[] = "'".db_EscapeString($value)."'";
					}
				} else {
					$valueList[] = "'".db_EscapeString($value)."'";
				}
			}
			return "(".implode(",",$valueList).")";
		} else if ($keysOnly){
			foreach($associativeArray as $key=>$value){
				$fieldList[] = $key;
			}
			return "(".implode(",",$fieldList).")";
		}
	} else {
		return false;
	}
}
function db_RetrieveTableFields($tableName){
	$query = "SHOW FIELDS FROM {$tableName}";
	$result = db_Query($query,'db.functions db_RetrieveTableFields() Q1');
	if(db_NumRows($result)){
		$fieldArray = array();
		while(($data = db_NextRecord($result)) != false){
			$fieldArray[$data['Field']] = $data['Field'];
		}
		return $fieldArray;
	} else {
		return false;
	}
}
?>