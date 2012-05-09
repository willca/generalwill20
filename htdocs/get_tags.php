<?php
//
// get_tags(int $user_id)
// %IN... int user_id(Twitter)
// %OUT.. string[] タグ
//

//CSVファイル定義
define('CSVFILE', 'data/tag_map.txt');
define('DELIMITER', ',');      //データ区切り(カンマ)
define('ENCLOSURE', '"');      //データ囲み文字(ダブルクォーテーション)

function get_tags( $user_id  ){

  //ファイルを開く
  $id2tag = array();
  
  if( $fp = fopen(CSVFILE, 'r') ){
	// do nothing;
  }else{
  	return array();
  }
  
  while ($field_array = fgetcsv($fp, 4096, DELIMITER, ENCLOSURE)) {

    $uid = array_shift($field_array);
    $name = array_shift($field_array);
  
      $id2tag[$uid] = array();
      foreach ($field_array as $value) {
  	array_push($id2tag[$uid], $value);
      }  
  }
  //ファイルを閉じる
  fclose($fp);
  
  if( isset( $id2tag[$user_id][1]) ){
  	return $id2tag[$user_id];
  }else{
  	return array();
  }

}

//test
if(0){
$hoge = get_tags(87084847);
var_dump($hoge);
}

if(0){
$myArray = array('first' => 1,'second'=>2,
'名'=> "ピーター",'イニシャル'=> "B",
'製' => "マッキンタイアー");
$myArray[] = "555-5678";

#echo "################\n";
#var_dump($myArray);
#echo "################\n";
#array_splice($myArray, 5);
#echo "################\n";
#var_dump($myArray);
}

?>

