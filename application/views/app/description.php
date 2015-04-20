</div>
<script>
		$(function() {

			$("textarea,input").jqBootstrapValidation(
				{
					preventSubmit: true,
					submitError: function($form, event, errors) {
					},
					filter: function() {
						return $(this).is(":visible");
					}
				}
			);
			$("a[data-toggle=\"tab\"]").click(function(e) {console.log('4444');
			var a = $(this).attr("href");
			console.log(a);
				e.preventDefault();
				$(this).tab("show");
				$(a).find("iframe").css("width","100%");
				//$(a).find("iframe").text("5555");
			});

		});
		
		
		$( document ).ready(function() {//console.log('4444');
			//$( window ).resize(function() {console.log('5555');})
		})
			$("iframe").each(function() { console.log('aaaa');
				//console.log(($this));
				$(this).css('width',"100%");
				 
			});
		
		
</script>
<div class="container" >
<form action="<?php echo base_url();?>myapp/description/<?php echo $this->uri->segment(3);?>" method="post"  novalidate="">
<div class="row">
	<div class="col-xs-4">
		<label for="newpoll">Poll Name</label>
		<div class="control-group">
			<input type="text" class="form-control" name="pollname" placeholder="New Poll" value="<?php echo $user_poll[0]['name'];?>" required="" >
			<p class="bg-danger"></p>
		</div>
	</div>
</div>
<br/>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#introduction" data-toggle="tab">Introduction</a></li>
		<li><a href="#poll_header" data-toggle="tab">Poll Header</a></li>
		<li><a href="#poll_footer" data-toggle="tab">Poll Footer</a></li>
		<li><a href="#thank_you"   data-toggle="tab">Thank-you text</a></li>
		<li><a href="#closed_poll" data-toggle="tab">Closed poll text</a></li>
	</ul>


	<div class="tab-content">
		<div class="tab-pane active" id="introduction">
			<textarea class="ckeditor" cols="60" id="editor1" name="polledit[]" rows="10" >
				<?php $text_0 = unserialize($user_poll[0]['text']); echo $text_0[0];?>
			</textarea>
		</div>
		<div class="tab-pane" id="poll_header">
			<textarea class="ckeditor" cols="60" id="editor2" name="polledit[]" rows="10" <?php if(false/* 		$poll_user[0]['upgrate']==0 */){ echo "disabled";}else{echo "";}?> >
				<?php $text_0 = unserialize($user_poll[0]['text']); echo $text_0[1];?>
			</textarea>
		</div>
		<div class="tab-pane" id="poll_footer">
			<textarea class="ckeditor" cols="60" id="editor3" name="polledit[]" rows="10" <?php if(false/* $poll_user[0]['upgrate']==0 */){ echo "disabled";}else{ echo "";} ?>>
				<?php $text_0 = unserialize($user_poll[0]['text']); echo $text_0[2];?>
			</textarea>
		</div>
		<div class="tab-pane" id="thank_you">
			<textarea class="ckeditor" cols="60" id="editor4" name="polledit[]" rows="10" <?php if(false/* $poll_user[0]['upgrate']==0 */){ echo "disabled";}else{echo "";} ?>>
				<?php $text_0 = unserialize($user_poll[0]['text']); echo $text_0[3];?>
			</textarea>
		</div>
		<div class="tab-pane" id="closed_poll">
			<textarea class="ckeditor" cols="60" id="editor4" name="polledit[]" rows="10" <?php if(false/* $poll_user[0]['upgrate']==0 */){ echo "disabled";}else{echo "";} ?>>
				<?php $text_0 = unserialize($user_poll[0]['text']); echo $text_0[4];?>
			</textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-success" id="next_quest">Next : Questions
			<span class="glyphicon glyphicon-chevron-right" style="padding-right: 3px;"></span>
	</button>
	<a href="<?php echo base_url('myapp/delete').'/'.$this->uri->segment(3);?>" onclick="alert('Are you sure want to delete this poll?')" class="btn btn-danger poll_delete"><span class="glyphicon glyphicon-minus"></span>Delete
	</a>
	
</form>
<div class="social_block">
<fb:like href="https://apps.facebook.com/pollified" layout="standard" action="like" show_faces="true" share="true"></fb:like>
</div>
</div>