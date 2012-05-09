<?php

require_once("twitteroauth/twitteroauth.php");
require_once("config.php");

//Keyの受け渡しを簡単にするためのクラス
class TOATool {
	
	// Consumer key
	const consumer_key = CONSUMER_KEY;
	
	// Consumer secret
	const consumer_secret = CONSUMER_SECRET;
	
	static private $oauth = null;
	
	//get_oauth()
	//作成したTwitterOAuthオブジェクトを受け取ります
	//事前にcreate_oauthメソッドを呼び出す必要あり。
	static function get_oauth() {
		return self::$oauth;
	}
	
	//create_oauth()
	//TwitterOAuthオブジェクトをを作成します
	//最初に一回呼び出せばOK（一回のアクセス中にユーザーを変更したときなどは除く）
	static function create_oauth($access_token, $access_token_secret) {
		
		return self::$oauth = new TwitterOAuth(self::consumer_key, self::consumer_secret, $access_token, $access_token_secret);
	}
}


//search(string word) 
//@word 検索語。
//@return 直近２０ツイートのユーザーの配列（マージ済み）。
function search($word){
	$url = 'http://search.twitter.com/search.json';
	$params = http_build_query(array('q' => $word, 'lang' => 'ja', 'rpp' => 20));
	$results = json_decode(file_get_contents("$url?$params") , true);
	
	$search_user = array();
	for ($i = 0; $i < count($results["results"]); $i++) {
		if(!isset($search_user[ $results["results"][$i]["from_user_id_str"] ])) {
			
			$search_user[ $results["results"][$i]["from_user_id_str"] ] = array(
				'user_id' => $results["results"][$i]["from_user_id_str"],
				'user_name' => $results["results"][$i]["from_user"],
				'icon' => $results["results"][$i]["profile_image_url"],
			);
		}
	}
	//var_dump(array_unique($search_user));
	return $search_user;
}

//get_tweets(int user_id) 
//@user_id ツイッターユーザーID。
//@return 直近２０ツイートの配列。
function get_tweets($user_id){
	
	// OAuthオブジェクト生成
	$twitterOauth = TOATool::get_oauth();
	$req = $twitterOauth->OAuthRequest("http://api.twitter.com/1/statuses/user_timeline.json","GET",array("user_id"=>$user_id));
//DEBUG対応
//	$req = $twitterOauth->OAuthRequest("http://api.twitter.com/1/statuses/user_timeline.json","GET",array("user_id"=>$user_id, "count"=>2));
	
	$results = json_decode($req);
	
	$user_textinfo = array();
	foreach($results as $value){
		$created_at = (string)($value ->created_at);//発言時刻
		$text = (string)($value->text);//発言内容
		if(is_object($value->geo)) {
			$geo = array(
				'lat' => $value->geo->coordinates[0],//緯度
				'lon' => $value->geo->coordinates[1],//経度
			);
		} else {
			$geo = null;
		}
		$user_textinfo[] = array("created_at"=>$created_at,"text"=>$text,"geo"=>$geo);
	}
	
	return $user_textinfo;
}


//get_lists(int user_id) 
//@user_id ツイッターユーザーID。
//@return 指定ユーザーが含まれるリストの名前の配列。 
function get_lists($user_id){
	
	// OAuthオブジェクト生成
	$twitterOauth = TOATool::get_oauth();
	$req = $twitterOauth->OAuthRequest("http://api.twitter.com/1/{$user_id}/lists/memberships.json","GET",array());
	
	$results = json_decode($req, true);
	
	$list = array();
	for ($i = 0; $i < count($results["lists"]); $i++) {
		$list[] = $results["lists"][$i]["name"];
	}
	
	return array_unique($list);
}


//get_follows(int user_id) 
//@user_id ツイッターユーザーID。
//@return 指定ユーザーがフォローしているユーザーのIDの配列。 
function get_follows($user_id){
	
	// OAuthオブジェクト生成
	$twitterOauth = TOATool::get_oauth();
	
	$ids = array();
	$next_cursor = '-1';
	
	while($next_cursor != 0) {
		$req = $twitterOauth->OAuthRequest("http://api.twitter.com/1/friends/ids.json","GET",array("id" => $user_id, "cursor" => $next_cursor));
		
		$results = json_decode($req, true);
		
		for ($i = 0; $i < count($results["ids"]); $i++) {
			$ids[$results["ids"][$i]] = $results["ids"][$i];
		}
		
		$next_cursor = $results['next_cursor_str'];
	}
	
	return $ids;
}


//get_follows(int user_id) 
//@user_id ツイッターユーザーID。
//@return 指定ユーザーがフォローしているユーザーのIDの配列。 
function get_followers($user_id){
	
	// OAuthオブジェクト生成
	$twitterOauth = TOATool::get_oauth();
	
	$ids = array();
	$next_cursor = '-1';
	
	while($next_cursor != 0) {
		$req = $twitterOauth->OAuthRequest("http://api.twitter.com/1/followers/ids.json","GET",array("id" => $user_id, "cursor" => $next_cursor));
		
		$results = json_decode($req, true);
		
		for ($i = 0; $i < count($results["ids"]); $i++) {
			$ids[$results["ids"][$i]] = $results["ids"][$i];
		}
		
		$next_cursor = $results['next_cursor_str'];
	}
	
	return $ids;
}


//get_sn2id(int user_id) 
//@screen_name スクリーンネーム
//@return ツイッターユーザーID。
function get_sn2id($screen_name){

	$url = 'https://api.twitter.com/1/users/show.json?screen_name=' . $screen_name;
	$req = file_get_contents($url);

	$results = json_decode($req, true);
	
	return $results['id'];
}

