<form class="form-horizontal J_ajaxForm" style="margin:10px 20px;" role="form" id="form" action="{!!route('admin.check_category.store')!!}" method="post" onkeydown="if(event.keyCode==13)return false;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="parent" value="{{ isset($params['parent']) ? $params['parent'] : 0 }}">

    <div class="form-group">
        <label for="title" class="col-sm-3 control-label">自检类型</label>
        <div class="col-sm-8">
            <input type="text" name="name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="status" class="col-sm-3 control-label">状态</label>
        <div class="col-sm-8">
            {{\App\Enums\BasicEnum::enumSelect(\App\Enums\BasicEnum::ACTIVE,false,'status')}}
        </div>
    </div>
    <div class="form-group">
        <label for="sort" class="col-sm-3 control-label">排序</label>
        <div class="col-sm-8">
            <input type="text" name="sort" class="form-control" value="1">
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-8"><span class="tips">排序越小越靠前</span></div>
    </div>
    <div class="form-group hide">
        <button type="submit" class="J_ajax_submit_btn"></button>
    </div>
</form>

