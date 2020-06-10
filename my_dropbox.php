<?php
session_start();
include ('auth/auth.php');
error_reporting(E_ALL ^ E_NOTICE);
?>
<!doctype html>
<html>
<head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>myDropbox</title>
	
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<link href="css/admin_theme_white.css" rel="stylesheet" type="text/css">    
	
	<link rel="stylesheet" media="(min-width : 240px) and (max-width : 319px) and (orientation: portrait)" href="css/responsive/responsive_portrait_small.css" type="text/css"> <!-- small phone portrait -->
	<link rel="stylesheet" media="(min-width : 320px) and (max-width : 359px) and (orientation: portrait)" href="css/responsive/responsive_portrait_regular.css" type="text/css"> <!-- regular phone portrait -->
	<link rel="stylesheet" media="(min-width : 360px) and (max-width : 413px) and (orientation: portrait)" href="css/responsive/responsive_portrait_big.css" type="text/css"> <!-- big phone portrait -->
	<link rel="stylesheet" media="(min-width : 414px) and (max-width : 424px) and (orientation: portrait)" href="css/responsive/responsive_portrait_huge.css" type="text/css"> <!-- huge phone portrait -->
	
</head>

<?php

// Returns a file size limit in bytes based on the PHP upload_max_filesize
// and post_max_size
function file_upload_max_size() {
  static $max_size = -1;

  if ($max_size < 0) {
    // Start with post_max_size.
    $post_max_size = parse_size(ini_get('post_max_size'));
    if ($post_max_size > 0) {
      $max_size = $post_max_size;
    }

    // If upload_max_size is less, then reduce. Except if upload_max_size is
    // zero, which indicates no limit.
    $upload_max = parse_size(ini_get('upload_max_filesize'));
    if ($upload_max > 0 && $upload_max < $max_size) {
      $max_size = $upload_max;
    }
  }
  return $max_size;
}

function parse_size($size) {
  $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
  $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
  if ($unit) {
    // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
    return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
  }
  else {
    return round($size);
  }
}


?>
<script>

    function getFileData(myFile){
		
		var file = myFile.files[0];  
		var filename = file.name;
		var filesize = file.size
		
		if(filesize < '<?php echo file_upload_max_size(); ?>'){
			var clean_file_name = filename

			//replace bad filename-chars with empty space - clean up filename characters before uploading...in the line below
			var clean_file_name = file.name.replace(/[|&;$%@"<>+,#!?"=\\:`{}\^*'|\/]/gi, "");
			filename = clean_file_name

			document.getElementById('_progress_status').innerHTML = '<b>' + filename + '</b> is loaded.<br><br> Click the "<b>Upload</b>" button to start.<br>' + (filesize/1048576).toPrecision(2) + ' MB in size.'

			document.getElementById('_submit').className = 'button_submit_ready';
			
		}else{
			
			document.getElementById('_progress_status').innerHTML = 'This file size is <span style="color:#ce3434;">greater than <b><?php echo number_format(parse_size(file_upload_max_size())/1048576,0,',',' '); ?> MB</b></span>.<br><Br> Please remove your file size limitation on your server and then re-upload this file.'
			
			//reset file dialog
			
			$("#_file").val('');
			
		}
			
    }
	
</script>


<body>

<?php
	if($_SESSION['user_logged_in'] == 1){
?>
 
<div id='outer_page'>
<div id='inner_page'>
<div id='centered_page'>

<!-- these 3 above, used for encapsulating the page and centering vertically and horizontally the whole content -->

<div id='main_module'>    <!-- around the whole app -->

	<div id='logo'>  <!-- the logo DIV --> 
        <img src='gfx/main_logo_small.png' border=0>
    </div>
    
	<div id='uploader_container' class='uploader_container'>  <!-- BEGINS uploader_container --> 
    <!-- BEGINS uploader_container -->
            
        <div id='file_container_title' class='file_container_title'>  <!-- BEGINS file_container_title --> 

			<?php
            
                echo '<div class="text3_light_gray" style="margin-bottom : 20px;">This web-server\'s current max-upload-size per each file is <b class="text1_white" style="font-size:18px;">' . ini_get('post_max_size') . "</b></div>";
            
            ?>
    
             <div id='global_custom_dropbox_message' class='global_custom_dropbox_message'>
                <?php echo $global_custom_dropbox_message; ?>
             </div>            
                    
         </div>  <!-- end file_container title -->         
        
         <div id='file_container' class='file_container'>   <!-- BEGINS file_container --> 
                 
            <!--<div class='text4 send_me_a_file'></div>-->
            <div>
                    <input type='hidden' id='_user_id' value='<?php echo $_GET['user_id']; ?>'>
                                
                    <input type='file' id='_file' onchange="getFileData(this);" class='file_dialog'>
					<br><br>
					
                    <input type='button' id='_submit' value='upload' class='button_style_1'>
					<br>
					
            </div>
                
            <div id='_progress_file' class='progress_file'></div> 
            
            <div class='container'>
                <div id='_progress' class='progress'></div>
            </div>

            <div id='_progress_text' class='progress_text'></div>
            
			<script>
				document.getElementById('_progress_text').style.visibility = 'hidden';
			</script>
            
            <div id='_progress_time' class='progress_time'></div>
            
            <div id='_progress_status' class='progress_status'></div>            

      </div> <!-- end file_container -->  

        <div id='menu_holder'>  <!-- BEGINS menu_holder (where the 3 buttons "log out", "stop download" and "see files" are) -->

            <div style='clear:both;'></div> <!-- inserts a break between DIVS -->
            <div id='menu_stop_progress'>
                <div id='stop_upload_in_progress' style='margin:15px;'>
                    <a href='my_dropbox.php' class='stop_button'>stop the upload</a>
                </div>
            </div>
            <div style='clear:both;'></div> <!-- inserts a break between DIVS -->
            <div id='menu_log_out' style='margin:15px;'>
                <a href='logout.php' class='edit_button'>log out</a>
            </div>
            <div style='clear:both;'></div> <!-- inserts a break between DIVS -->
            <div id='menu_see_files' style='margin:15px;'>    
                <a class='edit_button' href='see_files.php'>see uploaded files</a>
            </div>
            
        </div> <!-- end menu -->
      </div> <!-- end uploader_container --> 

    

	</div><!-- end main_module --> 

</div>
</div>
</div>
       
  <script src='upload.js'></script>
       
  <script>

	  document.getElementById("stop_upload_in_progress").style.visibility = "hidden";

  </script>         
       
       
<?php
	}else{
?>		

	<script language="javascript" type="text/javascript">
    
        window.location.href = 'index.php'
    
    </script> 

<?php
	}
?>       

</body>
</html>