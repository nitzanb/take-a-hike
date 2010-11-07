<?php
/*
 *      User.php
 *      
 *      Copyright 2010 Nitzan Brumer <nitzan@taz>
 *   

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(6) NOT NULL AUTO_INCREMENT COMMENT 'The user Id',
  `uname` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'The user name',
  `password` varchar(40) COLLATE utf8_bin NOT NULL COMMENT 'the user Password',
  `ulevel` tinyint(1) NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `realname` varchar(50) COLLATE utf8_bin NOT NULL,
  `phone` int(12) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin ;
*    
 */
define('SECRET','askldj08asd98asd2013h82650f58j23498'); //This is used to Hash the Passwords

class User{
	
	var $uname;
	var $uid;
	var $umail;
	var $ulevel;
	var $upass;
	var $realname;
	var $phone;
	
	public function populateUser($uid){
		$db = Database::obtain();		
		//check if username already exist		
		$sql = "SELECT * FROM `".TBL_USERS."` WHERE `uid` = '$uid'";
		$record = $db->query_first($sql);	
		if ($record){
			$this->uname = $record['uname'];
			$this->uid = $record['uid'];
			$this->umail = $record['email'];
			$this->ulevel = $record['ulevel'];
			$this->upass = $record['password'];
			$this->realname = $record['realname'];		
			$this->phone = $record['phone'];	
		}		
	}
	
	public function isAdmin(){
		if($this->ulevel == ADMIN_LEVEL)
			return TRUE;
		return FALSE;		
	}
	
	public function canView(){
		if($this->ulevel >= USER_LEVEL )
			return TRUE;
		return FALSE;		
	}
	
	public function canAssign(){
		if($this->ulevel >= EDITOR_LEVEL )
			return TRUE;
		return FALSE;		
	}	
	
	public function getName(){
		return $this->realname;
		
	}
	
	/*
	 * 	addNewUser($username, $password, $email)
	 * 
	 * 	Gets 3 parmeters - username, password and email address
	 * 	checks if the username or the email is already registered
	 * 	if not - creates new user and add to db
	 * 
	 */ 
	public function addNewUser($username, $password, $email, $realname,  $phone){
		global $db;		
		//check if username already exist		
		$sql = "SELECT uname FROM `".TBL_USERS."` WHERE `uname` = '$username'";
		$record = $db->query_first($sql);	
		if($record)	{ 	//if null we continue, if not we throw error
			$message['text'] = __('This user name Is already in use');
			return $message; 
			}		
		//check if email already exist
		$sql = "SELECT email FROM `".TBL_USERS."` WHERE `email` = '$email'";
		$record = $db->query_first($sql);		
		if($record) {	//if null we continue, if not we throw error
			$message['text'] = __('This email Is already in use');
			return $message; 
			}		
		$ulevel = USER_LEVEL;
		/*
		 * So, No such user exist and the mail is not in use, lets create the user
		 */ 		
		
		$data['uname'] = $username;
		$data ['password'] =  $this->generate_encrypted_password($password); //I hash the password
		$data['ulevel'] = $ulevel;
		$data['email']	= 	$email;
		$data['realname']	= 	$realname;
		$data['phone'] = $phone;
	
		$qid = $db->insert(TBL_USERS, $data); //if query succedded I get the new user Id
		
      	$message['text'] = __('User Created successfully');
      	$message['uid'] = $qid;
		return $message;       		
   }
   
   /*
    * 	authUser($uname, $pass)
    * 	This function checks if the user is in the DB 
    * 	and the password is correct.
    * 	
    * 	error level: 	1 - Success
    * 					2 - Wrong password
    * 					3 - No user
    */ 
   	public function authUser($uname, $pass){
		global $db;	
		$pass = $this->generate_encrypted_password($pass);
		
		$sql = "SELECT uid, uname, password FROM `".TBL_USERS."` WHERE `uname` = '$uname'";
		$record = $db->query_first($sql);
		if($record){
			if($pass == $record['password']){
				$err['msg'] = __('Success');
				$err['lvl'] = 1;
				$err['uid'] = $record['uid'];
			}
			else{
				$err['msg'] = __('Wrong Password');
				$err['lvl'] = 2;				
			}
		}
		else{
			$err['msg'] = __('No Such user');
				$err['lvl'] = 3;
			
		}
		return $err;		
	}
   
	/*
	 * 	I hash the password in the database so if someOne hack it he 
	 * 	will not have the original passwords.
	 * 
	 * 	IMPORTENT: 	after the site is up and running you CANNOT change the SECRET
	 * 				changing it will cause all passwords to stop working
	 */ 
	public function generate_encrypted_password($str) { 		
			$new_pword = md5(SECRET.$str); 
			return substr($new_pword, strlen($str), 40); 
	} 

	public function getUserLevel ($uid){
		if(empty($ulevel))
			$this->populateUser($uid);
		return $this->ulevel;
	}


}

?>
