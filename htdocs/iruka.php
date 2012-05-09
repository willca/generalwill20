<?php


require 'will_engine.php';

//パラメータを受け取る
if($_SERVER["REQUEST_METHOD"] != "POST"){
    // GET ブラウザからHTMLページを要求された場合
    $word = $_GET['word'];
}else{
    // POST フォームからPOSTによって要求された場合
    $word = $_POST['word'];
}

//セッションスタート
session_start();

//認証OKなら
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    header('Location: ./clearsessions.php');
} else {
	TOATool::create_oauth(
		$_SESSION['access_token']['oauth_token'], //access_token
		$_SESSION['access_token']['oauth_token_secret'] //access_token_secret
	);
}

//処理開始時間を保持
$start_time = time();

//分析処理
$res = analysis($word);

//処理終了時間を保持
$complete_time = time();


//経過時間を表示

	
	echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> 
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>いるかの戯れ言</title> ");

?>


		<link rel="stylesheet" type="text/css" href="./js/jquery.jqplot.min.css" />
 <!--[if IE]><script language="javascript" type="text/javascript" src="./js/excanvas.min.js"></script><![endif]-->
  <script language="javascript" type="text/javascript" src="./js/jquery.min.js"></script> 
  <script language="javascript" type="text/javascript" src="./js/jquery.jqplot.min.js"></script>
  <script language="javascript" type="text/javascript" src="./js/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script  type="text/javascript">
    function disableSubmit(form) {
      var elements = form.elements;
      for (var i = 0; i < elements.length; i++) {
        if (elements[i].type == 'submit') {
          elements[i].disabled = true;
        }
      }
    }
</script>
  
	</head>
	<body>
	
	<?
      	include('search.inc');
	  ?>
		<p>入力キーワード： <?php echo htmlspecialchars($word); ?></p>
		
		<div><p>
		
		<?php
		foreach($res['user'] as $u) {
			print '<a href="http://twitter.com/#!/'. $u['user_name'].'" target="_blank"><img src="'. $u['icon'] .'" title="'.$u['user_name'].'"></a> ';
		}
		
		?>
		</p></div>
		
		<?php
		$debug_mode = false;
		if( $debug_mode){ 
			print "処理時間: " . ($complete_time - $start_time) . "秒";
			var_dump($res);
		}

		include_once("geo.inc");
		include_once("time_graph.inc");
		include_once("cluster_table.inc");
		?>

	</body>
</html>


