<script>
$('.bs-modal-lg').modal({
  backdrop: false,
  keyboard:false,
  show:false
});
$(function() {
		$( "#edit_question" ).draggable();
	});
	$(function() {
		$( "#added_question" ).draggable();
	});
</script>
</div>
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
	$('#save_sort').live("click",function(){
		$('.table > tbody  > .drag').each(function(j){
			$(this).attr("drag",j)
			j++;
		});
		var arr=[];
		$('.table > tbody  > .drag').each(function(){
		var second=$(this).attr("drag");
		
		var first=$(this).attr("id");
		first=first.split('_');
		first=first[1];
		//arr[first]=second;
		arr.push([first,second]);
		
		});

		$.ajax({
		url:"<?php echo base_url('myapp/sort_table')?>",
		type:"post",
		data:{sort:arr},
		success:function(){location.reload();}
		});
	});	

</script>
<div class="container">

<?php if(!empty($poll_question)):?>
<div class="table-responsive">
<table class="table table-condensed table-hover">
<tbody>
	<tr class="info">
		<th></th>
		<th>Questions</th>
		<th>Choices</th>
		<th></th>
	</tr>
<?php foreach($poll_question as $quest): ?>

<!--...................Begin...............................-->
	<?php if($quest['question_type'] == 3 ):?>
	<tr class="drag" id="question_<?php echo $quest['id'];?>">
		<td style="width: 6%;" class="move">
			<span class="glyphicon glyphicon-arrow-up"></span>
			<span class="glyphicon glyphicon-arrow-down">
		</td>
		<td style="width: 150px;"><div class="center-block"><?php echo $quest['question'];?></div></td>
		<td style="width:621px">
			<div class="col-xs-6">
				<select class="form-control">
					<option value='' selected>Select Chosen</option>
					<?php foreach(unserialize($quest['question_choices']) as $ch):?>
					<option><?php echo $ch;?></option>
					<?php endforeach;?>
				</select>
			</div>
		</td>
		<td style="width: 20%;">
			<a href="#" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-lg-<?php echo $quest['id']?>" data-backdrop="false">
				<span class="glyphicon glyphicon-edit" ></span>Edit
			</a>
			
			<a href="<?php echo base_url('myapp/delete_quest').'/'.$quest['id'].'/'.$quest['poll_id'];?>" class="btn btn-danger">
				<span class="glyphicon glyphicon-remove" ></span>Delete
			</a>
		</td>
                
	</tr>
	<?php endif;?>
	<!--...................End...............................-->
	
	<!--..................Begin................................-->
	<?php if($quest['question_type'] == 1 ):?>
	<tr class="drag" id="question_<?php echo $quest['id'];?>">
	<td style="width: 6%;" class="move"><span class="glyphicon glyphicon-arrow-up"></span><span class="glyphicon glyphicon-arrow-down"></td>
		<td style="width: 150px;"><div class="center-block"><?php echo $quest['question'];?></div></td>
		<td style="width:621px">
			<div class="col-xs-6 radio_block">
				<?php foreach(unserialize($quest['question_choices']) as $key=>$ch):?>
					<input type="radio" value="<?=$key?>" name="radio"/><label><?php echo $ch;?></label><br/>
				<?php endforeach;?>
			</div>
		</td>
		<td style="width: 20%;">
			<a href="#" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-lg-<?php echo $quest['id']?>" data-backdrop="false">
				<span class="glyphicon glyphicon-edit" ></span>Edit
			</a>
			
			<a href="<?php echo base_url('myapp/delete_quest').'/'.$quest['id'].'/'.$quest['poll_id']?>" class="btn btn-danger">
				<span class="glyphicon glyphicon-remove" ></span>Delete
			</a>
		</td>
                
	</tr>
	<?php endif;?>
	<!--...................End...............................-->
	
	
	<!--..................Begin...................................-->
	<?php if($quest['question_type'] == 2 ):?>
	<tr class="drag" id="question_<?php echo $quest['id'];?>">
	<td style="width: 6%;" class="move"><span class="glyphicon glyphicon-arrow-up"></span><span class="glyphicon glyphicon-arrow-down"></td>
		<td style="width: 150px;"><div class="center-block"><?php echo $quest['question'];?></div></td>
		<td style="width:621px">
			<div class="col-xs-8 radio_block">
				<?php foreach(unserialize($quest['question_choices']) as $key=>$ch):?>
					<input type="checkbox" id="chekbox<?=$key?>" value="<?=$key?>" name="chek"/>
					<label for="chekbox<?=$key?>"><?php echo $ch;?></label><br/>
				<?php endforeach;?>
			</div>
		</td>
		<td style="width: 20%;">
			<a href="#" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-lg-<?php echo $quest['id']?>" data-backdrop="false">
				<span class="glyphicon glyphicon-edit" ></span>Edit
			</a>
			
			<a href="<?php echo base_url('myapp/delete_quest').'/'.$quest['id'].'/'.$quest['poll_id']?>" class="btn btn-danger">
				<span class="glyphicon glyphicon-remove" ></span>Delete
			</a>
		</td>
                
	</tr>
	<?php endif;?>
	<!--..................End................................-->
	
	<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 4 ):?>
	<tr class="drag" id="question_<?php echo $quest['id'];?>">
	<td style="width: 6%;" class="move"><span class="glyphicon glyphicon-arrow-up"></span><span class="glyphicon glyphicon-arrow-down"></td>
		<td style="width: 150px;"><div class="center-block"><?php echo $quest['question'];?></div></td>
		<td style="width: 621px">
			<div class="radio_block">
				<p style="float:left;margin-top: 8px;">
					<?php $poor=(unserialize($quest['question_scale'])); echo $poor[0];?>
				</p>
				<?php for($i=1;$i<=5;$i++):?>
					<input type="radio" id="you" value="<?=$i?>" name="chek" style="float:left;margin-top: 15px;margin-left: 6px"/>
					<label for="you" style="float:left"><?php echo $i;?></label>
				<?php endfor;?>
				<p style="float:left;margin-top: 8px;"><?php $poor=(unserialize($quest['question_scale'])); echo $poor[1];?></p>
			</div>
		</td>
		<td style="width: 20%;">
			<a href="#" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-lg-<?php echo $quest['id']?>" data-backdrop="false">
				<span class="glyphicon glyphicon-edit" ></span>Edit
			</a>
			
			<a href="<?php echo base_url('myapp/delete_quest').'/'.$quest['id'].'/'.$quest['poll_id']?>" class="btn btn-danger">
				<span class="glyphicon glyphicon-remove" ></span>Delete
			</a>
		</td>
                
	</tr>
	<?php endif;?>
	<!--..................End.................................-->
	
	<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 5 ):?>
	<tr class="drag" id="question_<?php echo $quest['id'];?>">
	<td style="width: 6%;" class="move"><span class="glyphicon glyphicon-arrow-up"></span><span class="glyphicon glyphicon-arrow-down"></td>
		<td style="width: 150px;"><div class="center-block"><?php echo $quest['question'];?></div></td>
		<td style="width:621px">
			<div class="col-xs-6">
				<input type="text" class="form-control" value="One-line text box" disabled="disabled"/>
			</div>
		</td>
		<td style="width: 20%;">
			<a href="#" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-lg-<?php echo $quest['id']?>" data-backdrop="false">
				<span class="glyphicon glyphicon-edit" ></span>Edit
			</a>
			
			<a href="<?php echo base_url('myapp/delete_quest').'/'.$quest['id'].'/'.$quest['poll_id']?>" class="btn btn-danger">
				<span class="glyphicon glyphicon-remove" ></span>Delete
			</a>
		</td>          
	</tr>
	<?php endif;?>
<!--.....................End.............................-->

<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 6 ):?>
	<tr class="drag" id="question_<?php echo $quest['id'];?>">
	<td style="width: 6%;" class="move"><span class="glyphicon glyphicon-arrow-up"></span><span class="glyphicon glyphicon-arrow-down"></td>
		<td style="width: 150px;"><div class="center-block"><?php echo $quest['question'];?></div></td>
		<td style="width:621px">
			<div class="col-xs-6">
					<textarea class="form-control" disabled="disabled"/>Multiple line text box</textarea>
			</div>
		</td>
		<td style="width: 20%;">
			<a href="#" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-lg-<?php echo $quest['id']?>" data-backdrop="false">
				<span class="glyphicon glyphicon-edit" ></span>Edit
			</a>
			
			<a href="<?php echo base_url('myapp/delete_quest').'/'.$quest['id'].'/'.$quest['poll_id']?>" class="btn btn-danger">
				<span class="glyphicon glyphicon-remove" ></span>Delete
			</a>
		</td>
                
	</tr>
	<?php endif;?>
<!--.....................End.............................-->


<!--..................Begin.................................-->
	<?php if($quest['question_type'] == 7 ):?>
	<tr class="drag" id="question_<?php echo $quest['id'];?>">
	<td style="width: 6%;" class="move"><span class="glyphicon glyphicon-arrow-up"></span><span class="glyphicon glyphicon-arrow-down"></td>
		<td style="width: 150px;"><div class="center-block"><?php echo $quest['question'];?></div></td>
		<td style="width:621px">
			<div class="col-xs-6">
					<input type="email"  class="form-control" disabled="disabled" value="Email address box"/>
			</div>
		</td>
		<td style="width: 20%;">
			<a href="#" class="btn btn-info" data-toggle="modal" data-target=".bs-modal-lg-<?php echo $quest['id']?>" data-backdrop="false">
				<span class="glyphicon glyphicon-edit" ></span>Edit
			</a>
			
			<a href="<?php echo base_url('myapp/delete_quest').'/'.$quest['id'].'/'.$quest['poll_id']?>" class="btn btn-danger">
				<span class="glyphicon glyphicon-remove" ></span>Delete
			</a>
		</td>
                
	</tr>
	<?php endif;?>
<!--.....................End.............................-->





<?php endforeach;?>
</tbody>
</table>
</div>
<?php foreach($poll_question as $quest): ?>
<div class="modal fade bs-modal-lg-<?php echo $quest['id']?>"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	
	<div class="modal-dialog popup_block" id="edit_question">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close edit_close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Edit Question</h4>
			</div>  
			<div class="modal-body">

				<form  action="<?php echo base_url('myapp/update_question').'/'.$quest['id'].'/'.$this->uri->segment(3);?>" method="POST" >
						<p>Quastion</p>
						<div class="col-xs-12 text_box">
							<textarea required="" class="form-control" rows="3" name="question"><?php echo $quest["question"];?></textarea>
							
						</div>
						<div class="col-xs-12">
							<p>Question type</p>
							
							<select class="type_question sml_selectbox form-control" name="question_type">
								<option value="1" <?php if($quest["question_type"]==1){ ?>selected="selected"<?php } ?> >Multiple choices</option>
								<option value="2" <?php if($quest["question_type"]==2){ ?>selected="selected"<?php } ?>  >Checkboxes</option>
								<option value="3" <?php if($quest["question_type"]==3){ ?>selected="selected"<?php } ?> >Drop-down list</option>
								<option value="4" <?php if($quest["question_type"]==4){ ?>selected="selected"<?php } ?> >Scale of 1 to 5</option>
								<option value="5" <?php if($quest["question_type"]==5){ ?>selected="selected"<?php } ?> >One-line text box</option>
								<option value="6" <?php if($quest["question_type"]==6){ ?>selected="selected"<?php } ?>>Multiple line text box</option>
								<option value="7" <?php if($quest["question_type"]==7){ ?>selected="selected"<?php } ?> >Email address box</option>
							</select>
							
						</div>
						<?php if($quest["question_type"]==1||$quest["question_type"]==2||$quest["question_type"]==3){?>
							<div class="col-xs-8 type_1" style="width: 100%;">
								<p>Answer choices</p>
								<?php if($quest["question_type"]==1){?>
									<?php if($quest["link_type"]==1){ ?>
										<input type="checkbox" id="chekbox-<?php echo $quest['id']; ?>" class="chekbox"  name="chek_link_edit" checked="on"/>
									<?php }
									else{ ?>
										<input type="checkbox" id="chekbox-<?php echo $quest['id']; ?>" class="chekbox" name="chek_link_edit" />
									 <?php } ?>
								
									<label for="chekbox-<?php echo $quest['id']; ?>"  class="th" style="font-weight:normal">Use link for Answer choices</label>
								<?php } else{?>
									
										<input type="checkbox" id="chekbox-<?php echo $quest['id']; ?>" class="chekbox" name="chek_link_edit" style="display:none"/>
									 
								
									<label for="chekbox-<?php echo $quest['id']; ?>" class="th" style="font-weight:normal;display:none" >Use link for Answer choices</label>
								
								<?php } ?>
								<div class="answer_edit">
								<?php if($quest["link_type"]==1){ ?>	
									<?php $res=unserialize($quest['question_choices']); $link=unserialize($quest['answer_link']); 
									for($i=0;$i<count($res);$i++){?>
									
										<div class="input">
											<label class="ans">Answer</label><input type="text" class="form-control" name="question_choices[]" style="width: 70%;float: left;" value="<?php echo $res[$i];?>"/> 
											<a href='#' class='btn btn-small' style='padding: 9px 12px;'>
											<span class="glyphicon glyphicon-remove-sign" style="float: left;"></span></a>
											<label class='url'>URL</label><input type='text' class='form-control link' name='question_link[]' required='' style='width: 50%;height: 25px;' value="<?php echo $link[$i];?>">
										</div>
								   	<?php }?>
								
								<?php } else{?>
									<?php $res=unserialize($quest['question_choices']);  
									for($i=0;$i<count($res);$i++){?>
									
										<div class="input">
											<label class="ans">Answer</label><input type="text" class="form-control" name="question_choices[]" style="width: 70%;float: left;" value="<?php echo $res[$i];?>"/> 
											<a href='#' class='btn btn-small' style='padding: 9px 12px;'>
											<span class="glyphicon glyphicon-remove-circle" style="float: left;"></span>
											</a>
										</div>
								   	<?php }?>
								
								<?php }?>
								
								</div>
								<a href="#" class="btn add_choices_edit">
									<span class="glyphicon glyphicon-plus-sign" style="width:104px;">
									<p class="add_choice" style="padding-right: 0px;">Add choice</p></span>
								</a>
							</div>
						<?php } else{ ?> 
							<div class="col-xs-8 type_1" style="width: 100%;display:none">
									<p>Answer choices</p>
									<input type="checkbox" id="chekbox-<?php echo $quest['id']; ?>" class="chekbox" name="chek_link_edit" />
									<label for="chekbox-<?php echo $quest['id']; ?>"  class="th" style="font-weight:normal">use link for Answer choices</label>
									<div class="answer">
										<div class=" input">
											<label class="ans">Answer</label><input type="text" class="form-control" name="question_choices[]" style="width: 80%;"/>
										</div>
										<div class=' input'>
											<label class="ans">Answer</label><input type='text' class="form-control" name="question_choices[]"  style="width: 80%;float: left;"/><a href='#' class='btn btn-small' style='padding: 9px 12px;'><span class="glyphicon glyphicon-remove-circle" style="float: left;"></span></a>
										</div>
									</div>
									<a href="#" class="btn add_choices"><span class="glyphicon glyphicon-plus-sign"><p class="add_choice">Add choice</p></span></a>
								</div>
						
						<?php } ?> 
						
						<div class="col-xs-8 type_2" style="display:none">
							2222
						</div>
						<div class="type_3" style="display:none">
							3333
						</div>
						
						<?php if($quest["question_type"]==4){ ?>
							<div class="type_4 col-xs-8" style="width: 100%;">
							<p>Scale labels</p>
							<div class="answer">
								<div class=" input">
									<input type="text" class="form-control" name="question_scale[]" style="width: 80%;" value="<?php $poor=(unserialize($quest['question_scale'])); echo $poor[0];?>"/>
								</div>
								<div class=" input">
									<input type="text" class="form-control" name="question_scale[]" style="width: 80%;" value="<?php $poor=(unserialize($quest['question_scale'])); echo $poor[1];?>"/>
								</div>
							</div>
						</div>
						<?php } else{?> 
							<div class="type_4 col-xs-8" style="width: 100%; display:none">
							<p>Scale labels</p>
							<div class="answer">
								<div class=" input">
									<input type="text" class="form-control" name="question_scale[]" style="width: 80%;" value="Poor"/>
								</div>
								<div class=" input">
									<input type="text" class="form-control" name="question_scale[]" style="width: 80%;" value="Excellent"/>
								</div>
							</div>
						</div>
						<?php } ?> 
						
						<?php if($quest["question_type"]==5){ ?>
							<div class="type_5" style="">
								
							</div>
						<?php } else{?> 
							<div class="type_5" style="display:none">
								
							</div>
						<?php } ?> 
						
						<?php if($quest["question_type"]==6){ ?>
							<div class="type_6" style="">
								
							</div>
						<?php } else{?> 
							<div class="type_6" style="display:none">
								
							</div>
						<?php } ?> 
						
						<?php if($quest["question_type"]==7){ ?>
							<div class="type_7" style="">
								
							</div>
						<?php } else{?> 
							<div class="type_7" style="display:none">
								
							</div>
						<?php } ?> 
						
						<div>
							<input type="submit" class="btn btn-primary" value="save" style="margin: 10px 0px 0px 14px;"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php endforeach;?>







<?php endif;?>
	<a href="<?php echo base_url();?>myapp/description/<?php echo $user_poll[0]['id']?>" class="btn btn-default">
		<span class=" glyphicon glyphicon-chevron-left"></span> Back : Description
	</a>
	<a href="#bs-modal-lg" class="btn btn-primary" data-toggle="modal" data-target=".bs-modal-lg" data-backdrop="false">
		<span class="glyphicon glyphicon-plus"></span>Add Question
	</a>
	<a href="<?php echo base_url();?>myapp/share/<?php echo $user_poll[0]['id']?>" class="btn btn-success">
		<span class="glyphicon glyphicon-share"></span>Share
	</a>
<input type="button"  class="btn btn-primary" id="save_sort" value="Save">
<div class="modal fade bs-modal-lg" tabindex="-1"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog popup_block" id="added_question">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">New question</h4>
			</div>         
			<div class="modal-body">

				<form  action="<?php echo base_url('myapp/add_question').'/'.$this->uri->segment(3);?>" method="POST">  
						<p>Question</p>
						<div class="col-xs-12 text_box">
						<div class="control-group">
							<textarea required=""  class="form-control" rows="3" name="question"></textarea>
							<p class="bg-danger"></p>
						</div>
							
						</div>
						<div class="col-xs-12">
							<p>Question type</p>
							<select required="" class="type_question" name="question_type">
								<option value="1">Multiple choices</option>
								<option value="2">Checkboxes</option>
								<option value="3">Drop-down list</option>
								<option value="4">Scale of 1 to 5</option>
								<option value="5">One-line text box</option>
								<option value="6">Multiple line text box</option>
								<option value="7">Email address box</option>
							</select>
						</div>
						<div class="col-xs-8 type_1" style="width: 100%;">
							<p>Answer choices</p>
							<input type="checkbox" id="chekbox_link"  name="chek_link"/>
							<label for="chekbox_link" class="th" style="font-weight:normal">Use link for Answer choices</label>
							<div class="answer">
								<div class=" input">
									<label class="ans">Answer</label>
									<input  type="text" class="form-control" name="question_choices[]" style="width: 70%;"/>
								</div>
								<div class='input'>
									<label class="ans">Answer</label>
									<input type='text' class="form-control" name="question_choices[]"  style="width: 70%;float: left;"/>
									<a href='#' class='btn btn-small' style='padding: 9px 12px;'>
										<span class="glyphicon glyphicon-remove-circle" style="float: left;"></span>
									</a>
								</div>
							</div>
							<a href="#" class="btn add_choices">
								<span class="glyphicon left glyphicon-plus-sign"><p class="add_choice">Add choice</p></span>
							</a>
						</div>
						<div class="col-xs-8 type_2" style="display:none">
							2222
						</div>
						<div class="type_3" style="display:none">
							3333
						</div>
						<div class="type_4 col-xs-8" style="width: 100%; display:none">
							<p>Scale labels</p>
							<div class="answer_1">
								<div class=" input">
									<input type="text" class="form-control" name="question_scale[]" style="width: 80%;" value="Poor"/>
								</div>
								<div class=" input">
									<input type="text" class="form-control" name="question_scale[]" style="width: 80%;" value="Excellent"/>
								</div>
							</div>
						</div>
						<div class="type_5" style="display:none">
							
						</div>
						<div class="type_6" style="display:none">
							
						</div>
						<div class="type_7" style="display:none">
							
						</div>
						<div>
							<input type="submit" class="btn btn-primary" value="save" style="margin: 10px 0px 0px 14px;"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/myjs.js"></script>