@extends('home.layout.base')

@section('content')
    <div class="side-html" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
        <div class="side-body swiper-lazy swiper-lazy-loaded swiper-slide-active" data-background="{{$banner->image_path}}">
            <div class="page met-showproduct pagetype1 animsition">
                <div class="met-showproduct-head">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="shownews-container  swiper-container-horizontal">
                                        <div class="shownews-wrapper">
                                            @foreach($product->pictures as $key => $value)
                                                <div class="shownews-slide swiper-slide-visible swiper-slide-active" style="width: 655px;">
                                                    <img class="shownews-lazy swiper-lazy-loaded" alt="" src="{{$value}}" style="opacity: 1;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-button-next swiper-button-white swiper-button-disabled"></div>
                                        <div class="swiper-button-prev swiper-button-white swiper-button-disabled"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 product-intro">
                                <div class="row">
                                    <div class="product-text">
                                        <h1>{{$product->name}}</h1>
                                        <span class="t">
                                            <i class="fa fa-clock-o"></i>&nbsp;{{$product->gmt_create}}
                                            <i class="icon fa-eye" aria-hidden="true"></i>&nbsp;{{$product->read}}
                                        </span>
                                        <p class="description">{{$product->synopsis}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="met-showproduct-body">
                    <div class="container">
                        <div class="row no-space">
                            <div class="col-md-9 product-content-body">
                                <div class="row">
                                    <div class="panel product-detail">
                                        <div class="panel-body">
                                            <ul class="nav nav-tabs nav-tabs-line met-showproduct-navtabs affix-nav">
                                                <li class="active">
                                                    <a data-toggle="tab" data-get="product-details">详细信息</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane met-editor lazyload clearfix animation-fade active" id="product-details">
                                                    <div class="editorlightgallery">
                                                        <div>
                                                            <?php echo $product->content ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="panel product-hot">
                                        <div class="panel-body">
                                            <h4 class="example-title">热门推荐</h4>
                                            <ul class="blocks-2 blocks-sm-3 mob-masonry" data-scale="1">
                                                @foreach($product_list as $key => $value)
                                                    <li>
                                                        <a href="{!! url('/home/product/detail', array($value->id)) !!}" class="img" title="{{$value->name}}">
                                                            <img class="swiper-lazy swiper-lazy-loaded" alt="{{$value->name}}" src="{{$value->image_path}}" style="opacity: 1;">
                                                        </a>
                                                        <a href="{!! url('/home/product/detail', array($value->id)) !!}" class="txt" title="{{$value->name}}">{{$value->name}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @include('home.public.footer')     <!--引入foot文件-->
        </div>
    </div>
@endsection
