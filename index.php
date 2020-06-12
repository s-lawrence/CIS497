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

	<title>CIS497G DropBox</title>
	
	<link href="css/admin_theme_white.css" rel="stylesheet" type="text/css">

	<link rel="stylesheet" media="(min-width : 240px) and (max-width : 319px) and (orientation: portrait)" href="css/responsive/responsive_portrait_small.css" type="text/css"> <!-- small phone portrait -->
	<link rel="stylesheet" media="(min-width : 320px) and (max-width : 359px) and (orientation: portrait)" href="css/responsive/responsive_portrait_regular.css" type="text/css"> <!-- regular phone portrait -->
	<link rel="stylesheet" media="(min-width : 360px) and (max-width : 413px) and (orientation: portrait)" href="css/responsive/responsive_portrait_big.css" type="text/css"> <!-- big phone portrait -->
	<link rel="stylesheet" media="(min-width : 414px) and (max-width : 424px) and (orientation: portrait)" href="css/responsive/responsive_portrait_huge.css" type="text/css"> <!-- huge phone portrait -->
	
</head>

<body>

<?php

	//if you didn't run installer yet, go there
	if($global_server_name==''){
	?>
    	<script>
			document.location = 'install.php';
        </script>
    <?php	
	}
	//end checking 

?>


<?php
	if($_POST['parse']!='login'){
		
	$_SESSION['user_logged_in'] = 0;
?>

<div id='outer_page'>
<div id='inner_page'>
<div id='centered_page'>

    <form id="form1" name="form1" method="post" action="index.php">
    <input type='hidden' id='parse' name='parse' value='login' />

        <div id='index_login_holder' class='admin_login_index'>

        <div class='small_logo'><img src='gfx/main_logo_small.png' border=0/></div>
        
   
            <div class='index_login_title'>
                  <?php
                    if($global_dropbox_name!=''){

						 echo $global_dropbox_name;
					}
                  ?>
            </div>
            
            <div style='clear:both; margin-bottom : 30px;'></div>
            
            <div>
                
				password &nbsp; <input name="pass" type="password" class="input_pass" id="pass" size="11" autofocus/> 
				<Br>
								
            </div>
            <div style='clear:both; margin-bottom : 30px;'></div>            
            <div>
                <input type="submit" class='button_style_1' src="gfx/login.png" name="button" id="button" value="Submit" border=0>
            </div>
			<br>
        </div>

    </form>

</div>
</div>
</div>

<?php
	}else if($_POST['pass']==$global_dropbox_password){
		
		$_SESSION['user_logged_in'] = 1;
		
?>

			<script language="javascript" type="text/javascript">
            
                window.location.href = 'my_dropbox.php'
            
            </script> 	

<?php
	}else if($_POST['pass']!=$global_dropbox_password){
		
		$_SESSION['user_logged_in'] = 0;
?>

			<script language="javascript" type="text/javascript">
            
                window.location.href = 'index.php'
            
            </script> 	

<?php
	}
?>

</body>
</html>