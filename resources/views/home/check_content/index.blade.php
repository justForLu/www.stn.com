<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title>{{$check_content->title}}</title>
		<link href="{{asset("/assets/home/css/base.css")}}" rel="stylesheet" />
		<link href="{{asset("/assets/home/css/lm_style.css")}}" rel="stylesheet" />
	</head>

	<body>
		<!--header 开始-->
		<header>
			<div class="header">
				<a class="new-a-back" href="javascript:history.back();"><i class="ico-left"></i></a>
				<h2>{{$check_content->title}}</h2>
			</div>
		</header>
		<!--header 结束-->
		<section>
			<ul class="zj-list">
				<li>
					<h3>问题症状</h3>
					<div class="text">
						<p>{{$check_content->symptom}}</p>
					</div>
				</li>
				<li>
					<h3>问题详情</h3>
					<div class="text">
						<p>{{$check_content->details}}</p>
					</div>
				</li>
				<li>
					<h3>解决方案</h3>
					<div class="text">
						<p>{{$check_content->solve}}</p>
					</div>
				</li>
				<li>
					<h3>安全提示</h3>
					<div class="text">
						<p>{{$check_content->prompt}}</p>
					</div>
				</li>
			</ul>
		</section>
		{{--<footer class="zj-btn">--}}
			{{--<a href="javascript:history.back();" class="btn-main">已解决</a>--}}
			{{--<span></span>--}}
			{{--<a href="" onclick = "btnClick();">未解决，立即报修</a>--}}
		{{--</footer>--}}
		<script type="text/javascript" src="{{asset("/assets/home/js/jquery.js")}}"></script>
		<script type="text/javascript">
			function btnClick()
			{
				if (/android/i.test(navigator.userAgent)){
					JSBridge.invoke('toRepair');
				} else if (/ipad|iphone|iPod|iOS|mac/i.test(navigator.userAgent)){
					repair_iOS("toRepair");
				}
			}

		</script>
	</body>
</html>