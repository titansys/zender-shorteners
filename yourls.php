<?php
/**
 * Yourls Shortener Controller
 * @author Titan Systems 
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$yourDomain = "https://yourls-domain-here.com"; // don't add ending slash
	$username = "USERNAME"; // username of your yourls admin
	$password = "PASSWORD"; // password of your yourls admin

	$shorten = json_decode($system->guzzle->post("{$yourDomain}/yourls-api.php", [
		"form_params" => [
			"username" => $username,
			"password" => $password,
			"action" => "shorturl",
			"format" => "json",
			"url" => $url
		],
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);

	try {
		$sUrl = $shorten["shorturl"] == "success" ? $shorten["shorturl"] : false;
	} catch(Exception $e){
		$sUrl = false;
	}

	return $sUrl;
}