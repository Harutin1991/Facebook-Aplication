</div>
<div class="container">
	<div class="col-xs-5" style="margin-left: -14px; margin-bottom: 20px; width: 43% !important;">
		<input type="text" class="user_url form-control"/>
	</div>
	<input type="submit" value="Send Url" id="send_url" class="btn btn-default" >
</div>
<div class="container">
	<table class="table table-hover table-bordered get_id">
		<tr>
			<th style="width: 50%;">User Id</th><td class="uid"></td>
		</tr>
		<tr>
			<th style="width: 50%;">First Name</th><td class="fname"></td>
		</tr>
		<tr>
			<th style="width: 50%;">Last Name</th><td class="lname"></td>
		</tr>
		<tr>
			<th style="width: 50%;">Link</th><td class="link"></td>
		</tr>
	</table>
</div>
<div class="container">
	<table class="table table-hover table-bordered">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Poll Count</th>
		</tr>
		<?php foreach($users as $key=>$user):?>
		<tr>
			<td><?=$user[0]['firstname']?></td>
			<td><?=$user[0]['lastname']?></td>
			<td><?=$user[0]['email']?></td>
			<td><?=$user['count_poll']?></td>
		</tr>
		<?php endforeach;?>
	</table>
</div>
<script>
	$('#send_url').click(function(){
		
		var url = $('.user_url').val();
		$.ajax({
			url: 'https://graph.facebook.com/'+url,
			success:function(respons){
				console.log(respons);
					 FB.api('/'+respons.id+'/feed', 'post', {message: 'Hello, world!'});
				$('.uid').append(respons.id);
				$('.fname').append(respons.first_name);
				$('.lname').append(respons.last_name);
				$('.link').append(respons.link);
			}
		});
	});
	$('#send_url').bind('click',function(){
			$('.get_id td').each(function(){
				$(this).text('');
			});
			
	});
</script>