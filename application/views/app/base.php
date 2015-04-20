	<div class="form-group">
			<div class="col-xs-4">
				<a href="<?php echo base_url('myapp/addpoll');?>" class="btn btn-default">New Poll</a>
			</div>
	</div>
</div>
	<div class="container " >

	<?php if($user):?>
		<table class="table table-hover content">
		<?php foreach($user_poll as $poll):?>
			<tr>
				<td style="width:45%; ">
					<a class="btn btn-sm" style="border:1px solid;border-color: wheat;min-width: 114px;" 
							href="<?php echo base_url('myapp/user_poll_question').'/'.$poll['id'];?>">
						<?php echo $poll['name']; ?>
					</a><br/>
					<!--<a href="#" class="btn btn-success">
						<span class="glyphicon glyphicon-star" style="color:yellow; padding-right: 3px;">
						</span>Upgrade to Premium
					</a>-->
				</td>
				<td>

					<a href="<?php echo base_url();?>myapp/description/<?php echo $poll['id']?>" class="btn btn-default btn-sm" id="desc">
						<span class="glyphicon glyphicon-pencil" style="padding-right: 3px;"></span>Description
					</a>
					<a href="<?php echo base_url();?>myapp/question/<?php echo $poll['id']?>" class="btn btn-info btn-sm">
						<span class="glyphicon glyphicon-bookmark" style="padding-right: 3px;"></span>Questions
					</a>
					<a href="<?php echo base_url();?>myapp/share/<?php echo $poll['id']; ?>" class="btn btn-warning btn-sm">
						<span class="glyphicon glyphicon-share" style="padding-right: 3px;"></span>Share
					</a>
					<a href="<?php echo base_url('myapp/result').'/'.$poll['id'];?>"  class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-stats" style="padding-right: 3px;"></span>Results
						<span class="badge" style="margin-left: 5px !important;">
							<?php if(!empty($result[$poll['id']])){ 
							echo count($result[$poll['id']]);}else{echo "0";}?>
						</span>
					</a>
					<a href="<?php echo base_url('myapp/delete').'/'.$poll['id'];?>"  class="btn btn-danger btn-sm" style="padding-right: 20px;">
						<span class="glyphicon glyphicon-minus" style="padding-right: 3px;"></span>
						Delete
					</a>
					
				</td>
			</tr>
		<?php endforeach;?>
		</table>
		<div class="social_block">
			<fb:like href="https://apps.facebook.com/pollified" layout="standard" action="like" show_faces="true" share="true"></fb:like>
		</div>
	<?php endif; ?>
	<?php  if(ceil($total_rows) > 1):?>
	<div id="base" align="center"></div>
 <script type='text/javascript'>
 
        var options = {
            currentPage: "<?php $y = $this->uri->segment(3); if(!$y){ echo 1;} else {echo $this->uri->segment(3);} ?>",
			
            totalPages: '<?php echo ceil($total_rows);?>',
			 pageUrl: function(type, page, current){
			
                return "<?php  echo base_url('myapp/index')?>/"+page;

            }
        }

        $('#base').bootstrapPaginator(options);
    </script>
	<?php endif;?>
</div>
