<?php
include("auth/auth.php");

	//get _POST variable -> my file to be deleted, decode the string..
	$my_file_to_delete = base64_decode($_POST['filename_base64']);
	
	//and delete it
	unlink("uploaded-files/".$my_file_to_delete."");
	
?>

