<div class="list">
<h3>ハッシュ</h3>
<ul>
<?
	echo "<li>";
	echo join("</li><li>", $res["hash_tag"]);
	echo "</li>";
?>
</ul>
</div>
<div class="list">
<h3>リスト</h3>
<ul>
<?
	echo "<li>";
	echo join("</li><li>", $res["list"]);
	echo "</li>";
?>
</ul>
</div>

