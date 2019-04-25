@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>分类列表</legend>
    </fieldset>

    <div class="main-toolbar">
        <div class="main-toolbar-item">
            @can('category.create')
                <a href="{!!route('admin.category.create')!!}" class="btn btn-sm bg-olive J_layer_dialog" title="创建分类">创建分类</a>
            @endcan
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <form action="{!! route('admin.category.index') !!}" method="get" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="name" class="form-control" placeholder="分类名称" value="{{ isset($params['name']) ?  $params['name'] : ''}}">
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
            <th>分类名称</th>
            <th>类型</th>
            <th>排序</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{\App\Enums\CategoryTypeEnum::getDesc($data->type)}}</td>
                <td>{{ $data->sort }}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>
                    @can('category.edit')<a href="{!! route('admin.category.edit',array($data->id)) !!}" class="btn bg-olive btn-xs J_layer_dialog" title="编辑分类"><i class="fa fa-edit"></i>编辑</a>@endcan
                    @can('category.destroy')
                        <a href="{!!route('admin.category.destroy',array($data->id))!!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i>删除</a>
                    @endcan
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