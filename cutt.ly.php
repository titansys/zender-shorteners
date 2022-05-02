<?php
/**
 * Cutt.ly Shortener Controller
 * @author Damien Benedetti <damien@benedetti.ovh>
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$accessToken = "ACCESS_TOKEN";

	$url = urlencode($url);




	$data = json_decode($system->guzzle->post("https://cutt.ly/api/api.php?key=$accessToken&short=$url", [
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);


	return $data['url']['status'] != 7 ? false : $data['url']['shortLink'];
}