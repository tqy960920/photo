$(function(){
	//回到顶部
	var layer=document.querySelector('.fixed-back');
	layer.onclick = function(e){
		//goTop();
		window.requestAnimationFrame(goTop);
	}
	function goTop(){
		//回到页面顶部	
		var currentTop = document.documentElement.scrollTop;
		currentTop = currentTop - 20;			
		//中间过度效果
		if(currentTop > 0){
			document.documentElement.scrollTop = currentTop;
			//setTimeout(goTop , 16); // setTimeout与setInterval
			window.requestAnimationFrame(goTop);
		}
		else{
			document.documentElement.scrollTop = 0;
		}
	}
	//当页面到达高度的一半时显示回到顶部的div
	window.onscroll = function(e){
		var height = screen.height / 2;
		if(document.documentElement.scrollTop > height){
			layer.style.display = 'block';
		}
		else{
			layer.style.display = 'none';
		}
	}

	// 头部右边的切换

	$userName=$('#userName');
	// console.log($userName.text());
	
	if($userName.text()){
		$('#log-reg').hide();
		$('#my-name').show();		
	}	
	else{
		$('#log-reg').show();
		$('#my-name').hide();
	}

	// 获取KeyName
	var ROOT_URL = "http://192.168.12.109:9091/graduation/";
	$('#keyTitle').bind('click',function(){
		$keyname=$('.key-search').val();
		console.log($keyname);
		if($keyname!=""){
			  location.href=ROOT_URL+'post.php?key='+$keyname;
		}else{

		}
	});


})