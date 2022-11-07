<?php
/**
 * BeLink Shortener Controller
 * @url <https://codecanyon.net/item/belink-ultimate-url-shortener/24354590>
 * @author Titan Systems 
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$belinkUrl = "https://belink.vebto.com"; // The url of your belink site, don't add ending slash
	$accessToken = "C73vOqDLEvOUVAmTF1Ejbm4IkGHcMnIcaSBENvSl"; // Access token from your belink account

	$shorten = $system->guzzle->post("{$belinkUrl}/api/v1/link", [
		"headers" => [
			"accept" => "application/json",
			"Content-Type" => "application/json",
			"Authorization" => "Bearer {$accessToken}"
		],
		"json" => [
			"type" => "direct",
			"active" => true,
			"long_url" => $url
		],
        "allow_redirects" => true,
        "http_errors" => false
	]);


	if($shorten->getStatusCode() == 200):
		try {
			$decode = json_decode($shorten->getBody()->getContents(), true);
			return isset($decode["link"]["short_url"]) ? $decode["link"]["short_url"] : false;
		} catch(Exception $e){
			return false;
		}
	else:
		return false;
	endif;
}