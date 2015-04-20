</div>
<script>
$(function() {

			$("input,textarea").jqBootstrapValidation(
				{
					preventSubmit: true,
					submitError: function($form, event, errors) {
						// Here I do nothing, but you could do something like display 
						// the error messages to the user, log, etc.
					},
					filter: function() {
						return $(this).is(":visible");
					}
				}
			)
			$("a[data-toggle=\"tab\"]").click(function(e) {
			var a = $(this).attr("href");
			console.log(a);
				e.preventDefault();
				$(this).tab("show");
				$(a).find("iframe").css("width","100%");
				//$(a).find("iframe").text("5555");
			});
			
	});

</script>
<div class="container" >
		<?php //out($user);out($poll_user);out($poll_use);out($poll_user[0]["uid"]);?>
		<form action="<?php echo base_url('myapp/add');?>" method="post" novalidate="">
		<div class="row">
			<div class="col-xs-6">
				<div class="control-group">
					<label for="newpoll">Poll Name</label>
					<input type="text" name="pollname" class="form-control" placeholder="New Poll" required="">
					<p class="bg-danger1"></p>
				</div>
			</div>
		</div>
		<br/>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#introduction" data-toggle="tab">Introduction</a></li>
			<li><a href="#poll_header" data-toggle="tab">Poll Header</a></li>
			<li><a href="#poll_footer" data-toggle="tab">Poll Footer</a></li>
			<li><a href="#thank_you"   data-toggle="tab">Thank-you text</a></li>
			<li><a href="#closed_poll" data-toggle="tab" >Closed poll text</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="introduction">
				<div class="control-group">
					<textarea required="" minlength="10" class="ckeditor" cols="60" id="editor1" name="polledit[]" rows="10" >
					</textarea>
				</div>
			</div>
			<div class="tab-pane" id="poll_header">
				<textarea class="ckeditor" cols="60" id="editor2" name="polledit[]" rows="10" >
					Poll Header
				</textarea>
			</div>
			<div class="tab-pane" id="poll_footer">
				<textarea class="ckeditor" cols="60" id="editor3" name="polledit[]" rows="10">
					
				</textarea>
			</div>
			<div class="tab-pane" id="thank_you">
				<textarea class="ckeditor" cols="60" id="editor4" name="polledit[]" rows="10">
					 Thanks for voting
				</textarea>
			</div>
			<div class="tab-pane" id="closed_poll">
				<textarea class="ckeditor" cols="60" id="editor4" name="polledit[]" rows="10">
					This poll is closed
				</textarea>
			</div>
		</div>
		<?php if(isset($poll_user)) {
			if(is_array($poll_user)){
				$poll_user = $poll_user[0]["uid"];
			}
			else{
				$poll_user=$poll_user;
			}
		
		
			if(in_array($poll_user,$user)){ ?>
			<button  type="submit" class="btn btn-success" id="next_quest">Next:Questions 
				<span class="glyphicon glyphicon-chevron-right"></span>
			</button>
			<?php }else{?>
					<div class="center-block text-primary" align="center" style="min-height: 30px;border: 1px solid #F0E4E4;
					background-color: #F7F7F7;;margin-top: 20px;">
			<p>You don't have permission to add poll</p></div>
			<?php }?>
	
		<?php }else{?>
		<input  type="button" class="btn btn-success" id="next_quest1" value="Next:Questions " style="margin-top: 10px;">
			
		<?php }?>
	</form>
<?php if(isset($user_poll)):?>
<fb:like href="https://apps.facebook.com/myappdesc" layout="standard" action="like" show_faces="true" share="true"></fb:like>
<?php endif;?>
</div>
<?php if(!$user_data):?>
<script>  
window.fbAsyncInit = function() {
        FB.init({
          appId      : '1421106854794084',
          status     : true,
          xfbml      : true
        });
}
</script>
<script>
	document.getElementById("next_quest1").onclick = function() {
		
	
	
		$('#next_quest1').attr("disabled", true);
		
				FB.login(function(response) {console.log("8888");
					if (response.authResponse) {
						FB.api('/me', function(response) {
							$.ajax({
								url: '<?php echo base_url('login/login_user');?>/<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2);?>',
								type: "POST",
								data: {id: response.id},
								success: 
								function(data){
									$('#next_quest').removeAttr( "disabled" );
									location.reload();
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

<?php endif;?>

<script>

//$( window ).resize(function() {
// $(".tab-content .tab-pane").addClass("active");
// $(".tab-content .tab-pane").removeClass("active");

// $(".tab-content .tab-pane").first().addClass("active");


// $("a[data-toggle=\"tab\"]").click(function(e) {
				// e.preventDefault();
				// $(this).tab("show");
			// });

//$(".tab-content iframe").each(function() { //console.log('aaaa');
				// console.log($(this));
				//$(this).css('width',"100%");
				 
			//});

//})
</script>

