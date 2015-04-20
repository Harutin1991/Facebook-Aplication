<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
</div>
<div class="container">
	<div class="form-group">
		<a href="<?php  echo base_url('myapp/statistics').'/'.$this->uri->segment(3); ?>"  class="btn btn-success">Statistics</a>
		<a href="<?php echo base_url('myapp/result').'/'.$this->uri->segment(3); ?>"  class="btn btn-primary">Detailed answers</a>
		<?php if(!empty($user_poll[0]['result_share_url'])):?>
			<button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Share Result</button>
		<div class="modal fade bs-example-modal-sm" style="top:200px" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content" style="width: 93%;height: 120px;;background-color: rgb(121, 151, 179);">
				<div class="container">
					<div class="modal-body col-xs-3">
						<label>Share Count Answered
						<input type="text" onClick="this.select();" class="form-control" value="<?=$user_poll[0]['result_share_url']?>" />
						</label>
					</div>
				</div>
			</div>
		  </div>
		</div>
		<?php endif;?>
	</div>
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