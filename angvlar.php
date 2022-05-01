<?php
/**
 * Angvlar Shortener Controller
 * @author Titan Systems 
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$apiKey = "API_KEY"; // API Key from your Angvlar account
	$domainId = 1; // (int) The domain ID the link to be saved under.
	$protocol = "https"; // Angvlar protocol, it can be https or http

	$shorten = json_decode($system->guzzle->post("https://api-ssl.bitly.com/v4/shorten", [
		"headers" => [
			"Authorization" => "Bearer {$apiKey}"
		],
		"form_params" => [
			"url" => $url,
			"domain" => $domainId
		],
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);

	return $shorten["status"] == 200 ? "{$protocol}://{$shorten["data"]["short_url"]}" : false;
}