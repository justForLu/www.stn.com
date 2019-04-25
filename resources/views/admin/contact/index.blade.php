@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>联系我们</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-horizontal col-sm-10"  style="margin:10px 20px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">QQ</label>
                                <div class="col-sm-8 form-control-static">
                                    {{$contact->qq}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司位置经纬度</label>
                                <div class="col-sm-8 form-control-static">
                                    <img src="{{$contact->location}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">联系我们内容</label>
                                <div class="col-sm-8 form-control-static">
                                    <?php echo $contact->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-1">
                @can('contact.edit')
                    <a href="{{ route('admin.contact.edit',array($contact->id)) }}" class="btn btn-default" style="background-color: #367fa9;color: #ffffff">编辑</a>
                @endcan
            </div>
        </div>
    </section>
@endsection