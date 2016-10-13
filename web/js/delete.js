	function removeData(e,type,id){

		var element = e;

		switch(type){
			case "adviertisement":
				console.log("adviertisement");
				break;
			case "message":
				console.log("message");
				break;
			default:
				console.log("yes");
		}

		//发送Ajax请求删除
		

		$.ajax({
			type:"POST",
			url:url,
			data:{type:type,id:id},
            datatype: "json",
			success:function(req){
				//{"result":"succ","message":"\u64cd\u4f5c\u6210\u529f"}
				var result = $.parseJSON(req);
				if(result["result"] == "succ"){
					$(e).parent().remove();			
				}else{
					//删除失败
				}
            }
         });
	}