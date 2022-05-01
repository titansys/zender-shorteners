<?php
/**
 * Phpshort Shortener Controller
 * Script codecanyon https://codecanyon.net/item/phpshort-url-shortener-software/26536593
 * @author Damien Benedetti <damien@benedetti.ovh>
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$accessToken = "ACCESS_TOKEN";
	$urlSystem = "URl_BASE_PHPSHORTS";




	$data = json_decode($system->guzzle->post("https://$urlSystem/api/v1/links", [
		"headers" => [
			"Authorization" => "Bearer $accessToken"
		],
		'form_params' => [
       		 'url' => $url
       	],
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);



	return !isset($data['data']['short_url']) ? false : $data['data']['short_url'];
}