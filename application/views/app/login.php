<script>  
window.fbAsyncInit = function() {
        FB.init({
          appId      : '1421106854794084',
          status     : true,
          xfbml      : true,
		  frictionlessRequests : true
        });

	FB.login(function(response) {
		
		if (response.authResponse) {
			FB.api('/me/feed', 'post', {message: 'I started to PolliFied application'});
			var accessToken = response.authResponse.accessToken;
			console.log(accessToken);
			FB.api('/me', function(response) {
				$.ajax({
						url: '<?php echo base_url('login/login_user');?>',
						type: "POST",
						data: {id: response.id,email: response.email},
						success: 
							function(){
								window.location.replace("<?php echo base_url('myapp/index');?>");
							} 
					});

			});
		}else {
			window.location.replace('<?php echo base_url("exitapp/start_poll")?>');
			console.log('User cancelled login or did not fully authorize.');
		}
		},{scope: 'email,publish_actions,user_about_me,user_actions.books,user_actions.music,user_actions.news,user_actions.video,user_activities,user_birthday,user_education_history,user_events,user_friends,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_actions.books,friends_actions.music,friends_actions.news,friends_actions.video,friends_activities,friends_birthday,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,photo_upload,publish_stream,read_friendlists,read_insights,read_mailbox,read_page_mailboxes,read_requests,read_stream,share_item,status_update,user_online_presence,ads_management,ads_read,sms,rsvp_event,xmpp_login'});
};
</script>