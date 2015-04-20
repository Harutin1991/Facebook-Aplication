</div>

<div class="container">
	<table class="table table-hover table-bordered">
		<tr>
			<th>Firstname</th>
			<td>
				<a href="" id="firstname" data-type="text" data-pk="1" class="editable editable-click">
					<?=$user[0]['firstname']?>
				</a>
			</td>
		</tr>
		<tr>
			<th>Lastname</th>
			<td>
				<a href="" id="lastname" data-type="text" data-pk="1" class="editable editable-click">
					<?=$user[0]['lastname']?>
				</a>
			</td>
		</tr>
		<tr>
			<th>Email</th>
			<td>
				<a href="" id="email" data-type="text" data-pk="1"  class="editable editable-click">
					<?=$user[0]['email']?>
				</a>
			</td>
		</tr>
		<tr>
			<th>Your Link</th>
			<td>
				<input type="text" value="<?=$user[0]['link']?>" class="form-control" disabled="disabled" />
			</td>
		</tr>
		<tr>
			<th>Create Polls Count</th>
			<td>
				<input type="text" value="<?=$poll_count?>" class="form-control" disabled="disabled" />
			</td>
		</tr>
	</table>
	<a href="#bs-modal-lg" class="btn btn-primary" data-toggle="modal" data-target=".contact" data-backdrop="false">
		<span class="glyphicon glyphicon-envelope" style="padding-right: 10px;padding-left: 3px;"></span>Contact us
	</a>
	<?php if($is_admin):?>
	<a href="<?php echo base_url('admin').'/'.$user_account[0]['uid'];?>" class="btn btn-info">
		<span class="glyphicon glyphicon-user" style="padding-right: 3px;"></span>Admin Page
	</a>
	<?php endif;?>
	<div class="modal fade bs-modal-lg contact" id="cotact" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog popup_block">
			<div class="modal-content contact_content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Contact us</h4>
				</div>         
				<div class="modal-body">
					<form action="" method="POST">
						<label for="name">Name</label>
						<input type="text" name="name" id="name" value="<?=$user[0]['firstname']?>  <?=$user[0]['lastname']?>" class="form-control">
						<label for="your_email">Email</label>
						<input type="email" name="email" id="your_email" value="<?=$user[0]['email']?>" class="form-control"/>
						<label for="message">Message</label>
						<textarea id="message" class="form-control"></textarea>
						<button type="submit" class="btn">Send</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(function(){
	$('#firstname').editable({
        url: '<?php echo base_url('myapp/update_user_date')?>',
        title: 'Enter comments',
		placement: 'right'
    });
	$('#lastname').editable({
        url: '<?php echo base_url('myapp/update_user_date')?>',
        title: 'Enter comments',
		placement: 'right'
    });
	$('#email').editable({
        url: '<?php echo base_url('myapp/update_user_date')?>',
        title: 'Enter comments',
		placement: 'right'
    });
	
});
	$(function() {
		$( "#cotact" ).draggable();
	});
</script>
