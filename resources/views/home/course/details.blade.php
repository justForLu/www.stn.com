<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title>教学视频</title>
		<link href="{{asset("/assets/home/css/base.css")}}" rel="stylesheet" />
		<link href="{{asset("/assets/home/css/lm_style.css")}}" rel="stylesheet" />
	</head>
	<body>
		<!--header 开始-->
		<header>
			<div class="header">
				<a class="new-a-back" href="javascript:history.back();"><i class="ico-left"></i></a>
				<h2>教学视频</h2>
			</div>
		</header>
		<!--header 结束-->
		<section class="course-detail">
			@if(isset($course->video))
				<div class="img-box">
					<video src="{{$course->video}}" controls="controls" poster="" width="100%" height="auto"></video>
				</div>
			@endif
				<h3 class="title">{{$course->title}}</h3>
				<?php echo $course->content ?>
       </section>
    <script type="text/javascript" src="{{asset("/assets/home/js/jquery-2.1.0.js")}}"></script>
	<script>
		$(function(){
			$('.course-detail img').attr('width','100%');
		});
	</script>
    <script type="text/javascript" src="{{asset("/assets/home/js/slider.js")}}"></script>
		<script type="text/javascript">
            // 视频------视频截图 ~~ 视频播放状态 ~~
            const setMedia = function(video, scale = 0.8) {
                // 设置poster属性：（非本地视频资源会有跨域截图问题）
                video.addEventListener('loadeddata', function(e) {
                    // 拿到图片
                    let canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth * scale;
                    canvas.height = video.videoHeight * scale;
                    canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                    let src = canvas.toDataURL('image/png');
                    // 显示在dom，测试用
                    (function(flag = true) {
                        if (!flag) {return;}
                        let img = document.createElement('img');
                        img.src = src;
                        document.body.appendChild(img);
                    })(0);

                    // 接着上文的img.src说
                    let file = src; // 把整个base64给file
                    let name = "test" + ".png"; // 定义文件名字（例如：abc.png ， cover.png）
                    var type = "image/png"; // 定义图片类型（canvas转的图片一般都是png，也可以指定其他类型）
                    let conversions = base64ToBlob(file, type); // 调用base64转图片方法
console.log(conversions);
                    // 设置属性
                    video.setAttribute('poster', conversions);

                });
// -------------------------------------------------------------------------------------
                //检测视频播放状态：
                //播放按钮
                let playBtn =  video.parentNode.childNodes[2].nextSibling;
                //设置状态
                function vidplaySate(e) {
                    if (video.paused) {
                        video.play();
                        playBtn.classList.add('pause');
                    } else {
                        video.pause();
                        playBtn.classList.remove('pause');
                    }
                }
                //点击监听
                video.addEventListener('click', vidplaySate, false);
                playBtn.addEventListener('click', vidplaySate, false);
                //结束监听
                video.addEventListener('ended',function () {
                    playBtn.classList.remove('pause');
                });
            };
            //视频：
            let videos = document.querySelectorAll('video');
            videos.forEach((video) => {
                setMedia(video);
            });



            // conversions就是转化之后的图片文件，

            function base64ToBlob(urlData, type) {
                let arr = urlData.split(',');
                let mime = arr[0].match(/:(.*?);/)[1] || type;
// 去掉url的头，并转化为byte
                let bytes = window.atob(arr[1]);
// 处理异常,将ascii码小于0的转换为大于0
                let ab = new ArrayBuffer(bytes.length);
// 生成视图（直接针对内存）：8位无符号整数，长度1个字节
                let ia = new Uint8Array(ab);
                for (let i = 0; i < bytes.length; i++) {
                    ia[i] = bytes.charCodeAt(i);
                }
                return new Blob([ab], {
                    type: mime
                });
            }

		</script>
	</body>
</html>