	//alert( avi_ajax_script_obj.ajax_url);

	var $aviLightPlugin = jQuery.noConflict();
	$aviLightPlugin("#avi_light_user_details_form_id").submit(function(e) {
		e.preventDefault();
		$aviLightPlugin('#avi_light_submit_btn').hide();
		$aviLightPlugin('#avi_light_all_error').html('');
		var error=0;
		var avi_light_customer_name = $aviLightPlugin.trim($aviLightPlugin('#avi_light_user_name_id').val());
		var avi_light_customer_email = $aviLightPlugin.trim($aviLightPlugin('#avi_light_user_email_id').val());
		var avi_light_customer_msg = $aviLightPlugin.trim($aviLightPlugin('#avi_light_user_message_id').val());
		
		
		if (avi_light_customer_name == "" || avi_light_customer_name == null) {
			$aviLightPlugin('#avi_light_all_error').append("<li>"+'Name can not be empty.'+"</li>");
			error=1;
		}
		//Check the Customer Email for invalid format 
		
		var avi_email_at_position = avi_light_customer_email.indexOf("@");
		var avi_email_dot_position = avi_light_customer_email.lastIndexOf(".");
		if (avi_email_at_position<1 || avi_email_dot_position<avi_email_at_position+2 || avi_email_dot_position+2>=avi_light_customer_email.length) {
			$aviLightPlugin('#avi_light_all_error').append("<li>"+'Given email address is not valid.'+"</li>");
			error=1;
		}

		if (avi_light_customer_msg == "" || avi_light_customer_msg == null) {
			$aviLightPlugin('#avi_light_all_error').append("<li>"+'Message can not be empty.'+"</li>");
			error=1;
		}

		if(!error){
			var data = $aviLightPlugin("#avi_light_user_details_form_id").serialize();
			if(data){
				$aviLightPlugin.ajax({
					url: avi_ajax_script_obj.ajax_url,
					type: 'post',
					data: {
						action : 'submit_ligth_avi_three_form',
						avilightusername : avi_light_customer_name,
						avilightuseremail : avi_light_customer_email,
						avilightusermsg : avi_light_customer_msg,
						security : avi_ajax_script_obj.check_nonce,
					},
					success: function (res) {					
						var obj = JSON.parse(res);
						if(obj.status == 'success'){
							alert('successfully Save.');
							window.location.reload(true);
						}else if(obj.status == 'fail'){
							$aviLightPlugin.each( obj, function( key, value ) {
								if(value!='fail'){
									$aviLightPlugin('#avi_light_all_error').append("<li>"+value+"</li>");
								}
							});
						}else{
							alert('Please refresh your page and try again');
						}
						$aviLightPlugin('#avi_light_submit_btn').show();
					},error: function (jqXHR, exception) {
						alert(exception);
						window.location.reload(true);
					},
				});
			}else{
				alert('Please fill form.');
			}
		}else{
			$aviLightPlugin('#avi_light_submit_btn').show();
		}
	});