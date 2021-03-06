<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>确认订单</title>
	<link rel="stylesheet" href="/Public/Home/css/oid.css">
	<link rel="stylesheet" href="/Public/Home/css/order.css">
	<link rel="stylesheet" href="/Public/Home/css/iconfont.css">
	<script src="/Public/Home/js/jquery-3.2.0.min.js"></script>
</head>
<body>
		<div class="oid-address">
			<p>收货地址</p>
		<?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="goods-address">
				<p>
					收货人：
					<span>
					   <?php echo ($vo["username"]); ?>   <?php echo ($vo["phone"]); ?>
					</span>
				</p>
				<p>
					<?php echo ($vo["province"]); ?>/<?php echo ($vo["city"]); ?>/<?php echo ($vo["area"]); ?>
				</p>
				<i class="iconfont">&#xe63b;</i>
			</div>
			<div style="height: 10px">
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	<div class="oid-things">
	    <p class="new-oid">豆瓣市集</p>
		<?php if(is_array($orderInfo)): $i = 0; $__LIST__ = $orderInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list-img clearfix ">
				<img src="<?php echo ($vo["image"]); ?>" alt="">
				<div class="img-about">
					<p><?php echo ($vo["goods_name"]); ?></p>
					<span class="oid-exp"><?php echo ($vo["goods_info"]); ?></span>
					<p>
						<span>数量<?php echo ($vo["count"]); ?></span>
						<span>￥<?php echo $p = sprintf("%0.2f",$vo['price']/100); ?> * <?php echo ($vo["count"]); ?></span>
					</p>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>

	<div class="oid-things">
	    <div class="list-oid clearfix click-coupon" >
	    	<span>优惠券</span>
	    	<span>暂无可用优惠券</span>
	    </div>
	    <div class="list-oid clearfix click-piao">
	    	<span>小计</span>
	    	<span>暂无可用优惠券</span>
	    </div>
	</div>
	<div class="oid-things">
	    <div class="list-oid clearfix" >
	    	<span>运费</span>
	    	<span>$0.00</span>
	    </div>
	    <div class="list-oid clearfix select-oid">
	        <label class="labelId" for="regular" >
			    <checkbox id="regular"/>
			</label>
	    	<span>小计</span>
	    	<span><i class="iconfont">&#xe63b;</i></span>
	    </div>
	    <div class="list-oid clearfix select-oid">
	        <input type="text" placeholder="备注（请输入 100 字以内留言 ">
	    	<p>请在下单30分钟内付款，否则将取消订单</p>
	    </div>
	</div>
	<div class="oid-things oid-ways clearfix">
	    <p>支付方式</p>
	    <?php if(is_array($pay_type)): $i = 0; $__LIST__ = $pay_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list-oid clearfix ways-list one-way">
		    	<span>
	                <img src="/Public/Home/images/weixin.png" alt="">
	                <?php echo ($vo['name']); ?>
		    	</span>
		    	<span></span>
		    </div><?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div class="coupon-box ppiao">
		<div class="coupon-title">
			优惠券
			<i class="coupon-none"></i>
		</div>
		<div class="coupon-content">
			<input type="text" placeholder="请输入优惠码">
			<button>兑换</button>
		</div>
		<div class="coupon-have">
			<a href="javascript:void(0)">不使用优惠券</a>
		    <a href="javascript:void(0)">
		    	<span>查看不可用优惠券</span>
		    </a>
		</div>
	</div>
	<div class="coupon-box clearfix labao" style="background:#f7f7f7;">
		<div class="coupon-title">
			发票信息
			<i class="piao-none"></i>
		</div>
		<div class=" ways-list piao-new clearfix one-way">
	    	<span class="biao-zhu">
                发票类型
	    	</span>
	    	<span class="one-make"> <b>电子发票</b></span>
	    </div>
	    <div class="piao-tab clearfix no-body">
	    	<span class="biao-zhu">
                发票类型
	    	</span>
	    	<div>
	    		<p class="newtab-set">
		    		<span class="tab-set"></span>
		    		个人
		    	</p>
		    	<p>
		    		<span class="tab-set"></span>
		    		单位
		    	</p>
	    	</div>
	    </div>
	    <div class="piaotab-list">
	    	<div>
	    		<div class="piao-tab clearfix ">
			    	<span class="biao-zhu">
		              
			    	</span>
			    	<p class="piaolist-text">
			    	    <input type="text" placeholder="请输入个人名字">
			    	</p>
			    </div>
			    <div class="piao-tab clearfix ">
			    	<span class="biao-zhu">
		                发票类型
			    	</span>
			    	<p>
			    		明细
			    	</p>
			    </div>
			    <div class="piao-tab clearfix ">
			    	<span class="biao-zhu">
		                收件人邮箱
			    	</span>
			    	<p class="piaolist-text">
			    	    <input type="text" placeholder="用于接受邮件号邮箱">
			    	</p>
			    </div>
	    	</div>
	    	<div class="hide">
	    		<div class="piao-tab clearfix ">
			    	<span class="biao-zhu">
		              
			    	</span>
			    	<p class="piaolist-text">
			    	    <input type="text" placeholder="请输入单位名称">
			    	</p>
			    </div>
			    <div class="piao-tab clearfix ">
			    	<span class="biao-zhu">
		                纳税人识别号
			    	</span>
			    	<p class="piaolist-text">
			    	    <input type="text" >
			    	</p>
			    </div>
			    <div class="piao-tab clearfix ">
			    	<span class="biao-zhu">
		                发票类型
			    	</span>
			    	<p>
			    		明细
			    	</p>
			    </div>
			    <div class="piao-tab clearfix ">
			    	<span class="biao-zhu">
		                收件人邮箱
			    	</span>
			    	<p class="piaolist-text">
			    	    <input type="text" placeholder="用于接受邮件号邮箱">
			    	</p>
			    </div>
	    	</div>
	    </div>
	</div>
	<div class="box-foot">
		<div class="cars-footer">
			<div class="all-select" style="font-size:0.14rem">
				应付 : 
			    <span class="select-show">
				    <b>￥<?php echo ($orderInfo['price']); ?></b>
			    </span>
			</div>
			<a href="javascript:void(0)" class="car-newtrue"> 提交订单</a>
		</div>
	</div>
	<script src="/Public/Home/js/oid.js">
		
	</script><script type="text/javascript">
		$(function(){
			$('.car-newtrue').click(function(){
				var aid = 2;
				var oid = <?php echo ($_GET['oid']); ?>;
				var pid = 1;
				console.log(oid);
				$.ajax({
					url : "<?php echo U('home/order/createorder');?>",
					type : "post",
					dataType : "json",
					data : {aid:aid, oid:oid, pid:pid},
					success : function(res) {
						console.log(res);
					}
				});
			});
		})
		
	</script>
</body>
</html>