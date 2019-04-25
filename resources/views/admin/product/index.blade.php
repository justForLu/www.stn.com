@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>产品列表</legend>
    </fieldset>
    <div class="main-toolbar">
        <div class="main-toolbar-item">
            @can('product.create')<a href="{!!route('admin.product.create')!!}" class="btn btn-sm bg-olive" title="添加产品" data-w="550px">添加产品</a>@endcan
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <form action="{!! route('admin.product.index') !!}" method="get" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="name" class="form-control" placeholder="产品名称" value="{{ isset($params['name']) ?  $params['name'] : ''}}">
                </div>
                <div class="col-sm-2">
                    <select name="type" class="form-control">
                        @if(isset($params['type']) && ($params['type'] == 0))
                            <option value="0" selected="selected">请选择产品分类</option>
                        @else
                            <option value="0">请选择产品分类</option>
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
            <th>产品名称</th>
            <th>类别</th>
            <th>状态</th>
            <th>排序</th>
            <th>是否推荐</th>
            <th>阅读量</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->name}}</td>
                <td>{{$data->type}}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>{{$data->sort}}</td>
                <td>{{\App\Enums\BoolEnum::getDesc($data->is_recommend)}}</td>
                <td>{{$data->read}}</td>
                <td>
                    @can('product.edit')<a href="{!! route('admin.product.edit',array($data->id)) !!}" class="btn bg-olive btn-xs" title="编辑"><i class="fa fa-edit"></i>编辑</a>@endcan
{{--                    @can('product.show')<a href="{!! route('admin.product.show',array($data->id)) !!}" class="btn btn-info btn-xs" title="查看"><i class="fa fa-eye"></i>查看</a>@endcan--}}
                    @can('product.destroy')<a href="{!! route('admin.product.destroy',array($data->id)) !!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i>删除</a>@endcan
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