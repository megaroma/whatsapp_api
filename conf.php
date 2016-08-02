<?php

$username = "16462264945";
$nickname = "darkromanovich";
$password = "S0f219B2QCGgVMPH35JPiKkFU2A="; // The one we got registering the number
$debug = false;




$db_server = "127.0.0.1";
$db_port = "4040";
//$db_server = "10.1.1.50";
//$db_port = "3306";

$db_username = "roman";
$db_password = "treadmill";
$db_name = "pacteltest";


$connection = mysqli_connect($db_server,$db_username,$db_password,$db_name,$db_port);



$w = new WhatsProt($username, $nickname, $debug);


class db {
	public static $connection;
	public static function set($connection) {
		self::$connection = $connection;
	}
	public static function get() {
		return self::$connection;
	}
  static public function query($sql) {
    return mysqli_query(self::$connection,$sql);
  }
  static public function escape($text) {
  	return mysqli_real_escape_string ( self::$connection , $text );
  }  	
}




db::set($connection);