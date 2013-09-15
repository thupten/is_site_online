<?php
class Service_model {

	function _get_status_code_after_curl_check($url){
		$status_code = - 1;
		$ch = curl_init($url);
		$options = array (
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_NOBODY => TRUE,
				CURLOPT_FOLLOWLOCATION => TRUE );
		curl_setopt_array($ch, $options);
		curl_exec($ch);
		if (! curl_errno($ch)){
			$infos = curl_getinfo($ch);
			$status_code = $infos ['http_code'];
		} else{
			$status_code = 444;
		}
		curl_close($ch);
		return $status_code;
	}
}