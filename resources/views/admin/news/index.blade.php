@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>新闻列表</legend>
    </fieldset>
    <div class="main-toolbar">
        <div class="main-toolbar-item">
            @can('news.create')<a href="{!!route('admin.news.create')!!}" class="btn btn-sm bg-olive" title="添加新闻" data-w="550px">添加新闻</a>@endcan
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <form action="{!! route('admin.news.index') !!}" method="get" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" class="form-control" placeholder="新闻标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}">
                </div>
                <div class="col-sm-2">
                    <input type="text" name="author" class="form-control" placeholder="作者" value="{{ isset($params['author']) ?  $params['author'] : ''}}">
                </div>
                <div class="col-sm-2">
                    <select name="type" class="form-control">
                        @if(isset($params['type']) && ($params['type'] == 0))
                            <option value="0" selected="selected">请选择新闻分类</option>
                        @else
                            <option value="0">请选择新闻分类</option>
                        @endif
                        @foreach($category as $value)
                            @if(isset($params['type']) && ($params['type'] == $value['id']))
                                <option value="{{$value['id']}}" selected="selected">{{$value['name']}}</option>
                            @else
                                <option value="{{$value['id']}}">{{$value['name']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\BasicEnum::enumSelect(isset($params['status']) ? $params['status'] : null,'选择状态','status')}}
                </div>
                <div class="col-sm-1">
                    <button type="submit" id="search-btn" class="btn btn-sm bg-olive">查询</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>新闻标题</th>
            <th>类别</th>
            <th>作者</th>
            <th>排序</th>
            <th>状态</th>
            <th>是否置顶</th>
            <th>阅读量</th>
            <th>发布时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->title}}</td>
                <td>{{$data->type}}</td>
                <td>{{$data->author}}</td>
                <td>{{$data->sort}}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>{{\App\Enums\BoolEnum::getDesc($data->is_top)}}</td>
                <td>{{$data->read}}</td>
                <td>{{$data->gmt_create}}</td>
                <td>
                    @can('news.edit')<a href="{!! route('admin.news.edit',array($data->id)) !!}" class="btn bg-olive btn-xs" title="编辑"><i class="fa fa-edit"></i>编辑</a>@endcan
                    @can('news.show')<a href="{!! route('admin.news.show',array($data->id)) !!}" class="btn btn-info btn-xs" title="查看"><i class="fa fa-eye"></i>查看</a>@endcan
                    @can('news.destroy')<a href="{!! route('admin.news.destroy',array($data->id)) !!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i>删除</a>@endcan
                </td>
            </tr>
        @endforeach
        @if(count($list) == 0)
            <tr>
                <td colspan="9">暂无数据</td>
            </tr>
        @endif
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection