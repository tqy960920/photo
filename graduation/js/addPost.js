 $(function(e){
 	var ROOT_URL = "http://192.168.12.109:9091/graduation/";
 	// 图片上传
	var fileUpload = document.querySelector('#fileUpload');
	var add = document.querySelector('.file-add');
	var image = document.querySelector('.this-img');
	var container = document.querySelector(".file-in");

	add.onclick = function(e){
		fileUpload.click();
	}
	fileUpload.onchange = function(e){
		// console.log(this.files[0]);     
		var formData = new FormData();
		formData.append("cover" , this.files[0]);

		var xhr = new XMLHttpRequest();
		xhr.open('post' , 'http://192.168.12.109:9091/graduation/upLoadFile.php' , true);

		xhr.onreadystatechange =function(){
			if(this.readyState == 4 && this.status == 200){
				var response = JSON.parse(this.responseText);
				console.log(response);
				if(response.code == 100){
					var item = document.createElement('div');
					item.className = "file-item";

					var img = document.createElement("img");
					img.src = response.data.path;
					console.log(img);

					img.name = "graphyImg";
					item.appendChild(img);

					container.appendChild(item);
				}
			}

		}

		xhr.send(formData);
	}

	var LabelId;

	$('#post-label').bind('change',function(){
		LabelId=$('#labelId').attr("value");
		
	});

	// 发表
	$('.submit').bind('click',function(){

		var Title=$('#post-title').val();
		var Content=$('#post-jiyu').val();

		var UserId=$('#addUserId').text();
		

        var $txtCovers = $('[name=graphyImg]');

        // ???
        // console.log($txtCovers.length);
		// console.log($txtCovers[0].src);
		var Image=null;
        //    // 检查数据有效性
        for($i = 0 ;$i < $txtCovers.length; $i++){
        	var path=$txtCovers[$i].src;
            if(Image == null){
                Image = path.substring(path.lastIndexOf("/")+1,path.length);
                console.log(Image);
            }
            else{
                Image += "," + $txtCovers[$i].src;
            }
            
        }
        console.log(Image);

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
         else if($txtCovers.length==0){

            $('#dialog').text("请选择图片！");

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
	        $.post(ROOT_URL + 'ajax/addFile.php' , 
	        	{Title:Title,Content:Content,Image:Image,LabelId:LabelId,UserId:UserId}).then(function(response){
	            if(response.code == 100){
	                console.log(response.data);
	                var $Id=response.data.Id;

	                location.href=ROOT_URL+'personal.php?Id='+UserId;

	            }
	        });

	    }
       
    });


});