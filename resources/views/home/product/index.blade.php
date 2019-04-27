@extends('home.layout.base')

@section('content')
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="{{$banner->image_path}}">
            <div class="met-product animsition type-0">
                <div class="container">
                    <div class="row">
                        <ul class="blocks-2 blocks-sm-2 blocks-md-3 blocks-xlg-4  met-page-ajax met-grid" id="met-grid" data-scale='0.7182320441989'>
                            @foreach($list as $key => $value)
                                <li class=" product-li shown">
                                    <a href="{!! url('/home/product/detail', array($value->id)) !!}" title="{{$value->name}}" target='_self'>
                                        <font>
                                            <img class="swiper-lazy" alt="{{$value->name}}" data-src='{{$value->image_path}}'>
                                        </font>
                                        <span>
                                            <b><b>{{$value->name}}</b></b>
                                        </span>
                                    </a>
                                    <p class="met-img-showbtn" data-imglist="{{$value->name}}">+</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class='met_pager' style="margin-top:35px;">
                    <span class="pageinfo">共 <strong>1</strong>页<strong>8</strong>条记录</span>

                </div>
            @include('home.public.footer')     <!--引入foot文件-->
            </div>
        </div>
        <div class="side-scroll swiper-scrollbar"></div>
    </div>
@endsection
