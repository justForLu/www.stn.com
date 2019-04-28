@extends('home.layout.base')

@section('content')
	<div class="side-html">
		<div class="side-body swiper-lazy" data-background="{{$banner->image_path}}">
			<section class="met-news animsition type-0">
				<div class="container">
					<div class="row">
						<div class="col-md-8 met-news-body">
							<div class="row">
								<div class="met-news-list">
									<ul class="met-page-ajax" data-scale=''>
										@foreach($list as $key => $value)
											<li class="news-li">
												<div class="news-img">
													<a href="{!! url('home/news/detail', array($value->id)) !!}" title="{{$value->title}}">
														<img class="swiper-lazy" data-src='{{$value->image_path}}'>
													</a>
												</div>
												<div class="news-text">
													<h3>
														<a href="{!! url('home/news/detail', array($value->id)) !!}" title="{{$value->title}}">{{$value->title}}</a>
													</h3>
													<ul>
														<li><i class="fa fa-clock-o"></i>&nbsp;{{$value->gmt_create}}</li>
														<li><i class="fa fa-user-plus"></i><b>&nbsp;{{$value->author}}</b></li>
														<li><i class="fa fa-eye"></i><b>&nbsp;{{$value->read}}</b></li>
													</ul>
													<p>{{$value->introduce}}</p>
													<a class="click-box" href="{!! url('home/news/detail', array($value->id)) !!}">
														<span>READ MORE</span>
													</a>
												</div>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						<div class="visible-xs-block">
							<div class='met_pager'>
								<a>首页</a>
								<a class="Ahover">1</a>
								<a href='list_16_2.html'>2</a>
								<a href='list_16_2.html'>下一页</a>
								<a href='list_16_2.html'>末页</a>

							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="met-news-bar">
									<div class="sidenews-lists">
										<h3><span>为您推荐</span></h3>
										<ul>
											@foreach($recommend_news as $value)
												<li>
													<a href="{!! url('/home/news/detail', array($value->id)) !!}" title="{{$value->title}}">
														<img class="swiper-lazy" data-src="{{$value->image_path}}">
														<b>{{$value->title}}</b>
														<p>{{$value->gmt_create}}</p>
													</a>
												</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="hidden-xs">
					<div class='met_pager'>
						<a>首页</a>
						<a class="Ahover">1</a>
						<a href='list_16_2.html'>2</a>
						<a href='list_16_2.html'>下一页</a>
						<a href='list_16_2.html'>末页</a>

					</div>
				</div>
			</section>
		@include('home.public.footer')     <!--引入foot文件-->
		</div>
	</div>
@endsection
