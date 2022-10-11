<?php
/**
 * 66biolinks Shortener Controller
 * @url https://codecanyon.net/item/biolink-boost-instagram-bio-linking/20740546
 * @author Titan Systems 
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$apiKey = "API_KEY"; // API Key from 66biolinks account
	$siteUrl = "https://mydomain.com"; // Your 66biolinks site url. eg. https://mydomain.com
	$urlDomain = "https://mycustomdomain.com"; // The domain to use for the shortened links, if empty, $siteUrl will be used

	try {
		$create = json_decode($system->guzzle->post("{$siteUrl}/api/links", [
			"headers" => [
				"Authorization" => "Bearer {$apiKey}"
			],
			"form_params" => [
				"location_url" => $url
			],
	        "allow_redirects" => true,
	        "http_errors" => false
		])->getBody()->getContents(), true);

		$getLink = json_decode($system->guzzle->get("{$siteUrl}/api/links/{$create["data"]["id"]}", [
			"headers" => [
				"Authorization" => "Bearer {$apiKey}"
			],
	        "allow_redirects" => true,
	        "http_errors" => false
		])->getBody()->getContents(), true);

		return empty($urlDomain) ? "{$siteUrl}/{$getLink["data"]["url"]}" : "{$urlDomain}/{$getLink["data"]["url"]}";
	} catch(Exception $e){
		return false;
	}
}