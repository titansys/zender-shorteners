<?php
/**
 * vk.cc Shortener Controller
 * @author CityPeople.ru (Ruslan)
 */

function shortenUrl($url, &$system){
	/**
	 * Implement shortening here
	 * @return string:Success
	 * @return false:Failed
	 */

	$access_token = "ACCESS_TOKEN";

	$shorten = json_decode($system->guzzle->post("https://api.vk.com/method/utils.getShortLink?url=".urlencode($url)."&access_token={$access_token}&v=5.199", [
        "allow_redirects" => true,
        "http_errors" => false
	])->getBody()->getContents(), true);
	

	return !isset($shorten["response"]["short_url"]) ? false : $shorten["response"]["short_url"];
}
