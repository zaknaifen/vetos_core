<?php
	class Mo_Wpum_Sign_Up_Actions{

		private $user_level_check = array( 'key' => 'wp_user_level', 'value' => '0', 'compare' => '>=');

		private $user_capabilities_check = array( 'key' => 'wp_capabilities', 'compare' => 'EXISTS' );

		private $relation_and = array( 'relation' => 'AND' );

		private $relation_or = array( 'relation' => 'OR' );

		function __construct(){
			add_filter( 'template_include', array( $this,'mo_wpum_activation_check' ), 100);
			add_action( 'init', array( $this,'mo_wpum_register_query_vars' ) );
		}

		function mo_wpum_register_query_vars() {
			global $wp;
			$wp->add_query_var( 'user' );
			$wp->add_query_var( 'admin' );
		}

		public function mo_wpum_new_user_signup( $user_id ){
			global $wpdb,$db_queries,$mo_manager_utility,$notification_actions;
			delete_user_option( $user_id, 'capabilities' );
			delete_user_option( $user_id, 'user_level'   );
			$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->users} SET user_status = 2 WHERE ID = %d", $user_id ) );
			$db_queries->add_customer_signup($user_id);
			$notification_actions->mo_wpum_send_admin_notification($user_id);
		}

		public function mo_wpum_activate_user( $user_id, $signup_id ){
			global $wpdb, $db_queries, $mo_manager_utility;
			if( $mo_manager_utility->is_registered()){
				$user = new WP_User($user_id);
				$role = get_option('default_role');
				$user->set_role($role);
				$db_queries->delete_customer_signup($signup_id);
				$wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->users} SET user_status = 0 WHERE ID = %d", $user_id ) );
			}	
		}

		public function mo_wpum_delete_user( $user_id, $signup_id ){
			global $wpdb, $db_queries, $mo_manager_utility;
			if( $mo_manager_utility->is_registered()){
				$db_queries->delete_customer_signup($signup_id);
				$wpdb->delete("{$wpdb->prefix}users",
					array( 'ID' => $user_id ),
					array( '%d' ,)
				);
			}
		}

		function mo_wpum_activation_check($template){
			global $wpdb,$wp_query,$mo_manager_utility,$db_queries,$default_template;
			if($wp_query->get('user')=="activate"){
					$mo_signup_id = $_GET['id'];
					$mo_activation_key = $_GET['key'];
					$signup_activation_key = $wpdb->get_var( $wpdb->prepare( "SELECT activation_key FROM {$wpdb->prefix}signups WHERE signup_id = %d",$mo_signup_id ) );
				if($signup_activation_key == $mo_activation_key){
					$user = $db_queries->get_customer_user_detail($mo_signup_id,$signup_activation_key);
					$user_id = $user->ID;
					$user_name = $user->user_login;
					$site_name = get_bloginfo();
					$this->mo_wpum_activate_user($user_id,$mo_signup_id);
					$_SESSION['login_message'] = "<p class='message register'>Your Account has been activated successfully.</p>";
					$content = $default_template->activation_confirmation;
					$content = str_replace('##User Name##',$user_name,$content);
					$content = str_replace('##Blog Name##',$site_name,$content);
					$from_mail = 'no-reply@miniorange.com';
					$to_mail = get_option('admin_email');
					$subject = 'miniOrange User Management | '.get_bloginfo();
					$headers = "From: no-reply@miniorange.com\r\n";
					$headers .= "Content-Type: text/html";
					if( get_option('mo_wpum_send_email_enable') == 1 ){
						if((ini_get('SMTP')!= FALSE)  ||(ini_get('smtp_port') != FALSE)){
							wp_mail($to_mail,$subject,$content,$headers);
						}
					}
				}else{
					$_SESSION['login_message'] = "<div id='login_error'>An error occured</div>";
				} 
				wp_redirect(wp_login_url());	
			}elseif($wp_query->get('admin')=="activate"){
					$mo_signup_id = $_GET['id'];
					$mo_activation_key = $_GET['key'];
					$signup_activation_key = $wpdb->get_var( $wpdb->prepare( "SELECT activation_key FROM {$wpdb->prefix}signups WHERE signup_id = %d",$mo_signup_id ) );
				if($signup_activation_key == $mo_activation_key){
					$user = $db_queries->get_customer_user_detail($mo_signup_id,$signup_activation_key);
					$user_id = $user->ID;
					$user_name = $user->user_login;
					$this->mo_wpum_activate_user($user_id,$mo_signup_id);
					$_SESSION['login_message'] = "<p class='message register'>User has been activated successfully.</p>";
					$site_name = get_bloginfo();
					$content = $default_template->activation_confirmation;
					$content = str_replace('##User Name##',$user_name,$content);
					$content = str_replace('##Blog Name##',$site_name,$content);
					$from_mail = 'no-reply@miniorange.com';
					$to_mail = get_option('admin_email');
					$headers = "From: no-reply@miniorange.com\r\n";
					$headers .= "Content-Type: text/html";
					$subject = 'miniOrange User Management | '. get_bloginfo();
					if( get_option('mo_wpum_send_email_enable') == 1 ){
						if((ini_get('SMTP')!= FALSE)  ||(ini_get('smtp_port') != FALSE)){
							wp_mail($to_mail,$subject,$content,$headers);
						}
					}
				}else{
					$_SESSION['login_message'] = "<div id='login_error'>An error occured</div>";
				}
				wp_redirect(wp_login_url());	
			}
			return $template;
		}

		public function mo_wpum_table_query_args($args){
			$args['meta_query'] = array( $this->relation_and, $this->user_level_check, $this->user_capabilities_check );
			return $args;
		}
	}
?>