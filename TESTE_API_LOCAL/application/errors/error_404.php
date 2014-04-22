<?php
header("HTTP/1.1 404 Not Found");
$CI =& get_instance();
if(!$CI->session->userdata('user_id') || !$CI->session->userdata('username') || !$CI->session->userdata('name_site')) {
		echo header("location:/backend/login");
}else{
		echo "Página de erro";
}
?> 