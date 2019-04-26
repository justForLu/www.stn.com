
/*判断浏览器是否小于IE8 start*/
var b_v = navigator.appVersion;
var IE7 = b_v.search(/MSIE 7/i) != -1;
if (IE7 || document.documentMode<=7)
{
	window.location.href="update_browser.html"; 
}
/*判断浏览器是否小于IE8 end*/

$(document).ready(function(){


	// ----------------- 公共 ----------------- 
	// 滚动动画
	window.scrollReveal = new scrollReveal({
		reset: false,
		move: '50px'
	});

	// 头部导航下拉
	$(".mod-head .h-nav li").hover(function(){
		var li = $(this);
		var ul = li.parent("ul");
		var line = ul.find(".line");
		var index = ul.children("li:visible").index(li);
		line.addClass("hover-" + (index + 1));
		li.find(".nav-box").stop(true,true).animate({
			height:'show',
			opacity: 1
		});
	}, function(){
		var li = $(this);
		var ul = li.parent("ul");
		var line = ul.find(".line");
		var index = ul.children("li:visible").index(li);
		line.removeClass("hover-" + (index + 1));
		li.find(".nav-box").stop(true,false).animate({
			height:'hide',
			opacity: 0
		});
	});

	// 头部演示下拉
	$(".mod-head .demo").hover(function(){
		var sub = $(this).find(".demo-sub");
		sub.show();
	}, function(){
		var sub = $(this).find(".demo-sub");
		sub.hide();
	})

	//普通切换
    $(".j-modslide").slide({
    	titCell : ".tabs li",
    	mainCell : ".items"
    });

    // APP三合一
    $(".section-combine .toggle").click(function(){
    	var $this = $(this);
    	var combine = $this.parents(".section-combine");
		combine.toggleClass("active");
		combine.siblings(".section-combine-hide").toggleClass("active");
    });

    // 右下角固定服务
    function FixedService(){
    	var wrap = $(".fixed-service");
    	var item = wrap.find(".service-item");

    	// 鼠标经过显示电话
	    item.hover(function(){
	    	$(this).find(".s-text").stop(true,true).animate({
	    		width: "show",
	    		paddingRight: "70px"
	    	});
	    }, function(){
			$(this).find(".s-text").stop(true,false).animate({
	    		width: "hide",
	    		paddingRight: "35px"
	    	});
		})

		// 客服波纹动画
		var msg = item.filter(".service-msg");
		setInterval(function(){
			repeatAni();
		}, 8000);
		function repeatAni(){
			var animate = msg.find(".animated-circles");
			animate.addClass("animated");
			//console.log(animate.length)
			setTimeout(function(){
				animate.removeClass("animated");
			}, 4000);
		}
		repeatAni();

	    // 返回顶部
	    var totop = item.filter(".service-top");
	    totop.hide();
		totop.click(function(){
		    $("html,body").animate({scrollTop:0},500);
		});
		$(window).scroll(function(){
		    if($(window).scrollTop() > 100){
		        totop.show()
		    }else {
		        totop.hide()
		    }
		});

    }
    FixedService();
	

	// ----------------- 首页 ----------------- 
	// 五楼手风琴
	$(".page-index .section-5 .mode-list .mode-item").hover(function(){
		$(this).addClass("active").siblings().removeClass("active");
	});
	// 六楼切换
	$(".page-index .section-6 .section-left li").hover(function(){
		var $this = $(this);
		var index = $this.index();
		var img = $this.parents(".section-left").siblings(".img");
		img.attr("class", "img img-" + (index + 1));
		$this.addClass("on").siblings().removeClass("on");
	});
	// 九楼切换
	$(".page-index .section-9 .slide .hd .item").hover(function(){
		var $this = $(this);
		var index = $this.index();
		var bd = $this.parents(".hd").siblings(".bd").children(".item");
		$this.addClass("on").siblings().removeClass("on");
		bd.eq(index).addClass("on").siblings().removeClass("on");
	});
	// 十楼轮播
	$(".page-index .section-10 .slide").slide({
		mainCell: '.bd ul',
		effect: 'fold'
	});
	// 十一楼轮播
	$(".page-index .section-11 .price-slide").slide({
		mainCell: '.bd'
	});

	// ----------------- 功能列表 ----------------- 
	// 
	// 表格切换
	$(".page-function-list").slide({
		mainCell:".section",
		titCell: ".section-subnav .subnav-item",
		trigger: "click"
	});
	$(".page-function-list .section-subnav .subnav-item").click(function(){
		$("html, body").animate({scrollTop : 580})
	});

	// 同城切换
	$(".page-mode-tongcheng .section-2 .slide").slide({
		mainCell:".bd ul"
	});
	
	// ----------------- app定制 ----------------- 
	//手风琴
	$(".section-app-make .mode-list .mode-item").hover(function(){
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	
/* 手机端js */
	$(".index_mobile .back_top").click(function(){
		$("body,html").animate({scrollTop:0},200);
        return false;
	});
	$(".reorder").click(function(){
		$(".js_nav").stop(true,false).slideToggle(300);
		if($(this).hasClass("active")){
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
		}
		
		$(".js_nav").find('.drop-down').removeClass('active');
		$(".js_nav").find('i').removeClass('m-icon-angle-up').addClass('m-icon-angle-down');
	});
	
	$(".drop-down").click(function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).find('i').removeClass('m-icon-angle-up').addClass('m-icon-angle-down');
		}else{
			$(this).addClass('active').siblings().removeClass("active").find('i').removeClass('m-icon-angle-up').addClass('m-icon-angle-down');
			$(this).find('i').removeClass('m-icon-angle-down').addClass('m-icon-angle-up');
		}
	});

	// ----------------- 首页 ----------------- 
	// 四楼切换
	$(".page-index-m .section-4 .slide").slide({
		mainCell: '.bd ul',
		titCell: '.hd li',
		effect: 'fade',
		trigger: 'click'
	});
	// 五楼轮播
	new Swiper(".page-index-m .section-5 .swiper-container",{
		pagination: '.page-index-m .section-5 .swiper-pagination'
	})
	// 六楼轮播
	new Swiper(".page-index-m .section-6 .swiper-container",{
		pagination: '.page-index-m .section-6 .swiper-pagination'
	});
	// ----------------- 社区模式 ----------------- 
	// 一楼轮播
	new Swiper(".page-mode-shequ-m .section-1 .swiper-container",{
		slidesPerView: 2,
		pagination: '.page-mode-shequ-m .section-1 .swiper-pagination'
	});
	// 六楼轮播
	new Swiper(".page-mode-shequ-m .section-6 .swiper-container",{
		pagination: '.page-mode-shequ-m .section-6 .swiper-pagination'
	});
	// ----------------- 同城模式 ----------------- 
	// 一楼轮播
	new Swiper(".page-mode-tongcheng-m .section-1 .swiper-container",{
		slidesPerView: 2,
		pagination: '.page-mode-tongcheng-m .section-1 .swiper-pagination'
	});
	// 7楼轮播
	new Swiper(".page-mode-tongcheng-m .section-7 .swiper-container",{
		pagination: '.page-mode-tongcheng-m .section-7 .swiper-pagination'
	});
	
	// 首页客户案例
	$(".case-list li").hover(function(){
		$(this).find('.case-show-img').hide();
		$(this).find('.case-show').stop().fadeIn();
	},function() {
		$(".case-list li .case-show").hide();
		$(this).find('.case-show-img').stop().fadeIn();
	});
	
	$(".case-list .case-demo i").hover(function(){
		var i = $(this);
		var parent = i.parent();
		var case_show = parent.parent().parent();
		var text = case_show.find('.show-text');
		var qrcode = case_show.find('.show-qrcode');
		var ul = case_show.find('.show-qrcode ul');
		
		var index = parent.children("i").index(i);
		//console.log(index);
		i.addClass('active');
		//console.log(qrcode.children('li').eq(index));
		text.hide();
		qrcode.show();
		ul.children('li').hide()
		ul.children('li').eq(index).fadeIn();
	}, function(){
		$('.case-demo i').removeClass('active');
		$('.show-qrcode li').hide();
		$('.show-qrcode').hide();
		$('.show-text').show();
	});
	

});