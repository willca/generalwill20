<?

?>

<table>
	<tr>
		<td>
			<div id="jq_graph_time" style="width : 300; height : 240;"></div>
		</td>
		<td>
			<div id="jq_graph_date" style="width : 300; height : 240;"></div>
		</td>
		<td>
			<div id="jq_graph_tweet_length" style="width : 300; height : 240;"></div>
		</td>
		<td>
			<div id="jq_graph_follow_rate" style="width : 300; height : 240;"></div>
		</td>
	</tr>
</table>
<script type="text/javascript">
//時間グラフ
    $(document).ready(function() {
        var s1 = <?
        	echo arrayTransformToJS(  get_time_for_tweets( $res["tweet"]) ) ?>;
        	
        $.jqplot('jq_graph_time', [ s1 ], {
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
        	echo arrayTransformToJS( get_date_for_tweets( $res["tweet"]) )  ?>;
        	
        $.jqplot('jq_graph_date', [ s2 ], {
       		title: '日付分布グラフ', 
			series: [{ 
			     label: '日付分布グラフ', 
			     neighborThreshold: -1 
			}], 
			
			axes: { 
				xaxis: { 
			        renderer: $.jqplot.DateAxisRenderer,
			        tickOptions:{formatString:'%Y/%#m/%#d'},
			        label: "年月日" 
			    }, 
			    yaxis: { 
			    	label: "回数"
			    } 
  			}
  		} );
  	
 	});


//ツイート長グラフ
    $(document).ready(function() {
        var s3 = <?
        	echo arrayTransformToJS(  $res["tweet_length"]) ; ?>;
        	
        $.jqplot('jq_graph_tweet_length', [ s3 ], {
       		title: 'ツイート長分布グラフ', 
			series: [{ 
			     label: 'ツイート長分布グラフ', 
			     neighborThreshold: -1 
			}],
			
			axesDefaults:{useSeriesColor: true}, 
		    axes:{
		        xaxis:{ label:'ツイート長' , min:0, max:140, tickInterval: '20'}, 
		        yaxis:{ label:'回数' , min:0} 
		        
		    } 
  		});
    });
 
 //ツイート長グラフ
    $(document).ready(function() {
        var s4 = <?
        	echo arrayTransformToJS(  $res["follow_rate"]) ; ?>;
        	
        $.jqplot('jq_graph_follow_rate', [ s4 ], {
       		title: '相互フォロー率', 
			series: [{ 
			     label: '相互フォロー率', 
			     neighborThreshold: -1 
			}],
			
			axesDefaults:{useSeriesColor: true}, 
		    axes:{
		        xaxis:{ label:'相互フォロー率' , min:0, max:100, tickInterval: '10'}, 
		        yaxis:{ label:'人数' , min:0} 
		        
		    }
		     
  		});
    });
 
 
</script>

