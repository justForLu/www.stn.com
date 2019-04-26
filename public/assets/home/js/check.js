//主函数
function CheckForm(oForm)
{
	var els = oForm.elements;
    //遍历所有表元素
    for(var i=0;i<els.length;i++)
    {
		//alert(els[i].getAttribute("check"));
        //判断input是否需要验证
        if(els[i].getAttribute("check"))
        {
            //取得验证的正则字符串
            var sReg = els[i].getAttribute("check");
            //取得表单的值,用通用取值函数
            var sVal = GetValue(els[i]);
            //字符串->正则表达式,不区分大小写
            var reg = new RegExp(sReg,"i");
            if(!reg.test(sVal))
            {
                //验证不通过,弹出提示warning
                alert(els[i].getAttribute("warning"));
				//document.getElementById(els[i].name+"Info").innerHTML="<font color='#FF0000'>*"+els[i].getAttribute("warning")+"</font>";
				//alert(els[i].warning);
				//GoBack(els[i]); 
				return false;
                //该表单元素取得焦点,用通用返回函数
                //GoBack(els[i]); 
            }//else document.getElementById(els[i].name+"Info").innerHTML="<font color='#00CC66'>*正确</font>";
        }
		if(els[i].name == 'domain'){
			if(els[i].getAttribute("num") != 'true' && els[i].value){
				alert("域名不符合要求")
				return false;
			}/*else if(els[i].value.indexOf(".top") < 0 || els[i].value.indexOf(".fun") < 0 || els[i].value.indexOf(".tw") < 0 || els[i].value.indexOf(".com") < 0 || els[i].value.indexOf(".cn") < 0 || els[i].value.indexOf(".pw") < 0 || els[i].value.indexOf(".wang") < 0 || els[i].value.indexOf(".tt") < 0 || els[i].value.indexOf(".net") < 0 || els[i].value.indexOf(".tk") < 0 || els[i].value.indexOf(".ltd") < 0 || els[i].value.indexOf(".ml") < 0 || els[i].value.indexOf(".ga") < 0 || els[i].value.indexOf(".cf") < 0 || els[i].value.indexOf(".gq") < 0 || els[i].value.indexOf(".cm") < 0 || els[i].value.indexOf(".org") < 0 || els[i].value.indexOf(".hk") < 0 || els[i].value.indexOf(".game") < 0 || els[i].value.indexOf(".info") < 0 || els[i].value.indexOf(".xxx") < 0 || els[i].value.indexOf(".aero") < 0 || els[i].value.indexOf(".tel") < 0 || els[i].value.indexOf(".name") < 0 || els[i].value.indexOf(".jobs") < 0 || els[i].value.indexOf(".mobi") < 0 || els[i].value.indexOf(".pro") < 0 || els[i].value.indexOf(".me") < 0 || els[i].value.indexOf(".cc") < 0 || els[i].value.indexOf(".in") < 0 || els[i].value.indexOf(".co") < 0 || els[i].value.indexOf(".gd") < 0 || els[i].value.indexOf(".so") < 0 || els[i].value.indexOf(".ws") < 0 || els[i].value.indexOf(".com.tw") < 0 || els[i].value.indexOf(".sh") < 0 || els[i].value.indexOf(".io") < 0 || els[i].value.indexOf(".us") < 0 || els[i].value.indexOf(".tv") < 0 || els[i].value.indexOf(".tm") < 0 || els[i].value.indexOf(".com.cn") < 0 || els[i].value.indexOf(".net.cn") < 0 || els[i].value.indexOf(".gov.cn") < 0 || els[i].value.indexOf(".cx") < 0){
				console.log(els[i].value.indexOf(".cc"))
				alert("域名后缀错误")
				return false;
			}*/
		}
    }
}


//通用取值函数分三类进行取值
//文本输入框,直接取值el.value
//单多选,遍历所有选项取得被选中的个数返回结果"00"表示选中两个
//单多下拉菜单,遍历所有选项取得被选中的个数返回结果"0"表示选中一个
function GetValue(el)
{
    //取得表单元素的类型
    var sType = el.type;
    switch(sType)
    {
        case "text":
			el.value=Trim(el.value);
        case "hidden":
        case "password":
        case "file":
        case "textarea": 
			el.value=Trim(el.value);
			return el.value;
        case "checkbox":
        case "radio": return GetValueChoose(el);
        case "select-one":
        case "select-multiple": return GetValueSel(el);
    }
    //取得radio,checkbox的选中数,用"0"来表示选中的个数,我们写正则的时候就可以通过0{1,}来表示选中个数
    function GetValueChoose(el)
    {
        var sValue = "";
        //取得第一个元素的name,搜索这个元素组
        var tmpels = document.getElementsByName(el.name);
        for(var i=0;i<tmpels.length;i++)
        {
            if(tmpels[i].checked)
            {
                sValue += "0";
            }
        }
        return sValue;
    }
    //取得select的选中数,用"0"来表示选中的个数,我们写正则的时候就可以通过0{1,}来表示选中个数
    function GetValueSel(el)
    {
        var sValue = "";
        for(var i=0;i<el.options.length;i++)
        {
            //单选下拉框提示选项设置为value=""
            if(el.options[i].selected && el.options[i].value!="")
            {
                sValue += "0";
            }
        }
        return sValue;
    }
}

//通用返回函数,验证没通过返回的效果.分三类进行取值
//文本输入框,光标定位在文本输入框的末尾
//单多选,第一选项取得焦点
//单多下拉菜单,取得焦点
function GoBack(el)
{
    //取得表单元素的类型
    var sType = el.type;
	var sFather=el.name.toLowerCase().substr(0,1);
	var iexit=eval('document.all.'+sFather+'?1:0');

	if (iexit==1){
		eval('document.all.'+sFather+'check.checked=""');
		show(sFather);
		}
    switch(sType)
    {
        case "text":
        case "hidden":
        case "password":
        case "file":
        case "textarea": el.focus();var rng = el.createTextRange(); rng.collapse(false); rng.select();
        case "checkbox":
        case "radio": var els = document.getElementsByName(el.name);els[0].focus();
        case "select-one":
        case "select-multiple":el.focus();
    }
}

  function show(obj)//火狐下不兼容document.all
  {
  var tmp=eval('document.all.'+obj+'check.checked');//eval('document.all.'+obj+'check.checked');
	if (tmp!=true)
		{
		eval("document.all."+obj+".style.display=''");
		eval('document.all.'+obj+'check.checked=true');
		eval('document.getElementById("'+obj+'Close").innerHTML="[<span class=webdings>5</span>收起]"');	
		}else{
		eval("document.all."+obj+".style.display='none'");
		eval('document.all.'+obj+'check.checked=false');
		eval('document.getElementById("'+obj+'Close").innerHTML="[<span class=webdings>6</span>展开]"');	   
	   }
	}

function show1(obj){
	//alert("212132");
	if(document.getElementById(obj).style.display=="none"){
		document.getElementById(obj).style.display="";	
	}else document.getElementById(obj).style.display="none";
}



function LTrim(str) 
{ 
	var i; 
	for(i=0;i<str.length;i++) 
	{ 
		if(str.charAt(i)!=" "&&str.charAt(i)!=" ")break; 
	} 
	str=str.substring(i,str.length); 
	return str; 
} 
function RTrim(str) 
{ 
	var i; 
	for(i=str.length-1;i>=0;i--) 
	{ 
		if(str.charAt(i)!=" "&&str.charAt(i)!=" ")break; 
	} 
	str=str.substring(0,i+1); 
	return str; 
} 
function Trim(str) 
{ 
	return LTrim(RTrim(str)); 
} 


function checkValue(obj){
		check=obj.getAttribute("check");
		warning=obj.getAttribute("warning");
		obj.value=Trim(obj.value);
        if(check)
        {
            //取得验证的正则字符串
            var sReg = check;
            //取得表单的值,用通用取值函数
            var sVal = obj.value;
            //字符串->正则表达式,不区分大小写
            var reg = new RegExp(sReg,"i");
            if(!reg.test(sVal))
            {
                //验证不通过,设置为warning
				eval("document.getElementById('"+obj.name+"Info').innerHTML='<span class=\"wInfo\">"+warning+"</span>';")
                //该表单元素取得焦点,用通用返回函数
                GoBack(obj)  
                return false;
            }else{
				//验证通过,设置为通过
				eval("document.getElementById('"+obj.name+"Info').innerHTML='<span class=\"greenfont\">输入正确.</span>';")
			}
        }
}

function check2Pass(objA,objB){
	//objA为old,//objB为new	
	if(objA.value==objB.value){
		eval("document.getElementById('"+objA.name+"Info').innerHTML='<span class=\"greenfont\">输入正确.</span>';");
	}else{
		 eval("document.getElementById('"+objA.name+"Info').innerHTML='<span class=\"wInfo\">两次输入密码不相同</span>';");
	}
}
function check2Pass_2(idA,idB){
    var objA = document.getElementById(idA), objB = document.getElementById(idB);
    if(objA.value == objB.value){
        document.getElementById(objA.name+"Info").innerHTML = document.getElementById(objB.name+"Info").innerHTML = '<span class="greenfont">输入正确</span>';
    }else{
        document.getElementById(objA.name+"Info").innerHTML = document.getElementById(objB.name+"Info").innerHTML = '<span class="wInfo">两次输入密码不相同</span>';
    }
}


function $G(id){
	return document.getElementById(id);
}