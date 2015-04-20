</div>
<div class="container">
<?php if($result):?>
<?php if(isset($result_type)) {?>
<a href="javascript:void(0)" id="share" class="btn btn-info" style="margin-bottom: 5px;">
					<span class="glyphicon glyphicon-share"></span>Share results
		</a> 
<?php }else {?>
<div class="form-group">
<a href="<?php  echo base_url('myapp/statistics').'/'.$this->uri->segment(3);?>"  class="btn btn-success">Statistics</a>
<a href="<?php  echo base_url('myapp/count_answered').'/'.$this->uri->segment(3);?>"  class="btn btn-success">Count Answered</a>

</div>
<?php }?>
<?php foreach($users_answer as $key=>$ua):?>
<table class="table table-hover table-bordered table-condensed"> 
	<tr>
		<th style="width: 60%;" class="success">
		<?php
		$this->load->model('polls_model');
		
		//out($user_name);
		if($ua['user_id'] != 'anonymouse'){
			$user_name =$this->polls_model->get_user($ua['user_id']);
			echo $user_name[0]['firstname'].' '.$user_name[0]['lastname'];
		}else{
			echo "Anonymous";
		}
		
		?>
			
			<span style="float:right; padding-right:20px;"> Answered <?=different_time_now($ua['date'])?> ago</span>
			
		</th>
		<th class="success">
			<a style="float:right"  href="<?php echo base_url('myapp/delete_answered').'/'.$ua['id'].'/'.$this->uri->segment(3);;?>">
				<span class="glyphicon glyphicon-minus"></span>
			</a>
		</th>
	</tr>
	<tr>	
		<th>Question</th>
		<th>Answered</th>
	</tr>
	<?php  $i=1;foreach($ua['answered'] as $key=>$a):?>
	<tr <?php  if($i%2):?>class="success"<?php else:?> class="danger" <?php endif;?> >
		<td><?=$key?></td>
		<?php if(is_array($a)): ?>
			<td>
				<?php $end = 0; $count = count($a); foreach($a as $key=>$chek):?>
					<?php $count = $count-1; if($count > 0){echo $chek; echo ", ";}else{echo $chek;}?>
				<?php endforeach;?>
			</td>			
		<?php else:?>
		<td><?=$a?></td>
		<?php endif;?>
	</tr>
		<?php endforeach;?>
	
</table>
<?php endforeach;?>
<?php endif; ?>
<?php if(!$result):?>
<div class="container">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<div class="alert alert-danger" align="center"><h3><?php echo $message;?></h3></div>
</div>
<?php endif;?>

	<div class="col-xs-8 social_block">
	<fb:like href="https://apps.facebook.com/pollified" layout="standard" action="like" show_faces="true" share="true"></fb:like>
	</div>
	<?php  if(ceil($total_rows) != 1):?>
	<div id="base" align="center"></div>
	<?php endif;?>
</div>

 <script type='text/javascript'>
 
 
 
        var options = {
            currentPage: "<?php $y = $this->uri->segment(4); if(!$y){ echo 1;} else {echo $this->uri->segment(4);} ?>",
			
            totalPages: '<?php echo ceil($total_rows);?>',
			 pageUrl: function(type, page, current){
				<?php if(isset($result_type)) {?>
                return "<?php  echo base_url('exitapp/result').'/'.$this->uri->segment(3);?>/"+page;
				<?php } else { ?>
				return "<?php  echo base_url('myapp/result').'/'.$this->uri->segment(3);?>/"+page;
				<?php } ?>

            }
        }

        $('#base').bootstrapPaginator(options);
    </script>
	
	
	<script>
	$(document).ready(function(){
		$("#share").click(function(){
		
		FB.ui({
	  method: 'feed',
	  link: '<?php echo $url;?>',
	  name: '<?php echo $info[0]['name']?>',
	  description: "<?php echo $info[0]['share_text'];?>",
		<?php if(empty($info[0]['path'])):?>
		picture: '<?php echo base_url();?>assets/img/avatar_no.jpg'
		<?php else:?>
		 picture: '<?php echo base_url().$info[0]['path']?>'
		<?php endif;?>
	}, function(response){});
		
		});
	})
	</script>