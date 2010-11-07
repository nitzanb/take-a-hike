<?php
//database server
define('DB_SERVER', "localhost");

//database login name
define('DB_USER', "takeahike");
//database login password
define('DB_PASS', "QwqC3LB9FFaVEDHq");

//database name
define('DB_DATABASE', "takeahike");

//table names 
define('TBL_HIKES', "hikes");
define('TBL_USERS', "users");
define('TBL_CITIES',"cities");

//User levels
define('USER_LEVEL',"1");
define('EDITOR_LEVEL',"5");
define('ADMIN_LEVEL',"9");


define('HOME','http://phpLead/');

require_once(ABSPATH.'classes/Database.singleton.php');
$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();

/* Loading the classess */
require_once(ABSPATH.'classes/User.php');
require_once(ABSPATH.'classes/Lead.php');
require_once(ABSPATH.'classes/Note.php');

function __($string){return $string;}
function _e($string){echo $string;}

//Departments

$departments = array (	1=>'Gynecology',
						2=>'Oncology ',
						3=>'General surgery',
						4=>'Fertility & Ivf',
						5=>'Neurosurgery',
						6=>'Cardiology',
						7=>'Orthopedic  ',
						8=>'Gastro',
						9=>'Bariatric surgery',
						10=>'Plastic surgery',
						11=>'Hematology',
						12=>'Nephrology',
						13=>'Urology');

$statuses = array(	1=> 'Not contacted yet',
					2 => 'Not interested',
					3 => 'Call Again later',
					4 => 'Successful conversion');

?>
