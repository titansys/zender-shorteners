<?php
/**
 * Switchy.io Shortener Controller
 * @author Titan Systems <mail@titansystems.ph>
 */
 
function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */
 
	$apiKey = "API_KEY"; // Switchy.io API key
 
	$shorten = json_decode($system->guzzle->post("https://api.switchy.io/v1/links/create", [
		"headers" => [
			"Api-Authorization" => "{$apiKey}",
		    "Content-Type: application/json"
		],
		"json" => [
			"link" => [
				"url" => $url
			]
		],
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);
 
	return isset($shorten["domain"], $shorten["id"]) ? "https://{$shorten["domain"]}/{$shorten["id"]}" : false;
}