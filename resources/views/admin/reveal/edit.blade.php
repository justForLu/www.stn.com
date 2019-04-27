@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>新闻编辑</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <form class="J_ajaxForm" role="form" id="form" action="{!!route('admin.reveal.update',array('id'=>$reveal['id']))!!}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$reveal['id']}}">
                        <div class="box-body tab-content">
                            <div class="form-horizontal col-sm-10 tab-pane active"  style="margin:10px 20px;" id="tab1">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>案例展示名称</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="name" value="{{$reveal->name}}" class="form-control" placeholder="请输入案例展示名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cover" class="col-sm-3 control-label">案例展示封面图片</label>
                                    <div class="col-sm-8">
                                        <div class="J_upload_image" data-id="cover" data-width="690" data-_token="{{ csrf_token() }}" data-num="1">
                                            @if(!empty($reveal->cover))
                                                <input type="hidden" name="image_val" value="{{ $reveal->cover }}">
                                                <input type="hidden" name="image_path[]" value="{{ $reveal->cover_path[0] }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">建议尺寸<span style="color: #ff0000">540*390 </span>px</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-3 control-label"><span class="must">*</span>案例展示图片</label>
                                    <div class="col-sm-8">
                                        <div class="J_upload_image" data-id="image" data-width="690" data-_token="{{ csrf_token() }}" data-type="multiple" data-num="5">
                                            @if(!empty($reveal->images))
                                                @foreach($reveal->images as $key => $value )
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
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>排序</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sort" class="form-control" value="{{$reveal->sort}}" placeholder="请输入排序">
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">排序越小越靠前</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">状态</label>
                                    <div class="col-sm-2">
                                        {{\App\Enums\BasicEnum::enumSelect($reveal->status,false,'status')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_top" class="col-sm-3 control-label">是否推荐</label>
                                    <div class="col-sm-8">
                                        {{\App\Enums\BoolEnum::enumRadio($reveal->is_recommend,'is_recommend')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>阅读量</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="read" class="form-control" value="{{$reveal->read}}" placeholder="请输入阅读量">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-2 col-md-1 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary J_ajax_submit_btn">提交</button>
                            </div>
                            <div class="col-xs-2 col-md-1">
                                <a href="{!! route('admin.reveal.index') !!}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection


