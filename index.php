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
session_start(); 
$sitemap = array();
$url = $_SERVER['REQUEST_URI'  ];
$url = trim($url, '/');

$location = explode('/', $url);
if ($location[0]=='')
		$sitemap['location']='main';
	else
		$sitemap['location']=$location[0];

if(isset($location[1]))
			$sitemap['action'] = $location[1];


if(!isset($_SESSION['user']))
	include (ABSPATH.'theme/'."login.php");
else
	include (ABSPATH.'theme/'.$sitemap['location'].".php");
?>
