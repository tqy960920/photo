$(function(e){

	var ROOT_URL = "http://192.168.12.109:9091/graduation/";
	//发送验证码
	$('#btnSendCode').bind('click' , function(){

		var nick = $('#nick').val();

		var phone = $('#phone').val();

		var pattern = /^1[3578]\d{9}$/;

		if(!pattern.test(phone)){
			alert('号码无效');
			return;
		}

		$.get('ajax/sendCode.php?phone=' + phone , function(response){
			if(response.code == 100){
				console.log(response);
				
			}
		});		

	});

	$.validator.setDefaults({
        submitHandler:function(form){
            console.log(form);
         
            var formData = new FormData(form);

            $.ajax({
                url:ROOT_URL + 'ajax/reg.php',
                type:'post',
                dataType:'json',
                data:formData,
                processData: false,
                contentType: false,
                success:function(response){
                    console.log(response);
                    if(response.code==100){
                        location.href="home.php";
                    }
                }
            });


        }
    });



    $.validator.addMethod('phoneIsValid' , function(value , element , params){
        console.log(value);
        console.log(element);
        console.log(params);

        var pattern = /^1[3578]\d{9}$/;
        return pattern.test(value);
    });
	
	$('#frmReg').validate({
        rules:{
            nick:{
                required:true,
            },
            phone: {
                required: true,
                phoneIsValid: true
            },
            password:{
            	required:true,
                minlength:4
            }
          
        },
        messages:{
            nick: {
               required: '昵称不能为空',
            },
            phone:{
            	required: '手机号不能为空',
                phoneIsValid:'手机号格式无效'
            },
            password:{
               required:'密码不能为空',
               minlength:'密码为4位'
           }
        }
    });


	// 注册
	// $('#btnReg').bind('click',function(){
		// var NickName=$('#nick').val();
		// var Phone=$('#phone').val();
		// var Password=$('#password').val();
		// var Code=$('#code').val();

	// 	console.log(Code);
	// 	var pattern1 = /^1[3578]\d{9}$/;
	// 	var pattern2=/^\d{4}$/;

	// 	if(!pattern1.test(Phone)){
	// 		alert('号码无效');
	// 		return;
	// 	}
	// 	if(!pattern2.test(Password)){
	// 		alert('密码不能为空');
	// 		return;
	// 	}

		// $.post(ROOT_URL + 'ajax/reg.php' , 
		// 	{Phone:Phone,NickName:NickName,Password:Password,Code:Code}).then(function(response){
		// 	if(response.code == 100){
  //           	console.log(response);
  //           	location.href='home.php';
  //           }
		// });

	// });
	

});