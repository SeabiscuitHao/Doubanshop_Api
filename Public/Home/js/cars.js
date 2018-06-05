$(document).ready(function(){

	//加的效果
	$(".add").click(function(){
		var n=$(this).siblings(".text_box").val();
		console.log(n);
		var num=parseInt(n)+1;
		if(num==0){ return;}
		$(this).siblings(".text_box").val(num);
	});
	//减的效果
	$(".min").click(function(){
		var n=$(this).siblings(".text_box").val();
		var num=parseInt(n)-1;
		if(num==0){ return}
		$(this).siblings(".text_box").val(num);
	});
	$(".cars-list>label").click(function() {
		//只使用单个
        var val= $(this).attr("class");
        if(val == 'labelId'){
            $(this).addClass("label-select").removeClass("labelId");
			var prices = $(this).parent().siblings().children("").children("span").text();
			console.log(prices)
			//改：结算只适用一个
			// $(".select-show").children("b").text(prices)
			$(".select-show").addClass("new-select");
			$(".car-true").addClass("car-newtrue");
            return false;
        }{
        	$(this).addClass("labelId").removeClass("label-select")
            $(".all-select>label").addClass("labelId").removeClass("label-select");
            //改：结算只适用一个
            // $(".select-show").children("b").text("￥0.00");
            $(".car-true").removeClass("car-newtrue");
        	return false;
        }
	})
	$(".all-select>label").click(function(){
		var val= $(".cars-list>label").attr("class");
        var valthis = $(".all-select>label").attr("class");
         console.log(valthis)
        if(valthis == 'labelId'){
            $(".all-select>label").addClass("label-select").removeClass("labelId");
            $(".cars-list>label").addClass("label-select").removeClass("labelId");
            return false;
        }{
        	$(".all-select>label").addClass("labelId").removeClass("label-select")
        	$(".cars-list>label").addClass("labelId").removeClass("label-select")
        	return false;
        }
	})
	$(".deleta").click(function(){
		console.log(111)
		$(this).parents(".cars-buy").addClass("haha");
		$(this).parents(".cars-buy").empty();
	})
})