@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>反馈管理</legend>
    </fieldset>

    <div class="main-toolbar">
        <div class="main-toolbar-item">
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <form action="{!! route('admin.feedback.index') !!}" method="get" class="form-horizontal" role="form">
                <div class="col-sm-2">
                    <input type="text" name="name" class="form-control" placeholder="反馈人姓名" value="{{ isset($params['name']) ?  $params['name'] : ''}}">
                </div>
                <div class="col-sm-2">
                    <input type="text" name="mobile" class="form-control" placeholder="反馈人手机号" value="{{ isset($params['mobile']) ?  $params['mobile'] : ''}}">
                </div>
                <div class="col-sm-2">
                    <input type="text" name="email" class="form-control" placeholder="反馈人邮箱" value="{{ isset($params['email']) ?  $params['email'] : ''}}">
                </div>
                <div class="col-sm-2">
                    {{\App\Enums\FeedbackStatusEnum::enumSelect(isset($params['status']) ? $params['status'] : null,'选择状态','status')}}
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
            <th>反馈人姓名</th>
            <th>反馈人手机号</th>
            <th>反馈人邮箱</th>
            <th>反馈时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($list as $data)
            <tr>
                <td>{{ $data->name }}</td>
                <td>{{$data->mobile}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->gmt_create}}</td>
                <td>{{\App\Enums\FeedbackStatusEnum::getDesc($data->status)}}</td>
                <td>
                    @can('feedback.edit')<a href="{!! route('admin.feedback.edit',array($data->id)) !!}" class="btn bg-olive btn-xs" title="编辑反馈"><i class="fa fa-edit"></i>编辑</a>@endcan
                    @can('feedback.destroy')
                        <a href="{!!route('admin.feedback.destroy',array($data->id))!!}" class="btn btn-danger btn-xs J_layer_dialog_del" title="删除" data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i>删除</a>
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