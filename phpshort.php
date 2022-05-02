<?php
/**
 * Phpshort Shortener Controller
 * @url https://codecanyon.net/item/phpshort-url-shortener-software/26536593
 * @author Damien Benedetti <damien@benedetti.ovh>
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$apiKey = "API_KEY"; // API Key from a phpshort account
	$domainId = 1; // (int) The domain ID the link to be saved under.
	$siteUrl = "https://mydomain.com"; // Your phpshort site url. eg. https://mydomain.com
	$protocol = "https"; // Your phpshort site protocol, https or http

	$shorten = json_decode($system->guzzle->post("{$siteUrl}/api/v1/links", [
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