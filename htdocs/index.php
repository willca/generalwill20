<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

//date初期か
date_default_timezone_set('Asia/Tokyo');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = new stdClass();

$content->verify_credentials = $connection->get('account/verify_credentials');
$content->rate_limit_status = $connection->get('account/rate_limit_status');

//screen_name

//API残り
$limit = $content->rate_limit_status->hourly_limit;
if(isset($content->rate_limit_status->remaining_hits)) {
	$limit = $content->rate_limit_status->remaining_hits;
	$reset_time = $content->rate_limit_status->reset_time_in_seconds;
	$reset_string = '　API リセット日時:' . date('m/d H:i', $reset_time);
}


if(isset($content->verify_credentials->id))
	$user_id = $content->verify_credentials->id;
else
	$user_id = null;
	
if(isset($content->verify_credentials->id))
	$screen_name = $content->verify_credentials->screen_name;
else
	$screen_name = null;


/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992)));
//$connection->post('friendships/destroy', array('id' => 9436992)));




/* Include HTML to display on the page */
include('html.inc');
