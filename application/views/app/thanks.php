</div>
<div class="container">



	<div class="alert alert-success">
			<?php
				echo $thanks[3];
			?>
			<a href="<?php  echo base_url('exitapp/result').'/'.$this->uri->segment(3);?>">view results</a>
	</div>
	<a href="javascript:void(0)" id="share" class="btn btn-info" style="margin-bottom: 5px;margin-bottom: 5px;">
					<span class="glyphicon glyphicon-share"></span>Share
		</a> 
	<?php if($flesh_message):?>
	<!--<p class="lead bg-primary login" style="height: 60px;border-radius: 4px; padding-left: 53px;font-size: 24px;font-style: oblique;font-family: serif;">For registration in application Pollified please enter here  
	<button class="btn btn-success btn-lg" role="button" style="margin-top: 5px;" id="login">Registration</button>
	</p>
	<div class="alert alert-warning alert-dismissable dont_reg" style="display:none;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>You are cancelled login or did not fully authorize.Please register for use poll.</strong>
	</div>-->
</div>
	<?php endif; ?>
</div>
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

<!--  email,publish_actions,user_about_me,user_actions.books,user_actions.music,user_actions.news,user_actions.video,user_activities,user_birthday,user_education_history,user_events,user_friends,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_actions.books,friends_actions.music,friends_actions.news,friends_actions.video,friends_activities,friends_birthday,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,photo_upload,publish_stream,read_friendlists,read_insights,read_mailbox,read_page_mailboxes,read_requests,read_stream,share_item,status_update,user_online_presence,ads_management,ads_read,sms,rsvp_event,xmpp_login!-->