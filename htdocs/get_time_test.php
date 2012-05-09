<?php

require 'get_time.php';


//debug テストコード テスト実施時は$debug_mode=trueにする
$get_time_debug_mode = true;

if( $get_time_debug_mode){
	$array = array( 0 => array('created_at' => 'Sat Nov 28 11:25:49 +0000 2009'),
					1 => array('created_at' => 'Sat Nov 28 13:25:49 +0000 2009'),
					2 => array('created_at' => 'Sat Nov 02 03:25:49 +0900 2009'),
					3 => array('created_at' => 'Sat Nov 20 20:25:49 +0900 2009'),
					4 => array('created_at' => 'Sat Jan 02 03:25:49 +0900 2010'),
					5 => array('created_at' => 'Sat Nov 10 14:25:49 +0000 2009'));
	
	echo ("<html xmlns=\"http://www.w3.org/1999/xhtml\"> <head> 
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> <title>Message</title> ");
?>
<link rel="stylesheet" type="text/css" href="./js/jquery.jqplot.min.css" />
 <!--[if IE]><script language="javascript" type="text/javascript" src="./js/excanvas.min.js"></script><![endif]-->
  <script language="javascript" type="text/javascript" src="./js/jquery.min.js"></script> 
  <script language="javascript" type="text/javascript" src="./js/jquery.jqplot.min.js"></script>
  <script language="javascript" type="text/javascript" src="./js/plugins/jqplot.dateAxisRenderer.min.js"></script>
  
</head>

<?
	$time_results = get_time_for_tweets( $array );
	var_dump($time_results);
	echo "<br />";
	$date_results = get_date_for_tweets( $array );
	var_dump($date_results);
	

?>

<div id="jq_graph01" style="width : 500; height : 300;"></div>
<br /><br />
<div id="jq_graph02" style="width : 500; height : 300;"></div>

<script type="text/javascript">
//時間グラフ
    $(document).ready(function() {
        var s1 = <?
        	echo arrayTransformToJS( $time_results) ?>;;
        	
        $.jqplot('jq_graph01', [ s1 ], {
       		title: '時間分布グラフ', 
			series: [{ 
			     label: '時間分布グラフ', 
			     neighborThreshold: -1 
			}],
			
			axesDefaults:{useSeriesColor: true}, 
		    axes:{
		        xaxis:{ label:'時間' , min:0, max:23, tickInterval: '1'}, 
		        yaxis:{ label:'回数' , min:0} 
		        
		    } 
  		});
    });

//日付グラフ
    $(document).ready(function() {
        var s2 = <?
        	echo arrayTransformToJS( $date_results)  ?>;
        	
        $.jqplot('jq_graph02', [ s2 ], {
       		title: '日付分布グラフ', 
			series: [{ 
			     label: '日付分布グラフ', 
			     neighborThreshold: -1 
			}], 
			
			axes: { 
				xaxis: { 
			        renderer: $.jqplot.DateAxisRenderer,
			        //min:'August 1, 2009 16:00:00', 
			        //tickInterval: '4 months', 
			        tickOptions:{formatString:'%Y/%#m/%#d'},
			        label: "年月日" 
			    }, 
			    yaxis: { 
			    	label: "回数"
			        //tickOptions:{formatString:'$%.2f'} 
			    } 
  			}
  		} );
  	
 	});
 </script>

	
	
<?	
	
}


?>