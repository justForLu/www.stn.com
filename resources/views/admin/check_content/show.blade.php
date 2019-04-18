@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>自检内容查看</legend>
    </fieldset>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-horizontal col-sm-10"  style="margin:10px 20px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">自检标题</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$check_content->title}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">问题症状</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$check_content->symptom}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">问题详情</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$check_content->details}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">解决方案</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$check_content->solve}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">安全提示</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$check_content->prompt}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">关联类型</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$check_content->type_first->name}} — {{$check_content->type_second->name}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">关联故障码</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$check_content->fault}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-8 form-control-static">
                                    {{\App\Enums\BasicEnum::getDesc($check_content->status)}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-1">
                <a href="{{ route('admin.check_content.index') }}" class="btn btn-default">返回</a>
            </div>
            <div class="col-sm-1">
                <a href="{{ route('admin.check_content.edit',array($check_content->id)) }}" class="btn btn-default" style="background-color: #367fa9;color: #ffffff">编辑</a>
            </div>
        </div>
    </section>
@endsection