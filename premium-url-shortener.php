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
 
	$apiKey = "API_KEY"; // API key
	$urlSystem = "SITE_URL"; // Your premium url shortener site url. eg. https://mydomain.com
	$customDomain = "CUSTOM_DOMAIN"; // Custom domain, remove value if no custom domain
 
	$data = json_decode($system->guzzle->post("{$urlSystem}/api/url/add", [
		"headers" => [
			"Authorization" => "Bearer {$apiKey}",
		    "Content-Type: application/json"
		],
		"json" => [
			"url" => $url,
			"domain" => empty($customDomain) ? false : $customDomain
		],
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);
 
	return $data["error"] != 0 ? false : $data["shorturl"];
}