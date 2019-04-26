$(function(){
    $(".banner").each(function(){
        var l=$(this).find(".ban_ul li").length;
        if(l>1){
            bigScroll();
        }else{
            $(".switch").hide();
        }
    });


    //切换
	$(".core_tab li").click(function(){
		$(this).addClass("on").siblings().removeClass("on");
		var index = $(this).index();
		$(".core_end dd").eq(index).show().addClass("active").siblings(".core_end dd").hide().removeClass("active");
	}).eq(0).trigger('click');



	$(".ul_round ul").roundabout({
		duration: 1000,
		btnPrev:".btnPrev",
		btnNext:".btnNext",
		autoplay: false,
		minOpacity: 0,
		maxOpacity: 1,
		reflect: true,
		startingChild: 3,
		enableDrag: true
	});

	$(".func_ul li:nth-child(6n)").css("margin-right","0px");

	$(window).scroll(function() {
 		var t = $(window).scrollTop();
    	var h = $(window).height();
    	for(var i = 1; i < 8; i ++){
	        var off = $(".move" + i).offset().top + 100;
	        if(t + h > off){
	            $(".move" + i).addClass("animate");
	            };
        };
 	});

 	$(".out_pattern .w1285 li.li4 .con").hover(function(){
 		$(this).parent("li").css("z-index",100);
 	},function(){
 		$(this).parent("li").css("z-index",0);
 	})
		
})