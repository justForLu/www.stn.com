/* 代码整理：懒人之家 www.lanrenzhijia.com */
document.writeln("<div class=\"float-contact\" id=\"float-contact\" style=\"position: fixed;z-index:1000; right: 1px; display: block;\">");
document.writeln("<a title=\"点击收缩\" href=\"javascript:void(0);\" onclick=\"show()\" class=\"close_rr\" id=\"float-contact-close\">点击收缩</a>");
document.writeln("<div class=\"container_r\">");
document.writeln("<div class=\"qq\">");
document.writeln("<strong class=\"qqtitle\">在线客服</strong><br />");
document.writeln("<span class=\"qqtitle\">周一至周六</span><br />");
document.writeln("<span class=\"qqtitle\">9:00-18:00</span>");
document.writeln("<ul class=\"btn\">");
document.writeln("<li><a title=\"购买咨询\" target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=2018994766&site=qq&menu=yes\">购买咨询</a></li>");
document.writeln("<li><a title=\"功能咨询\" target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=2011848042&site=qq&menu=yes\">功能咨询</a></li>");
document.writeln("<li><a title=\"销售咨询\" target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=2018994766&site=qq&menu=yes\">销售咨询</a></li>");
document.writeln("<li><a title=\"客服咨询\" target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=2011848042&site=qq&menu=yes\">客服咨询</a></li>");
document.writeln("<li><a title=\"技术专员\" target=\"_blank\" href=\"http://wpa.qq.com/msgrd?v=3&uin=2018994766&site=qq&menu=yes\">技术专员</a></li>");
document.writeln("</ul>");
document.writeln("</div>");
document.writeln("<div class=\"qqtel\">");
document.writeln("<strong class=\"qqtitle\">咨询热线</strong>");
document.writeln("<div class=\"qqcontent\">010-57121206</div>");
document.writeln("</div>");
document.writeln("</div>");
document.writeln("<a  href=\"#\" class=\"myqqlink\">返回顶部</a>");
document.writeln("</div>");
document.writeln("<div class=\"float-contact-mini\" id=\"float-contact-mini\" style=\"display: none; position: fixed;z-index:1000; right: 1px;\">");
document.writeln("<a href=\"javascript:void(0);\" onclick=\"show()\" id=\"float-contact-mini\">联系我们</a>");
document.writeln("</div>");
function show() {
	var floatContact = document.getElementById('float-contact');
	var floatContactMini = document.getElementById('float-contact-mini');
	if(floatContact.style.display=="none") {
		floatContact.style.display="block";
		floatContactMini.style.display="none";
	}else {
		floatContact.style.display="none";
		floatContactMini.style.display="block";
	}
}
/* 代码整理：懒人之家 www.lanrenzhijia.com */