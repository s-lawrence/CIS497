<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Documentation</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="css/admin_theme_white.css" rel="stylesheet" type="text/css">
	</head>

<body>
<style>


	.headline_paging{
	
		 font-family : Verdana, Helvetica, sans-serif;
		 font-size : 14px; 
		 color : #26b0b0;
		 background-color : #ffffff;
		 padding : 5px;
		 width : 200px;
		 text-align : center;
		 
		-webkit-border-radius : 16px;
		border-radius : 16px;
		border : 1px solid #26b0b0;			 
		
	}
	
	.picture_paging{
	
		 font-family : Verdana, Helvetica, sans-serif;
		 font-size : 14px; 
		 color : #26b0b0;
		 background-color : #ffffff;
		 padding : 5px;
		 width : 100px;
		 text-align : center;
		 
		-webkit-border-radius : 16px;
		border-radius : 16px;
		border : 1px solid #26b0b0;			 
		
	}

</style>
<div class='admin_page_holder'>  
    <div class='table_admin_default_clean'>
    
	<!-- this is the top anchor for the page, so from each subsection, the user can easily go back to the list of contents -->
	<a name='top'></a>
	
    <table cellpadding=4 cellspacing=0 border=0 width='94%' align='center' class='admin_table_documentation'>
    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom'>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;Documentation</div>
        </td>
	</tr>

	<Tr onMouseOver='this.className="admin_features_tr"' onMouseOut='this.className="admin_features_tr_transparent"'>
        <td class='table_separator_top table_separator_bottom' align='justify'>
	        
		<div style='margin:20px;'>
		We have built this section with your needs in mind. We documented thoroughly the uploader section,
		so you can easily understand and insert it into your code.
		<Br><br>
		We also described in detail the installing and uninstalling process + general infos on how everything works.<br><br>
		<b style='margin-left:120px;'>Table of contents</b>
		</div>

		<ul style='margin-left:170px;'>
			<li><a href='#documentation_on_ajax_uploader'>1. Full documentation on our <b>AJAX file uploader</b></a></li>
			<li><a href='#compatibility'>2. Compatibility</a></li>
			<li><a href='#system_variables'>3. System variables</a></li>
			<li><a href='#themes'>4. CSS Themes</a></li>
			<li><a href='#stored_files'>5. Stored files</a></li>
			<li><a href='#how_to_install'>6. How to install</a></li>
			<li><a href='#how_to_uninstall'>7. How to uninstall</a></li>
			<li><a href='#folder_auth_explained'>8. Folder <b>auth</b> explained</a></li>
		</ul>
			
		</td>
	</tr>

    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
		
		<!-- anchor -->
		<a name='documentation_on_ajax_uploader'></a>
		
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;1. Full documentation on AJAX uploader</div>
        </td>
	</tr>	
	
	<Tr onMouseOver='this.className="admin_features_tr"' onMouseOut='this.className="admin_features_tr_transparent"'>
        <td class='table_separator_top table_separator_bottom' align='justify'>
	        <div class='admin_statistics_help_1'>
            
			Below you'll find the complete documentation on an important part of our website, the AJAX uploader. You will learn
			how it works, what every function does and how to implement it separately in your code.
			
	            <!-- div that shows the menu icon + description -->
            	<div class='doc_menu_item'>
                    <table class='tr_menu_admin'>	
                        <tr>
                        	<td class=''>
                            	<img src='gfx/documentation/main_uploader_view.png' border=0 align=left hspace=20 vspace=20>
                                
                <p><!-- end -->
                  The uploader section is present on our mobile-ready frontpage, the actual dropBox (see image to the left). Users login to your dropBox and upload files to your webserver, that are stored in a sub-folder for you.<br><br>
                  We will further explain the uploader, since it is separated nicely in 3 files, and it can very easily be embedded as your own uploader, in your website. It is made in pure Javascript and plain simple PHP (no object / class code), with elegant CSS3 classes
                  for nice graphics.
                  <br><Br>
                  So, the uploader is spread across 3 files: <b>my_dropbox.php</b>, <b>upload.js</b> and <b>upload.php</b>.
                  <br><br>
                  <b>my_dropbox.php</b> contains the .php code that displays the actual uploader, <b>upload.js</b> contains the pure Javascript code
                  used to run the client-side code and to transfer the file and <b>upload.php</b> contains
                  the actual code that saves the file on the server or throws an error if the file is already there.
                  <br><br>
                  These 3 files are located in the <b>"root"</b> folder of your instalation folder.
                  So let's begin inspecting the contents of my_dropbox.php.
                  <br>
                </p>                                
                        	</td>      
                        </tr>
                	</table>
                </div>


                <p class='headline_paging'><b>my_dropbox.php</b> explained below</p>
                
                <p class='picture_paging'>image 1 / 7</p>
                <img src='gfx/documentation/my_dropbox_1.jpg' border=1>
                
                <p>First, we start the _SESSION (in case you need to have _SESSION variables in your website), include <b>auth/auth.php</b> where we include the current theme (from <b>theme.php</b> and global variables from <b>global_vars.php</b>)<br>
                and set error reporting to no debug.
                <br><br>
                Next PHP little script is called when you change the graphic theme. It checks which theme you selected, creates the new content for <b>theme.php</b>
                stored in <em>$content</em> variable, then opens the <em>theme.php</em> file for writing, writes in the file the new current theme, and also sets it as the global current theme.
                <Br><Br>
                Since we wanted all this to be simple, we don't have database connection and database saving.
                </p>

				<p class='picture_paging'>image 2 / 7</p>
                <img src='gfx/documentation/my_dropbox_2.jpg' border=1>
                
                <p>In <b>image 2</b>, we have a Javascript function called <b>getFileData</b> which gets triggered after you selected a file to upload.
                <Br>
                It reads the file name, runs a Regular Expression on it to clean it of unwanted characters (to be save proof) and displays
                a <em>status message</em> in the status message box of the uploader that "the file is loaded, click the <b>Upload</b> button to start".
                </p>


				<p class='picture_paging'>image 3 / 7</p>
                <img src='gfx/documentation/my_dropbox_3.jpg' border=1>
                
                <p>In <b>image 3</b>, it first checks if user is logged in. We store this information in the variable <em>$_SESSION['user_logged_in']</em>.
                This variable is turned to 1 when loggin in succesfully. If the value is 0, then the page will not display and redirect back to the login box.
                <Br><Br>
                The 3 DIVS (outer_page, inner_page and centered_page) are used to encompass the whole page, so everything gets nicely centered. You can find
                the CSS positioning code in the folder CSS, there are the 3 CSS themes.
                <Br><br>
                Then there's the <b>main_module</b> DIV, that contains the logo of myDropbox, and all other DIVs that create the uploader (statistics, buttons etc.).
                <BR><br>
                The <em>file_container_title</em> DIV contains 2 messages : 1 that's always displaying the current servers's MAX size upload file,
                and an optional variable called <em>$global_custom_dropbox_message</em> which is found in <b>auth/global_vars.php</b>.
                You can always edit the file and set it to a message of your own that your users can see (such as a welcome message or a more personalized HTML message). 
                <Br><Br>
                We use it in our demo version to let people know that we have a limit on our servers and inform them of a delay while the file is saving. You can
                write whatever you want in this variable, or just leave it empty.
                </p>


				<p class='picture_paging'>image 4 / 7</p>
                <img src='gfx/documentation/my_dropbox_4.jpg' border=1>
                <p>
                	In <b>image 4</b> we can see the code inside <em>file_container</em> DIV.
                    <Br><Br>
                    It contains the text <b>Send me a file</b>, the file browsing INPUT dialog, the progress GIF animated image (stored in DIV _progress), the progress
                    text DIV (the percentage loaded), progress time DIV that displays statistics when uploading a file (KB/s, time remaining) and the progress status,
                    which is the window where infos are displayed such as (file is loaded or file is complete or file already exists).
                    <Br><Br>
                    These DIVs contain a corresponding class (eg. class='progress_time') that is found in the current theme CSS data, located in the folder <b>CSS</b>.
                    <Br><Br>
                    For example if your current theme is set to <em>text_mode.css</em> theme, and you want to customise the progress time (where you get stats on seconds
                    remaining or KB/s upload), you go edit <em>css/text_mode.css</em> and look for the class called <b>.progress_time</b>. There you can style your
                    text, colors, background or anything else for the progress_time DIV.
                
                </p>

				<p class='picture_paging'>image 5 / 7</p>
                <img src='gfx/documentation/my_dropbox_5.jpg' border=1>

                <p>
                	In <b>image 5</b>, we define the <em>menu_holder</em> DIV that will display "stop upload" button, when the transfer is active,
                    the "see uploaded files" and the "log out" button.
                    <br><Br>
                    Below, there's the <em>change_theme</em> DIV where you can choose between the currently available themes.
                </p>

				<p class='picture_paging'>image 6 / 7</p>
                <img src='gfx/documentation/my_dropbox_6.jpg' border=1>
                <p>
	                In <b>image 6</b>, we can see the HTML and PHP code that manages the selection for changing the theme.
                </p>

				<p class='picture_paging'>image 7 / 7</p>
                <img src='gfx/documentation/my_dropbox_7.jpg' border=1>
                <p>
                	In <b>image 7</b>, we initially hide the <em>stop_upload_in_progress</em> button, and show it only when the file is being uploaded.
                    <Br><Br>
                    The latest part of the image shows the code that redirects back to "index.php" if the current user has not provided a good password.
                    <Br><br>
                    And that's it for the main dropBox file. Next, we'll present the Javascript core that does almost all the tricks.
                </p>

                
				<p class='headline_paging'><b>upload.js</b> explained below</p>
                
                <p class='picture_paging'>image 1 / 5</p>
                <img src='gfx/documentation/upload_JavaScript_1.jpg' border=1>
                
                <p>In the first 10 var declarations, we declare 10 Javascript variable to which we assign the DIVs that we need to work with.
                <br><br>
                
                Then we can see the main upload_file <em>function</em> that gets triggered when we hit the "Upload" button in the main uploader.
                <Br><Br>
                
                It first checks if there are any files loaded, and if the size of the file is greater than 0, otherwise it quits.
                
                <Br><Br>
                Then it modifies the <em>_progress_status</em> DIV, to "Upload started..".
                <Br><Br>
                
                
                </p>

				<p class='picture_paging'>image 2 / 5</p>
                <img src='gfx/documentation/upload_JavaScript_2.jpg' border=1>
                
                <p>In <b>image 2</b>, we start by changing the "Upload" button appearance to "Uploading..", by changing <em>_submit.value</em>
                <br>
                We then disable the button, so we can't click it during the upload process and display the button that lets us stop the upload.
                <Br><br>
                We also display the <em>_progress_text</em> DIV on the page (the percent counter, eg. 27%) so we can see how much
                of the upload is going on. Initially, for graphical purposes it is hidden from the page.
                <Br><br>
                Then we declare a Javascript variable <em>data</em> of type FormData, which means we're gonna use the transfer such as
                POST, and include the file we loaded for upload. Ignore the <em>user_id</em> field. This was from the other application,
                and it's useful if you want to upload the file with a certain <em>id</em>, say you want to upload a certain file for a certain person,
                good for your future apps.
                <Br><br>
                Then we create an AJAX object, that's the Javascript way to send data in the background to our server where all the files are being uploaded.
                <em>createRequestObject</em> function does this.
                <Br><br>
                Then we initialize the variable <b>http</b> to hold our AJAX object, with whom we'll upload files and have statistics every step of the way.
                <Br>
                Then we initialize all sorts of variables like <em>bytes_per_second</em> or <em>total_remaining_minutes</em>
                that we'll use next to calculate our transfer statistics.
                
                
                </p>                
                

				<p class='picture_paging'>image 3 / 5</p>
                <img src='gfx/documentation/upload_JavaScript_3.jpg' border=1>
                
                <p>
                
                In <b>image 3</b>, we now open a request to the server, like we're sending a FORM with POST attribute, but via our <em>http</em> Ajax object. 
                It opens <em>upload.php</em> when the upload is completed, and <em>upload.php</em> will handle the actual saving of the file on the server.
				In the Ajax terminology, if <em>http.readyState==4</em> and <em>http.status==200</em>,
                means everything is complete and done, and then it executes <em>upload.php</em>.
                <Br><Br>
                We now get the JSON message from <em>upload.php</em> and we display it "File uploaded succesfully etc.", we revert the "Uploading.." button to "Upload" and activate it again.
                We also hide the <em>_stop_upload_in_progress</em> button, since the file has transferred.
				<br>
                                
                </p>
                
				<p class='picture_paging'>image 4 / 5</p>
                <img src='gfx/documentation/upload_JavaScript_4.jpg' border=1>
                
                <p> In <b>image 4</b>, we can see the <Em>catch</Em>part of the <b>try / catch</b> error checking handler that shows a corresponding error if there's any.
                <br><Br>
                Below then, there's the function that makes the real transfer.<br><Br>
                
                We add a listener for the upload event <em>http.upload.addEventListener</em>, and define the function that displays the live statistics of the upload.
                (percentage, time left, KB/s).
                <Br><br>
                You can see there we're calculating the percent uploaded. This function gets called each time we succesfully sent a packet of data to the server.
                The <b>Ajax</b> object <em>http</em> we've created earlier, sends chunks of data to the server, and each time it advaces it calls this event listener
                function). You can play around and do all kinds of statistics, based on the <em>e.loaded</em> and <em>e.total</em> variables. They hold the current
                total bytes of the file to be uploaded and the bytes currently loaded. We also use <em>Date().getTime()</em> Javascript function to define our own
                chronometer, so we can estimate the remaining time of the file being uploaded.
                </p>
                
				<p class='picture_paging'>image 5 / 5</p>
                <img src='gfx/documentation/upload_JavaScript_5.jpg' border=1>
                
                <p> In <b>image 5</b>,we calculate <em>bytes_per_second</em> and <em>total_time_remaining</em> variables, that we use to display
                the file transfer statistics.
                <br>
                The <em>_progress_time.innerHTML</em> is used to display in <em>_progress_time</em> DIV our statistics.
                <Br><br>
                Don't forget that <b>upload.js</b> file that we're discussing here is included at the end of <b>my_dropbox.php</b>, so the purpose
                of having 2 separate files is for clarity.
                <Br><br>
                <em>http.send(data)</em> does start the code for the <em>http AJAX object</em> and basically starts sending the POST variable <b>data</b> to the server.
                Remember, we attached a file to this POST variable called <em>data</em>, that is our file we want to upload.
                <Br><Br>
                Then, the last line in <b>upload.js</b> is a crucial one, it actually binds a <em>click</em> event listener to our "Upload" <em>submit</em> button,
                that says, "if anyone clicks on the <b>upload</b> button, execute the function <em>upload_file</em>".
                </p>
                
				<p class='headline_paging'><b>upload.php</b> explained below</p>
                
                <p class='picture_paging'>image 1 / 1</p>
                <img src='gfx/documentation/upload_PHP_file.jpg' border=1>
                
                <p> This above is the whole content of our file.
                Basically, when the file is finally uploaded, our <em>http</em> AJAX object calls on <b>"upload.php"</b>.
                <Br>
                In <em>upload.php</em>
                we start the _SESSION to preserve it, include main <b>auth.php</b> file that contains all the global variables we need,
                and clear debugging (do not display notices from the PHP system).
                <BR><BR>
                Then we have a function declared, <em>outputJson</em>, that displays a message, which our AJAX object will read back and display, such as
                "File uploaded succesfully" or similar messages.
                <Br><br>
                The important stuff for saving the file is the <b>move_uploaded_file</b> function, that saves the file to our <em>uploaded-files</em> folder.
                <br><br>
                And that's about it, this is the code used for uploading a file with <em>Ajax</em>. 
                <br><Br>
                We believe that the code itself is simple enough and with lots of comments + and our comments here
                will help you integrate in little time the <b>AJAX uploader code</b> into your own website, anyone with basic programmer skills should be able to get it fast.
                
                <br><Br>
                               
                               
                </p>
                
	        </div>
		</td>
    </tr>	
    
    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
   		<a name='compatibility'></a>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;2. Compatibility<span>&nbsp;&nbsp;&nbsp;<a class='go_to_top_button' href='#top'>go to top ^</a></span></div>
        </td>
	</tr>
	
	<Tr>
    	<td align='center' valign='middle' class='textbig_1 table_separator_top table_separator_bottom' valign='top' width='207'>
        
        	<table cellpadding=2 border=0>

            	<tr>

                    <td class='admin_statistics_help_1' valign='top'>
						<span class='documentation_underline_text_1'>[Windows]</span><br>
                        
						This webapp is compatible / tested with Google Chrome, Mozilla Firefox, Apple's Safari and Opera.<br><br>
                        <span class='documentation_underline_text_1'>[Apple / Mac]</span><br>
                        Mac/Apple users can use Safari as the browser and everything runs fine.<br><Br>
                        <span class='documentation_underline_text_1'>[mobile / Android]</span><br>
                        Android devices (tablets / phones) run ok, can do anything in the app including uploading.<br><br>

			<a name='system_variables'></a>

						<span class='documentation_underline_text_1'>[mobile / iOS]</span><br>
                        iOS devices run fine.
                    
                   </td>
                </tr>

            </table>
        

        
		</td>
    </tr>

    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;3. System variables<span>&nbsp;&nbsp;&nbsp;<a class='go_to_top_button' href='#top'>go to top ^</a></span></div>
        </td>
	</tr>
	
	
	<Tr>
    	<td align='center' valign='middle' class='textbig_1 table_separator_top table_separator_bottom' valign='top' width='207'>
        

        	<table cellpadding=2 border=0>

            	<tr>

                    <td class='admin_statistics_help_1' valign='top'>
                                            
                        The folder <span class='documentation_underline_text_1'>"auth"</span> contains system variables in 2 files.
                        After the installation, in the server folder "auth" (so not your local folder), 2 more files
                        will be created : <span class='documentation_underline_text_1'>global_vars.php</span> and <span class='documentation_underline_text_1'>theme.php</span>.
                        
                        <br><br>
                        <span class='documentation_underline_text_2'>global_vars.php</span> will contain the global scope variables where you have important stuff defined such as domain address, passwords, etc. We wanted to keep the whole script clean
                        with no database (e.g. mySql) saving, so we save our few things directly into these 2 files.
                        
                        <br><br>
                        <span class='documentation_underline_text_2'>theme.php</span> will contain the .css filename of the current theme in use.
                        
                        
				<a name='themes'></a>		
						
						
						<br><br>
                        All these variables are explained below, further down the page.
                    
                   </td>
                </tr>

            </table>
        
        
		</td>
    </tr>

    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;4. CSS Themes<span>&nbsp;&nbsp;&nbsp;<a class='go_to_top_button' href='#top'>go to top ^</a></span></div>
        </td>
	</tr>	
	
	<Tr>
    	<td align='center' valign='middle' class='textbig_1 table_separator_top table_separator_bottom' valign='top' width='97'>
        

        	<table cellpadding=2 border=0>

            	<tr>

                    <td class='admin_statistics_help_1' valign='top'>
                    
                        The 1st version of this web snippet / standalone comes with 3 themes defined in our website. <span class='documentation_underline_text_1'>Sleek white</span>, <span class='documentation_underline_text_1'>Text mode</span> and <span class='documentation_underline_text_1'>Lightblue</span>.  In the future, we'll come up with more themes.
                        
					<a name='stored_files'></a>
					
                   </td>
                </tr>

            </table>
        
        
		</td>
    </tr>

    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;5. Stored files<span>&nbsp;&nbsp;&nbsp;<a class='go_to_top_button' href='#top'>go to top ^</a></span></div>
        </td>
	</tr>	
	
	<Tr>
    	<td align='center' valign='middle' class='textbig_1 table_separator_top table_separator_bottom' valign='top' width='97'>
        

        	<table cellpadding=2 border=0>

            	<tr>

                    <td class='admin_statistics_help_1' valign='top'>
                    
                        All files being uploaded with the script are stored in the <span class='documentation_underline_text_1'>"uploaded-files"</span> folder. 
                    
                   </td>
                </tr>

            </table>
        
		<a name='how_to_install'></a>		
        
		</td>
    </tr>

  
    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;6. How to install<span>&nbsp;&nbsp;&nbsp;<a class='go_to_top_button' href='#top'>go to top ^</a></span></div>
        </td>
	</tr>	

	<Tr>
    	<td align='center' valign='middle' class='textbig_1 table_separator_top table_separator_bottom' valign='top' width='97'>
        

        	<table cellpadding=2 border=0>

            	<tr>

                    <td class='admin_statistics_help_1' valign='top'>
                    
                    	<ul>
                        <li>
                            Make a folder named myDropbox (or any other simple name, but no spaces or other special characters, for your later convenience).
                            Make sure the folder is exactly under your web hosting folder, so the whole link would be http://yoursite.com/myDropbox .
                            Extract all the files from the .ZIP in this folder
                        </li>
                        <li>    
                            Then,
                            run <span class='documentation_underline_text_2'>http://www.yoursite.com/myDropbox/install.php</span> and follow the few steps there.
						</li>
                        <li>                            
                            After installing, delete install.php, or keep it somewhere else where noone can execute it.
                            And also keep the original archive somewhere too.                   
						</li>
                        <li>                            
                            And you're done.
                            
                            The password for the admin module, can be found in auth/global_vars.php as <span class='documentation_underline_text_2'>$global_admin_password</span>
                            and the password to access the uploader is set in auth/global_vars.php as <span class='documentation_underline_text_2'>$global_dropbox_password</span>
						</li>
                       	</ul>
                        
                   </td>
                </tr>

            </table>
        
			<a name='how_to_uninstall'></a>
        
		</td>
    </tr>

    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;7. How to uninstall<span>&nbsp;&nbsp;&nbsp;<a class='go_to_top_button' href='#top'>go to top ^</a></span></div>
        </td>
	</tr>	

	<Tr>
    	<td align='center' valign='middle' class='textbig_1 table_separator_top table_separator_bottom' valign='top' width='97'>
        

        	<table cellpadding=2 border=0>

            	<tr>

                    <td class='admin_statistics_help_1' valign='top'>

                            Just delete the folder you have installed the app into on your server. It will delete all files, including the uploaded files.
                            <Br>
                            Since there's no connection to any MySql database, this would be all you need to do.
                        
                   </td>
                </tr>

            </table>
        
       <a name='folder_auth_explained'></a>
		</td>
    </tr>

    

	
    
    <tr class='admin_header_edit_user'>
      	<td colspan='2' height='50' class='table_separator_bottom table_separator_top'>
 		<div class='text_header_popups'>&nbsp;&nbsp;&nbsp;8. Folder "auth" explained<span>&nbsp;&nbsp;&nbsp;<a class='go_to_top_button' href='#top'>go to top ^</a></span></div>
        </td>
	</tr>	

   
    <tr class=''>
    	<td colspan='2' class='text1_big_1 table_separator_top table_separator_bottom' valign='middle' align='center' width='97' height='60'>
        <div class='text_header_popups'>[global_vars.php]</div>
        </td>
    </tr>
    <tr>
        <td colspan='2' align='center' class='table_separator_bottom table_separator_top'>
        
        	<table cellpadding=1 cellspacing=6 border=0>

            	<tr>
                	<td class='text6_blue' valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_admin_password</div>
                    this is the password to your administration module, where only YOU see the uploaded files and manage them (delete or download).</td>
                </tr>  
            	<tr>
                	<td class='text6_blue' valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_dropbox_password</div>
                    this is the password that you give to anyone you wish to upload you files via the main login of the website.</td>
                </tr>
 
            	<tr>
                	<td class='text6_blue' valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_dropbox_name</div>
                   (optional) it displays a Dropbox name on the front side of the website (e.g. Lorem Ipsum 's dropBox</td>
                </tr>    
                                             
            	<tr>
                	<td class='text6_blue' valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_custom_dropbox_message</div>
                   (optional) it displays a custom message inside the uploader so anyone can see it (be creative or write something to let user know)</td>
                </tr>  
                
            	<tr>
                	<td class='text6_blue' valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_file_type_icons_folder</div>
                    is set so the web-app knows where to find the icons for the appropriate filetype (mp3, pdf etc.)</td>
                </tr>                                   
                       
            	<tr>
                	<td class='text6_blue' valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_server_name</div>
                    your http:// link to your domain where you have installed the app (important!)</td>
                </tr> 
                
            	<tr>
                	<td class='text6_blue' valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_installed_folder</div>
                    the folder name where you have installed the app. If you installed to a sub-domain, this variable should be empty.</td>
                </tr>                                        
                              
            </table>        
        
        </td>        
    	</tr>
        
        <tr class=''>
            <td colspan='2'class='text1_big_1 table_separator_top table_separator_bottom' valign='middle' align='center' width='97' height='60'>
            <div class='text_header_popups'>[theme.php]</div>
            </td>
        </tr>
        <tr>
        <td colspan='2' align='center' class='table_separator_top'>
        	<table cellpadding=1 cellspacing=6 border=0
            	<tr>
                	<td valign='middle'></td>
                    <td class='admin_statistics_help_2' valign='top'>
                    <div class='text6_blue'>$global_admin_theme_file</div>
                    this is the .CSS style currently used all throughout the website. It's being modified each time you change your theme.</td>
                </tr>
            </table>
        </td>    
    
    </tr>    
    
	</table>
    
    </div>
  </div>

</body>
</html>
  