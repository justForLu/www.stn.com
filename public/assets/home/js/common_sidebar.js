//side客服QQ和电话
$(document).ready(function(){
	
	$(".side ul li").hover(function(){
		$(this).find(".sidebar_qq").stop().animate({"width":"150px"},200)	
		$(this).find(".sidebar_phone").stop().animate({"width":"150px"},200)
	},function(){
		$(this).find(".sidebar_qq").stop().animate({"width":"50px"},200)
		$(this).find(".sidebar_phone").stop().animate({"width":"50px"},200)
	});
	
});
//微信图显示隐藏
$(document).ready(function(e) {
    $("#moquu_wxin").hover(function(){
		$(".weixin").toggle();
		});
});
//回到顶部
function goTop(){
	$('html,body').animate({'scrollTop':0},600);
}