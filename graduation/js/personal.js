$(function(){

	
	// 动态
	$("#dongtai").bind('click',function(){
		$("#dongtai").toggleClass("personal-active");
		$("#ziliao").removeClass("personal-active");
		$("#weishenhe").removeClass("personal-active");
		$("#daishenhe").removeClass("personal-active");
		$("#body-1").show();
		$("#body-2").hide();
		$("#body-3").hide();
		$("#body-4").hide();
		$("#body-5").hide();
		$("#body-6").hide();
	});

	// 个人中心
	$("#ziliao").bind('click',function(){
		$("#ziliao").toggleClass("personal-active");
		$("#dongtai").toggleClass("personal-active");
		$("#weishenhe").removeClass("personal-active");
		$("#daishenhe").removeClass("personal-active");
		$("#body-2").show();
		$("#body-1").hide();
		$("#body-3").hide();
		$("#body-4").hide();
		$("#body-5").hide();
		$("#body-6").hide();
	});

	// 待审核
	$("#daishenhe").bind('click',function(){
		$("#daishenhe").toggleClass("personal-active");
		$("#weishenhe").removeClass("personal-active");
		$("#dongtai").removeClass("personal-active");
		$("#ziliao").removeClass("personal-active");
		$("#body-5").show();
		$("#body-1").hide();
		$("#body-2").hide();
		$("#body-3").hide();
		$("#body-4").hide();
		$("#body-6").hide();
	});

	// 未通过审核
	$("#weishenhe").bind('click',function(){
		$("#weishenhe").toggleClass("personal-active");
		$("#dongtai").removeClass("personal-active");
		$("#ziliao").removeClass("personal-active");
		$("#daishenhe").removeClass("personal-active");
		$("#body-6").show();
		$("#body-1").hide();
		$("#body-2").hide();
		$("#body-4").hide();
		$("#body-5").hide();
		$("#body-3").hide();
	});

	// 关注
	$("#guanzhu").bind('click',function(){
		$("#ziliao").removeClass("personal-active");
		$("#dongtai").removeClass("personal-active");
		$("#weishenhe").removeClass("personal-active");
		$("#daishenhe").removeClass("personal-active");
		$("#body-3").show();
		$("#body-1").hide();
		$("#body-2").hide();
		$("#body-4").hide();
		$("#body-5").hide();
		$("#body-6").hide();
	});

	// 粉丝
	$("#fensi").bind('click',function(){
		$("#ziliao").removeClass("personal-active");
		$("#dongtai").removeClass("personal-active");
		$("#weishenhe").removeClass("personal-active");
		$("#daishenhe").removeClass("personal-active");
		$("#body-4").show();
		$("#body-1").hide();
		$("#body-2").hide();
		$("#body-3").hide();
		$("#body-5").hide();
		$("#body-6").hide();
	});


})