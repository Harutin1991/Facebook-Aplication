<script>
		$(function() {

			$("input,textarea,select").jqBootstrapValidation(
				{
					preventSubmit: true,
					submitError: function($form, event, errors) {
					},
					filter: function() {
						return $(this).is(":visible");
					}
				}
			);
		});
</script>
</div>
<?php if(!$user_data):?>
<!--<div class="container">
	<p class="lead bg-primary login" style="height: 60px;border-radius: 4px; padding-left: 53px;font-size: 24px;font-style: oblique;font-family: serif;">For registration in application Pollified please enter here  
	<button class="btn btn-success btn-lg" role="button" style="margin-top: 5px;" id="login">Registration</button>
	</p>
	<div class="alert alert-warning alert-dismissable dont_reg" style="display:none;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>You are cancelled login or did not fully authorize.Please register for use poll.</strong>
	</div>
</div>-->
<?php endif; ?>
<div class="container">
<?php if(!empty($question)):?>
	<div class="center-block text-primary" align="center" style="min-height: 60px;border: 1px solid #F0E4E4;
	background-color: #F7F7F7;;margin-bottom: 20px;">
		<?php echo $poll_text[1]; ?>
	</div>
<form novalidate="" action="<?php echo base_url('exitapp/chek').'/'.$question[0]['poll_id'];?>" method="POST"class="form-horizontal" >
<table class="table table-condensed table-hover">
	<tr class="info">
		<th>Questions</th>
		<th>Choices</th>
		<th></th>
	</tr>
<?php foreach($question as $key=>$quest): ?>

<!--...................Begin...............................-->
	<?php if($quest['question_type'] == 3 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $quest['question'];?></td>
		<td style="width: 621px;">
			<div class="control-group">
				<div class="col-xs-6">
					<select required="" name="selectbox_<?=$quest['id']?>" class="form-control">
						<option value='' selected>Select Chosen</option>
						<?php foreach(unserialize($quest['question_choices']) as $key=>$ch):?>
						<option><?php echo $ch;?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div style="float:right;">
					<p class="bg-danger1"></p>
				</div>
			</div>
		</td>
	</tr>
	<?php endif;?>
	<!--...................End...............................-->
	
	<!--..................Begin................................-->
	<?php if($quest['question_type'] == 1 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $quest['question'];?></td>
		<td style="width: 621px;">
			<div class="control-group radio_block">
				<?php foreach(unserialize($quest['question_choices']) as $key=>$ch):?>
				
					<input type="radio" required="" value="<?php echo $ch;?>" id="radio<?php echo $ch.md5($key).$quest['question'];?>"  
					name="radiobox_<?=$quest['id']?>" />
					<?php $answer_link = unserialize($quest['answer_link']);  if(!empty($answer_link[$key])):?>
						<input type="hidden" value="<?=$answer_link[$key]?>">
					<?php endif;?>
					<label for="radio<?php echo $ch.md5($key).$quest['question'];?>"><?php echo $ch;?></label><br/>
				<?php endforeach;?>
				<div style="float:right;">
					<p class="bg-danger1"></p>
				</div>
			</div>
		</td>
	</tr>
	<?php endif;?>
	<!--...................End...............................-->
	
	
	<!--..................Begin...................................-->
	<?php if($quest['question_type'] == 2 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $quest['question'];?></td>
		<td style="width: 621px;">
			<div class="control-group radio_block">
				<?php foreach(unserialize($quest['question_choices']) as $key=>$ch):?>
				<?php $arr = $quest['id'];?>
					
					<input type="checkbox" data-validation-minchecked-minchecked="1" data-validation-minchecked-message="Choose one" id="chekbox<?php echo $ch;?>" aria-invalid="false" value="<?php echo $ch;?>"  name="chekbox_<?=$quest['id']?>[]" />
					<label for="chekbox<?php echo $ch;?>"><?php echo $ch;?></label></br>

				<?php endforeach;?>
				<div style="float:right;">
					<p class="bg-danger1"></p>
				</div>
			</div>
		</td> 
	</tr>
	<?php endif;?>
	<!--..................End................................-->
	
	<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 4 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $quest['question'];?></td>
		<td style="width: 621px;">
				<div class="control-group radio_block">
					<p style="float:left;margin-top: 8px;"><?php $poor=(unserialize($quest['question_scale'])); echo $poor[0];?></p>
					<?php for($i=1;$i<=5;$i++):?>
						<input required="" data-validation-required-message="You must agree to the terms and conditions"  type="radio" value="<?php echo $i;?>" id="radiobox<?php echo $i;?>" style="float:left;margin-top: 15px;margin-left: 6px"  
						name="radiobox5_<?=$quest['id']?>"/>
						<label for="radiobox<?php echo $i;?>" style="float:left"><?php echo $i;?></label>
					<?php endfor;?>
					<p style="float:left;margin-top: 8px;"><?php $poor=(unserialize($quest['question_scale'])); echo $poor[1];?></p>
						<div style="float:right;">
							<p class="bg-danger1"></p>
						</div>
				</div>
			</div>
		</td>
	</tr>
	<?php endif;?>
	<!--..................End.................................-->
	
	<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 5 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $quest['question'];?></td>
		<td style="width: 621px;">
			<div class="control-group">
				 <div class="col-xs-6">
					<input type="text" required="" minlength="5"class="form-control" name="textbox_<?=$quest['id']?>"   placeholder="One-line text box" />
				</div>
				<div style="float:right;">
					<p class="bg-danger1"></p>
				</div>
			</div>
		</td> 
	</tr>
	<?php endif;?>
<!--.....................End.............................-->

<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 6 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $quest['question'];?></td>
		<td style="width: 621px;">
			<div class="control-group">
				<div class="col-xs-6">
					<textarea required="" minlength="10"   class="form-control has-error" name="textareabox_<?=$quest['id']?>"placeholder="Multiple line text box" /></textarea>
				</div>
				<div style="float:right;">
					<p class="bg-danger1"></p>
				</div>
			</div>
		</td>
	</tr>
	<?php endif;?>
<!--.....................End.............................-->


<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 7 ):?>
	<tr>
		<td style="width: 150px;"><?php echo $quest['question'];?></td>
		<td style="width: 621px;">
			<div class="control-group">
				<div class="col-xs-6">
					<input required="" class="form-control" type="email" class="form-control" name="email_<?=$quest['id']?>"  placeholder="Email address box"/>
				</div>
				<div style="float:right;">
					<p class="bg-danger1"></p>
				</div>
			</div>
		</td>  
	</tr>
	<?php endif;?>
<!--.....................End.............................-->

<?php endforeach;?>
</table>
	<div class="form-actions">
		<button type="submit" class="btn btn-success"  >
			<span class="glyphicon glyphicon-ok"></span>Vote
		</button>
		<!--<a href="javascript:void(0)" id="share" class="btn btn-info">
					<span class="glyphicon glyphicon-share"></span>Share
		</a>-->
	</div>
</form>
<?php endif;?>
<div  style="float:left" class="social_block">
	<fb:like href="https://apps.facebook.com/pollified" layout="standard" action="like" show_faces="true" share="true"></fb:like>
</div>
<?php if(!empty($poll_text[2])):?>
<div class="center-block text-primary col-xs-12" align="center" style="min-height: 40px;border: 1px solid #F0E4E4;
background-color: #F5F2B5;margin-top: 20px;padding-top: 5px">
	<?php echo $poll_text[2]; ?>
</div>
<?php endif;?>
</div>
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
	
	})
	var answer_link; var link;
			$('input:radio').click(function(){
				is_hidden_input = $(this).first().next().is('input:hidden');
				if(is_hidden_input){
					answer_link = $(this).first().next('input:hidden').val();
					link = '<a href="'+answer_link+' " target="_blank"></a>';
				}
				console.log(answer_link);
			});
			$('form').submit(function(){
				if(answer_link){ 
					window.open(answer_link,'_blank');
				}
			});
	});

</script>
<script>  
window.fbAsyncInit = function() {
        FB.init({
          appId      : '1421106854794084',
          status     : true,
          xfbml      : true
        });
document.getElementById("login").onclick = function() {
 $('#login').attr("disabled", true);
	  FB.login(function(response) {
   if (response.authResponse) {
     FB.api('/me', function(response) {
		$.ajax({
				url: '<?php echo base_url('login/login_user');?>',
				type: "POST",
				data: {id: response.id},
				success: 
					function(data){
						$('.login').hide();
						$('#login').removeAttr( "disabled" );
					} 
			});

     });
	} else {
			$('.dont_reg').show();
			$('.login').hide();
			$('#login').attr("disabled", false);
			$('.close').click(function(){
			$('.login').show();
		});
		}
		
 },{scope: 'email,publish_actions,user_friends'});
       }
   };
</script>