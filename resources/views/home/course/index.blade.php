<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title>新手教程</title>
		<link href="{{asset("/assets/home/css/base.css")}}" rel="stylesheet" />
		<link href="{{asset("/assets/home/css/lm_style.css")}}" rel="stylesheet" />
	</head>
	<body>
		<!--header 开始-->
		<header>
			<div class="header">
				<a class="new-a-back" href="javascript:history.back();" onclick = "btnClick();"><i class="ico-left"></i></a>
				<h2>新手教程</h2>
			</div>
		</header>
		<!--header 结束-->
		<section>
			<ul class="consult-list">
				@foreach($list as $course)
					<li>
						<a href="{{url('home/course/details', ['id' => $course['id']])}}" class="item">
							<div class="img-box"> <img src="{{$course->image_path}}"> </div>
							<div class="text-box">
								<h3>
									@if($course->is_top == 1)
										<span class="top-icon">置顶</span>
									@endif
									{{$course->title}}
								</h3>
								<p class="twoLine">{{$course->introduce}}</p>
								<p class="time">{{$course->gmt_create}}</p>
							</div>
						</a>
					</li>
				@endforeach
			</ul>
			@include('home.public.pages')
       </section>
	<script type="text/javascript" src="{{asset("/assets/home/js/jquery.js")}}"></script>
	<script type="text/javascript">
		function btnClick()
		{
			if (/android/i.test(navigator.userAgent)){
				JSBridge.invoke('toReturn');
			} else if (/ipad|iphone|iPod|iOS|mac/i.test(navigator.userAgent)){
				return_iOS("toReturn");
			}
		}

	</script>
	</body>
</html>