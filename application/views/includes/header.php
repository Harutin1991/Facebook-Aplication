<html xmlns:fb="https://ogp.me/ns/fb#">

<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css">
<script src="//code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap_valid.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-paginator.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-editable.js"></script>
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/pollified_icon.png">
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1421106854794084";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
	
window.fbAsyncInit = function() {
	FB.Canvas.setSize({ width: 624, height: 1024 });
};
</script>
<script>
	$('#polltab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
</script>

	<title>PolliFied</title>
</head>

<body class="body">

	<div class="main">	
            <div class="container header">
			<div class="form-group">
				
					<div class="col-xs-8">
						<a href="<?php echo base_url('myapp/index'); ?>">				
							<img src="<?php echo site_url('assets/img')?>/pollified_logo.png" style="margin-top: -20px;
margin-bottom: 10px; height: 100px;" id="desc">
						</a>
					</div>
					
			</div>
				
