<!DOCTYPE HTML>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta charset="utf-8"/>
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="generator" content="dedecms.com" data-variable="/,cn,10001,,10001,M1156010"/>
    <meta name="format-detection" content="email=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>拾叁网络官网</title>
    <meta name="description" content="拾叁网络官网"/>
    <meta name="keywords" content="拾叁网络官网"/>
    <meta name="author" content="order by dedecms.com"/>
    <link rel='stylesheet' href='{{asset('/assets/home/css/index.css')}}'>
    <link rel='stylesheet' href='{{asset('/assets/home/css/main.css')}}'>
</head>
<body class="class-10001">
@include('home.public.header')     <!--引入header文件-->

<div class="window-box">
    <div class="window-cut">
        <div class="window-bin window-banner" data-hash="index" data-title="网站首页">
            <div class="banner-box">
                <div class="banner-cut">
                    @foreach($index_banner as $key => $value)
                        @if($key == 0)
                            <div class="banner-bin banner-lazy" data-background="{{$value['image_path']}}">
                                <div class="container">
                                    <div class="row">
                                        <div class="banner-bin-o">
                                            <p>
                                                <span>DEVELOPMENT</span>
                                                <span>IOS程序 + APK程序</span>
                                                <span><u>APP</u>应用开发</span>
                                            </p>
                                            <p>
                                                <span>APP</span>
                                            </p>
                                            <p>
                                                <span><u>——</u> 为企业快速打造全平台应用制作开发</span>
                                                <span>For the rapid development of enterprise application development</span>
                                            </p>
                                            <p>
                                                <span>√</span>
                                                <span>高品质服务</span>
                                                <span>√</span> <span>扁平化设计</span>
                                                <span>√</span> <span>专业性开发</span>
                                            </p>
                                        </div>
                                        <div class="banner-bin-p">
                                            <p>
                                        <span>让营销变得<u>
                                            </u>更简单</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($key == 1)
                            <div class="banner-bin banner-lazy" data-background="{{$value['image_path']}}">
                                <div class="container">
                                    <div class="row">
                                        <div class="banner-bin-h">
                                            <span>互联网<u>+</u></span>
                                            <span>营销型建站</span>
                                        </div>
                                        <div class="banner-bin-i">
                                            <p><span>SEO OPTIMIZING</span></p>
                                            <p><span>咨询策划　创意设计　技术开发　运营维护　营销推广</span></p>
                                        </div>
                                        <div class="banner-bin-j">
                                            <p>
                                                <span>技术优势</span>
                                                <span>“互联网+”就是“互联网+各传统行业”，但这并不是简单相加</span>
                                            </p>
                                            <p>
                                                <span>解决方案</span>
                                                <span>资源中的优化和集成，将互联网的创新成果深度融合于经济</span>
                                            </p>
                                            <p>
                                                <span>服务流程</span>
                                                <span>它代表一种新的社会形态，让互联网与传统行业进行深度融合</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($key == 2)
                            <div class="banner-bin banner-lazy" data-background="{{$value['image_path']}}">
                                <div class="container">
                                    <div class="row">
                                        <div class="banner-bin-a">
                                            <span>平</span>
                                            <span>面</span>
                                            <span>设</span>
                                            <span>计</span>
                                        </div>
                                        <div class="banner-bin-b">
                                            <span>GRAPHIC DESIGN</span>
                                            <span>创意新思维<br>尽在掌握</span>
                                            <span>广告策划</span>
                                            <span>服务理念：提供售前、售中和售后的一条龙服务，<br>全过程把满足客户需求作为企业活动的核心。</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="banner-pager"></div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>
        <div class="window-bin swiper-lazy" data-hash="about" data-title="关于我们" data-background="{{$about_banner['image_path']}}">
            <div class="container about-box">
                <div class="row">
                    <div class="about-left">
                        <h3>
                            <font>Thirteen Network Technology Co., Ltd.</font> <span><u>拾叁</u>网络科技有限公司</span>
                        </h3>
                        <ul>
                            <li>
                                <strong>
                                    <hr class="n9">
                                    <hr class="n8">
                                </strong>
                                <font>位</font>
                                <span>投资服务商</span>
                            </li>
                            <li>
                                <strong>
                                    <hr class="n5">
                                    <hr class="n8">
                                    <hr class="n3">
                                    <hr class="n2">
                                </strong>
                                <font>套</font>
                                <span>精品案例数</span>
                            </li>
                            <li>
                                <strong>
                                    <hr class="n9">
                                    <hr class="n0">
                                    <hr class="n0">
                                </strong>
                                <font>万</font>
                                <span>总承诺资金</span>
                            </li>
                            <li>
                                <strong>
                                    <hr class="n5">
                                    <hr class="n4">
                                </strong>
                                <font>个</font>
                                <span>全国分销商</span>
                            </li>
                        </ul>
                        <div class="about-content"><?php echo $about->content ?></div>
                        <a class="click-box" href="/a/guanyuwomen/">
                            <span>READ MORE</span>
                        </a>
                    </div>
                    <div class="about-right">
                        <div class="about-list">
                            <ul class="about-ul">
                                @foreach($about->images as $value)
                                    <li class="about-li">
                                        <img class="about-lazy" data-src='{{$value}}'>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="about-click">
                        <a class="click-box" href="/a/guanyuwomen/">
                            <span>READ MORE</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>
        <div class="window-bin swiper-lazy" data-hash="picture" data-title="产品中心" data-background="{{$product_banner->image_path}}">
            <div class="container picture-box">
                <div class="row">
                    <div class="picture-title">
                        <h3><u>推荐套餐</u> —— 铸造辉煌，唯有质量！</h3>
                    </div>
                    <div class="picture-nav">
                        <p>
                            @foreach($product_category as $key => $value)
                                @if($key == 0)
                                    <b data-href="/a/chanpinzhongxin/APPkaifa/" data-id="{{$value->id}}" title="{{$value['name']}}" class="active">
                                        <span>√</span>
                                        <span>{{$value['name']}}</span>
                                    </b>
                                @else
                                    <b data-href="/a/chanpinzhongxin/APPkaifa/" data-id="{{$value->id}}" title="{{$value['name']}}">
                                        <span>√</span>
                                        <span>{{$value['name']}}</span>
                                    </b>
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <div class="picture-cut">
                        @foreach($product_category as $key => $value)
                            @if($key == 0)
                                <div data-id="{{$value->id}}" class="picture-list active">
                                    <ul class="picture-ul">
                                        @foreach($value->product as $k => $val)
                                            <li class="picture-li swiper-slide-active">
                                                <a href="{!! url("/home/product/detail", array($val->id)) !!}" title="{{$val->name}}">
                                                    <font>
                                                        <img class="picture-lazy" data-src='{{$val->image_path}}' alt="{{$val->name}}">
                                                    </font>
                                                    <span>
                                            <b>{{$val->name}}</b>
                                        </span>
                                                </a>
                                                <p class="met-img-showbtn" data-imglist="{{$val->name}}">+</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div data-id="{{$value->id}}" class="picture-list">
                                    <ul class="picture-ul">
                                        @foreach($value->product as $k => $val)
                                            <li class="picture-li swiper-slide-active">
                                                <a href="{!! url("/home/product/detail", array($val->id)) !!}" title="{{$val->name}}">
                                                    <font>
                                                        <img class="picture-lazy" data-src='{{$val->image_path}}' alt="{{$val->name}}">
                                                    </font>
                                                    <span>
                                            <b>{{$val->image_path}}</b>
                                        </span>
                                                </a>
                                                <p class="met-img-showbtn" data-imglist="{{$val->name}}">+</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>
        <div class="window-bin swiper-lazy" data-hash="case" data-title="案例展示" data-background="{{$reveal_banner->image_path}}">
            <div class="container case-box">
                <div class="row">
                    <div class="case-left">
                        <h3><u>案例展示，</u>优质开发！</h3>
                        <p>{{$config->reveal}}</p>
                        <a class="click-box" href="{!! url('/home/reveal/index') !!}"><span>READ MORE</span></a></div>
                    <div class="case-right">
                        <div class="case-list">
                            <ul class="case-ul">
                                <li class="case-li case-null swiper-slide-active"></li>
                                @foreach($reveal_list as $key => $value)
                                    @if($key%2 == 0)
                                        <li class="case-li">
                                    @endif
				                    <span>
                                        <a href="{!! url('/home/reveal/detail', array($value->id)) !!}" title="{{$value->name}}">
                                            <img class="case-lazy" src='{{$value->cover_path}}' alt="{{$value->name}}">
                                            <font>{{$value->name}}</font>
                                        </a>
                                        <p class="fa fa-search met-img-showbtn" data-imglist="{{$value->name}}"></p>
                                    </span>
                                    @if($key%2 == 1)
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>
        <div class="window-bin swiper-lazy" data-hash="info" data-title="新闻资讯" data-background="{{$news_banner->image_path}}">
            <div class="container info-box">
                <div class="row">
                    <div class="info-left">
                        @foreach($news_category as $key => $value)
                            @foreach($value->news as $k => $val)
                                @if($k == 0)
                                    @if($key == 0)
                                        <div data-id="{{$value->id}}" class="info-first info-ease active">
                                            <div class="info-img">
                                                <a href="{!! url('/home/news/detail', array($val->id)) !!}" title="{{$val->title}}">
                                                    <img class="swiper-lazy" data-src='{{$val->image_path}}' height="440px">
                                                </a>
                                            </div>
                                            <div class="info-text">
                                                <h3>
                                                    <a href="{!! url('/home/news/detail', array($val->id)) !!}" title="{{$val->title}}">{{$val->title}}</a>
                                                </h3>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i><b>{{$val->gmt_create}}</b></li>
                                                    <li><i class="fa fa-user-plus"></i><b>{{$val->author}}</b></li>
                                                    <li><i class="fa fa-eye"></i><b>{{$val->read}}</b></li>
                                                </ul>
                                                <div class="news-content"><?php echo $val->content ?></div>
                                                <em> <b></b> </em>
                                                <a class="click-box" href="{!! url('/home/news/detail', array($val->id)) !!}">
                                                    <span>READ MORE</span>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div data-id="{{$value->id}}" class="info-first info-ease">
                                            <div class="info-img">
                                                <a href="{!! url('/home/news/detail', array($val->id)) !!}" title="{{$val->title}}">
                                                    <img class="swiper-lazy" data-src='{{$val->image_path}}' height="440px">
                                                </a>
                                            </div>
                                            <div class="info-text">
                                                <h3>
                                                    <a href="{!! url('/home/news/detail', array($val->id)) !!}" title="{{$val->title}}">{{$val->title}}</a>
                                                </h3>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i><b>{{$val->gmt_create}}</b></li>
                                                    <li><i class="fa fa-user-plus"></i><b>{{$val->author}}</b></li>
                                                    <li><i class="fa fa-eye"></i><b>{{$val->read}}</b></li>
                                                </ul>
                                                <div class="news-content"><?php echo $val->content ?></div>
                                                <em> <b></b> </em>
                                                <a class="click-box" href="{!! url('/home/news/detail', array($val->id)) !!}">
                                                    <span>READ MORE</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                    <div class="info-right">
                        <h3><u>新闻资讯 · </u>让营销变得简单</h3>
                        <div class="info-nav">
                            <p>
                                @foreach($news_category as $key => $value)
                                    @if($key == 0)
                                        <b data-href="" data-id="{{$value->id}}" title="{{$value->name}}" class="active">
                                            <span>√</span>
                                            <span>{{$value->name}}</span>
                                        </b>
                                    @else
                                        <b data-href="" data-id="{{$value->id}}" title="{{$value->name}}">
                                            <span>√</span>
                                            <span>{{$value->name}}</span>
                                        </b>
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <div class="info-cut">
                            @foreach($news_category as $key => $value)
                                @if($key == 0)
                                    <div data-id="{{$value->id}}" class="info-list info-ease active">
                                        <ul class="info-ul">
                                            @foreach($value->news as $k => $val)
                                                @if($k%2 == 0)
                                                    <li class="info-li swiper-slide-active">
                                                        @endif
                                                        <p>
                                                            <img class="info-lazy" src='{{$val->image_path}}' alt="{{$val->title}}">
                                                            <a href="{!! url('/home/news/detail', array($val->id)) !!}" title="{{$val->title}}">{{$val->title}}</a>
                                                            <b>{{$val->gmt_create}}</b>
                                                        </p>
                                                        @if($k%2 == 1)
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <div data-id="{{$value->id}}" class="info-list info-ease">
                                        <ul class="info-ul">
                                            @foreach($value->news as $k => $val)
                                                @if($k%2 == 0)
                                                    <li class="info-li swiper-slide-active">
                                                        @endif
                                                        <p>
                                                            <img class="info-lazy" src='{{$val->image_path}}' alt="{{$val->title}}">
                                                            <a href="{!! url('/home/news/detail', array($val->id)) !!}" title="{{$val->title}}">{{$val->title}}</a>
                                                            <b>{{$val->gmt_create}}</b>
                                                        </p>
                                                        @if($k%2 == 1)
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>
        <div class="window-bin swiper-lazy" data-hash="contact" data-title="联系我们" data-background="{{$contact_banner->image_path}}">
            <div class="container contact-box">
                <div class="row">
                    <div class="contact-left" id="map" coordinate="{{$contact->location}}"></div>
                    <div class="contact-right">
                        <div class="contact-cut">
                            <div class="contact-bin">
                                <h2>全国统一服务热线：</h2>
                                <h1>{{$config->phone}}</h1>
                                <p><em class="fa fa-cloud-download"></em> <span>：{{$config->address}}</span></p>
                                <p><em class="fa fa-tty"></em> <span>{{$config->phone}} / (+86) {{$config->mobile}}</span></p>
                                <p><em class="fa fa-envelope"></em> <span>{{$config->email}}</span></p>
                            </div>
                            <div class="contact-bin">
                                <dl>
                                    <dt>
                                        <img class="swiper-lazy" data-size="120_120" data-src="{{$config->code_path}}">
                                    </dt>
                                    <dd>
                                        <strong>
                                            <font>扫一扫</font>
                                            <em class="fa fa-desktop"></em>
                                            <em class="fa fa-tablet"></em>
                                            <em class="fa fa-mobile"></em>
                                        </strong>
                                        <span>
                                            拿起手机扫描二维码，即可时刻关注我们！  <br>
                                            公司名称： <u>{{$config->company}}</u>  <br>
                                            微信号： <u>{{$config->wechat}}</u> 
                                        </span>
                                    </dd>
                                </dl>
                                <a class="click-box" href="{!! url('/home/contact/index') !!}">
                                    <span>READ MORE</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="window-next">SCROLL</div>
        </div>
        <div class="window-bin foot">
        @include('home.public.footer')     <!--引入foot文件-->
        </div>
    </div>
</div>
@include('home.public.share')     <!--引入share文件-->
@include('home.public.js')     <!--引入js文件-->
<!--产品中心 -->
<style>
    .sign-ul li { position: relative;}
    .sign-box { overflow: visible;}
    .product-down { position: absolute; left: -207px; top: 70px; width: 680px; height: 292px; background: #fff; display: none;}
    .sign-ul li:hover .product-down { display: block;}
    .product-tabs { border-top: solid 2px #4cc4eb; border-bottom: solid 2px #4cc4eb; width: 112px; margin: 0; padding: 0; }
    .product-tabs li { height: 58px; line-height: 58px; list-style: none; float: none;}
    .product-tabs li a { display: block; height: 58px; text-align: center; font-size: 14px; color: #fff; font-weight: bold; background: #4cc4eb; border-left: solid 1px #4cc4eb; border-right: solid 1px #4cc4eb; border-bottom: solid 1px #40b6dd;}
    .product-tabs li:last-child a { border-bottom: none;}
    .product-tabs li.active a { background: #fff; color: #333; border-bottom: solid 1px #fff;}
    .tabs-box { position: absolute; left: 112px; display: none; top: 0; right: 0; bottom: 0; border-top: solid 2px #ddd; padding: 25px 20px 0 30px;}
    .form-control { height: 34px; background: #f6f6f6 url(skin/images/search.png) 10px center no-repeat; border-color: #f6f6f6; padding-left: 35px; margin-bottom: 30px;}
    .product-label li { list-style: none; float: left; height: 26px; margin-left: 10px; margin-bottom: 15px; }
    .product-label { margin: 0; padding: 0;}
    .product-label li a { display: block; width: 100px; height: 26px; font-size: 12px; color: #666; line-height: 24px; text-align: center; border: solid 1px #b0e4f5;}
    .product-label li a:hover { background: #b0e4f5; color: #fff; }
    .about-content{ height: 100px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin-bottom: 20px;}
    .news-content{ height: 100px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; margin-bottom: 20px;}
</style>
<script>
    window.onload = function () {             //在整个文档下面加一个JS属性
        var li = document.getElementsByClassName("sign-li")[2];       //绑定sign-li 2  也就是三
        var lDiv = document.createElement('div');         //在JS里面加了个div
        lDiv.innerHTML = '';
        li.appendChild(lDiv);           //li下面追加一个子元素   div
        $(".product-tabs li a").hover(function () {
            $(".product-tabs li").removeClass("active");
            $(this).parents("li").addClass("active");
            $(".tabs-box").hide();
            var b = $(this).attr("href");
            $(b).show();
        });
    }
</script>
</body>
</html>