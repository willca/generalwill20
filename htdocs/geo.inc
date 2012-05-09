<?php

$map_geo = "";
foreach($res["geo"] as $geo){
	//echo($geo["lat"].$geo["lon"]);
	if($geo["lat"] == null){
		continue;
	}
	if($map_geo == ""){
		$map_geo = $map_geo.$geo["lat"].",".$geo["lon"];
	}else{
		$map_geo = $map_geo."|".$geo["lat"].",".$geo["lon"];
	}
}

//echo($map_geo);
$map_url = "http://maps.google.co.jp/maps/api/staticmap?markers=".$map_geo."&zoom=4&size=300x300&sensor=false";
//echo($map_url);

if($map_geo != ""){
	echo("<img src='$map_url'>");
}else{
	echo("位置情報が見つかりませんでした。");
}

