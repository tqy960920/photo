$(function(){

    var ROOT_URL = "http://192.168.12.109:9091/graduation/";
	   // 头部切换
    $userName=$('#userName');
	// console.log($userName.text());
	
	if($userName.text()==""){
		$('#log-reg').show();
		$('#my-name').hide();	
	}	
	else{
		
		$('#log-reg').hide();
		$('#my-name').show();
	}

    // 点赞
    $btnLike=$('#likeCount');
    $btnLike.bind('click',function(){
        // 页面更新
        var thisNum=$('#countNum').text();
        console.log(parseInt(thisNum));
        var countNum=parseInt(thisNum)+1;
        console.log(countNum);
        $('#countNum').text(countNum);
        $Id=$('#this-id');

        // 数据库更新
        $.get(ROOT_URL + 'ajax/likeAddOne.php?Id='+$Id).then(function(response){
            if(response.code == 100){               
               console.log(response);
              
            }
        });
        
    });
    ConcernId=$('#graphyUserId').text();
    NoticerId=$('#this-id').text();
    // 关注
    $('#aready2').bind('click',function(){

        $.post(ROOT_URL + 'ajax/noticeChange.php',{ConcernId:ConcernId,NoticerId:NoticerId}).then(function(response){
            if(response.code == 100){               
               console.log(response);
                $('#aready2').hide();
                $('#aready1').show();
            }
        });

    });
    // 取消关注
    $('#aready1').bind('click',function(){

        $.post(ROOT_URL + 'ajax/noticeCancel.php',{ConcernId:ConcernId,NoticerId:NoticerId}).then(function(response){
            if(response.code == 100){               
               console.log(response);
               $('#aready2').show();
               $('#aready1').hide();
            }
        });

    });

    // 显示评论
    loadComment();

    $singleComment=$('#body-comment');


    // 提交评论
    $btnSave=$('#btnSave');

    $btnSave.bind('click' , function(e){
    	// 检查数据有效性
        var GraphyId=$('#this-id').text();
        var Content = $('#text-content').val();
        var Header = $('#Header').attr("src");
        var UserId = $('#UserId').text();
        var NickName= $('#NickName').text();

        if(UserId==""){
            location.href="login.php";
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
        // 上传
        else{
            $.post(ROOT_URL + 'ajax/createComment.php' , {UserId:UserId,NickName:NickName,Content:Content,GraphyId:GraphyId,Header:Header}).then(function(response){
                if(response.code == 100){
                	console.log(response);
                    $('#dialog').text("评论成功！！");

                    var timeout=setTimeout(function(){
                        $('#dialog').show();
                    });
                    var timeout=setTimeout(function(){
                        $('#dialog').hide();
                    },3000);

                     var $newRow = createData(response.data);
                    $newRow.appendTo($singleComment);
                    $('#text-content').val("");
                }
            });
        }
    });


    /*获取评论*/
    function loadComment(){
        var $Id=$('#this-id').text();
        var key="";
        // console.log($Id);
        // console.log(1);

        $.post(ROOT_URL + 'ajax/commentList.php',{Id:$Id}).then(function(response){
            if(response.code == 100){ 

               console.log(response);
               $result=response.data;
               $length=$result.length;
               if($length>0){
                    $('#body.no').hide();  
                    for(let i=0;i<$length;i++){
                   		var $row=createData($result[i]);
    					$singleComment.append($row);
                   }
                }else{
                    $('#body.no').show();   
                }
            }
        });
    }

    function createData($data){
    	// console.log($data);
    	var $div=$('<div class="row border"></div');

    	var $div1=$('<div class="col-md-2"></div>').appendTo($div);
    	var $div12=$('<div class="comment-left"></div>').appendTo($div1);
    	var $img1=$('<img />').attr('src',$data.Header).appendTo($div12);
    	var $div13=$('<div></div>').text($data.NickName).appendTo($div12);

		var $div2=$('<div class="col-md-10"></div>').appendTo($div);
		var $div21=$('<div class="answer"></div>').text($data.Content).appendTo($div2);
		var $div22=$('<div class="answer-time"></div>').text($data.CommentTime).appendTo($div2);

   		return $div;
    }


})
