@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>角色管理</legend>
    </fieldset>

    <div class="main-toolbar">
        <div class="main-toolbar-item">
            @can('role.create')<a href="{!!route('admin.role.create',array('module'=>$params['module']))!!}" class="btn btn-sm bg-olive J_layer_dialog" title="添加角色">添加角色</a>@endcan
        </div>
    </div>

    <div class="box">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                @foreach($modules as $module)
                    <li @if($params['module'] == $module['key'])class="active"@endif><a href="{!!route('admin.role.index',array('module'=>$module['key']))!!}">{{$module['value']}}角色</a></li>
                @endforeach
            </ul>
        </div>

        <div class="box-header">
        <form method="get" action="{!! route('admin.role.index') !!}" class="form-horizontal" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="module" value="{{$params['module']}}">
            <label class="col-sm-1 control-label">角色名称</label>
            <div class="col-sm-2">
                <input type="text" name="name" autocomplete="off" class="form-control" placeholder="角色名称" value="{{ isset($params['name']) ?  $params['name'] : ''}}">
            </div>

            <div class="col-sm-1">
                <button type="submit" class="btn bg-olive">搜索</button>
            </div>
        </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>角色名称</th>
            <th>角色描述</th>
            <th>系统角色</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->desc}}</td>
                <td>{{\App\Enums\BoolEnum::getDesc($data->is_system)}}</td>
                <td>{{$data->gmt_create}}</td>
                <td>
                    @can('role.edit')<a href="{!!route('admin.role.edit',array($data->id))!!}" class="btn bg-olive btn-xs J_layer_dialog" title="编辑"><i class="fa fa-pencil"></i> 编辑</a>@endcan
                    @if(!$data->is_system)
                        @if($data->parent == Auth::user()->roles[0]->id)
                            @can('role.authority')<a href="{{url('admin/role/authority',array($data->id))}}" class="btn btn-info btn-xs layui-btn-normal" title="授权"><i class="fa fa-check-square-o"></i>授权</a>@endcan
                        @endif
                        @can('role.destroy')<a href="{!!route('admin.role.destroy',array($data->id))!!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除"><i class="fa fa-trash-o"></i>删除</a>@endcan
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('admin.public.pages')

@endsection