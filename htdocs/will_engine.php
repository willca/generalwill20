<?php
require_once 'tweet_wrapper.php';
require_once 'get_time.php';

function analysis($word) {
    $users = search($word);     // ユーザーIDの配列
    $tweets = array();          // ユーザーのツイート
    $lists = array();           // ユーザーが登録されているリスト
    $follow_rates = array();    // 相互フォロー率の配列
    
    // ユーザーごとのツイートとリストの集約	
    foreach ($users as $user) {
        $user_id = $user['user_id'];
        
        $tweets = array_merge($tweets, get_tweets($user_id));
        $lists = array_merge($lists, get_lists($user_id));

        // 相互フォロー率の統計
        $rate = get_follow_rate($user_id);

        if (isset($follow_rates[$rate])) {
            $follow_rates[$rate]++;
        } else {
            $follow_rates[$rate] = 1;
        }
    }

    ksort($follow_rates, SORT_NUMERIC);

    // ツイート位置情報の統計
    $geos = get_geos($tweets);

    // ツイート日の統計
    $tweet_dates = get_date_for_tweets($tweets);

    // ツイート時間の統計
    $tweet_times = get_time_for_tweets($tweets);
	
    // ツイート長の統計
    $tweet_length = get_length_for_tweets($tweets);
    
    // ハッシュタグの統計
    $hash_tags = get_hash_tags($tweets);
    
    // ソート
    asort($lists);
    asort($hash_tags);
    
    $res = array(
        "user" => $users,
        "tweet" => $tweets,
        "geo" => $geos,
        "list" => $lists,
        "tweet_date" => $tweet_dates,
        "tweet_time" => $tweet_times,
        "tweet_length" => $tweet_length,
        "hash_tag" => $hash_tags,
        "follow_rate" => $follow_rates
    );
    
//    var_dump($res);

    return $res;
}

// ツイート長の統計
// @tweets ツイートの配列
// @return key:ツイート長, value:頻度の連想配列
function get_length_for_tweets($tweets) {
    $num = array();

    foreach ($tweets as $tweet) {
        $l = mb_strlen($tweet["text"], "utf-8");

        if (isset($num[$l])) {
            $num[$l]++;
        } else {
            $num[$l] = 1;
        }
    }
  
    ksort($num, SORT_NUMERIC);

    return $num;
}

// ハッシュタグ配列の取得
// @tweets ツイートの配列
// @return マージされたハッシュタグの配列
function get_hash_tags($tweets) {
    $hash_tags = array();
    
    foreach ($tweets as $tweet) {
        $tokens = preg_split("/ /s", $tweet["text"]);
        
        foreach ($tokens as $token) {
            if (strstr($token, "#")) {
                $hash_tags[] = $token;
            }
        }
    }

    return array_unique($hash_tags);
}

// 相互フォロー率の取得
// @user_id ユーザーID
// @return 相互フォロー率
function get_follow_rate($user_id) {
    $follows = get_follows($user_id);
    $followers = get_followers($user_id);
    
    $follower_cnt = 0;
    
    foreach ($follows as $follow) {
        if (array_key_exists($follow, $followers)) {
            $follower_cnt++;
        }
    }

    if (0 == count($follows)) {
        return 0;
    } else {
        return round(($follower_cnt / count($follows)) * 100);
    }
}

// 位置情報配列の取得
// @tweets ツイートの配列
// @return 位置情報の配列
function get_geos($tweets) {
    $geos = array();
    
    foreach ($tweets as $tweet) {
        $geo = $tweet["geo"];
        $geos[] = array("lat" => $geo["lat"], "lon" => $geo["lon"]);
    }

    return $geos;
}
