<?php

  
                            
	$file_extension = get_file_extension($filename);
	switch(strtolower($file_extension)){
			default: echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_default.png' width=50 height=50 border=0>"; break;
			case 'mp3' : echo ""; break;
			case 'mp4' : echo ""; break;
			case 'wav' : echo ""; break;			
			case 'pdf' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_pdf.png' width=50 height=50 border=0>"; break;
			case 'txt' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_txt.png' width=50 height=50 border=0>"; break;
			case 'doc' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_txt.png' width=50 height=50 border=0>"; break;
			case 'docx' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_txt.png' width=50 height=50 border=0>"; break;
			case 'xls' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_excel.png' width=50 height=50 border=0>"; break;
			case 'ods' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_excel.png' width=50 height=50 border=0>"; break;			
			case 'odt' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_txt.png' width=50 height=50 border=0>"; break;						
			case 'rtf' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_txt.png' width=50 height=50 border=0>"; break;
			case 'exe' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_exe_dll_system.png' width=50 height=50 border=0>"; break;
			case 'dll' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_exe_dll_system.png' width=50 height=50 border=0>"; break;
			case 'dmg' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_exe_dll_system.png' width=50 height=50 border=0>"; break;
			case 'zip' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_zip.png' width=50 height=50 border=0>"; break;			
			case 'rar' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_zip.png' width=50 height=50 border=0>"; break;
			case 'gz' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_zip.png' width=50 height=50 border=0>"; break;
			case 'gzip' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_zip.png' width=50 height=50 border=0>"; break;
			case 'arj' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_zip.png' width=50 height=50 border=0>"; break;
			case 'jpg' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_image.png' width=50 height=50 border=0>"; break;
			case 'jpeg' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_image.png' width=50 height=50 border=0>"; break;
			case 'gif' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_image.png' width=50 height=50 border=0>"; break;
			case 'tiff' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_image.png' width=50 height=50 border=0>"; break;
			case 'png' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_image.png' width=50 height=50 border=0>"; break;			
			case 'avi' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_movie.png' width=50 height=50 border=0>"; break;						
			case 'mov' : echo "<img src='gfx/".$global_file_type_icons_folder."/filetype_movie.png' width=50 height=50 border=0>"; break;									
	}
			
	/* here you can add more icons to the list, if you need other filetypes as well to display a nice icon  
		this file is included in see_files.php, and formats each file with a nice icon in the front of the filename
	
	*/
							
?>							