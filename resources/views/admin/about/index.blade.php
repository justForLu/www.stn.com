@extends('admin.layout.base')

@section('content')
    <fieldset class="main-field main-field-title">
        <legend>关于我们</legend>
    </fieldset>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="form-horizontal col-sm-10"  style="margin:10px 20px;">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">关于我们展示图片</label>
                                <div class="col-sm-8 form-control-static">
                                    @foreach($about->image as $value)
                                        <div class="col-sm-3 form-control-static">
                                            <img src="{{$value}}" width="100%" height="100%">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">公司版权</label>
                                <div class="col-sm-8 form-control-static">
                                    <?php echo $about->content ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="col-sm-1">
                @can('about.edit')
                    <a href="{{ route('admin.about.edit',array($about->id)) }}" class="btn btn-default" style="background-color: #367fa9;color: #ffffff">编辑</a>
                @endcan
            </div>
        </div>
    </section>
@endsection