@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>教程管理</legend>
    </fieldset>
    <div class="main-toolbar">
        <div class="main-toolbar-item">
            @can('course.create')<a href="{!!route('admin.course.create')!!}" class="btn btn-sm bg-olive" title="添加教程" data-w="550px">添加教程</a>@endcan
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <form action="{!! route('admin.course.index') !!}" method="get" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="title" class="form-control" placeholder="教程标题" value="{{ isset($params['title']) ?  $params['title'] : ''}}">
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
            <th>ID</th>
            <th>教程标题</th>
            <th>状态</th>
            <th>排序</th>
            <th>是否置顶</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->title}}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>{{$data->sort}}</td>
                <td>{{\App\Enums\BoolEnum::getDesc($data->is_top)}}</td>
                <td>
                    {{--@can('course.edit')<a href="{!! route('admin.course.edit',array($data->id)) !!}" class="btn bg-olive btn-xs" title="编辑"><i class="fa fa-edit"></i>编辑</a>@endcan--}}
                    @can('course.show')<a href="{!! route('admin.course.show',array($data->id)) !!}" class="btn btn-info btn-xs" title="查看"><i class="fa fa-eye"></i>查看</a>@endcan
                    @can('course.destroy')<a href="{!! route('admin.course.destroy',array($data->id)) !!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i>删除</a>@endcan
                </td>
            </tr>
        @endforeach
        @if(count($list) == 0)
            <tr>
                <td colspan="6">暂无数据</td>
            </tr>
        @endif
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection