$(function(){
  $(".address-add").click(function(){   
     $(".click-box").slideDown();  
  })
  $(".add-head>a").click(function(){  
     $(".click-box").hide();  
  })
  $(".add-button>a").click(function(){
      var textname = $(".name").val();
      var namelength = $(".name").val().length;
      console.log(namelength)
       console.log(textname)
      var textphone = $(".phone").val();
      var phoneLength = $(".phone").val().length;
      var textmore = $(".city-more").val();
      var morelength = $(".city-more").val().length;
      var uPattern = /^[\u4e00-\u9fff\w]{2,25}$/;//用户名正则，2-16位由字母、数字、_或汉字组成
      var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
      if(!namelength == 0){
        if(!uPattern.test(textname)){
          alert("请填写用户信息 2-25位由字母、数字、_或汉字组成 ")
          return false;
        }else {

        }
      }else{
        alert("请填写用户信息 2-25位由字母、数字、_或汉字组成")
        return false;
      }
      if(!phoneLength == 0){
        if(!myreg.test(textphone)){
          alert("请填写用户手机号码")
          return false;
        }else {

        }
      }else{
        alert("请填写用户手机号码")
        return false;
      }
      if(!morelength == 0){
        
      }else{
        alert("请填写详细信息")
        return false;
      }
  })       
})