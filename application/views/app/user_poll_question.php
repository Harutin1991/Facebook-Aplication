</div>
<?php if($user_poll_question):?>
<div class="container">
	<div class="jumbotron">
		<div class="row">
			<p><?=$user_poll_question[0]['name']?></p>
			<?php foreach(unserialize($user_poll_question[0]['text']) as $key=>$txt):?>
					<?php if($key ==0 ){echo $txt;}?>
			<?php endforeach;?>
		</div>
		<div class="row">
			<a href="<?php echo base_url('myapp/description').'/'.$user_poll_question[0]['id'];?>" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-pencil" style="padding-right: 3px;"></span>Description
			</a>
			<a href="<?php echo base_url('myapp/question').'/'.$user_poll_question[0]['id'];?>" class="btn btn-info btn-sm">
				<span class="glyphicon glyphicon-ok" style="padding-right: 3px;"></span>Questions
			</a>
			<a href="<?php echo base_url('myapp/share').'/'.$user_poll_question[0]['id'];?>" class="btn btn-warning btn-sm">
				<span class="glyphicon glyphicon-user" style="padding-right: 3px;"></span>Share
			</a>
			<a href="<?php echo base_url('myapp/result').'/'.$user_poll_question[0]['id'];?>" class="btn btn-success btn-sm">
				<span class="glyphicon glyphicon-stats" style="padding-right: 3px;"></span>Results<span class="badge" style="margin-left: 5px !important;"><?php if(!empty($result[$user_poll_question[0]['id']])){ echo count($result[$user_poll_question[0]['id']]);}else{echo "0";}?></span>
			</a>
			<a href="<?php echo base_url('myapp/delete').'/'.$user_poll_question[0]['id'];?>"  class="btn btn-danger btn-sm" style="padding-right: 20px;">
									<span class="glyphicon glyphicon-minus" style="padding-right: 3px;"></span>
									Delete
								</a>
		</div>
	</div>
</div>
<?php endif;?>
<?php if($user_poll_question):?>
<div class="container">
	
<table class="table table-condensed table-hover">

		<?php foreach($user_poll_question as $poll):?>
	
	
	<!--..................Begin................................-->
	<?php if($poll['question_type'] == 1 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $poll['question'];?></td>
		<td style="width:621px">
			<div class="col-xs-6 radio_block">
				<?php foreach(unserialize($poll['question_choices']) as $key=>$ch):?>
					<input type="radio" value="<?php echo $ch;?>"  name="<?=$poll['id']?>"/>
					<label><?php echo $ch;?></label></br>
				<?php endforeach;?>
			</div>
		</td>
	</tr>
	<?php endif;?>
	<!--...................End...............................-->
	
	
	
	<!--..................Begin...................................-->
	<?php if($poll['question_type'] == 2 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $poll['question'];?></td>
		<td style="width:621px">
			<div class="col-xs-8 radio_block">
				<?php foreach(unserialize($poll['question_choices']) as $key=>$ch):?>
					<input type="checkbox" value="<?php echo $ch;?>"  name="<?=$poll['id']?>"/>
					<label><?php echo $ch;?></label></br>
				<?php endforeach;?>
			</div>
		</td> 
	</tr>
	<?php endif;?>
	<!--..................End................................-->
	
	
			<!--...................Begin...............................-->
	<?php if($poll['question_type'] == 3 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $poll['question'];?></td>
		<td style="width:621px">
			<div class="col-xs-6">
				<select name="<?=$poll['id']?>" class="form-control">
					<option value='' selected>Select Chosen</option>
					<?php foreach(unserialize($poll['question_choices']) as $key=>$ch):?>
					<option ><?php echo $ch;?></option>
					<?php endforeach;?>
				</select>
			</div>
		</td>
	</tr>
	<?php endif;?>
	<!--...................End...............................-->
	
	
	
	
	<!--..................Begin.................................-->
	<?php if($poll['question_type'] == 4 ):?>
	<tr>
		<td><?php echo $poll['question'];?></td>
		<td>
			<div class="radio_block">
				<p style="float:left;margin-top: 8px;">
					<?php $poor=(unserialize($poll['question_scale'])); echo $poor[0];?>
				</p>
				<?php for($i=1;$i<=5;$i++):?>
					<input type="radio" value="<?php echo $i;?>"   name="<?=$poll['id']?>" 
					style="float:left;margin-top: 15px;margin-left: 6px"/>
					<label style="float:left"><?php echo $i;?></label>
				<?php endfor;?>
				<p style="float:left;margin-top: 8px;">
				<?php $poor=(unserialize($poll['question_scale'])); echo $poor[1];?></p>
			</div>
		</td>
	</tr>
	<?php endif;?>
	<!--..................End.................................-->
	<!--..................Begin.................................-->
	<?php if($poll['question_type'] == 5 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $poll['question'];?></td>
		<td style="width:621px">
			<div class="col-xs-6">
				<input type="text" class="form-control" name=<?=$poll['id']?>" value="One-line text box"  placeholder="One-line text box" required/>
			</div>
		</td> 
	</tr>
	<?php endif;?>
<!--.....................End.............................-->


<!--..................Begin.................................-->
	<?php if($poll['question_type'] == 6 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $poll['question'];?></td>
		<td style="width:621px">
			<div class="col-xs-6">
					<textarea class="form-control" name="<?=$poll['id']?>" />Multiple line text box</textarea>
			</div>
		</td>
	</tr>
	<?php endif;?>
<!--.....................End.............................-->


<!--..................Begin.................................-->
	<?php if($poll['question_type'] == 7 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $poll['question'];?></td>
		<td style="width:621px">
			<div class="col-xs-6">
					<input type="email" class="form-control" name="<?=$poll['id']?>" disabled="disabled" value="Email address box"/>
			</div>
		</td>  
	</tr>
	<?php endif;?>
<!--.....................End.............................-->

<?php endforeach;?>
</table>
	<div class="center-block text-primary col-xs-12" align="center" style="min-height: 40px;border: 1px solid #F0E4E4;
background-color: #F5F2B5;margin-top: 20px;padding-top: 5px">
	<?php  foreach(unserialize($user_poll_question[0]['text']) as $key=>$txt):?>
		<?php if($key == 2 ){echo $txt;}?>
	<?php endforeach;?>		
	</div>
	</div>
<?php else:?>
<div class="container">
<h2 align="center">No Question</h2>
</div>

<?php endif; ?>