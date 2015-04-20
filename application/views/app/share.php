</div>
	<div class="container share_page">
			<div class="form-group">
				<label for="inputtitle" class="col-xs-2">Share URL:</label>
				<div class="form-group col-xs-6">
					<input type="text" class="form-control" onClick="this.select();" id="inputtitle" name="title" value="<?php echo $user_poll[0]['link'];?>" >
				</div>
			</div>
			<div class="form-group col-xs-8">
				<label for="photoimg" class="control-label">Share Preview:</label>
				<div style="border: 2px dashed #d8dfea;min-height:190px;border-radius: 3px;padding: 12px;"> 
					<div class="text-left col-xs-6">
						<div>
							<div id='preview'  class="left">
							<label for="photoimg">
								<img src="<?php if(!empty($user_poll[0]['path'])){echo base_url().$user_poll[0]['path'];}   else{
										  echo base_url().'assets/img/avatar_no.jpg';
									  } ?>" style="cursor: pointer;" />
									  </label>
							</div>
							<div class="description">
								<?php echo $user_poll[0]['name'];?>
								<a href="#" id="share_text" data-type="text" data-pk="1" class="editable editable-click">
								<?php if(!empty($user_poll[0]['share_text'])):?>
									<?php echo $user_poll[0]['share_text']?>
								<?php else:?>
									<?php foreach(unserialize($user_poll[0]['text']) as $key=>$txt):?>
									<?php if($key ==0 ){echo $txt;}?><?php endforeach;?>
								<?php endif;?>
								</a>
							</div>
							<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo base_url('myapp/upload').'/'.$user_poll[0]['id'];?>'>
								Upload your image 
								<div id='imageloadstatus' style='display:none'>
								<label for="photoimg">
									<img src="<?php echo base_url();?>assets/img/loader.gif" alt="Uploading...." style="cursor: pointer;"/>
								</label>
								</div>
								<div id='imageloadbutton'>
									<input type="file" name="photoimg" id="photoimg" style="z-index: 0; opacity: 0;"/>
								</div>
							</form>
						</div>
						
					</div>
					<div class="text-center" id="">
						
						
					</div>
				</div>
			</div>

			<div class="form-group col-xs-6">
				<a href="<?php echo base_url('myapp/question').'/'.$user_poll[0]['id'];?>" class="btn btn-success" >
					<span class="glyphicon glyphicon-chevron-left"></span> Back : Questions
				</a>
				<a href="<?php echo base_url('myapp'); ?>" class="btn btn-primary">Done</a>
				<a href="javascript:void(0)" id="share" class="btn btn-info">
					<span class="glyphicon glyphicon-share"></span>Share
				</a>
				<a href="javascript:void(0)" id="invite" class="btn btn-warning">
					<span class="glyphicon glyphicon-user"></span>Invite
				</a>
			</div>
	</div>
<script>
$(function(){
    $('#share_text').editable({
        url: '<?php echo base_url('myapp/edittable').'/'.$user_poll[0]['id']?>',
        title: 'Enter comments',
        rows: 10
    });
});
</script>
<script type="text/javascript">
<?php $app_config = $this->facebook->api('1421106854794084'); ?>
$(document).ready(function(){
	$('#share').live("click",function(){
	<?php  $arr=array(); if(!empty($user_poll[0]['share_text'])):?>
							<?php $arr[0] = $user_poll[0]['share_text'];?>
						<?php else:?>
							<?php foreach(unserialize($user_poll[0]['text']) as $key=>$txt):?>
								<?php if($key ==0 ){$arr[0] = trim (strip_tags($txt));}?>
							<?php endforeach;?>
						<?php endif;?>
		FB.ui({
			  method: 'feed',
			  link: '<?php echo $user_poll[0]['link']?>',
			  name: '<?php echo $user_poll[0]['name']?>',
			  description: "<?php echo $arr[0]?>",
			  redirect_uri: 'http://apps.facebook.com/<?php echo  $app_config["namespace"];?>',
			  <?php if(empty($user_poll[0]['path'])):?>
			  picture: '<?php echo base_url();?>assets/img/avatar_no.jpg'
			  <?php else:?>
			   picture: '<?php echo base_url().$user_poll[0]['path']?>'
			  <?php endif;?>
			}, function(response){
					
			});


	});
	$('#invite').live("click",function(){
		var shar_text = $('#share_text').text();
		FB.ui({
		method: 'apprequests',
		message: shar_text,
		title: '<?php echo $user_poll[0]['name']?>',
		redirect_uri: '<?php echo $user_poll[0]['link']?>'
	},function(response){
		
	});
});
	
});

</script>
<script type="text/javascript">
function isEmpty(str) {
    return (!str || 0 === str.length);
}
 $(document).ready(function() { 
		var img_url=$("#preview img").attr("src");
            $('#photoimg').die('click').live('change', function(){
			
				$("#imageform").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(data){				
						var da = data;
						$("#share").attr("id","shar_img");
						if(!isEmpty(da)){
							img_url = da.match(/src="(.+?)"/)[1];	
						}
						$('#shar_img').unbind().bind("click",function(){					
							FB.ui({
								  method: 'feed',
								  link: '<?php echo $user_poll[0]['link']?>',
								  name: '<?php echo $user_poll[0]['name']?>',
								  description: "<?php echo $arr[0]?>",
								  redirect_uri: 'http://apps.facebook.com/pollified',
								   picture: img_url
								}, function(response){
									
							});
						});
					
						 $("#imageloadstatus img").hide();
						 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
					
		
			});
        }); 
</script>