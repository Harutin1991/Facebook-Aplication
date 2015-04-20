<div class="form-group">
	<div class="col-xs-4">
		<button  id="next_quest2" class="btn btn-default btn-lg btn-warning btn-block">Start Poll</button>
	</div>
</div>
</div>
<div class="container">
	<div class="row">
        <div class="col-md-4">
			<img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200" src="<?php echo base_url()?>/assets/img/poll1.png" style="width: 200px; height: 200px;">
			
        </div>
		<div class="col-md-4">
			<img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200" src="<?php echo base_url()?>/assets/img/poll2.png" style="width: 200px; height: 200px;">
			
		</div>
        <div class="col-md-4">
			<img data-src="holder.js/200x200" class="img-thumbnail" alt="200x200" src="<?php echo base_url()?>/assets/img/poll3.png" style="width: 200px; height: 200px;">
			
        </div>
	</div>
</div>
 

 
 
<script>
	document.getElementById("next_quest2").onclick = function() {
		
	
	
		$('#next_quest2').attr("disabled", true);
		
				FB.login(function(response) {console.log("8888");
					if (response.authResponse) {
						FB.api('/me', function(response) {
							$.ajax({
								url: '<?php echo base_url('login/login_user');?>',
								type: "POST",
								data: {id: response.id},
								success: 
								function(data){
									//$('#next_quest').removeAttr( "disabled" );
									//window.location.replace('myapp/index');
									window.location.reload();
								} 
							});
							
						});
					} else {
						window.location.reload();
						console.log('User cancelled login or did not fully authorize.');
					}
				});
		}
</script>