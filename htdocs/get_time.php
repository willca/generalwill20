<?php

//date初期か
date_default_timezone_set('Asia/Tokyo');

// ツイートリストからツイートの時間分布を返す
// get_time_for_tweets( array array_tweets)
//@array_tweets 
//@return 時間分布のハッシュ
function get_time_for_tweets( $array_tweets ){
	$init_hour = 0;
	$end_hour = 23;
	
	$hour_list = array();
	
	// 初期化
	for( $i=$init_hour; $i<$end_hour+1; $i++){
		$hour_list[$i] = 0;
	}
	
	// 0〜23　の配列に分布させる
	foreach( $array_tweets as $tweet){
		$str_date = $tweet['created_at'];
		//$i = strpos( $date, ':');
		//$hour = (int)substr( $date, $i-2, 2);
				
		$time_date = strtotime($str_date);
		$hour =  (int)date("H" ,$time_date);
		
		$hour_list[$hour]++;
	}
	
	
	return $hour_list;
}

// ツイートリストからツイートの日付分布を返す
// get_time_for_tweets( array array_tweets)
//@array_tweets 
//@return 日付分布のハッシュ
function get_date_for_tweets( $array_tweets){
	
	$date_list = array();
	
	foreach( $array_tweets as $tweet){
		$str_date = $tweet['created_at'];
		$time_date = strtotime($str_date);
		//$time_date = strtotime($str_date);
		$date = date("Y-m-d" ,$time_date);
		
		if (isset($date_list[$date])) {
            $date_list[$date]++;
        } else {
            $date_list[$date] = 1;
        }
	}
	
	return $date_list;
}

//GMT変換のメソッド　不要になった
function cast_to_jpn_date( $date){
	return strtotime($date);
	
	$i = strpos( $date, '+');
	$diff_gmt = (int)substr( $date, $i, 5);
	
	if( $diff_gmt == "+0900"){
		$jpn_date =  strtotime($date);
	}else if( $diff_gmt == "+0000"){
		var_dump($date);
		$jpn_date =  strtotime($date);
		
		var_dump( date( 'Y年m月d日 H時i分s秒', $jpn_date));
	}else{
		$jpn_date =  strtotime($date);
	}
	return $jpn_date;
}

	
function arrayTransformToJS( $array){
	$keys = array_keys($array);
    $v_php = "["; 
    foreach( $keys as $key){
    	$v_php .= "['" . $key ."'," . $array[$key]. "], " ;
    }
    $v_php .= "]";
	return $v_php;
}





?>