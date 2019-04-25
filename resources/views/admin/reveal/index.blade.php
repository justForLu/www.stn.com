@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>案例展示列表</legend>
    </fieldset>
    <div class="main-toolbar">
        <div class="main-toolbar-item">
            @can('reveal.create')<a href="{!!route('admin.reveal.create')!!}" class="btn btn-sm bg-olive" title="添加案例展示" data-w="550px">添加案例展示</a>@endcan
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <form action="{!! route('admin.reveal.index') !!}" method="get" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="name" class="form-control" placeholder="案例展示名称" value="{{ isset($params['name']) ?  $params['name'] : ''}}">
                </div>
                <div class="col-sm-2">
                    <input type="text" name="author" class="form-control" placeholder="作者" value="{{ isset($params['author']) ?  $params['author'] : ''}}">
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
            <th>案例展示名称</th>
            <th>作者</th>
            <th>排序</th>
            <th>状态</th>
            <th>是否推荐</th>
            <th>阅读量</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->author}}</td>
                <td>{{$data->sort}}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>{{\App\Enums\BoolEnum::getDesc($data->is_recommend)}}</td>
                <td>{{$data->read}}</td>
                <td>
                    @can('reveal.edit')<a href="{!! route('admin.reveal.edit',array($data->id)) !!}" class="btn bg-olive btn-xs" title="编辑"><i class="fa fa-edit"></i>编辑</a>@endcan
                    {{--@can('reveal.show')<a href="{!! route('admin.reveal.show',array($data->id)) !!}" class="btn btn-info btn-xs" title="查看"><i class="fa fa-eye"></i>查看</a>@endcan--}}
                    @can('reveal.destroy')<a href="{!! route('admin.reveal.destroy',array($data->id)) !!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i>删除</a>@endcan
                </td>
            </tr>
        @endforeach
        @if(count($list) == 0)
            <tr>
                <td colspan="7">暂无数据</td>
            </tr>
        @endif
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection