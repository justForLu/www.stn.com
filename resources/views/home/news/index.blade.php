<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<title>新闻资讯</title>
	<link href="{{asset("/assets/home/css/base.css")}}" rel="stylesheet" />
	<link href="{{asset("/assets/home/css/lm_style.css")}}" rel="stylesheet" />
</head>
<body>
<section>
	<!--header 开始-->
	<header>
		<div class="header" style="position: fixed;width: 100%;background-color: #fff;">
			<h2>新闻资讯</h2>
		</div>
		<div style="height: 44px;"></div>
	</header>
	<!--header 结束-->
	<ul class="consult-list">
		@foreach($list as $news)
			<li> <a href="{{url('home/news/details', ['id' => $news['id']])}}" class="item">
				<div class="img-box"> <img src="{{$news->image_path}}"> </div>
				<div class="text-box">
					<h3>
						@if($news->is_top == 1)
							<span class="top-icon">置顶</span>
						@endif
							{{$news->title}}
					</h3>
					<p class="twoLine">{{$news->introduce}}</p>
					<p class="time">{{$news->gmt_create}}</p>
				</div>
				</a>
			</li>
		@endforeach
	</ul>
</section>
<script type="text/javascript" src="{{asset("/assets/home/js/jquery-2.1.0.js")}}"></script>
<script>
    $(function () {
        var all = "{{$list->LastPage()}}";  //后台返回总页面
        var pageNum = 1;//定义初始页面
        var pageSize = 5;  // 每页显示的个数
        var close = true;  // 因为ajax是异步请求，所以设置一个boolean类型，将ajax控制为同步请求
        $(window).scroll(function() {
            var scrollTop = $(this).scrollTop();      //计算已经卷进去滚动条的的高度
            var scrollHeight = $(document).height();  //当前页面的总高度
            var windowHeight = $(this).height();      //当前window也就是浏览器的高度
            if(parseInt(scrollTop) + parseInt(windowHeight) == parseInt(scrollHeight)) {
                // 如果class为true 并且当前页数小于或等于总页数
                if (close && pageNum <= all) {
                    pageNum += 1;
                    //将close改为false，无法在请求后台
                    close = false;
                    $.post("{{url('home/news/index')}}", {page:pageNum,_token:'{{ csrf_token() }}'},
                        function (res) {
                            // 根据id或class 将返回的页面拼接到页面
							var html = '';
							console.log(res);
							$.each(res, function(i, item){
							    html += "<li>";
							    html += "<a href='"+"{{url('home/news/details', ['id' => $news['id']])}}"+"' class='item'>";
							    html += "<div class='img-box'>";
							    html += "<img src='{{$news->image_path}}'>";
							    html += "</div>";
							    html += "<div class='text-box'>";
							    html += "<h3>";
							    if(item.is_top){
							        html += "<span class='top-icon'>置顶</span>";
                                }else{
							        html += "{{$news->title}}";
                                }
                                html += "</h3>";
								html += "<p class='twoLine'>";
								html += "{{$news->introduce}}";
								html += "</p>";
								html += "<p class='time'>";
								html += "{{$news->gmt_create}}";
								html += "</p>";
								html += "</div>";
								html += "</a>";
								html += "</li>";
							});
                            $('.consult-list').append(html);
                            // 请求成功后将close改回true
                            close = true;
                    });
                } else {
                    return false;
                }
            }
        });
    });
</script>
</body>
</html>