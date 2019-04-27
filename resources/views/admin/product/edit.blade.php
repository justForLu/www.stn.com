@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>产品编辑</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form class="J_ajaxForm" role="form" id="form" action="{!!route('admin.product.update',array('id'=>$product['id']))!!}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$product['id']}}">
                        <div class="box-body tab-content">
                            <div class="form-horizontal col-sm-10 tab-pane active"  style="margin:10px 20px;" id="tab1">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>产品名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" value="{{$product->name}}" class="form-control" placeholder="请输入产品名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">产品分类</label>
                                    <div class="col-sm-8">
                                        <select name="type" class="form-control">
                                            @foreach($category as $value)
                                                @if(isset($product['type']) && ($product['type'] == $value['id']))
                                                    <option value="{{$value['id']}}" selected="selected">{{$value['name']}}</option>
                                                @else
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-3 control-label"><span class="must">*</span>产品展示图片</label>
                                    <div class="col-sm-8">
                                        <div class="J_upload_image" data-id="image" data-width="690" data-_token="{{ csrf_token() }}" data-num="1">
                                            @if(!empty($product->image))
                                                <input type="hidden" name="image_val" value="{{ $product->image }}">
                                                <input type="hidden" name="image_path[]" value="{{ $product->image_path[0] }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">建议尺寸<span style="color: #ff0000">640*460 </span>px</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>产品简介</label>
                                    <div class="col-sm-8">
                                        <textarea name="synopsis" rows="4" class="form-control" placeholder="请输入产品简介">{{$product->synopsis}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="picture" class="col-sm-3 control-label"><span class="must">*</span>案例展示图片</label>
                                    <div class="col-sm-8">
                                        <div class="J_upload_image" data-id="picture" data-width="690" data-_token="{{ csrf_token() }}" data-type="multiple" data-num="5">
                                            @if(!empty($product->pictures))
                                                @foreach($product->pictures as $key => $value )
                                                    <input type="hidden" name="image_val" value="{{ $key }}">
                                                    <input type="hidden" name="image_path[]" value="{{ $value }}">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">建议尺寸<span style="color: #ff0000">690*284 </span>px</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">排序</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sort" class="form-control" value="{{$product->sort}}" placeholder="请输入排序">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">阅读量</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="read" class="form-control" value="{{$product->read}}" placeholder="请输入阅读量">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">状态</label>
                                    <div class="col-sm-2">
                                        {{\App\Enums\BasicEnum::enumSelect($product->status,false,'status')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_top" class="col-sm-3 control-label">是否推荐</label>
                                    <div class="col-sm-8">
                                        {{\App\Enums\BoolEnum::enumRadio($product->is_top,'is_recommen')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">联系我们内容</label>
                                    <div class="col-sm-8">
                                        <script type="text/plain" name="content" id="editor" style="font-size:10px;width:100%;height:400px;">
                                            <?php echo $product->content ?>
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-2 col-md-1 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary J_ajax_submit_btn">提交</button>
                            </div>
                            <div class="col-xs-2 col-md-1">
                                <a href="{!! route('admin.product.index') !!}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset("/assets/plugins/ueditor/ueditor.config.js")}}"></script>
    <script src="{{asset("/assets/plugins/ueditor/ueditor.all.min.js")}}"></script>
    <script src="{{asset("/assets/plugins/ueditor/lang/zh-cn/zh-cn.js")}}"></script>
<script type="text/javascript">
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('editor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
        alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }

</script>
@endsection

