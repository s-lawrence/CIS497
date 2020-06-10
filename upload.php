<?php
session_start();
include ('auth/auth.php');
error_reporting(E_ALL ^ E_NOTICE);


// this is the PHP file called through AJAX from the Javascript upload.js module
// that checks if file is loaded on server, and then if no other error, saves it

	// Output JSON function
	function outputJSON($msg, $status = 'error'){
		//header('Content-Type: application/json');
		die(json_encode(array(
			'data' => $msg,
			'status' => $status
		)));
	}

	//corrects the filename
	$filename = str_replace("\"","", $_FILES['SelectedFile']['name']);

	// Check if the file already exists
	if(file_exists('uploaded-files/' . $filename)){
		outputJSON('File with that name already exists.<br>Choose and upload another file.');
	}

	// considers upload complete, checks for it below..
	$upload_complete = 1; 

	// below it saves the file unter "uploaded-files" subfolder

	
	if(!move_uploaded_file($_FILES['SelectedFile']['tmp_name'], 'uploaded-files/' . $filename)){
		$upload_complete = 0; //if not (!) the above function, then upload is not complete, throws an error..
		outputJSON('Error uploading file - check destination is writeable.');
	}
	
	if($upload_complete==1){//successfully uploaded
		outputJSON('File uploaded successfully. ', 'success');
	}

/*
	if($upload_complete==1){//DEMO version - upload not allowed
		outputJSON('On the <font style="color:red;">demo version</font> of this software, <font style="color:red;">file saving is disabled</font>. <br><br>Only on the <b>full version</b>, <b>uploading is allowed</b>. Thanks for understanding!', 'success');
	}
*/
	
?>