@extends('home.layout.base')

@section('content')
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="{{$banner['image_path']}}">
            <section class="met-shownews animsition">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 met-shownews-body">
                            <div class="row">
                                <div class="met-shownews-header">
                                    <h1>数据监控应用</h1>
                                    <div class="info">
                                        <span>
                                            <i class="fa fa-clock-o"></i>&nbsp;{{$reveal->gmt_create}}
                                        </span>
                                        <span>
                                            <i class="fa fa-user-plus"></i>&nbsp;{{$reveal->author}}
                                        </span>
                                        <span>
                                            <i class="icon wb-eye margin-right-5" aria-hidden="true"></i>&nbsp;{{$reveal->read}}
                                        </span>
                                    </div>
                                </div>
                                <div class="shownews-container">
                                    <div class="shownews-wrapper">
                                        @foreach($reveal->images as $key => $value)
                                            <div class="shownews-slide">
                                                <img class="shownews-lazy" data-src="{{$value[$key]}}" alt=""/>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next swiper-button-white"></div>
                                    <div class="swiper-button-prev swiper-button-white"></div>
                                </div>
                                <div class="met-editor lazyload clearfix"></div>
                                <div class="met-shownews-footer">
                                    <ul class="pager pager-round">
                                        <li class="previous ">
                                            <a disabled="true" href='/a/anlizhanshi/2018/0422/177.html'>上一篇：万能日历</a>
                                        </li>
                                        <li class="next ">
                                            <a disabled="true">下一篇：没有了</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="met-news-bar">
                                    <div class="sidenews-lists">
                                        <h3>
                                            <span>为您推荐</span>
                                        </h3>
                                        <ul>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @include('home.public.footer')     <!--引入foot文件-->
        </div>
    </div>
@endsection
