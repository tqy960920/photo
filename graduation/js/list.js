$(function(){

	$("#newLi").bind('click',function(){
		$("#newLi").toggleClass("li-active");
		$("#hotLi").removeClass("li-active");
		$("#newList").show();
		$("#hotList").hide();
	});

	$("#hotLi").bind('click',function(){
		// $(this).addClass('btn-default');
		// $(this).addClass('btn-primary');
		$("#newLi").removeClass("li-active");
		$("#hotLi").addClass("li-active");
		$("#hotList").show();
		$("#newList").hide();
	});

		
})