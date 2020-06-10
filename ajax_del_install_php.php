<?php
session_start();
include ('auth/auth.php');
error_reporting(E_ALL ^ E_NOTICE);

	echo "Done";
	
	//deletes install.php
	unlink('install.php');

?>