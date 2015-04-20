<div class="col-xs-12 ">
	<ul class="nav nav-pills segment">
		<li class="<?php if(isset($user_poll) && $this->uri->segment(2)=='description' ||$this->uri->segment(2)== 'addpoll'){ echo 'active';}
						else{echo '';}?>" >
			<a href="#" ><span>Description</span>
			<span class="glyphicon glyphicon-chevron-right"></span>
			</a> 
			
		</li>
		<li class="<?php if(isset($user_poll) && $this->uri->segment(2)=='question'){ echo 'active';}elseif(isset($user_poll)){echo "";}else{echo 'disabled';}?>" >
		  <?php if(isset($user_poll)):?>
			<a href="<?php echo base_url();?>myapp/question/<?php echo $user_poll[0]['id']; ?>" >
				<span>Questions</span><span class="glyphicon glyphicon-chevron-right"></span>
			</a> 
			<?php else: ?>
				<a href="#">
				<span>Questions</span>
				<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			<?php endif;?>
		</li>
		<li  class="<?php if(isset($user_poll) && $this->uri->segment(2)=='share'){ echo 'active';}elseif(isset($user_poll)){echo "";}else{echo 'disabled';}?>" >
			<?php if(isset($user_poll)):?>
			  <a href="<?php echo base_url();?>myapp/share/<?php echo $user_poll[0]['id']; ?>" ><span>Share </span><span></span></a> 
			  <?php else: ?>
			  <a href="#">
				<span>Share</span>
				<span></span>
				</a>
			 <?php endif;?>
		</li>
	</ul> 
</div>
