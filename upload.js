// here happens main Javascript action for the uploader

	var _stop_upload_in_progress = document.getElementById('stop_upload_in_progress');
	var _submit = document.getElementById('_submit');
	var _file = document.getElementById('_file');
			
	var _user_id = document.getElementById('_user_id').value;
	var _progress = document.getElementById('_progress');
	var _progress_text = document.getElementById('_progress_text');
	var _progress_time = document.getElementById('_progress_time');
	var _progress_file = document.getElementById('_progress_file');
	var _progress_status = document.getElementById('_progress_status');
	
	
	//here below starts the main upload function
	
	var upload_file = function(){
	
		if(_file.files.length === 0){
			return;
		}
	
		//write in _progress_status	that upload has started
		var my_current_status = document.getElementById('_progress_status').innerHTML
		my_current_status = my_current_status + '<br><span class="text1_light_gray" style="font-size:12px; font-weight:bold;">Upload started, please wait..</font>'
		document.getElementById('_progress_status').innerHTML = my_current_status 
	
		//change "Submit" button's text and also disables it
		_submit.value = 'Uploading..'
		_submit.disabled = true;
		_stop_upload_in_progress.style.visibility = 'visible';
	
		//make sure progress background color is white and visible
		_progress_text.style.visibility = 'visible'
		_progress_text.style.backgroundColor = 'white';
		
		var data = new FormData();
		
		
	/* code for cleaning up the filename before uploading */
	
		var file = _file.files[0];  
		var filename = file.name;
	   	var clean_file_name = filename

		//replace bad filename-chars with empty space - clean up filename characters before uploading...in the line below
		var clean_file_name = file.name.replace(/[|&;$%@"<>+,#!?"=\\:`{}\^*'|\/]/gi, "");
		filename = clean_file_name
		
		//alert(filename)
	
	/* end code for cleaning up filename */	
	
		//append to FORM Data the file and the new filename
		data.append('SelectedFile', _file.files[0], filename);
		data.append('user_id', _user_id);
	
		//function that creates the AJAX object for transferring files (data) to server
		
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
	
		var bytes_per_second=0;
		var total_remaining_seconds;
		var total_remaining_minutes;
		var total_remaining_seconds_reminder;
		var elapsed_seconds=0
		var cont=1
		var time_check_1 = new Date().getTime() / 1000;
		var time_check_2;
	
		var phpscript = 'upload.php'
		http.open('post', phpscript)
		//http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		http.onreadystatechange = function()
				{
					if(http.readyState == 4)
					{
						if(http.status == 200)
						{	
						
							_progress_text.style.backgroundColor='#22c2c2';
							_progress_text.style.border='1px solid #333333';
	
								try {
									
									//parses the JSON received from upload.php and puts it in the Javascript variable resp
									var resp = JSON.parse(http.responseText);
	
									_progress_status.innerHTML = '<br>' + resp.data + '';
									
									//transfer finnished
									//makes "Upload" button again true (clears disabled flag) so we can again click on it
									_submit.disabled = false;
	
									_progress.style.width = '100%';
									_progress_text.innerHTML = '100%'								
	
									_submit.value = "Upload"
									_progress_time.innerHTML = '<br><font style="font-size:11px;"><br>You can upload another file.</font>';
									_stop_upload_in_progress.style.visibility = 'hidden';
									
									_progress_text.style.border='none';
									
									//reset file
									$("#_file").val('');
									
									//reset looks of "Submit" button
									document.getElementById('_submit').className = "button_style_1"
									
								} 
								
								catch (e){
									var resp = {
										status: 'error',
										data: 'Unknown error occurred: [' + http.responseText + ']'
									};
									_progress_status.innerHTML = resp.status + ':' + resp.data;								
									
								}
								
								console.log(resp.status + ': ' + resp.data);
	
						}
					}
				}


			//the magic "progress" event handler (that does tricks while uploading)
			
			http.upload.addEventListener('progress', function(e){
		
				_progress.style.width = '' + Math.ceil((e.loaded/e.total) * 100) + '%';
				_progress_text.innerHTML = Math.ceil((e.loaded/e.total) * 100) + '%'
		
				//remaining time code
				time_check_2 = new Date().getTime() / 1000;
				if(time_check_2>=time_check_1+1){
					
					if(bytes_per_second=0){
						bytes_per_second = e.loaded
					}else{
						bytes_per_second = Math.ceil((e.loaded - bytes_per_second) / elapsed_seconds)
					}
						elapsed_seconds++
						time_check_1 = time_check_2
				}
				
				total_remaining_seconds = Math.ceil((e.total-e.loaded)/bytes_per_second) 
						
				//test if KB/sec is integer value		
				
				if (parseInt(bytes_per_second).toString() === bytes_per_second.toString()){
					kbytes_per_second = Math.ceil(bytes_per_second / 1000);
				}else{
					kbytes_per_second = 'n/a'
				}
				
				_progress_time.innerHTML = '<span class="download_text_highlight">' + kbytes_per_second + ' KB/s</span>,<br><span class="download_text_highlight">' + elapsed_seconds + '</span> seconds elapsed,<br>' + 'remaining <span class="download_text_highlight">' + total_remaining_seconds + ' seconds</span><br>' + 'or <span class="download_text_highlight">' + Math.floor(total_remaining_seconds/60) + ' minutes.';
				
			}, false);
			
			//AJAX object send function
			http.send(data);
	}

//the upload file event handler, that starts on click on the big "Upload" button
_submit.addEventListener('click', upload_file);