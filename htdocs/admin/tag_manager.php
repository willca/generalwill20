<?php
//$file = "data/tag_map_1.txt";
//@readfile($file);
$file = fopen("/Projects/generalwill20/htdocs/data/tag_map_1.txt", "r"); 

$row = array();

while(!feof($file)){ 
    $str = fgets($file); 
    $arr = explode(",", $str);
    $row[] = array("user_id" => $arr[0], "user_name" => $arr[1], "user_tag" => array_slice($arr, 2));
} 

//閉じる 
fclose($file);

?>

<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<style type="text/css">
table#tag_table {
    width: 530px;
    border: 1px #E3E3E3 solid;
    border-collapse: collapse;
    border-spacing: 0;
}

table#tag_table th {
    padding: 5px;
    border: #E3E3E3 solid;
    border-width: 0 0 1px 1px;
    background: #F5F5F5;
    font-weight: bold;
    line-height: 120%;
    text-align: center;
}
table#tag_table td {
    padding: 5px;
    border: 1px #E3E3E3 solid;
    border-width: 0 0 1px 1px;
    text-align: center;
}
</style>
</head>
<body>
<form action="update_tag" method="POST">
    <table id="tag_table">
        <th>ユーザーID</th>
        <th>ユーザー名</th>
        <th>タグ</th>
        
<?php
foreach ($row as $l) {
?>
  <tr>
    <td>
        <input type="text" name="textbox" value="<?php echo $l['user_id'] ?>">
    </td>
    <td>
  echo $l["user_name"];
    </td>
    <td>
  echo  join(",",$l["user_tag"]);
    </td>
  </tr>
<?php
}
?>
        </table>
    <input type="submit" value="更新"></input>
</form>
    </body>
</html>