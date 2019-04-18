<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title>{{$check_category->name}}</title>
		<link href="{{asset("/assets/home/css/base.css")}}" rel="stylesheet" />
		<link href="{{asset("/assets/home/css/lm_style.css")}}" rel="stylesheet" />
		<style type="text/css">
			.scTitle i{
				line-height:40px;
				width:40px;
				height:40px;
				vertical-align:top;
				display:inline-block;
				background-repeat:no-repeat;
				background-size:contain;
			}
		</style>
	</head>

	<body>
		<!--header 开始-->
		<header>
			<div class="header">
				<a class="new-a-back" href="javascript:history.back();"><i class="ico-left"></i></a>
				<h2>{{$check_category->name}}</h2>
			</div>
		</header>
		<!--header 结束-->
		<section>
			<div class="scTitle">
				@if($check_category->id == 1)
					<i class="icon-ct"></i>
				@elseif($check_category->id == 5)
					<i class="icon-wg"></i>
				@elseif($check_category->id == 6)
					<i class="icon-sc"></i>
				@elseif($check_category->id == 7)
					<i class="icon-yc"></i>
				@elseif($check_category->id == 8)
					<i class="icon-fd"></i>
				@elseif($check_category->id == 9)
					<i class="icon-dk"></i>
				@elseif($check_category->id == 10)
					<i class="icon-dy"></i>
				@elseif($check_category->id == 11)
					<i class="icon-gz"></i>
				@elseif($check_category->id == 12)
					<i class="icon-app"></i>
				@elseif($check_category->id == 13)
					<i class="icon-qita"></i>
				@endif
				{{$check_category->name}}
			</div>
			<ul class="question-list">
				@foreach($children_category as $key => $category)
					@if($key == 0)
						<li class="open">
							<span>{{$category->name}}</span>
							<i class="arrowR"></i>
							<ul class="de-list">
								@foreach($category->problem as $data)
									<li>
										<a href="{{url('home/check_content/index', ['id' => $data['id']])}}">
											<span>{{$data->title}}</span>
											<i class="arrowR"></i>
										</a>
									</li>
								@endforeach
							</ul>
						</li>
					@else
						<li>
							<span>{{$category->name}}</span>
							<i class="arrowR"></i>
							<ul class="de-list">
								@foreach($category->problem as $data)
									<li>
										<a href="{{url('home/check_content/index', ['id' => $data['id']])}}">
											<span>{{$data->title}}</span>
											<i class="arrowR"></i>
										</a>
									</li>
								@endforeach
							</ul>
						</li>
					@endif

				@endforeach
			</ul>
		</section>
		<script type="text/javascript" src="{{asset("/assets/home/js/jquery.js")}}"></script>
		<script>
			$(document).ready(function(){
				$(".question-list>li>span").on("click",function(){
					var $this=$(this);
					var xiabiao = $(this).parents("li").index();
					var height = $(this).parents("li").offset().top - $(window).scrollTop();
                    sessionStorage.setItem("xiabiao", xiabiao);
                    sessionStorage.setItem("height", height);
					var boo=$this.parents("li").hasClass("open");
					if(boo){
						$this.parents("li").removeClass("open");
					}else{
						$(".question-list>li").removeClass("open");
						$this.parents("li").addClass("open");
					}
				});
				$('.new-a-back').click(function(){
                    sessionStorage.clear('xiabiao');
                    sessionStorage.clear('height');
				});
                // localStorage.setItem("site", "");
                // var site = localStorage.getItem("site");
                // alert(site);
			});
            window.onload = function(){
                var xiabiao = sessionStorage.getItem("xiabiao");
                var height = sessionStorage.getItem("height");
                if(xiabiao != null){
                    $(".question-list>li").eq(0).attr('class','');
                    $(".question-list>li").eq(xiabiao).attr('class','open');
                    $(".question-list>li").eq(xiabiao).scrollTop(height+'px');
				}
            };
		</script>
	</body>

</html>