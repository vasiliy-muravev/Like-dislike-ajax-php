function like_dislike(the_element){
	var like_or_dislike = $(the_element).attr("like_dislike");
	var data_razdel = $(the_element).attr("data_razdel");
	var comment_id = $(the_element).attr("comment_id");
	var client_id = $(the_element).attr("client_id");
	
	$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "like_or_dislike="+like_or_dislike+"&data_razdel="+data_razdel+"&comment_id="+comment_id+"&client_id="+client_id,
		success: function(data){
				$(".count-"+like_or_dislike+"[data-countid="+comment_id+"]").html(data);
		}
	});
}