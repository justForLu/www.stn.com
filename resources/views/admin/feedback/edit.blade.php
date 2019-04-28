@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>反馈编辑</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form class="J_ajaxForm" role="form" id="form" action="{!!route('admin.feedback.update',array('id'=>$feedback['id']))!!}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$feedback['id']}}">
                        <div class="box-body tab-content">
                            <div class="form-horizontal col-sm-10 tab-pane active"  style="margin:10px 20px;" id="tab1">
                                <div class="form-group">
                                    <label for="image" class="col-sm-3 control-label">反馈人姓名</label>
                                    <div class="col-sm-8">
                                        {{$feedback->name}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">反馈人手机号</label>
                                    <div class="col-sm-8">
                                        {{$feedback->mobile}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">反馈人邮箱</label>
                                    <div class="col-sm-8">
                                        {{$feedback->email}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">反馈内容</label>
                                    <div class="col-sm-8">
                                        {{$feedback->content}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">反馈状态</label>
                                    <div class="col-sm-8">
                                        {{\App\Enums\FeedbackStatusEnum::enumSelect($feedback->status,false,'status')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">备注</label>
                                    <div class="col-sm-8">
                                        <textarea name="remarks" rows="4" class="form-control" placeholder="请输入备注">{{$feedback->remarks}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-2 col-md-1 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary J_ajax_submit_btn">提交</button>
                            </div>
                            <div class="col-xs-2 col-md-1">
                                <a href="{!! route('admin.feedback.index') !!}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection



