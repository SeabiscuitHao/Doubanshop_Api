$(document).ready(function(){
	$(".box-order>a").click(function(){
		var index = $(this).index();
		$(this).addClass("order-bg").siblings().removeClass("order-bg");
		$(".box-tab>div").eq(index).show().siblings().hide();
		var content = $(".box-tab>div").eq(index).children("").html();
		arr =  $(".box-tab>div").eq(index).children(".list-content");
		console.log(content)
		console.log(content.length)
		if(content == null || content.length == 0){
			$(".list-about").show();
		}else{
			$(".list-about").hide();
		}
		return {arr: arr }
		console.log(arr)
	})
	$(".make-true").click(function(){
		$(".make-hide").hide();
		$(arr).empty();
	})
	var content = $(".haha").html();
	console.log(content)
	console.log(content.length)
	if(content == null || content.length == 0){
		$(".list-about").show();
	}else{
		$(".list-about").hide();
	}
	$(".delete-click").click(function(){
		$(".make-hide").slideDown();
	})
	$(".make-no").click(function(){
		$(".make-hide").hide();
	})

})