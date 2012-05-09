<?php

require_once('get_tags.php');

function get_social_tags($id){
	/*
	 * 未テスト。ディクショナリが完成した際にテスト予定
	 * ユーザーIDを渡すと、ソーシャルグラフから浮かび上がるその人の属性をタグという形で返却する。
	 *
	 * @$follower_array=$fameのフォロワーのユーザIDを入れるint配列
	 * @$follow_list=引数ユーザIDのフォローリストのint配列
	 * @$merged_array = $follow_arrayと$follower_arrayの要素で共通なものを入れるint配列
	 * @$fame = タグ持ちのタグを入れたString配列
	 * @$tags=結果のタグそのものを入れるString配列
	 */

	$follower_array = array();
	$follow_array = get_follows($id);
	$merged_array = array();
	$tags = array();
	foreach($follow_array as $follow){
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
	if((double)$target/(double)($base-1) >= 0.2) return true;
	else return false;
}




class User{
	private $user_id;
	private $follows;
	private $followers;
	private $tags;

	public function __construct(int $id){
		self::$user_id = $id;
	}
	public function set_follows(){
		self::$follows = get_follows(self::$user_id);
	}
	public function get_user_id(){
		return self::$user_id();
	}
	public function get_follows(){
		return self::$follows;
	}

	//$tag_array = tagが入っているString配列。
	//必ず正規化して渡してください(つまりタグのダブりがないように)
	public function set_tags($tag_array){
		self::$tags = $tag_array;
	}
	public function get_tags(){
		return self::$tags;
	}

	public function set_followers(){
		self::$followers = get_followers(self::$user_id);
	}
}



