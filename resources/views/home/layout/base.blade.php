<!DOCTYPE html>
<html>
<head>
    <meta name="renderer" content="webkit">
    <meta charset="utf-8"/>
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="generator" content="dedecms.com" data-variable="/,cn,108,,2,M1156010"/>
    <meta name="format-detection" content="email=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="full-screen" content="yes">
    <meta name="x5-fullscreen" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <title>拾叁网络官网</title>
    <meta name="keywords" content=""/>
    <meta name="description" content="网站打开慢的其中一个原因是图片文件过大，一个网站在打开时需要同时加载很多图片，如果网站中每张图片都很大就容易发生卡顿状态！"/>
    @include('home.public.css')
</head>
<body>
@include('home.public.header')

<div class="side-content">
    <div class="banner-sub auto not-has" data-height="420|350|200"></div>
    @yield('content')
    <div class="side-scroll swiper-scrollbar"></div>
</div>

@include('home.public.share')
@include('home.public.js')
@yield('scripts')
</body>
</html>