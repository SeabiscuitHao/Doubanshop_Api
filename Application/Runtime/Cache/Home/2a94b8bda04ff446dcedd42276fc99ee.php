<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/Public/Home/css/douban.css">
	<link rel="stylesheet" href="/Public/Home/css/iconfont.css">
	<link rel="stylesheet" href="/Public/Home/css/swiper.min.css">
	<script src="/Public/Home/js/swiper.min.js"></script>
	 <script src="/Public/Home/js/jquery-3.2.0.min.js"></script>
	<title>首页</title>
</head>
<body>
	<div class="box-swiper" id="box-swiper">
		<div class="swiper-container">
			<div class="swiper-wrapper clearfix">
				<?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['status'] == 1): ?><a href="javascript:void(0)" class="swiper-slide">
							<img src="<?php echo ($vo["image"]); ?>">
						</a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>

	<div class="box-user clearfix">
		<a href="<?php echo U('Home/Cart/cart');?>"><i class="iconfont">&#xe61a;</i>购物车</a>
		<a href="<?php echo U('Home/User/people');?>"><i class="iconfont">&#xe60c;</i>我的中心</a>
	</div>
	<div class="box-list">
		<div class="list-header">
			新品首发
		</div>
		<div class="list-cntent clearfix">

			<?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['status'] == 1): ?><div>
						<a href="<?php echo U('Home/Index/info',array('id'=>$vo['id']));?>">
							<div class="content-img">
								<img src="http://dbshop.com/<?php echo ($vo["image"]); ?>" alt="">
							</div>
							<div class="content-text">
								<h3><?php echo ($vo["goods_name"]); ?></h3>
								<p><?php echo ($vo["goods_info"]); ?></p>
								<b>
								<?php $vo['price'] /= 100; echo sprintf("%0.2f",$vo['price']); ?>
								</b>
									<?php $tag = array(); $tag = explode(',',$vo['tag_id']); foreach($tag as $v) { echo "<span>$v</span> "; } ?>
							</div>
						</a>
					</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>

		</div>
	</div>
	<div class="box-list">
		<div class="list-header">
			诗集小组
		</div>
		<div class="box-mess clearfix">
			<a href="javascript:void(0)" class="clearfix">
				<div class="mess-i">
				    <i class="iconfont">&#xe63d;</i>
                    <span>11</span>
				</div>
				<div class="mess-text">
					hahahaha hahaaaa ahhhhhhhhhh哈哈哈哈啊哈哈哈哈哈哈哈哈或或或或或或或或或或还是瘦我想看充电宝西安事变卡车下不行啊看出那是开车
				</div>
				<div class="mess-img" style="background-image:url(./images/p114912775.jpg);">
				</div>
			</a>
			<div class="mess-ad clearfix">
				<a href="javascript:void(0)">
					<div class="ad-name">
						<img src="/Public/Home/images/u119347429-13.jpg" alt="">
						豆瓣诗集
					</div>
					<div class="ad-time">20:22</div>
				</a>
			</div>
		</div>
		<div class="box-mess clearfix">
			<a href="javascript:void(0)" class="clearfix">
				<div class="mess-i">
				    <i class="iconfont">&#xe63d;</i>
                    <span>11</span>
				</div>
				<div class="mess-text">
					hahahaha hahaaaa ahhhh
				</div>
				<div class="mess-img" style="background-image:url(./images/p114912775.jpg);">
				</div>
			</a>
			<div class="mess-ad clearfix">
				<a href="javascript:void(0)">
					<div class="ad-name">
						<img src="/Public/Home/images/u119347429-13.jpg" alt="">
						豆瓣诗集
					</div>
					<div class="ad-time">20:22</div>
				</a>
			</div>
		</div>
		<div class="a-see">
			<a href="javascript:void(0)" >查看更多评论 ></a>
	    </div>
		</div>
    <div class="box-list">
		<div class="list-header">
			热门活动
		</div>
		<div class="list-ctent clearfix" style="border-top:0;">
		    <a href="javascript:void(0)">
		        <img src="/Public/Home/images/file-1524481845-0.jpg" alt="">
		    	<h3>#男生包里面有什么哈哈哈哈#</h3>
		        <p>akjxnsck ashb cjsabc asbcxajbx 啊啊哈是你测试也不错的本手册</p>
		    </a>
		</div>
		<div class="list-ctent clearfix">
		    <a href="javascript:void(0)">
		        <img src="/Public/Home/images/file-1524481845-0.jpg" alt="">
		    	<h3>#男生包里面有什么哈哈哈哈#</h3>
		        <p>akjxnsck ashb cjsabc asbcxajbx 啊啊哈是你测试也不错的本手册</p>
		    </a>
		</div>
		<div class="list-ctent clearfix">
		    <a href="javascript:void(0)">
		        <img src="/Public/Home/images/file-1524481845-0.jpg" alt="">
		    	<h3>#男生包里面有什么哈哈哈哈#</h3>
		        <p>akjxnsck ashb cjsabc asbcxajbx 啊啊哈是你测试也不错的本手册</p>
		    </a>
		</div>
		<div class="list-ctent clearfix">
		    <a href="javascript:void(0)">
		        <img src="/Public/Home/images/file-1524481845-0.jpg" alt="">
		    	<h3>#男生包里面有什么哈哈哈哈#</h3>
		        <p>akjxnsck ashb cjsabc asbcxajbx 啊啊哈是你测试也不错的本手册</p>
		    </a>
		</div>
	</div>
	<div class="box-footer box-list box-user">
		<a href="javascript:void(0)">
			<i class="iconfont">&#xe631;</i>购物说明
		</a>
		<a href="javascript:void(0)">
			<i class="iconfont">&#xe649;</i>意见反馈
		</a>
		<a href="javascript:void(0)">
			<i class="iconfont">&#xe8b2;</i>商务合作
		</a>
	</div>
    <script src="/Public/Home/js/douban.js"></script>
</body>
</html>