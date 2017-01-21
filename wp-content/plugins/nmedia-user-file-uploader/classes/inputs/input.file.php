<?php
/*
 * Followig class handling file input control and their
* dependencies. Do not make changes in code
* Create on: 9 November, 2013
*/

class NM_File extends NM_Inputs_filemanager{
	
	/*
	 * input control settings
	 */
	var $title, $desc, $settings;
	
	
	/*
	 * this var is pouplated with current plugin meta 
	 */
	var $plugin_meta;
	
	function __construct(){
		
		$this -> plugin_meta = get_plugin_meta_filemanager();
		
		$this -> title 		= __ ( 'File Input', 'nm-filemanager' );
		$this -> desc		= __ ( 'regular file input', 'nm-filemanager' );
		$this -> settings	= self::get_settings();
		
		$this -> input_scripts = array(	'shipped'		=> array(''),
				
										'custom'		=> array(
																	array (
																			'script_name' 	=> 'plupload_script',
																			'script_source' => '/js/plupload-2.1.2/js/plupload.full.min.js',
																			'localized'		=> false,
																			'type' 			=> 'js',
																			'depends'		=> array('jquery'),
																			'in_footer'		=> '',
																	),
																	
																)
															);
		
		add_action ( 'wp_enqueue_scripts', array ($this, 'load_input_scripts'));
		
	}
	
	
	
	
	private function get_settings(){
		
		return array (
						'title' => array (
						'type' => 'text',
						'title' => __ ( 'Title', 'nm-filemanager' ),
						'desc' => __ ( 'It will be shown as field label', 'nm-filemanager' ) 
				),
				'data_name' => array (
						'type' => 'text',
						'title' => __ ( 'Data name', 'nm-filemanager' ),
						'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'nm-filemanager' ) 
				),
				'description' => array (
						'type' => 'text',
						'title' => __ ( 'Description', 'nm-filemanager' ),
						'desc' => __ ( 'Small description, it will be diplay near name title.', 'nm-filemanager' ) 
				),
				'error_message' => array (
						'type' => 'text',
						'title' => __ ( 'Error message', 'nm-filemanager' ),
						'desc' => __ ( 'Insert the error message for validation.', 'nm-filemanager' ) 
				),
				
				'required' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Required', 'nm-filemanager' ),
						'desc' => __ ( 'Select this if it must be required.', 'nm-filemanager' ) 
				),
				
				'class' => array (
						'type' => 'text',
						'title' => __ ( 'Class', 'nm-filemanager' ),
						'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'nm-filemanager' ) 
				),
				
				'width' => array (
						'type' => 'text',
						'title' => __ ( 'Width', 'nm-filemanager' ),
						'desc' => __ ( 'Type field width in % e.g: 50%', 'nm-filemanager' ) 
				),
						
				'dragdrop' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Drag & Drop', 'nm-filemanager' ),
						'desc' => __ ( 'Turn drag & drop on/eff.', 'nm-filemanager' )
				),
				
				'popup_width' => array (
						'type' => 'text',
						'title' => __ ( 'Popup width', 'nm-filemanager' ),
						'desc' => __ ( '(if image) Popup window width in px e.g: 750', 'nm-filemanager' )
				),
				
				'popup_height' => array (
						'type' => 'text',
						'title' => __ ( 'Popup height', 'nm-filemanager' ),
						'desc' => __ ( '(if image) Popup window height in px e.g: 550', 'nm-filemanager' )
				),
				
				'button_label_select' => array (
						'type' => 'text',
						'title' => __ ( 'Button label (select files)', 'nm-filemanager' ),
						'desc' => __ ( 'Type button label e.g: Select Photos', 'nm-filemanager' ) 
				),
				
				
				'button_class' => array (
						'type' => 'text',
						'title' => __ ( 'Button class', 'nm-filemanager' ),
						'desc' => __ ( 'Type class for both (select, upload) buttons', 'nm-filemanager' ) 
				),
				'files_allowed' => array (
						'type' => 'text',
						'title' => __ ( 'Files allowed', 'nm-filemanager' ),
						'desc' => __ ( 'Type number of files allowed per upload by user, e.g: 3', 'nm-filemanager' ) 
				),
				'file_types' => array (
						'type' => 'text',
						'title' => __ ( 'File types', 'nm-filemanager' ),
						'desc' => __ ( 'File types allowed seperated by comma, e.g: jpg,pdf,zip', 'nm-filemanager' ) 
				),
				
				'file_size' => array (
						'type' => 'text',
						'title' => __ ( 'File size', 'nm-filemanager' ),
						'desc' => __ ( 'Type size with units in kb|mb per file uploaded by user, e.g: 3mb', 'nm-filemanager' ) 
				),
				/*'chunk_size' => array (
						'type' => 'text',
						'title' => __ ( 'chunk size', 'nm-filemanager' ),
						'desc' => __ ( 'Enables you to chunk the large file into smaller pieces, e.g: 1mb', 'nm-filemanager' )
				),
				
				'photo_editing' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Enable photo editing', 'nm-filemanager' ),
						'desc' => __ ( 'Allow users to edit photos by Aviary API, make sure that Aviary API Key is set in previous tab.', 'nm-filemanager' ) 
				),
				
				'editing_tools' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Editing Options', 'nm-filemanager' ),
						'desc' => __ ( 'Select editing options', 'nm-filemanager' ),
						'options' => array (
								'enhance' => 'Enhancements',
								'effects' => 'Filters',
								'frames' => 'Frames',
								'stickers' => 'Stickers',
								'orientation' => 'Orientation',
								'focus' => 'Focus',
								'resize' => 'Resize',
								'crop' => 'Crop',
								'warmth' => 'Warmth',
								'brightness' => 'Brightness',
								'contrast' => 'Contrast',
								'saturation' => 'Saturation',
								'sharpness' => 'Sharpness',
								'colorsplash' => 'Colorsplash',
								'draw' => 'Draw',
								'text' => 'Text',
								'redeye' => 'Red-Eye',
								'whiten' => 'Whiten teeth',
								'blemish' => 'Remove skin blemishes' 
						) 
				), */
				
				'logic' => array (
						'type' => 'checkbox',
						'title' => __ ( 'Enable conditional logic', 'nm-filemanager' ),
						'desc' => __ ( 'Tick it to turn conditional logic to work below', 'nm-filemanager' )
				),
				'conditions' => array (
						'type' => 'html-conditions',
						'title' => __ ( 'Conditions', 'nm-filemanager' ),
						'desc' => __ ( 'Tick it to turn conditional logic to work below', 'nm-filemanager' )
				),
			);
	}
	
	
	/*
	 * @params: args
	*/
	function render_input($args, $content=""){
		
		$_html = '<div class="container_buttons">';
			$_html .= '<div class="btn_center">';
			$_html .= '<a id="selectfiles-'.$args['id'].'" href="javascript:;" class="select_button '.$args['button-class'].'">' . $args['button-label-select'] . '</a>';
			
			//$_html .= '<input type="button" name="upload_file_front" value="Upload file" />';
			$_html .= '</div>';
			
			
			
		$_html .= '</div>';		//container_buttons

		if( isset( $args['dragdrop']) && $args['dragdrop'] ){
			
			$_html .= '<div class="droptext">';
				if($this -> if_browser_is_ie())
					$_html .= __('Drag file(s) in this box', 'nm-filemanager');
				else 
					$_html .= __('Drag file(s) or directory in this box', 'nm-filemanager');
			$_html .= '</div>';
		}
    	
    	$_html .= '<div id="filelist-'.$args['id'].'" class="filelist"></div>';
    	
    	
    	echo $_html;
    	
    	$this -> get_input_js($args);
	}
	
	
	/*
	 * Aviary editing tools is returned
	 */
	function get_editing_tools($editing_tools){
	
		parse_str ( $editing_tools, $tools );
		if ($tools['editing_tools'])
			return implode(',', $tools['editing_tools']);
	}
	
	
	/*
	 * following function is rendering JS needed for input
	 */
	function get_input_js($args){
		
		//filemanager_pa($args);
		
		if($this -> if_browser_is_ie())
			$runtimes = 'flash';
		else 
			$runtimes = 'html5,flash,silverlight,html4,browserplus,gear';
		
		$chunk_size =  '1mb';
		
		$popup_width	= $args['popup-width'] == '' ? 600 : $args['popup-width'];
		$popup_height	= $args['popup-height'] == '' ? 450 : $args['popup-height'];
		
			
		
		?>

	<script type="text/javascript">	
		<!--

		var file_count_<?php echo $args['id']?> = 1;
		var uploader_<?php echo $args['id']?>;
		jQuery(function($){

			// delete file
			$("#nm-uploader-area-<?php echo $args['id']?>").find('.u_i_c_tools_del > a').live('click', function(){

				// console.log($(this));
				var del_message = '<?php _e('are you sure to delete this file?', 'nm-filemanager')?>';
				var a = confirm(del_message);
				if(a){
					// it is removing from uploader instance
					var fileid = $(this).attr("data-fileid");
					uploader_<?php echo $args['id']?>.removeFile(fileid);

					var filename  = jQuery('input:checkbox[name="<?php echo $args['id']?>['+fileid+']"]').val();
					
					// it is removing physically if uploaded
					jQuery("#u_i_c_"+fileid).find('img').attr('src', nm_filemanager_vars.plugin_url+'/images/loading.gif');
					
					console.log('filename <?php echo $args['id']?>['+fileid+']');
					var data = {action: 'nm_filemanager_delete_file', file_name: filename};
					
					jQuery.post(nm_filemanager_vars.ajaxurl, data, function(resp){
						alert(resp);
						jQuery("#u_i_c_"+fileid).hide(500).remove();

						// it is removing for input Holder
						jQuery('input:checkbox[name="<?php echo $args['id']?>['+fileid+']"]').remove();
						file_count_<?php echo $args['id']?>--;		
						
					});
				}
			});

			
			var $filelist_DIV = $('#filelist-<?php echo $args['id']?>');
			uploader_<?php echo $args['id']?> = new plupload.Uploader({
				runtimes 			: '<?php echo $runtimes?>',
				browse_button 		: 'selectfiles-<?php echo $args['id']?>', // you can pass in id...
				container			: 'nm-uploader-area-<?php echo $args['id']?>', // ... or DOM Element itself
				drop_element		: 'nm-uploader-area-<?php echo $args['id']?>',
				url 				: '<?php echo admin_url ( 'admin-ajax.php' )?>',
				multipart_params 	: {'action' : 'nm_filemanager_upload_file'},
				max_file_size 		: '<?php echo $args['file-size']?>',
				max_file_count 		: parseInt(<?php echo $args['files-allowed']?>),
			    
			    chunk_size: '<?php echo $chunk_size?>',
				
			    // Flash settings
				flash_swf_url 		: '<?php echo $this -> plugin_meta['url']?>/js/uploader/Moxie.swf',
				// Silverlight settings
				silverlight_xap_url : '<?php echo $this -> plugin_meta['url']?>/js/uploader/Moxie.xap',
				
				filters : {
					mime_types: [
						{title : "Filetypes", extensions : "<?php echo $args['file-types']?>"}
					]
				},
				
				init: {
					PostInit: function() {
						$filelist_DIV.html('');
	
						$('#uploadfiles-<?php echo $args['id']?>').bind('click', function() {
							uploader_<?php echo $args['id']?>.start();
							return false;
						});
					},
	
					FilesAdded: function(up, files) {
						
						var files_added = up.files.length;
						var max_count_error = false;
	
						
						
					    plupload.each(files, function (file) {
	
					    	if(file_count_<?php echo $args['id']?> > uploader_<?php echo $args['id']?>.settings.max_file_count){
					        
					      		max_count_error = true;
					        }else{
					            // Code to add pending file details, if you want
					            add_thumb_box(file, $filelist_DIV, up);
					        }
					        
					        file_count_<?php echo $args['id']?>++;
					    });

					    
					    if(max_count_error)
						    alert('Only '+uploader_<?php echo $args['id']?>.settings.max_file_count+' files are allowed');

					    setTimeout('uploader_<?php echo $args['id']?>.start()', 100);    
						
					},
					
					FileUploaded: function(up, file, info){
						
						/* console.log(up);
						console.log(file);*/
	
						var obj_resp = $.parseJSON(info.response);
						//console.log(obj_resp);
						var file_thumb 	= ''; 
	
						// checking if uploaded file is thumb
						ext = obj_resp.file_name.substring(obj_resp.file_name.lastIndexOf('.') + 1);					
						ext = ext.toLowerCase();
						
						if(ext == 'png' || ext == 'gif' || ext == 'jpg' || ext == 'jpeg'){
	
							file_thumb = nm_filemanager_vars.file_upload_path_thumb + obj_resp.file_name;
							$filelist_DIV.find('#u_i_c_' + file.id).find('.u_i_c_thumb').html('<img src="'+file_thumb+ '" id="thumb_'+file.id+'" />');
							
							var file_full 	= nm_filemanager_vars.file_upload_path + obj_resp.file_name;
							// thumb thickbox only shown if it is image
							$filelist_DIV.find('#u_i_c_' + file.id).find('.u_i_c_thumb').append('<div style="display:none" id="u_i_c_big' + file.id + '"><img src="'+file_full+ '" /></div>');
	
							// Aviary editing tools
							if('<?php echo $args['photo-editing']; ?>' === 'on'){
								var editing_tools = '<?php echo $this -> get_editing_tools($args['editing-tools']); ?>';
								$filelist_DIV.find('#u_i_c_' + file.id).find('.u_i_c_tools_edit').append('<a onclick="return launch_aviary_editor(\'thumb_'+file.id+'\', \''+file_full+'\', \''+obj_resp.file_name+'\', \''+editing_tools+'\')" href="javascript:;" title="Edit"><img width="15" src="'+nm_filemanager_vars.plugin_url+'/images/edit.png" width="16" /></a>');
							}
	
							// zoom effect
							$filelist_DIV.find('#u_i_c_' + file.id).find('.u_i_c_tools_zoom').append('<a href="#TB_inline?width=<?php echo $popup_width?>&height=<?php echo $popup_height?>&inlineId=u_i_c_big'+file.id+'" class="thickbox" title="'+obj_resp.file_name+'"><img src="'+nm_filemanager_vars.plugin_url+'/images/zoom.png" width="16" /></a>');
							is_image = true;
						}else{
							file_thumb = nm_filemanager_vars.plugin_url+'/images/file.png';
							$filelist_DIV.find('#u_i_c_' + file.id).find('.u_i_c_thumb').html('<img src="'+file_thumb+ '" id="thumb_'+file.id+'" width="16" />');
							is_image = false;
						}
						
						// adding checkbox input to Hold uploaded file name as array
						$filelist_DIV.append('<input style="display:none" checked="checked" type="checkbox" value="'+obj_resp.file_name+'" name="<?php echo $args['id']?>['+file.id+']" />');
					},
	
					UploadProgress: function(up, file) {
						//document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
						//console.log($filelist_DIV.find('#' + file.id).find('.progress_bar_runner'));
						$filelist_DIV.find('#u_i_c_' + file.id).find('.progress_bar_number').html(file.percent + '%');
						$filelist_DIV.find('#u_i_c_' + file.id).find('.progress_bar_runner').css({'display':'block', 'width':file.percent + '%'});
					},
	
					Error: function(up, err) {
						//document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
						alert("\nError #" + err.code + ": " + err.message);
					}
				}
				
	
			});
			
			uploader_<?php echo $args['id']?>.init();

		});	//	jQuery(function($){});

		function add_thumb_box(file, $filelist_DIV){

			var inner_html 	= '<div class="u_i_c_tools_bar">';
			inner_html		+= '<div class="u_i_c_tools_del"><a href="javascript:;" data-fileid="' + file.id+'" title="Delete"><img src="'+nm_filemanager_vars.plugin_url+'/images/delete.png" width="16" /></a></div>';
			inner_html		+= '<div class="u_i_c_tools_edit"></div>';
			inner_html		+= '<div class="u_i_c_tools_zoom"></div><div class="u_i_c_box_clearfix"></div>';
			inner_html		+= '</div>';
			inner_html		+= '<div class="u_i_c_thumb"><div class="progress_bar"><span class="progress_bar_runner"></span><span class="progress_bar_number">(' + plupload.formatSize(file.size) + ')<span></div></div>';
			inner_html		+= '<div class="u_i_c_name"><strong>' + file.name + '</strong></div>';
			  
			jQuery( '<div />', {
				'id'	: 'u_i_c_'+file.id,
				'class'	: 'u_i_c_box',
				'html'	: inner_html,
				
			}).appendTo($filelist_DIV);

			// clearfix
			// 1- removing last clearfix first
			$filelist_DIV.find('.u_i_c_box_clearfix').remove();
			
			jQuery( '<div />', {
				'class'	: 'u_i_c_box_clearfix',				
			}).appendTo($filelist_DIV);
		}

		//--></script>
<?php
			
	/*if ($args ['photo-editing'] == 'on') {
			
			
			echo '<script type="text/javascript" src="http://feather.aviary.com/js/feather.js"></script>';
			
			echo '<script type="text/javascript">';
			// it is setting up Aviary API
			echo 'if(\'' . $args ['aviary-api-key'] . '\' != \'\'){';
			echo 'var featherEditor = new Aviary.Feather({';
			echo 'apiKey			: \'' . $args ['aviary-api-key'] . '\',';
			echo 'apiVersion		: 3,';
			echo 'theme			: \'dark\','; // Check out our new 'light' and 'dark' themes!
			echo 'postUrl		: nm_filemanager_vars.ajaxurl+\'?action=nm_filemanager_save_edited_photo\',';
			echo 'onSave			: function(imageID, newURL) {';
			echo 'var img = document.getElementById(imageID);';
			echo 'img.src = newURL;';
			echo 'featherEditor.close();';
			echo '},';
			echo 'onError			: function(errorObj) {';
			echo 'alert(errorObj.message);';
			echo '}';
			echo '});';
			echo '}';
			
			
			echo 'function launch_aviary_editor(id, src, file_name, editing_tools) {';
			echo 	'editing_tools = (editing_tools == "" && editing_tools == undefined) ? \'all\' : editing_tools;';
				echo 'featherEditor.launch({';
					echo 'image: id,';
					echo 'url: src,';
					echo 'tools: editing_tools,';
					echo 'postData			: {filename: file_name},';
				echo '});';
				echo 'return false;';
			echo '}';
			echo '</script>';
		}*/
	}
}