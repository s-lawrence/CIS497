<?php
session_start();
//include ('auth/auth.php');
error_reporting(E_ALL ^ E_NOTICE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<title>Installer script for myDropbox</title>
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="css/admin_theme_white.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" media="(min-width : 240px) and (max-width : 319px) and (orientation: portrait)" href="css/responsive/responsive_portrait_small.css" type="text/css"> <!-- small phone portrait -->
	<link rel="stylesheet" media="(min-width : 320px) and (max-width : 359px) and (orientation: portrait)" href="css/responsive/responsive_portrait_regular.css" type="text/css"> <!-- regular phone portrait -->
	<link rel="stylesheet" media="(min-width : 360px) and (max-width : 413px) and (orientation: portrait)" href="css/responsive/responsive_portrait_big.css" type="text/css"> <!-- big phone portrait -->
	<link rel="stylesheet" media="(min-width : 414px) and (max-width : 424px) and (orientation: portrait)" href="css/responsive/responsive_portrait_huge.css" type="text/css"> <!-- huge phone portrait -->
	
<script>

	
	 //simple AJAX request javascript that sends javascript variables to a .php that then interacts with the database via GET
	function createRequestObject() {
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
	
	function delete_install_php(){


			var phpscript = 'ajax_del_install_php.php'
			http.open('post', phpscript)
			http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');			
			http.onreadystatechange = function()
			{
				if(http.readyState == 4)
				{
					if(http.status == 200)
					{	
		
						// deletes the install.php file with an AJAX call
										
							document.getElementById('deletion_text_box').innerHTML = 'Done.'
							document.getElementById('delete_install_button').style.visibility = 'hidden'
							
		
					}
				}
			}
			http.send();		
		
	}


</script>


</head>

<body>

<?php

	if($_POST['parse']!='setup'){
	
?>

<div id='outer_page'>
<div id='inner_page'>
<div id='centered_page'>


    <div>

		<form name="form1" method="post" action="install.php">
        <input type='hidden' id='parse' name='parse' value='setup' />
        <table cellpadding=5 class='install_table'>
        	<tr>
                <td><img id='install_logo' src='gfx/install_icon.png' border=0 /></td>
            </tr>

        	<tr>
                <td><input id='dropbox_pass' name='dropbox_pass' type='text' placeholder='set main dropbox password' />
			</td>
            </tr>
        	<tr>
                <td><input id='admin_pass' name='admin_pass' type='text' placeholder='set see_files (admin) password'/>
			</td>
            </tr>        
        	<tr>
                <td><input id='dropbox_name' name='dropbox_name' type='text' placeholder='set a name for your dropbox' />
                </td>
            </tr>
        	<tr>
                <td>
				<br><Br>
				<input type='checkbox' id='installing_on_subdomain' name='installing_on_subdomain'><label for="installing_on_subdomain" style='cursor:pointer;'>&nbsp;I'm installing on a subdomain</label>
				<br><Br>
                </td>
            </tr>


            <tr>

                <td class='text1_white' style='word-break: break-all;'>detected root folder<br> <b>
                	<?php
					
					echo "<font class='text2'>";
					echo $_SERVER["SERVER_NAME"];
					echo "</font>";
					$req_uri = explode("/", $_SERVER["REQUEST_URI"]);
					echo "/";
					echo $req_uri[1];
					
					echo "</b>";
					
					if($req_uri[1]==''){
						echo "<br><br><br /><br><div style='text-align:justify; width:360px;'><font color='red'>Warning!</font> Install folder not detected ! <br><br>If you're installing to a <b>sub-domain</b> check below that you're installing on a sub-domain, otherwise please put all the files in a folder on your domain, not right in the root of your domain, and then access install again from there.<br><Br></div>";
						echo "<Br><br>";
					}
					?>
                    
                    <input type='hidden' id='website_root' name='website_root' value='<?php echo $req_uri[1]; ?>'>
                    
                    
                    
                </td>
            </tr>
            
            <tr>
            	<td colspan='2'>
                   <input type='submit' id='install_button' name='install_button' class='button_style_1' value='Install...'>
					<?php
                    if($req_uri[1]==''){
					?>
                        <script>
							document.getElementById('install_button').disabled = true;
						</script>
					<?php
                    }
					?>               
                </td>
            </tr>
                               
        </table>
        </form>
    
    </div>
</div>
</div>
</div>    

<?php

	}else{

	echo "<div id='outer_page'>";
	echo "<div id='inner_page'>";
	echo "<div id='centered_page'>";

	echo "<div class='text1_white' style='width:400px; margin:0 auto; text-align:center;'>";

	//check if all fields are entered...
	//assume yes...


		$dropbox_pass = $_POST['dropbox_pass'];
		$admin_pass = $_POST['admin_pass'];
		$dropbox_name = $_POST['dropbox_name'];
		
	$all_fields_ok = 1;

		if($_POST['dropbox_pass']=='') $all_fields_ok = 0;
		if($_POST['admin_pass']=='') $all_fields_ok = 0;
		if($_POST['dropbox_name']=='') $all_fields_ok = 0;
		
	if($all_fields_ok==1){
	
		echo "Good. You entered all the fields in the form<Br>";
		
	}else{
		
		echo "Please go back and enter all the fields<br>";	
		
	}
	
	
		$good_website_root = 0;
		if($_POST['website_root']!='' || isset($_POST['installing_on_subdomain'])){
			 $good_website_root = 1;
		}
	
		if($good_website_root==1){
		
			echo "Your website root folder is OK.<Br>";
				
		}else{
			
			echo "You should copy all your files to a <B>Folder</b> on your server, under your <b>public_html</b>, <b>www</b> or your main folder that contains web stuff on your server.";
			
		}	
	

			if($all_fields_ok==1 && $good_website_root==1){
			
				
					//gets the URL
					$req_uri = explode("/", $_SERVER["REQUEST_URI"]);
				
					//if installing on subdomain, folder name will be empty
					//otherwise use folder name

					$my_instalation_folder = '';
					if($_POST['installing_on_subdomain']=='on'){
						$my_instalation_folder = '';
					}else{
						$my_instalation_folder = $req_uri[1];
					}
						
			$content = "<?php
						\$global_dropbox_password ='".$dropbox_pass."';
						\$global_admin_password = '".$admin_pass."';
						\$global_dropbox_name = '".addslashes($dropbox_name)."';
						\$global_custom_dropbox_message = '';
						\$global_server_name = '".$_SERVER["SERVER_NAME"]."';
						\$global_installed_folder = '".$my_instalation_folder."';
						?>";
						
						$fp = fopen("auth/global_vars.php","wt");
						fwrite($fp,$content);
						fclose($fp);	
						
						echo "<Br>Saved <b>auth/global_vars.php</b> the file that contains all your global variables. You can edit it by hand later on to change stuff as you like.";
				
						
						echo "<br><br><font style='font-size:30px;'>Instalation complete.</font>";
						
						echo "<Br><Br>";	
						
						echo "<font style='color:red'>Make sure</font> to delete <u>install.php</u><Br>";
						echo "<br>";	
						?>
							<span class='text1_big_1' style='padding:10px;'>Delete <u>install.php</u> ?</span> 
							<input type='button' value='Yes' id='delete_install_button' class='submit_button'/ onClick='delete_install_php();'>
							<div id='deletion_text_box' style='' class='text1_black'><br /></div>
						<?php
						echo "<br><br><br>";

						echo "<div style='display:block; text-align:center; margin-left : 10px;'>";
							echo "<a href='index.php' class='edit_button'>go to your dropBox</a>";
							echo "&nbsp;&nbsp;&nbsp;";
							echo "<a href='documentation.php' class='edit_button'>the documentation</a>";
						echo "</div>";
				
				}
				

			
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
		
?>




<?php

	}

?>


</body>
</html>