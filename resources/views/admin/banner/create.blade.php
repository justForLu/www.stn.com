@extends('admin.layout.base')

@section('content')

    <fieldset class="main-field main-field-title">
        <legend>添加背景图</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">

                    <form class="J_ajaxForm" role="form" id="form" action="{!!route('admin.banner.store')!!}" method="post">
                        <div class="box-body tab-content">
                            <div class="form-horizontal col-sm-10 tab-pane active"  style="margin:10px 20px;" id="tab1">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>背景图标题</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="title" class="form-control" placeholder="请输入背景图标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="is_top" class="col-sm-3 control-label">背景图位置</label>
                                    <div class="col-sm-8">
                                        {{\App\Enums\BannerPositionEnum::enumSelect(\App\Enums\BannerPositionEnum::INDEX,false,'position')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label"><span class="must">*</span>排序</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sort" class="form-control" value="1" placeholder="请输入排序">
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">排序越小越靠前</span></div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">状态</label>
                                    <div class="col-sm-2">
                                        {{\App\Enums\BasicEnum::enumSelect(\App\Enums\BasicEnum::ACTIVE,false,'status')}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="col-sm-3 control-label"><span class="must">*</span>背景图图片</label>
                                    <div class="col-sm-8">
                                        <div class="J_upload_image" data-id="image" data-width="2000" data-_token="{{ csrf_token() }}" data-num="1">
                                        </div>
                                    </div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">首页轮播建议尺寸<span style="color: #ff0000">1920*1000 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">首页关于我们建议尺寸<span style="color: #ff0000">1920*900 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">首页产品中心建议尺寸<span style="color: #ff0000">1920*900 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">首页案例展示建议尺寸<span style="color: #ff0000">1920*1080 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">首页新闻资讯建议尺寸<span style="color: #ff0000">1920*800 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">首页联系我们建议尺寸<span style="color: #ff0000">1920*1358 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">关于我们建议尺寸<span style="color: #ff0000">1920*1000 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">产品中心建议尺寸<span style="color: #ff0000">1920*1000 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">案例展示建议尺寸<span style="color: #ff0000">1920*1000 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">新闻资讯建议尺寸<span style="color: #ff0000">1920*1000 </span>px</span></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-8"><span class="tips">联系我们建议尺寸<span style="color: #ff0000">1920*1000 </span>px</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-xs-2 col-md-1 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary J_ajax_submit_btn">提交</button>
                            </div>
                            <div class="col-xs-2 col-md-1">
                                <a href="{!! route('admin.banner.index') !!}" class="btn btn-default">取消</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection



