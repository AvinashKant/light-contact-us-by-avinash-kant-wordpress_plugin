<?php 

function submit_ligth_avi_three_form(){
	if(check_ajax_referer('light-avi-nonce', 'security')){
		global $wpdb;
		$error=0;

		$aviLightUserName = strip_tags(trim($_POST['avilightusername']));
		$aviLightUserEmail = strip_tags(trim($_POST['avilightuseremail']));
		$aviLightUserMsg = strip_tags(trim($_POST['avilightusermsg']));

		
		if(empty($aviLightUserName)){
			$msg['username']='Name can not be empty.';
			$error=1;
		}
		
		if(empty($aviLightUserEmail)){
			$msg['useremail']='Email can not be empty.';
			$error=1;
		}
		if(empty($aviLightUserMsg)){
			$msg['usermsg']='Message can not be empty.';
			$error=1;
		}	

		if(!$error){
			$wpdb->insert('avi_light_post_data', array (
				'user_name' => $aviLightUserName,
				'user_email'  => $aviLightUserEmail,
				'user_message'  => $aviLightUserMsg
			) );
			$msg['status']='success';
		}else{
			$msg['status']='fail';
		}

		echo json_encode($msg);
		die();
	}
	
}

?>