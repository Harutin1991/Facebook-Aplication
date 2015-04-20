<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>-->

</div>
<div class="container">
	<div class="form-group">
		<a href="<?php echo base_url('myapp/result').'/'.$this->uri->segment(3); ?>"  class="btn btn-primary">Detailed answers</a>
	</div>
</div>
<div class="container">
	<div id="container_count" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<div class="container">
	<div class="stats">
	<?php  $i=1;$stat=array(); foreach($value as $val){

	$stat[$i]=$val;
	$i++; ?>

		<div  id="container_<?php echo ($i-1);?>"  style="min-width: 110px; height: 200px; margin: 0 auto"></div>
		

	<?php }
	?>
	</div>
</div>
<?php $stat_count=array();
$stat_count=$date_answer;

foreach($stat_count as $key=>$count){
	$key=explode("-",$key);
	$key='Date.UTC('.$key[0].','.($key[1]-1).','.$key[2].')';
	$co[$key]=$count;
}
?>


<script>
$(function () {

                
var l=('<?php echo $i; ?>');
for(var f=1;f<l;f++){
var obj = jQuery.parseJSON('<?php echo json_encode($stat); ?>');
var chart_values = [];

jQuery.each( obj[f], function( i, val ) {
		chart_values.push([i,parseInt(val)]);
                
                
                
                });
                

    $('#container_'+f).highcharts({
     
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true
        },
        title: {
            text: '<??>'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
       
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: chart_values
            
        }]
        
    
    });
    }
});

$(function () {
var obj = jQuery.parseJSON('<?php echo json_encode($co); ?>');
var chart_values = [];

jQuery.each( obj, function( i, val ) {
		chart_values.push([eval(i),parseInt(val)]);

                });
        $('#container_count').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: '<?=$user_poll[0]['name']?>',
				x: -20 
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b',
                    
                }
            },
            yAxis: {
                title: {
                    text: 'Values'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' vote';
                }
            },
            
            series: [{
                name: "count",
                data: chart_values
            
            }]
        });
    });

$(document).ready(function (){
$('.highcharts-container text tspan[x="1130"]').text('');
});

</script>