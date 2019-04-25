<form class="form-horizontal J_ajaxForm" style="margin:10px 20px;" role="form" id="form" action="{!!route('admin.category.store')!!}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="title" class="col-sm-3 control-label"><span class="must">*</span>分类名称</label>
        <div class="col-sm-8">
            <input type="text" name="name" class="form-control" placeholder="请输入分类名称">
        </div>
    </div>
    <div class="form-group">
        <label for="status" class="col-sm-3 control-label">分类类型</label>
        <div class="col-sm-8">
            {{\App\Enums\CategoryTypeEnum::enumSelect(\App\Enums\CategoryTypeEnum::NEWS,false,'type')}}
        </div>
    </div>
    <div class="form-group">
        <label for="sort" class="col-sm-3 control-label"><span class="must">*</span>排序</label>
        <div class="col-sm-8">
            <input type="text" name="sort" class="form-control" value="1">
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-8"><span class="tips">排序越小越靠前</span></div>
    </div>
    <div class="form-group">
        <label for="status" class="col-sm-3 control-label">状态</label>
        <div class="col-sm-8">
            {{\App\Enums\BasicEnum::enumSelect(\App\Enums\BasicEnum::ACTIVE,false,'status')}}
        </div>
    </div>
    <div class="form-group hide">
        <button type="submit" class="J_ajax_submit_btn"></button>
    </div>
</form>

