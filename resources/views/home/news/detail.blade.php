@extends('home.layout.base')

@section('content')
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="{{$banner['image_path']}}">
            <section class="met-shownews animsition">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 met-shownews-body">
                            <div class="row">
                                <div class="met-shownews-header">
                                    <h1>{{$news->title}}</h1>
                                    <div class="info">
                                        <span>
                                            <i class="fa fa-clock-o"></i>&nbsp;{{$news->gmt_create}}
                                        </span>
                                        <span>
                                            <i class="fa fa-user-plus"></i>&nbsp;{{$news->author}}
                                        </span>
                                        <span>
                                            <i class="icon fa-eye margin-right-5" aria-hidden="true"></i>&nbsp;{{$news->read}}
                                        </span>
                                    </div>
                                </div>
                                <div class="met-editor lazyload clearfix">
                                    <div>
                                        <?php echo $news->content ?>
                                    </div>
                                </div>
                                <div class="met-shownews-footer">
                                    <ul class="pager pager-round">
                                        <li class="previous ">
                                            <a disabled="true" href='/a/xinwenzixun/gongsixinwen/2018/0422/159.html'>上一篇：如何成为一个优秀的工程师？</a>
                                        </li>
                                        <li class="next ">
                                            <a disabled="true" href='/a/xinwenzixun/gongsixinwen/2018/0422/161.html'>下一篇：ECMAScript 8都发布了，你还没有用上ECMAScript 6？</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="met-news-bar">
                                    <div class="sidenews-lists">
                                        <h3><span>为您推荐</span></h3>
                                        <ul class="blocks-2 blocks-sm-3 mob-masonry" data-scale="1">
                                            @foreach($news_list as $key => $value)
                                                <li>
                                                    <a href="{!! url('/home/news/detail', array($value->id)) !!}" class="img" title="{{$value->title}}">
                                                        <img class="swiper-lazy swiper-lazy-loaded" alt="{{$value->title}}" src="{{$value->image_path}}" style="opacity: 1;">
                                                    </a>
                                                    <a href="{!! url('/home/news/detail', array($value->id)) !!}" class="txt" title="{{$value->title}}">{{$value->title}}</a>
                                                </li>
                                            @endforeach
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
