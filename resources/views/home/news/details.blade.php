<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>查看新闻</title>
    <link href="{{asset("/assets/home/css/base.css")}}" rel="stylesheet"/>
    <link href="{{asset("/assets/home/css/lm_style.css")}}" rel="stylesheet"/>
</head>
<body>
<!--header 开始-->
<header style="position: fixed;">
    <div class="header">
        <!-- 用户ID -->
        <input type="hidden" id="user_id" value="{{$user_id}}">
        <input type="hidden" class="news-id" value="{{$news->id}}">
        <input type="hidden" class="from-collect" value="{{$from_collect}}">
        @if(isset($from_collect) && ($from_collect == 1))
            <a class="new-a-back" href="javascript:history.back();" onclick = "btnReturn();"><i class="ico-left"></i></a>
        @else
            <a class="new-a-back" href="javascript:history.back();"><i class="ico-left"></i></a>
        @endif

        <h2>查看新闻</h2>
        @if($collection)
            <i class="ico-collect-yes"></i>
            <i class="ico-collect-no" style="display: none;"></i>
        @else
            <i class="ico-collect-yes" style="display: none;"></i>
            <i class="ico-collect-no"></i>
        @endif

    </div>
</header>
<!--header 结束-->
<section class="bulletin-detail">
    @if(isset($from_collect) && ($from_collect != 1))
        <i class="ico-share" onclick = "btnClick();"></i>
    @endif
    <h3 class="name">{{$news->title}}</h3>
    <h1 class="time">{{$news->gmt_create}}</h1>
    <div class="detail">
        <?php echo $news->content ?>
    </div>
</section>
<script type="text/javascript" src="{{asset("/assets/home/js/jquery.js")}}"></script>
<script type="text/javascript" src="{{asset("/assets/home/js/slider.js")}}"></script>
<script>
    $(function(){
        $('.news-content img').attr('width','100%');
    });
</script>
<script type="text/javascript">
    $(function(){
        var url = document.referrer;
        var from = $(".from-collect").val();
        if((url == '') && (from == 0)){
            $('.ico-share').css('display','none');
            $('.new-a-back').css('display','none');
            $('.ico-collect-yes').css('display','none');
            $('.ico-collect-no').css('display','none');
            // if(!from){
            //     $('header').css('display','none');
            // }
        }
        var user_id = $('#user_id').val();
        //判断user_id的值是否是0，如果是0则请求一次获取用户信息的接口
        if(user_id == 0){
            var token = '{{$token}}';
            $.get('/home/getUserInfo?token=' + token, function (data) {
                if(data) {
                    $('#user_id').val(data.user_id);
                    user_id = data.user_id;
                }
            });
        }
        //收藏
        var id = $('.news-id').val();
        $('.ico-collect-no').on('click',function(){
            $.get('/home/collect_news?type=1&news_id=' + id + '&user_id=' + user_id , function (data) {
                if(data) {
                    $('.ico-collect-no').css('display','none');
                    $('.ico-collect-yes').css('display','block');
                }else {
                    alert('收藏失败');
                }
            });
        });
        $('.ico-collect-yes').on('click',function(){
            $.get('/home/collect_news?type=2&news_id=' + id + '&user_id=' + user_id, function (data) {
                if(data) {
                    $('.ico-collect-no').css('display','block');
                    $('.ico-collect-yes').css('display','none');
                }else {
                    alert('取消收藏失败');
                }
            });
        })
    });
</script>
<script type="text/javascript">
    function btnClick()
    {
        //分享
        var title = "{{$news->title}}";
        var image = "{{$news->image_path}}";
{{--        var image_base64 = '{{$news->image_base64}}';--}}
        var introduce = "{{$news->introduce}}";
        var url_arr = window.location.href.split("?");
        var url = url_arr[0];
        var data = '{"title":"'+title+'","url":"'+url+'","image":"'+image+'","introduce":"'+introduce+'"}';

        if (/android/i.test(navigator.userAgent)){
            JSBridge.invoke('toShare',data);
        } else if (/ipad|iphone|iPod|iOS|mac/i.test(navigator.userAgent)){
            share_iOS(title,image,url,introduce);
        }
    }
    function btnReturn()
    {
        //从新闻收藏那里进去的时候，点击返回
        if (/android/i.test(navigator.userAgent)){
            JSBridge.invoke('toReturn');
        } else if (/ipad|iphone|iPod|iOS|mac/i.test(navigator.userAgent)){
            return_iOS("toReturn");
        }
    }
</script>
</body>
</html>