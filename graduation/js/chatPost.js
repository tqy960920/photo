$(function(){


	var ROOT_URL = "http://192.168.12.109:9091/graduation/";

    loadAnswer();

    var $single=$('#chatP-bom');


    // 提交评论
    $btnSave=$('#btnAnswer');

    $btnSave.bind('click' , function(e){
    	var Id=$('#chat-id').text();
    	// 检查数据有效性
        var Content = $('#chat-content').val();
        // 发帖人
        var CharterId = $('#CharterId').val();
        // 跟帖人
        var FollowId = $('#FollowId').text();
        var NickName= $('#NickName').text();
        var Header = $('#Header').attr("src");

        if(FollowId==""){
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
            $.post(ROOT_URL + 'ajax/createChat.php' , {Content:Content,Id:Id,FollowId:FollowId,CharterId:CharterId,NickName:NickName,Header:Header}).then(function(response){
                if(response.code == 100){
                	console.log(response);
                    $('#dialog').text("评论成功！！");

                    var timeout=setTimeout(function(){
                        $('#dialog').show();
                    });
                    var timeout=setTimeout(function(){
                        $('#dialog').hide();
                    },3000);

                    var $newRow = createAnswer(response.data);
                    $newRow.appendTo($single);
                    $('#chat-content').val("");
                }
            });
        }
    });


    /*获取评论*/
    function loadAnswer(){
    	var $Id=$('#chat-id').text();
        console.log($Id);

        $.get(ROOT_URL + 'ajax/chatList.php?Id='+$Id).then(function(response){
            if(response.code == 100){           	
               console.log(response);
               $result=response.data[1];
               for(let i=0;i<$result.length;i++){
               		var $row=createAnswer($result[i],i+2);
					$single.append($row);
               }
            }
        });
    }

    function createAnswer($data,i){
    	console.log($data);
    	var $div=$('<div class="row chatP-item"></div');

    	var $div1=$('<div class="col-xs-12 col-sm-2 col-md-2"></div>').appendTo($div);
    	var $div12=$('<div class="chatP-left"></div>').appendTo($div1);
    	var $img1=$('<img />').attr('src',$data.Header).appendTo($div12);

    	var $div2=$('<div class="col-xs-12 col-sm-8 col-md-8"></div>').appendTo($div);
    	var $div21=$('<div class="chatP-mid"></div>').appendTo($div2);
    	var $div22=$('<div class="chatP-mid-top"></div>').appendTo($div21);
    	var $p=$('<p></p>').text($data.NickName).appendTo($div22);
    	var $p=$('<p></p>').text('回复了新帖').appendTo($div22);
		var $p=$('<p></p>').text($data.FollowTime).appendTo($div22);
		var $div23=$('<div class="chatP-mid-con"></p>').text($data.Content).appendTo($div21);

		var $div3=$('<div class="col-xs-12 col-sm-2 col-md-2"></div>').appendTo($div);
		var $div31=$('<div class="chatP-right"></div>').appendTo($div3);
		var $div32=$('<div></div>').appendTo($div31);
		var $p=$('<p></p>').text(i).appendTo($div32);
    	var $p=$('<p></p>').text('楼#').appendTo($div32);
		

   		return $div;
    }


})
