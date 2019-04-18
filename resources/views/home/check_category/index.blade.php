<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title>自检手册</title>
		<link href="{{asset("/assets/home/css/base.css")}}" rel="stylesheet" />
		<link href="{{asset("/assets/home/css/lm_style.css")}}" rel="stylesheet" />
		<style>
			input::-webkit-input-placeholder { /* WebKit, Blink, Edge */
				color:    #3A9CFD !important;
			}
			input::-moz-placeholder { /* Mozilla Firefox 4 to 18 */
				color:    #3A9CFD !important;
			}
			input:-moz-placeholder { /* Mozilla Firefox 19+ */
				color:    #3A9CFD !important;
			}
			input:-ms-input-placeholder { /* Internet Explorer 10-11 */
				color:    #3A9CFD !important;
			}

		</style>
	</head>

	<body>
		<!--header 开始-->
		<header>
			<div class="header">
				<p class="new-a-back"  onclick = "btnClick();"><i class="ico-left"></i></p>
				<h2>自检手册</h2>
			</div>
		</header>
		<!--header 结束-->
		<section>
			<div class="zjTitle">
				<h1>您的车出了什么问题？</h1>
				<div class="input-box">
					<form action="/home/check_content/details" method="post" style="height: 45px;">
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="fault" value="" placeholder="请输入故障代码">
						<input type="submit" value="搜索" style="width: 13%;position: relative;bottom: 45px;left: 85%;">
					</form>
				</div>
			</div>
			<ul class="serve-list">
				<li>
					<h3>问题分类</h3>
					<ul class="wenti-list">
						@foreach($list as $data)
							<li>
								<a href="{{url('home/check_category/details', ['id' => $data->id])}}">
									@if($data->id == 1)
										<i class="icon-ct"></i>
									@elseif($data->id == 5)
										<i class="icon-wg"></i>
									@elseif($data->id == 6)
										<i class="icon-sc"></i>
									@elseif($data->id == 7)
										<i class="icon-yc"></i>
									@elseif($data->id == 8)
										<i class="icon-fd"></i>
									@elseif($data->id == 9)
										<i class="icon-dk"></i>
									@elseif($data->id == 10)
										<i class="icon-dy"></i>
									@elseif($data->id == 11)
										<i class="icon-gz"></i>
									@elseif($data->id == 12)
										<i class="icon-app"></i>
									@elseif($data->id == 13)
										<i class="icon-qita"></i>
									@endif
									<span>{{$data->name}}</span>
								</a>
							</li>
						@endforeach
					</ul>
				</li>
				<li>
					<h3>常见问题</h3>
					<ul class="de-list">
						@foreach($problem as $data)
							<li>
								<a href="{{url('home/check_content/index', ['id' => $data['id']])}}">
									<span>{{$data->title}}</span>
									<i class="arrowR"></i>
								</a>
							</li>
						@endforeach
					</ul>
				</li>
			</ul>
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