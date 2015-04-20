$( document ).ready(function() {
	$(".add_choices").live("click",function(){
		if($("#chekbox_link").is(':checked')){console.log(555);
			$(".answer").append("<div class=' input'><label class='ans'>Answer</label><input type='text' required='' class='form-control' name='question_choices[]' style='width: 70%;float: left;'/><a href='#' class='btn btn-small'style='padding: 9px 12px;' ><span class='glyphicon glyphicon-remove-circle' style='float: left;'></span></a><label class='url'>URL</label><input type='text' class='form-control link' name='question_link[]' required='' style='width: 50%;height: 25px;'></div>")

			}
		
		else{console.log(888);
			$(".answer").append("<div class=' input'><label class='ans'>Answer</label><input type='text' required='' class='form-control' name='question_choices[]' style='width: 70%;float: left;'/><a href='#' class='btn btn-small'style='padding: 9px 12px;' ><span class='glyphicon glyphicon-remove-circle' style='float: left;'></span></a></div>")
		}
	});

$(".add_choices_edit").live("click",function(){
	if($(".chekbox").is(':checked')){
		$(".answer_edit").append("<div class=' input'><label class='ans'>Answer</label><input type='text' required='' class='form-control' name='question_choices[]' style='width: 70%;float: left;'/><a href='#' class='btn btn-small'style='padding: 9px 12px;' ><span class='glyphicon glyphicon-remove-circle' style='float: left;'></span></a><label class='url'>URL</label><input type='text' class='form-control link' name='question_link[]' required=''  style='width: 50%;height: 25px;'></div>")
	
	}
	else{
		$(".answer_edit").append("<div class=' input'><label class='ans'>Answer</label><input type='text' class='form-control' name='question_choices[]' style='width: 70%;float: left;'/><a href='#' class='btn btn-small'style='padding: 9px 12px;' ><span class='glyphicon glyphicon-remove-circle' style='float: left;'></span></a></div>")
	}
})


<!-- *****************ADDED******************************>
var th_added;
$(".type_question").live("click",function(){
				th_added=$('option:selected', this).attr('value');
})

$(".type_question").change(function(){
	var a=$('option:selected', this).attr('value');
	
		if(a==1){
			$('.type_'+th_added).hide();
			$('.type_1').show();
			$(".chekbox").show();
			$(".type_1 label").show();
			$(".type_1 #chekbox_link").show();
		}
		
		if(a==2){
			$('.type_'+th_added).hide();
			$('.type_1').show();
			
			
			if($("#chekbox_link").is(':checked')){
					$("#chekbox_link").attr("checked",false);
			}
			if($(".chekbox").is(':checked')){
				$(".chekbox").attr("checked",false);
			}
			$(".chekbox").hide();
			$(".type_1 .th").hide();
			$(".type_1 #chekbox_link").hide();
			$(".link").remove();
			$(".url" ).remove();
		}
		
		if(a==3){
			$('.type_'+th_added).hide();
			$('.type_1').show();
			
			
			if($("#chekbox_link").is(':checked')){
					$("#chekbox_link").attr("checked",false);
			}
			if($(".chekbox").is(':checked')){
				$(".chekbox").attr("checked",false);
			}
			$(".chekbox").hide();
			
			$(".type_1 .th").hide();
			$(".type_1 #chekbox_link").hide();
			$(".link").remove();
			$(".url" ).remove();
		}
		
		if(a==4){
			$('.type_4').show();
			$('.type_'+th_added).hide();
			$('.type_1').hide();
		}
		
		if(a==5){
			$('.type_5').show();
			$('.type_'+th_added).hide();
			$('.type_1').hide();
		}
		
		if(a==6){
			$('.type_6').show();
			$('.type_'+th_added).hide();
			$('.type_1').hide();
		}
		
		if(a==7){
			$('.type_7').show();
			$('.type_'+th_added).hide();
			$('.type_1').hide();
		}
});


<!--*****************  EDIT     ****************** -->
var th_edit;

$(".type_question_edit").live("click",function(){
				th_edit = $('option:selected', this).attr('value');
})

$(".type_question_edit").change(function(){
	var a=$('option:selected', this).attr('value');
	
		if(a==1){
			$('.type_'+th_edit).hide();
			$('.type_1').show();
			$(".chekbox").show();
			$(".type_1 label").show();
			$("#chekbox_link").show();
			if($(".chekbox").is(':checked')){
				$(".chekbox").attr("checked",false);
			}
		}
		
		if(a==2){
			$('.type_'+th_edit).hide();
			$('.type_1').show();
			
			
			if($("#chekbox_link").is(':checked')){
				$("#chekbox_link").attr("checked",false);
			}
			if($(".chekbox").is(':checked')){
				$(".chekbox").attr("checked",false);
			}
			$(".chekbox").hide();
			$(".type_1 .th").hide();
			//$(".type_1 label").hide();
			$("#chekbox_link").hide();
			$(".link").remove();
			$(".url" ).remove();
		}
		
		if(a==3){
			$('.type_'+th_edit).hide();
			$('.type_1').show();
			
			
			if($("#chekbox_link").is(':checked')){
				$("#chekbox_link").attr("checked",false);
			}
			if($(".chekbox").is(':checked')){
				$(".chekbox").attr("checked",false);
			}
			$(".chekbox").hide();
			//$(".type_1 label").hide();
			$(".type_1 .th").hide();
			$("#chekbox_link").hide();
			$(".link").remove();
			$(".url" ).remove();
		}
		
		if(a==4){
			$('.type_4').show();
			$('.type_'+th_edit).hide();
			$('.type_1').hide();
		}
		
		if(a==5){
			$('.type_5').show();
			$('.type_'+th_edit).hide();
			$('.type_1').hide();
		}
		
		if(a==6){
			$('.type_6').show();
			$('.type_'+th_edit).hide();
			$('.type_1').hide();
		}
		
		if(a==7){
			$('.type_7').show();
			$('.type_'+th_edit).hide();
			$('.type_1').hide();
		}
});

$(".btn-small").live("click", function(){
$(this).parent("div").remove();
});
var j=1;
$('.table tbody').sortable({
			handle: ".move"
}).disableSelection();


// $('#save_sort').live("click",function(){
	// $('.table > tbody  > .drag').each(function(j){
		// $(this).attr("drag",j)
		// j++;
	// });
	// var arr=[];
	// $('.table > tbody  > .drag').each(function(){
	// var second=$(this).attr("drag");
	
	// var first=$(this).attr("id");
	// first=first.split('_');
	// first=first[1];
	//arr[first]=second;
	// arr.push([first,second]);
	
	// });

	// $.ajax({
	// url:"<?php echo base_url('myapp/sort_table')?>",
	// type:"post",
	// data:{sort:arr},
	// success:function(){location.reload();}
	// });
// });


$("#chekbox_link").live("click", function(){
	if($(this).is(':checked')){console.log("aaaa")
		$(".answer > .input").each(function(){
			
				$(this).append("<label class='url'>URL</label><input type='text' class='form-control link' name='question_link[]' required=''  style='width: 50%;height: 25px;'>");
			
		});
	}
	else{
		$(".answer > .input").each(function(){
			$(this).find( ".link" ).remove();
			$(this).find( ".url" ).remove();
		});
	}

})

$(".chekbox").live("click",function(){
	if($(this).is(':checked')){
		$(".answer_edit > .input").each(function(){
			
			
				$(this).append("<label class='url'>URL</label><input type='text' class='form-control link' name='question_link[]' required='' style='width: 50%;height: 25px;'>");
				
		});
	}
	else{
		$(".answer_edit > .input").each(function(){
			$(this).find( ".url" ).remove();
			$(this).find( ".link" ).remove();
		});
	}

})

$(".edit_close").click(function(){
	location.reload();
});

});
