var index = new Vue({
	el:'#login',
	data:{
       isshow: false,
       makechang: "password",
       valuemore: '',
       makepassword: '',
       ismake: false,
       showtext: '',
       valuename:'',
       valueregin: '',
	},
	mounted:function(){
       this.getData();
	},
	methods:{
       getData:function(){

       },
       change:function(){
       	    this.isshow = !this.isshow;
       	    if(this.isshow == true){
       	  	   this.makechang = 'text'
       	    }else{
       	     	this.makechang = 'password'
       	    }
       },
       setregin:function(){
            var myreg=/^[1][3,4,5,7,8][0-9]{9}$/; //手机号
       	    var email = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var uPattern = /^[a-zA-Z0-9_-]{4,16}$/;//用户名4到16位（字母，数字，下划线，减号）
            var passWord=/^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;//4到16位（字母，数字，下划线，减号）
         	var that = this;
            if(that.valueregin == ''){
            	that.ismake = true;
            	that.showtext = "账号不能为空"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(that.makepassword == ''){
            	that.ismake = true;
            	that.showtext = "密码不能为空"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(that.valuename == ''){
            	that.ismake = true;
            	that.showtext = "昵称不能为空"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(myreg.test(that.valueregin)){
            	
            }else if(email.test(that.valueregin)) {

            }else{
            	that.ismake = true;
            	that.showtext = "个性化账号格式错误"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(!passWord.test(that.makepassword)){
            	that.ismake = true;
            	that.showtext = "密码格式错误"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(!uPattern.test(that.valuename)){
            	that.ismake = true;
            	that.showtext = "昵称格式错误"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            alert("满足所有条件！")
       },
       setlogin:function(){
       	    var myreg=/^[1][3,4,5,7,8][0-9]{9}$/; //手机号
       	    var email = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            var uPattern = /^[a-zA-Z0-9_-]{4,16}$/;//用户名4到16位（字母，数字，下划线，减号）
            var passWord=/^[A-Za-z]+[0-9]+[A-Za-z0-9]*|[0-9]+[A-Za-z]+[A-Za-z0-9]*$/g;//4到16位（字母，数字，下划线，减号）
         	console.log(this.valuemore)
         	var that = this;
            if(that.valuemore == ''){
            	that.ismake = true;
            	that.showtext = "账号不能为空"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(that.makepassword == ''){
            	that.ismake = true;
            	that.showtext = "密码不能为空"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(myreg.test(that.valuemore)){
            	
            }else if(uPattern.test(that.valuemore)) {

            }else if(email.test(that.valuemore)) {

            }else{
            	that.ismake = true;
            	that.showtext = "个性化账号格式错误"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            if(!passWord.test(that.makepassword)){
            	that.ismake = true;
            	that.showtext = "密码格式错误"
            	setTimeout(function(){
            		that.ismake = false;
            	},3000)
            	return false;
            }
            alert("满足所有条件！")
            
       }
	}
})