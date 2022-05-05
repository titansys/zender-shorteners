<?php
/**
 * Premium-url-shortener Shortener Controller
 * Script codecanyon https://codecanyon.net/item/premium-url-shortener/3688135
 * @author Damien Benedetti <damien@benedetti.ovh>
 */
 
function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */
 
	$accessToken = "ACCESS_TOKEN"; // API token/key
	$urlSystem = "SITE_URL"; // Your premium url shortener site url. eg. https://mydomain.com
 
	$data = json_decode($system->guzzle->post("{$urlSystem}/api/url/add", [
		"headers" => [
			"Authorization" => "Bearer {$accessToken}",
		    "Content-Type: application/json"
		],
		"json" => [
			"url" => $url
		],
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);
 
	return $data["error"] != 0 ? false : $data["shorturl"];
}