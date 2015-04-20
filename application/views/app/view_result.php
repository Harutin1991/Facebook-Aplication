<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
</div>
<div class="container">
	<?php if(!empty($poll_text[1])): ?>
		<div id="poll_header">
			<div class="center-block text-primary" align="center" style="min-height: 60px;border: 1px solid #F0E4E4;
			background-color: #F7F7F7;;margin-bottom: 20px;">
				<?php echo $poll_text[1]; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php $i=1;$stat=array(); foreach($value as $val){

$stat[$i]=$val;
$i++; ?>

<?php }
?>
<div class="container">
<?php 
$j=1;$answ=array(); foreach($value as $val){
$answ[$j]=$val;
$j++; ?>
<div id="container_<?php echo ($j-1);?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php
}
?>
</div>
<div class="container">
	<?php if(!empty($poll_text[2])):?>
		<div class="center-block text-primary col-xs-12" align="center" style="min-height: 40px;border: 1px solid #F0E4E4;
		background-color: #F5F2B5;margin-top: 20px;padding-top: 5px">
			<?php echo $poll_text[2]; ?>
		</div>
	<?php endif;?>
</div>
<script>
$(function () {
var l=('<?php echo $i; ?>');
var n=('<?php echo $j; ?>');

	for(var f=1;f<l;f++){
		var obj2 = jQuery.parseJSON('<?php echo json_encode($answ); ?>');
		var chart_values = [];
		var chart_name=[];
	jQuery.each( obj2[f], function( i, val ) {
		chart_values.push([parseInt(val)]);
		chart_name.push(i);
                });
        $('#container_'+f).highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '<?=$user_poll[0]['name']?>'
            },
            xAxis: {
                categories: chart_name,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Answer (count)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
				data:chart_values
			}]
        });
	}
});
</script>