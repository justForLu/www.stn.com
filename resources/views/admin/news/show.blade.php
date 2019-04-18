@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>新闻查看</legend>
    </fieldset>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-horizontal col-sm-10"  style="margin:10px 20px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">新闻标题</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$news->title}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">封页图片</label>
                                <div class="col-sm-8 form-control-static">
                                    <img src="{{$news->image}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">新闻简介</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$news->introduce}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态</label>
                                <div class="col-sm-8 form-control-static">
                                    {{\App\Enums\BasicEnum::getDesc($news->status)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">是否置顶</label>
                                <div class="col-sm-8 form-control-static">
                                    {{\App\Enums\BoolEnum::getDesc($news->is_top)}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">发布时间</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$news->release}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">新闻详情</label>
                                <div class="col-sm-8 form-control-static">
                                    <?php echo $news->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-1">
                <a href="{{ route('admin.news.index') }}" class="btn btn-default">返回</a>
            </div>
            <div class="col-sm-1">
                <a href="{{ route('admin.news.edit',array($news->id)) }}" class="btn btn-default" style="background-color: #367fa9;color: #ffffff">编辑</a>
            </div>
        </div>
    </section>
@endsection