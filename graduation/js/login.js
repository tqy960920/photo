 $(function(e){

    $('#cancel').bind('click',function(){
        location.href("home.php");
    });
        	
    $.validator.addMethod('phoneIsValid', function(value, element) {
    	console.log(value);
    	console.log(element);
        var pattern=/^1[3578]\d{9}$/;
        var length=value.length;
        return pattern.test(value)&&(length==11);
    });

    $.validator.addMethod('passwordIsValid', function(value, element, param) {
        console.log(value);
        console.log(element);
        var pattern=/^\w{4}$/;
        return pattern.test(value);
    });


    $('#frm').validate({
        rules:{
            phone: {
                required: true,
                phoneIsValid: true
            },
            password:{
                required:true,
                passwordIsValid:true
            }         
        },
        messages: {
            phone: {
                required: "电话号码不能为空",
                phoneIsValid: "电话号码长度为11位的数字，必须以18、13、15、17开头"
            },
            password: {
                required: "密码不能为空",
                passwordIsValid: "密码为4位的非空白字符"
            }      
        }
    });
});