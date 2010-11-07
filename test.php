<?php
/*
 *      index.php
 *      
 *      Copyright 2010 Nitzan Brumer <nitzan@whiteweb.com>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
require_once(ABSPATH.'config.inc.php');
require_once(ABSPATH.'function.php');



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Test Page</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.18" />
</head>

<body>
	<h1>Hello world</h1>
	<h2>Now we test:</h2>
	<?php
	$uid = $_GET['uid'];
	$lid = $_GET['lid'];
	$note = array();
	$note['uid'] = $uid;
	$note['lid'] = $lid;
	$note['title'] = "thsdfs is a tedfst";
	$note['content'] = "uis turpis tellus . Corporis suscipit. Dictumst amet, nibh. Corporis suscipit. Dictumst amet, nibh. Corporis suscipit. Dictumst amet, nibh. Corporis suscipit. Dictumst amet, nibh. Corporis suscipit. Dictumst amet, nibh nunc aenean quam, vitae dui velit vestibulum neque. In quam porttitor vitae orci, in nulla sed rhoncus, nulla nisl, sed non id elit massa, lobortis et nulla sed. Pede quam eget vestibulum sit amet, nullam non vel integer aenean metus, lobortis diam quis. Vehicula sit gravida pe";
	
	$n = new Note();
	print_r($n->storeNote($note));
	
	?>
	
	
</body>
</html>
