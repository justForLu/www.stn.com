
$(".look-demo").on('click', function(ev){
    var e=ev || window.event;
    e.stopPropagation();
    if($(".demo-content").hasClass("down")){
        $(".demo-content").stop(true,false).animate({ height:0,opacity:0},350);
        $(".demo-content").removeClass("down");
        console.log(0);
    }else{
        $(".demo-content").stop(true,false).animate({
            height: 360,
            opacity:1
        },350);
        $(".demo-content").addClass("down");
    }
});
$(document).on('click', function(){
    $(".demo-content").stop(true,false).animate({ height:0,opacity:0},350);
    $(".demo-content").removeClass("down");
});

$(window).scroll(function(){
    if($(window).scrollTop()>80){
        $(".demo-content").css({
            top      : 60
        });
    }else{
        $(".demo-content").css({
            top      : 140
        });
    }
});

//二级菜单下拉动画

$(".look-app").hover(function(){
    $(".b2c-app").stop(true,false).animate({
        height:"show",
        opacity:1
    },250);
},function(){
    $(".b2c-app").stop(true,false).animate({
        height:"hide",
        opacity:0
    },250);
});
$(".look-weshop").hover(function(){
    $(".b2c-weshop").stop(true,false).animate({
        height:"show",
        opacity:1
    },250);
},function(){
    $(".b2c-weshop").stop(true,false).animate({
        height:"hide",
        opacity:0
    },250);
});
$(".look-func").hover(function(){
    $(".b2c-func").stop(true,false).animate({
        height:"show",
        opacity:1
    },250);
},function(){
    $(".b2c-func").stop(true,false).animate({
        height:"hide",
        opacity:0
    },250);
});

$(window).scroll(function(){
      if($(window).scrollTop()>80){
      
      $(".b2c-nav").css({
        position: "fixed",
        top:0
      });
    }else{
      
      $(".b2c-nav").css({
        position: "absolute",
        top:80,
      });
    }
  });