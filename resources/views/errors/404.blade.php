<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no，email=no" name="format-detection" />
    <title>404</title>
    <style type="text/css">
        .mistake{width:100%;height:100vh;background-color:#fff;}
        .mistake>img{width:100%;display:block;padding-top:30%;}
        .mistake>a{margin:20px auto;display:block;line-height:36px;text-align:center;font-size:16px;text-align: center;width: 112px;color: #fff;border-radius: 5px;background-color: #ff8d1f;}
    </style>
</head>
<body>
@if(!is_mobile())
    <div style="width:100%;height:100vh;background-color:#fff;">
        <img src="{{asset("/assets/admin/images/404.jpg")}}" style="width:40%;display:block;margin:0 auto;position:relative;top:10%;">
        <a href="javascript:history.back();" style="position:relative;top:12%;margin:20px auto;display:block;line-height:42px;text-align:center;font-size:16px;text-align: center;width: 240px;color: #fff;border-radius: 5px;background-color: #ff8d1f;">返回</a>
    </div>
@else
    <div class="mistake">
        <img src="{{asset("/assets/admin/images/404.jpg")}}">
        <a href="javascript:history.back();">返回</a>
    </div>
@endif
</body>

</html>