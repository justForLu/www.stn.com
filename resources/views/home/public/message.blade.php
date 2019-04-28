@extends('home.layout.base')

@section('content')
	<style type="text/css">
		.message{
			text-align: center;
			font-size: 24px;
		}
	</style>
	<div class="side-html">
		<div class="side-body swiper-lazy" data-background="">
			<section class="met-news animsition type-0">
				<div class="container">
					<div class="row">
						<div class="message">
							提示
						</div>
					</div>
				</div>
			</section>
		@include('home.public.footer')     <!--引入foot文件-->
		</div>
	</div>
@endsection



