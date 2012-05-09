<?php
//////////
//////////
////////// this is test code fro get_social_tags
//////////
//////////

session_start();

require_once('get_tags.php');
require_once('tweet_wrapper.php');

TOATool::create_oauth(
	$_SESSION['access_token']['oauth_token'], //access_token
	$_SESSION['access_token']['oauth_token_secret'] //access_token_secret
);

function get_social_tags($id){

	$follower_array = array();
	$follow_array = get_follows($id);
	$merged_array = array();
	$tags = array();
	foreach(get_follows($id) as $follow){
		$fame = get_tags($follow);
		if(0 < count($fame)){
			foreach(get_followers($follow) as $follower){
				$follower_array[] = $follower;
			}
			foreach($follow_array as $element1){
				foreach($follower_array as $element2){
					if($element1 == $element2){
						$merged_array[]=$element1;
					}
				}
			}
			
			if(tag_shade_filter(count($merged_array),count($follow_array))){
				foreach($fame as $added_tag){
					$tags[]=$added_tag;
				}
			}
		}
	}
	
	$tags = array_unique($tags);
	
	return $tags;
}

function tag_shade_filter($target ,$base){
	if((double)$target/(double)$base >= 0.2) return true;
	else return false;
}

$t = get_social_tags(439645910);
var_dump($t);


