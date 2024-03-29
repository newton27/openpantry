<?php

	/*	user.lib.php
		@richard pianka
		
		contains functions to manipulate and retrieve from the blog database	*/
	
	define('access_home', pow(2, 0));
	define('access_client', pow(2, 1));
	define('access_inventory', pow(2, 2));
	define('access_all', pow(2, 30));
		
	function create_user($username, $password, $first_name, $last_name, $email, $access) {
		$salt = rand_str(32);
		$checksum = md5(md5($password) . $salt);
		
		$s = q("insert into user values('', '".clean_query($username)."', '".clean_query($checksum)."', '".clean_query($salt)."', '".clean_query($first_name)."', '".clean_query($last_name)."', '".clean_query($email)."', '".clean_query($access)."');");
		
		return (a() > 0 ? true : false);
	}
	
	function is_access($try) {
		$access = 0;
		$temp = get_session('user');
		$user_entry = (strlen($temp) > 0 ? unserialize($temp) : null);
		if ($user_entry != null) {
			$access = $user_entry['access'];
		}
		
		return (($access & $try) == $try ? true : false);
	}
		
	function get_user_by_id($userid) {
		$s = q("select * from user where user.userid = '".clean_query($userid)."' limit 1;");
		
		if (n($s) > 0)
			return f($s);
			
		return null;
	}
	
	function get_user_by_username($username) {
		$s = q("select * from user where user.username = '".clean_query($username)."' limit 1;");
		
		if (n($s) > 0)
			return f($s);
			
		return null;
	}
	
	function get_all_users() {
		$s = q("select * from user order by userid asc;");
		return rtoa($s);
	}
	
	function edit_user($userid, $username, $first_name, $last_name, $email) {
		$s = q("UPDATE user SET username = '".clean_query($username)."', first_name  = '".clean_query($first_name)."', last_name  = '".clean_query($last_name)."', email  = '".clean_query($email)."' WHERE userid = '".clean_query($userid)."' LIMIT 1;");
		if(a() > 0)
			return true;
		return false;
	}
	
	function delete_user($userid) {
		$s = q("DELETE FROM user WHERE userid = '".clean_query($userid)."' LIMIT 1;");
		if(a() > 0)
			return true;
		return false;
	}
	
	function user_change_password($userid, $old_password, $new_password) {		
		$user_entry = get_user_by_id($userid);
		$checksum = md5(md5($old_password) . $user_entry['salt']);
		if ($checksum == $user_entry['password']) {
			// valid old password, set new password
			$new_checksum = md5(md5($new_password) . $user_entry['salt']);
			$s = q("UPDATE user SET password = '".clean_query($new_checksum)."' WHERE userid = '".clean_query($userid)."' LIMIT 1;");
			if(a() > 0)
				return true;
			return false;
		} else // invalid old password
			return false;
	}
?>