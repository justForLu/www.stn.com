try {
    // 导航菜单鼠标滑过效果
    $('.subitems-nav li').hover(function(){
        $('.subitems-nav .line').css({
            'left': $(this).position().left,
            'width': $(this).outerWidth()
        })
    },function(){
        $('.subitems-nav .line').css('width',0);
    })
} catch (t) {
}

//页面滚动 添加 类
$(window).scroll(function() {
	if($(window).scrollTop() > 500){
            $('.subitems-nav-box').addClass('subitems-slide');
        }else{
            $('.subitems-nav-box').removeClass('subitems-slide');
        }
});
