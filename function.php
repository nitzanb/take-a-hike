<?php
/*
 *      function.php
 *      
 */

//This function convert timestamp from Mysql format to human format
function displayTimeStamp($ts){
	
	
}

//This function convert timestamp from human format to mysql format
function saveTimeStamp($ts){
	
	
}

function isValidUser($uid){
	$db = Database::obtain();	
	//check if username already exist		
	$sql = "SELECT * FROM `".TBL_USERS."` WHERE `uid` = '$uid'";
	$record = $db->query_first($sql);	
	if(empty($record))
		return FALSE;
	return TRUE;
}

function isValidLead($lid){
	$db = Database::obtain();		
	//check if Lead already exist		
	$sql = "SELECT * FROM `".TBL_LEADS."` WHERE `lid` = '$lid'";
	$record = $db->query_first($sql);	
	if(empty($record))
		return FALSE;
	return TRUE;
}

function getNotesByLead($lid){
	$db = Database::obtain();		
	//check if Lead already exist		
	$sql = "SELECT * FROM `".TBL_NOTES."` WHERE `lid` = '$lid'";
	$results = $db->query($sql);
	$notes = array();
	while($row = mysql_fetch_assoc($results)){
		$note = new Note();
		$note->noteFromArray($row);
		$notes[]=$note;	
	}
	return $notes;
	
}
?>
