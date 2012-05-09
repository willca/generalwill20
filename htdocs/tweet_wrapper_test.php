<?php

//テスト対象のコード
require_once('tweet_wrapper.php');

//debug

//アクセストークンを作成する
//最初に一度呼び出せば良い
TOATool::create_oauth(
	"49650585-Jkfaz7X4v0SbEAkupLnczFOgLo3hL5asN7wGhy9Z4", //access_token
	"7gSHlpRoIiVSWlZYesyC7OZHLJunt7Vi8qWIYqKoo" //access_token_secret
);



if(0){
//呼び出し
$word = "一般意志";
$results = search($word);
//結果表示
echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>Message</title> </head>");
var_dump($results);
}


if(0){
//呼び出し
$user_id = "49650585";
$results = get_tweets($user_id);
//結果表示
echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>Message</title> </head>");
var_dump($results);
}

if(0){
//呼び出し
$user_id = "49650585";
$results = get_lists($user_id);
//結果表示
echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>Message</title> </head>");
var_dump($results);
}


if(0){
//呼び出し
$user_id = "49650585";
$results = get_follows($user_id);
//結果表示
echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>Message</title> </head>");
var_dump($results);
}


if(0){
//呼び出し
$user_id = "49650585";
//$user_id = "9449612"; //あずまん
$results = get_followers($user_id);
//結果表示
echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>Message</title> </head>");
var_dump($results);
}



//呼び出し
$screen_name = "tattyamm";
$results = get_sn2id($screen_name);
//結果表示
echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>Message</title> </head>");
var_dump($results);//tattyammに対して49650585がもらえると正解
