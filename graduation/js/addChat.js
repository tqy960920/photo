 $(function(e){
 	var ROOT_URL = "http://192.168.12.109:9091/graduation/";

	// 发表
	$('.submit').bind('click',function(){

		var Title=$('#chat-title').val();
		var Content=$('#chat-jiyu').val();

		var UserId=$('#addUserId').text();
		

        if(UserId==""){
            $('#dialog').text("请先登录！");

            var timeout=setTimeout(function(){
                $('#dialog').show();
            });
            var timeout=setTimeout(function(){
                $('#dialog').hide();
            },3000);
        }
        else if(Title==""){
            $('#dialog').text("标题不能为空！");

            var timeout=setTimeout(function(){
                $('#dialog').show();
            });
            var timeout=setTimeout(function(){
                $('#dialog').hide();
            },3000);
        }
        else if(Content==""){

            $('#dialog').text("内容不能为空！");

            var timeout=setTimeout(function(){
                $('#dialog').show();
            });
            var timeout=setTimeout(function(){
                $('#dialog').hide();
            },3000);
        }       
        else{
        // 上传
            var UserId=$('#addUserId').text();
	        $.post(ROOT_URL + 'ajax/addChatAjax.php' , 
	        	{Title:Title,Content:Content,UserId:UserId}).then(function(response){
	            if(response.code == 100){
	                console.log(response.data);
	                // var $Id=response.data.Id;

	                location.href="chat.php";

	            }
	        });

	    }
       
    });


});