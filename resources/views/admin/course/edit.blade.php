@extends('admin.layout.base')

@section('content')
    <link rel="stylesheet" href="{{asset("/assets/plugins/uploadify/Huploadify.css")}}">
    <style type="text/css">
        .must{color: red; padding-right: 5px;}
    </style>
    <fieldset class="main-field main-field-title">
        <legend>教程编辑</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form class="J_ajaxForm" role="form" id="form" action="{!!route('admin.course.update',array('id'=>$course['id']))!!}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$course['id']}}">
                        <div class="box-body tab-content">
                            <div class="form-horizontal col-sm-10 tab-pane active"  style="margin:10px 20px;" id="tab1">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>教程标题</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="title" value="{{$course->title}}" class="form-control" placeholder="请输入教程标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-3 control-label"><span class="must">*</span>教程封页</label>
                                    <div class="col-sm-8">
                                        <div class="J_upload_image" data-id="image" data-width="710" data-_token="{{ csrf_token() }}">
                                            @if(!empty($course->image))
                                                <input type="hidden" name="image_val" value="{{ $course->image }}">
                                                <input type="hidden" name="image_path[]" value="{{ $course->image_path[0] }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">只允许上传一张图片，图片尺寸限制为<span style="color: #ff0000">710*305 </span>px</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>教程简介</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="introduce" class="form-control" value="{{$course->introduce}}" placeholder="请输入简介">
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">教程简介最多20个字</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>排序</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sort" class="form-control" value="{{$course->sort}}" placeholder="请输入排序">
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">排序越小越靠前</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">状态</label>
                                    <div class="col-sm-2">
                                        {{\App\Enums\BasicEnum::enumSelect($course->status,false,'status')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_top" class="col-sm-3 control-label">是否置顶</label>
                                    <div class="col-sm-8">
                                        {{\App\Enums\BoolEnum::enumRadio($course->is_top,'is_top')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file" class="col-sm-3 control-label">教程视频</label>
                                    <div class="col-sm-8">
                                        <div id="upload"></div>
                                        <div id="file_upload-queue"></div>
                                        @if($course->video)
                                            <video src="{{$course->video}}" controls="controls" width="300px" height="300px"></video>
                                        @endif
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">只允许上传一个文件</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="billing" class="col-sm-3 control-label"><span class="must">*</span>教程详情</label>
                                    <div class="col-sm-8">
                                        <script type="text/plain" name="content" id="editor" style="font-size:10px;width:100%;height:240px;">
                                            <?php echo $course->content ?>
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
                                <a href="{!! route('admin.course.index') !!}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset("/assets/plugins/uploadify/jquery.Huploadify.js")}}"></script>
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
<script type="text/javascript">
    $(function(){
        $('#upload').Huploadify({
            auto:true,
            fileTypeExts:'*.mp4;*.avi;*.wmv;*.mov;*.asf;*.rmvb;*.mkv;*.rm;*.MP4;*.AVI;*.WMV;*.MOV;*.ASF;*.RMVB;*.MKV;*.RM',
            multi:true,
            formData:{'_token': '{{csrf_token()}}'},
            fileSizeLimit:9999,
            showUploadedPercent:true,//是否实时显示上传的百分比，如20%
            showUploadedSize:true,
            removeTimeout:9999999,
            uploader:'/admin/file/uploadFile',
            onUploadStart:function(){
                //alert('开始上传');
            },
            onInit:function(){
                //alert('初始化');
            },
            onUploadComplete:function(file, data, response){
                //alert('上传完成');
                //如果上传多个，删除上一个
                var len = $('.uploadify-queue-item').length;
                if(len > 1){
                    $('.uploadify-queue-item').eq(0).remove();
                }
                //如果上传了，删除原来的video
                $('.col-sm-8').children('video').remove();
                //处理返回的数据
                data = data.replace(/[\\]/g,'').replace('"','').replace('"','');
                var html = "<input type='hidden' name='video' value="+data+">";
                $('#file_upload-queue').html(html);
            },
            onDelete:function(file){
                console.log('删除的文件：'+file);
                console.log(file);
                $('#file_upload-queue').remove(html);
            }
        });
    });
</script>
@endsection

