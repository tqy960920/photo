!function(){
	var images=document.querySelectorAll('.change img');
	var nav=document.querySelectorAll('.navNum i');
	var navLeft=document.querySelector('.nav-left');
	var navRight=document.querySelector('.nav-right');
	var current=0;
	//自动轮播

	var timer=setInterval(leftShow,4000);
	//点击下方导航进行轮播切换
	for(var i=0;i<nav.length;i++){
		//监听事件轮播下方导航
		bindClickEvent(i);;
	}	
	function bindClickEvent(index){
		if(timer)
			clearInterval(timer);
		nav[index].onclick=function(){
			if(current==index)
				return;
			nav[current].className='';
			nav[index].className='navactived';
			//切换背景
			 if(index>current){				
				images[current].className='leftout';
				images[index].className='rightin';
			 }			
			if(index<current){
				images[current].className='rightout';
				images[index].className='leftin';
			}	
			 current=index;
		}
			
		timer=setInterval(leftShow,4000);
	
		
	}

	
	//左边导航切换轮播
	navLeft.onclick=changeLeft;
	function changeLeft(){
		leftShow();
		//取消绑定
		if(timer)
			clearInterval(timer);
		var self=this;
		self.onclick=null;
		//再次绑定
		setTimeout(function(){
			self.onclick=changeLeft;
			timer=setInterval(leftShow,4000);
		},3000);
	}

	function leftShow(){
		images[current].className='leftout';
		nav[current].className='';	
		current++;
		if(current==nav.length)
			current=0;
		images[current].className='rightin';
		nav[current].className='navactived';
	}
	//右边导航切换轮播
	navRight.onclick=changeRight;
	function changeRight(){
		rightShow();
		//取消绑定
		if(timer)
			clearInterval(timer);
		var self=this;
		self.onclick=null;
		//再次绑定
		setTimeout(function(){
			self.onclick=changeRight;
			timer=setInterval(rightShow,4000);
		},3000);
	}

	function rightShow(){
		images[current].className='rightout';
		nav[current].className='';	
		current--;
		if(current==-1)
			current=nav.length-1;
		images[current].className='leftin';
		nav[current].className='navactived';
	}

	
}();