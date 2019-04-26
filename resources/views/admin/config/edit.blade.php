@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>网站配置编辑</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form class="J_ajaxForm" role="form" id="form" action="{!!route('admin.config.update',array('id'=>$config['id']))!!}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$config['id']}}">
                        <div class="box-body tab-content">
                            <div class="form-horizontal col-sm-10 tab-pane active"  style="margin:10px 20px;" id="tab1">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">公司名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="company" value="{{$config->company}}" class="form-control" placeholder="请输入公司名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="code" class="col-sm-3 control-label">公司微信号二维码</label>
                                    <div class="col-sm-8">
                                        <div class="J_upload_image" data-id="code" data-width="690" data-_token="{{ csrf_token() }}" data-num="1">
                                            @if(!empty($config->code))
                                                <input type="hidden" name="image_val" value="{{ $config->code }}">
                                                <input type="hidden" name="image_path[]" value="{{ $config->code_path[0] }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">建议尺寸<span style="color: #ff0000">120*120 </span>px</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">公司电话</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="phone" class="form-control" value="{{$config->phone}}" placeholder="请输入公司电话">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">公司手机号</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="mobile" class="form-control" value="{{$config->mobile}}" placeholder="请输入公司手机号">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">公司邮箱</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" class="form-control" value="{{$config->email}}" placeholder="请输入公司邮箱">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">公司微信公众号名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="wechat" class="form-control" value="{{$config->wechat}}" placeholder="请输入公司微信公众号名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">公司版权</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="copyright" class="form-control" value="{{$config->copyright}}" placeholder="请输入公司版权">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">公司地址</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="address" class="form-control" value="{{$config->address}}" placeholder="请输入公司地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">案例展示简介</label>
                                    <div class="col-sm-8">
                                        <textarea name="reveal" rows="4" class="form-control" placeholder="请输入案例展示简介">{{$config->reveal}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-2 col-md-1 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary J_ajax_submit_btn">提交</button>
                            </div>
                            <div class="col-xs-2 col-md-1">
                                <a href="{!! route('admin.config.index') !!}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

