@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>教程查看</legend>
    </fieldset>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-horizontal col-sm-10"  style="margin:10px 20px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">教程标题</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$course->title}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">教程封页</label>
                                <div class="col-sm-8 form-control-static">
                                    <img src="{{$course->image}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">教程简介</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$course->introduce}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">排序</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$course->sort}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-8 form-control-static">
                                    {{\App\Enums\BasicEnum::getDesc($course->status)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否置顶</label>
                                <div class="col-sm-8 form-control-static">
                                    {{\App\Enums\BoolEnum::getDesc($course->is_top)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">发布时间</label>
                                <div class="col-sm-8 form-control-static">
                                    <video src="{{$course->video}}" controls="controls" width="300px" height="300px"></video>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">教程详情</label>
                                <div class="col-sm-8 form-control-static">
                                    <?php echo $course->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-1">
                <a href="{{ route('admin.course.index') }}" class="btn btn-default">返回</a>
            </div>
            <div class="col-sm-1">
                <a href="{{ route('admin.course.edit',array($course->id)) }}" class="btn btn-default" style="background-color: #367fa9;color: #ffffff">编辑</a>
            </div>
        </div>
    </section>
@endsection