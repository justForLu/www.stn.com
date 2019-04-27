@extends('home.layout.base')

@section('content')
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="{{$banner['image_path']}}">
            <div class="met-img animsition imgs0">
                <div class="container">
                    <div class="row">
                        <ul class="blocks-2 blocks-sm-3 blocks-md-4 blocks-xlg-4  met-page-ajax" data-scale='0.72222222222222'>
                            @foreach($list as $value)
                            <li class="img-li">
                                <span>
                                    <a href="{!! url('/home/reveal/detail', array($value->id)) !!}" title="{{$value->name}}">
                                        <img class="swiper-lazy" data-src='{{$value->cover_path}}' alt="{{$value->name}}">
                                        <font>{{$value->name}}</font>
                                    </a>
                                    <p class="fa fa-search met-img-showbtn" data-imglist="{{$value->name}}"></p>
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class='met_pager' style="margin-top:35px;"><span
                            class="pageinfo">共 <strong>1</strong>页<strong>12</strong>条记录</span>

                </div>
            </div>
        @include('home.public.footer')     <!--引入foot文件-->
        </div>
    </div>
@endsection
