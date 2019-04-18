@extends('admin.layout.base')

@section('content')
    <style type="text/css">
        .bichi{
            color: red;
            padding-right: 3px;
        }
    </style>
    <fieldset class="main-field main-field-title">
        <legend>添加自检内容</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <form class="J_ajaxForm" role="form" id="form" action="{!!route('admin.check_content.store')!!}" method="post">
                        <div class="box-body tab-content">
                            <div class="form-horizontal col-sm-10 tab-pane active"  style="margin:10px 20px;" id="tab1">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label"><span class="bichi">*</span>自检标题</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="title" class="form-control" placeholder="请输入自检标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="symptom" class="col-sm-3 control-label"><span class="bichi">*</span>问题症状</label>
                                    <div class="col-sm-8">
                                        <textarea name="symptom" class="form-control" placeholder="请输入问题症状"></textarea>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">问题症状最多200个字</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="details" class="col-sm-3 control-label"><span class="bichi">*</span>问题详情</label>
                                    <div class="col-sm-8">
                                        <textarea name="details" class="form-control" placeholder="请输入问题详情"></textarea>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">问题详情最多200个字</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="solve" class="col-sm-3 control-label"><span class="bichi">*</span>解决方案</label>
                                    <div class="col-sm-8">
                                        <textarea name="solve" class="form-control" placeholder="请输入解决方案"></textarea>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">解决方案最多200个字</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="prompt" class="col-sm-3 control-label">安全提示</label>
                                    <div class="col-sm-8">
                                        <textarea name="prompt" class="form-control" placeholder="请输入安全提示"></textarea>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">安全提示最多200个字</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="type_first_id" class="col-sm-3 control-label"><span class="bichi">*</span>关联类型</label>
                                    <div class="col-sm-8">
                                        <div class="col-sm-3">
                                            <select name="type_first_id" class="form-control" id="type_first_id" style="width: 100%;">
                                                <option value="">选择自检类型</option>
                                                @if(!empty($category_list))
                                                    @foreach($category_list as $data)
                                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="type_second_id" class="form-control" style="width: 100%;" id="type_second_id">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fault" class="col-sm-3 control-label">关联故障码</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="fault" class="form-control" placeholder="请输入故障码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">状态</label>
                                    <div class="col-sm-2">
                                        {{\App\Enums\BasicEnum::enumSelect(\App\Enums\BasicEnum::ACTIVE,false,'status')}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-2 col-md-1 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary J_ajax_submit_btn">提交</button>
                            </div>
                            <div class="col-xs-2 col-md-1">
                                <a href="{!! route('admin.check_content.index') !!}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            //选择自检类型
            $('#type_first_id').change(function () {
                var id = $(this).val();
                $.get('/admin/getChildrenCategory?id=' + id, function (data) {
                    var html = '';
                    if(data) {
                        html += "<option value=''>"+"选择自检类型"+"</option>";
                        $.each(data, function (index, item) {
                            html += "<option value="+item.id+">"+
                                    item.name +
                                    "</option>";
                        });
                        $("#type_second_id").html(html);
                    }
                });
            });
        });
    </script>
@endsection


