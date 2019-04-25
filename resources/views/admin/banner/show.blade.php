@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>背景图查看</legend>
    </fieldset>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-horizontal col-sm-10"  style="margin:10px 20px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">背景图标题</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$banner->title}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">背景图位置</label>
                                <div class="col-sm-8 form-control-static">
                                    {{\App\Enums\BoolEnum::getDesc($banner->position)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">排序</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$banner->sort}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-8 form-control-static">
                                    {{\App\Enums\BasicEnum::getDesc($banner->status)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">封页图片</label>
                                <div class="col-sm-8 form-control-static">
                                    <img src="{{$banner->image_path}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-1">
                <a href="{{ route('admin.banner.index') }}" class="btn btn-default">返回</a>
            </div>
            <div class="col-sm-1">
                @can('banner.edit')
                    <a href="{{ route('admin.banner.edit',array($banner->id)) }}" class="btn btn-default" style="background-color: #367fa9;color: #ffffff">编辑</a>
                @endcan
            </div>
        </div>
    </section>
@endsection