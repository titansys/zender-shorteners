<?php
/**
 * Bit.ly Shortener Controller
 * @author Titan Systems 
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$accessToken = "ACCESS_TOKEN";
	$bitlyDomain = "bit.ly";

	$shorten = json_decode($system->guzzle->post("https://api-ssl.bitly.com/v4/shorten", [
		"headers" => [
			"Authorization" => "Bearer {$accessToken}"
		],
		"json" => [
			"domain" => $bitlyDomain,
			"long_url" => $url
		],
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);

	return !isset($shorten["link"]) ? false : $shorten["link"];
}