@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>网站配置</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-horizontal col-sm-10"  style="margin:10px 20px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司名称</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$config->company}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司微信号二维码</label>
                                <div class="col-sm-8 form-control-static">
                                    <img src="{{$config->code_path}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司电话</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$config->phone}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司手机号</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$config->mobile}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司微信公众号名称</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$config->wechat}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司版权</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$config->copyright}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司地址</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$config->address}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">案例展示简介</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$config->reveal}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-1">
                @can('config.edit')
                    <a href="{{ route('admin.config.edit',array($config->id)) }}" class="btn btn-default" style="background-color: #367fa9;color: #ffffff">编辑</a>
                @endcan
            </div>
        </div>
    </section>
@endsection