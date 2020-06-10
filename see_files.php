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

	<title>myDropbox uploaded files listing</title>
	
	<link rel="stylesheet" type="text/css" href="css/admin_theme_white.css">
	
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
	<link rel="stylesheet" media="all" href="js/jquery-ui/jquery-ui.css" type="text/css">	
	
	<script type="text/javascript" src="audioplayer/simple_white/js/mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="audioplayer/simple_white/css/styles.css">  
	
	<link rel="stylesheet" media="(min-width : 240px) and (max-width : 319px) and (orientation: portrait)" href="css/responsive/responsive_portrait_small.css" type="text/css"> <!-- small phone portrait -->
	<link rel="stylesheet" media="(min-width : 320px) and (max-width : 359px) and (orientation: portrait)" href="css/responsive/responsive_portrait_regular.css" type="text/css"> <!-- regular phone portrait -->
	<link rel="stylesheet" media="(min-width : 360px) and (max-width : 413px) and (orientation: portrait)" href="css/responsive/responsive_portrait_big.css" type="text/css"> <!-- big phone portrait -->
	<link rel="stylesheet" media="(min-width : 414px) and (max-width : 624px) and (orientation: portrait)" href="css/responsive/responsive_portrait_huge.css" type="text/css"> <!-- huge phone portrait -->

</head>


<script>

	//simple AJAX request object
	function createRequestObject() 
	{
		var ro;
		var browser = navigator.appName;
		if(browser == "Microsoft Internet Explorer"){
			ro = new ActiveXObject("Microsoft.XMLHTTP");
		}else{
			ro = new XMLHttpRequest();
		}
		return ro;
	}
	
	var http = createRequestObject();
	
	function show_yes_no_menu(id)
	{
		$("#yes_no_menu_" + id + "").show()
	}

	function hide_yes_no_menu(id)
	{
		document.getElementById("yes_no_menu_" + id + "").style.display = 'none'
	}


	$( document ).ready(function() {
		  
		  $('.audio-player-itself').mediaelementplayer({
			alwaysShowControls: true,
			features: ['playpause'],
			audioVolume: 'horizontal',
			audioWidth: 50,
			audioHeight: 50,
			iPadUseNativeControls: false,
			iPhoneUseNativeControls: false,
			AndroidUseNativeControls: false
		  });
	   
	   $(".audio-player-itself").show();
	});

	function delete_file(i)
	{
		
		var filename_base64_encoded = document.getElementById("file_id_" + i + "").value
		
		var phpscript = 'ajax_del_file.php'
		http.open('post', phpscript)		
		http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		
			http.onreadystatechange = function()
			{
				if(http.readyState == 4)
				{
					if(http.status == 200)
					{
						
						var ajaxMessage = http.responseText
						//alert(ajaxMessage)
																		
						$("#row_file_" + i + "").hide();
		
						//then hide the yes/no menu
						hide_yes_no_menu(i);		
						
						
					}
				}
			}
			http.send('filename_base64=' + filename_base64_encoded + '');		
		
		
		
		
		
	}
	
</script>


<style>
	body{
		background-color : transparent;
	}


	.files_div{
	
		font-family : Verdana, Helvetica;
		font-size : 12px;
		color : white;
		
	}

	.box {
		
		width:300px;
		height:180px;
		position:fixed;
		margin-left:-150px; 
		margin-top:-150px;  
		top:50%;
		left:50%;
		
		-moz-box-shadow: 1px 1px 108px #ffffff;	
		-webkit-box-shadow: 1px 1px 108px #ffffff;	
		box-shadow: 1px 1px 108px #ffffff;			
		
	}	
	

</style>

<body>

<?php
	if($_SESSION['user_logged_in'] == 1){
?>


<?php
   function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
	} 
?>
<?php
	if($_POST['parse']!='login'){
?>

    <form id="form1" name="form1" method="post" action="see_files.php">
    <input type='hidden' id='parse' name='parse' value='login' />

    
    <div id='outer_page'>
		<div id='inner_page'>
		<div id='centered_page'>
    
            <div id='admin_login_inner' class='admin_login_index'>
            
                <div class='admin_icon'>
                    <img src='gfx/server_icon.png' border=0 />    
                </div>            
            
                <div id='admin_login_title'>
					Administrator login required<br>
					(<b>see uploaded files</b>)
                </div>
                <div style="clear:both; margin-bottom : 20px;"></div>
                
                <div id='admin_login_password_field'>
                    password <br><br> <input name="pass" type="password" class="input_pass" id="pass" size="14" autofocus/>
                </div>
                
				<div style="clear:both; margin-bottom : 20px;"></div>
                
                <div>
                    <input type="submit" class='button_style_1' src="gfx/login.png" name="button" id="button" value="Submit" border=0>
                </div>

				<Br><br>
				
				<a href='my_dropbox.php'>
				<div style='width:250px;margin:0 auto;font-size:22px;cursor:pointer;'>
					back to the uploader
				</div>
				</a>
				
				<br><Br>
				
            </div>
            
		</div>
        </div>
	</div>

    
    </form>

<?php
	}else if($_POST['pass']==$global_admin_password){
?>


	<div class='files_div'>
	
	
	
	
	<div class="table_see_files" id="list_files_table">

	
		
      

		<?php

			$files = glob('uploaded-files/*',GLOB_NOSORT);
			foreach ($files as $f){
			  $tmp[basename($f)] = filemtime($f);
			}
			arsort($tmp);
			$files = array_keys($tmp);		
		
			//print_r($files);
		
		/*
			
			//old code...
			
		 	$dir = 'uploaded-files';
        	$files1 = scandir($dir);
		*/
			for($i=0; $i<count($files);$i++){

				$filename = $files[$i];
				$total_space_occupied += filesize("uploaded-files/".addslashes($filename)."");
			}
		?>

            <div class='text4' style='padding:20px;'>
                Here are your dropBox uploaded files.<Br /><br />
                <span class='text_filesize'><?php echo number_format($total_space_occupied/1000000,1); ?> MB disk space in use</span>
            </div>


	<?php
    
        
        
       
    
	
				$counter = 0;
    

						for($i=0; $i<count($files);$i++){


							$filename = $files[$i];
							
							$filesize = filesize('uploaded-files/'.$filename);
								
							if($filename!='index.php' && $filesize>0){

							
									  
								//below is the TR line
									echo "<div class='admin_tr_1_off' id='row_file_".$i."'>";
									
									echo "<input type='hidden' id='file_id_".$i."' value='".base64_encode($filename)."'>";
									
									
									echo "<div bgcolor='transparent' class='see_files_numbering'>";
									
										$counter++;
										echo $counter;
									
									echo "</div>";	
									
									
									echo "<div class='see_files_icon'>";
									
									include("show_file_icons.php");
									
										//if audio file, show player
										if(strtolower($file_extension)=='wav' or strtolower($file_extension)=='mp3' or strtolower($file_extension)=='mp4'){
										
										?>
										
											<div class="audio-player">
												<audio class="audio-player-itself" src="uploaded-files/<?php echo $filename; ?>" type="audio/mp3" controls preload='none'>
											</div>
											
											<script>
												$(".audio-player-itself").hide();
											</script>
									
										<?php
										
										}
										
									echo "</div>";							

									
									echo "<div class='see_files_filename'>";

											echo "<div id='container_".$id."_user_name'>";
												echo $filename;
											echo "</div>";
											echo "<div style='clear:both;'></div>";
											
											echo "<div class='see_files_filename_date'>";
											echo date("F d Y H:i:s.",filemtime('uploaded-files/'.$filename));
											echo "</div>";
											
									echo "</div>";
									
									//size on disk
									echo "<div class='see_files_filesize'>";


									$filesize = filesize('uploaded-files/'.$filename);
									
										if($filesize>800000000){
												
												echo "<span style='font-size:16px;color:#9587e4;text-shadow:1px 1px 0 #eee;'>";
												echo number_format($filesize/1000000000,2);
												echo "</span>";
											echo " GB";						
										}else if($filesize>500000 && $filesize<=800000000){
												
												echo "<span style='font-size:16px;color:#9587e4;text-shadow:1px 1px 0 #eee;'>";
												echo number_format($filesize/1000000,1);	
												echo "</span>";
											echo " MB";						
										}else if($filesize>=10000 && $filesize<500000){
												
												echo "<span style='font-size:16px;color:#9587e4;text-shadow:1px 1px 0 #eee;'>";
												echo number_format($filesize/1000,0);	
												echo "</span>";
											echo " KB";						
										}else if($filesize<10000){
												
												echo "<span style='font-size:16px;color:#9587e4;text-shadow:1px 1px 0 #eee;'>";
												echo number_format($filesize,0);	
												echo "</span>";
											echo " bytes";
										}

										
									echo "</div>";
									
									
									//onClick='location.ref=\"del_file.php?action=confirm-del&filename=".base64_encode($filename)."\"'
									
										echo "<div class='see_files_del_div'>";
										
											echo "<div id='yes_no_menu_".$i."' class='list_delete_yes_no'>";
											echo "<div class='list_delete_yes' onClick='delete_file(".$i.");'>Yes</div> <div class='list_delete_no' onClick='hide_yes_no_menu(".$i.");'>no</div>";
											echo "</div>";
											
										?>
										
											<script>
												$("#yes_no_menu_" + <?php echo $i; ?> + "").hide();
											</script>										
										
										<?php
											
											echo "<div class='edit_button' onClick='show_yes_no_menu(".$i.");' style='display:block;width:40px;height:20px;font-size:11px;padding-top:9px;'>delete</div>";
											
										echo "</div>";
									
										echo "<div class='see_files_download_div'>";
											echo '<a download="'.$filename.'" href="uploaded-files/'.$filename.'">';
												echo '<div class="edit_button_2" style="display:block;width:40px;height:24px;padding:4px;">Down<br>load</div>';
											echo '</a>';
										echo "</div>";																						
										
									echo "</div>";	

								
								echo "<div style='clear:both;'></div>";
								
							}
						}
	
    
    ?>
    <tr>
    	<td colspan='7' class='see_files_header table_separator_top table_separator_bottom_black' align='center'>

            <div class='text4' onClick='location.href="my_dropbox.php"' onMouseOver='this.style.cursor="pointer";' style='padding:20px;'>
                <div class='button_style_1'>back to myDropbox</div>
            </div>
		<!--
            <div class='text4' onClick='location.href="documentation.php"' onMouseOver='this.style.cursor="pointer";' style='padding:20px;'>
                <div class='button_style_1'>see documentation</div>
            </div>
		-->

        </td>
    </tr>
    
	</div> <!-- end main div (TABLE) -->
	
	</div>

<?php
	}else if($_POST['pass']!=$global_admin_password){
	
		?>
        	
			<script language="javascript" type="text/javascript">
            
                window.location.href = 'see_files.php'
            
            </script> 
        
        <?php
	
	}
?>

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