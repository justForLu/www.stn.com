@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>自检手册分类</legend>
    </fieldset>

    <div class="main-toolbar">
        <div class="main-toolbar-item">
            @if(isset($params['parent']) && $params['parent'] > 0)
                @can('check_category.create')<a href="{!!route('admin.check_category.create',array('parent'=>isset($params['parent']) ?  $params['parent'] : 0))!!}" class="btn btn-sm bg-olive J_layer_dialog" title="创建自检分类">创建自检分类</a>@endcan
                <a href="javascript:history.back();" class="btn btn-sm bg-olive"><i class="fa fa-reply" aria-hidden="true"></i></a>
            @endif
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <form action="{!! route('admin.check_category.index') !!}" method="get" class="form-horizontal" role="form">
                <input type="hidden" name="parent" value="{{ isset($params['parent']) ?  $params['parent'] : ''}}">
                <div class="col-sm-2">
                    <input type="text" name="name" class="form-control" placeholder="自检类型" value="{{ isset($params['name']) ?  $params['name'] : ''}}">
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
            <th>自检类型</th>
            <th>状态</th>
            <th>排序</th>
            @if ( isset( $list[0]->grade ) ? ( $list[0]->grade < 2) : 0)
                <th>子级</th>
            @endif
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{\App\Enums\BasicEnum::getDesc($data->status)}}</td>
                <td>{{ $data->sort }}</td>
                @if ( isset($data->grade ) ? ($data->grade < 2) : 0)
                <td>
                    <a href="{!! route('admin.check_category.index',['parent' => $data->id ]) !!}">[子级区域]</a>
                </td>
                @endif
                <td>
                    @can('check_category.edit')<a href="{!! route('admin.check_category.edit',array($data->id)) !!}" class="btn bg-olive btn-xs J_layer_dialog" title="编辑自检分类"><i class="fa fa-edit"></i>编辑</a>@endcan
                    @can('check_category.destroy')
                        @if(isset($params['parent']) && $params['parent'] > 0)
                            <a href="{!!route('admin.check_category.destroy',array($data->id))!!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除" data-msg="该分类下的自检内容也将被删除，确定删除吗？" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i>删除</a>
                        @endif
                    @endcan
                </td>
            </tr>
        @endforeach
        @if(count($list) == 0)
            <tr>
                <td colspan="5">暂无数据</td>
            </tr>
        @endif
        </tbody>
    </table>
    @include('admin.public.pages')
@endsection