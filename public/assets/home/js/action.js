//获取css非行间样式；
function getStyle(obj,attr)
{
    if(obj.currentStyle)
    {
        return obj.currentStyle[attr];
    }
    else
    {
        return getComputedStyle(obj,false)[attr];
    }
}
//缓冲运动，链式运动；
function buffer_action(obj,json,fn)
{
    clearInterval(obj.timer);
    obj.timer = setInterval(function(){
        var oStop = true;
        for(var attr in json)
        {
            var iCur = 0;
            if(attr == 'opacity')
            {
                iCur = parseInt(parseFloat(getStyle(obj,attr))*100);
            }
            else
            {
                iCur = parseInt(getStyle(obj,attr));
            }
            var iSpeen = (json[attr] - iCur)/8;
            iSpeen = iSpeen >0?Math.ceil(iSpeen):Math.floor(iSpeen);
            if(attr == 'opacity')
            {
                obj.style.opacity = (iSpeen + iCur)/100;
                obj.style.filter = 'alpha(opacity = '+ (iSpeen + iCur) +')';
            }
            else
            {
                obj.style[attr] = (iSpeen + iCur) + 'px';
            }
            if(iCur != json[attr])
            {
                oStop = false;
            }
        }
        if(oStop)
        {
            clearInterval(obj.timer);
            if(fn)
            {
                fn();
            }
        }
    },30)
}