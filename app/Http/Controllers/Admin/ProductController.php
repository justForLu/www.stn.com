<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Enums\CategoryTypeEnum;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Category;
use App\Repositories\Admin\Criteria\ProductCriteria;
use App\Repositories\Admin\ProductRepository as Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class ProductController extends BaseController
{
    /**
     * @var Product
     */
    protected $product;

    public function __construct(Product $product)
    {
        parent::__construct();

        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $this->product->pushCriteria(new ProductCriteria($params));
        //产品类别
        $category = Category::where('type', '=', CategoryTypeEnum::PRODUCT)->where('status', '=', BasicEnum::ACTIVE)->get();

        $list = $this->product->paginate(Config::get('admin.page_size',10));
        //处理分类名称
        foreach ($list as $key => $value){
            $category_info = Category::find($value['type']);
            $list[$key]['type'] = isset($category_info['name']) ? $category_info['name'] : '';
        }

        return view('admin.product.index',compact('params','list','category'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //产品类别
        $category = Category::where('type', '=', CategoryTypeEnum::PRODUCT)->where('status', '=', BasicEnum::ACTIVE)->get();

        return view('admin.product.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $data = $request->filterAll();

        $data = $this->product->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.product.index'));
        }else{
            return $this->ajaxError('添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.product.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $product = $this->product->find($id);
        $product->image_path = array_values(FileController::getFilePath($product->image));
        //产品类别
        $category = Category::where('type', '=', CategoryTypeEnum::PRODUCT)->where('status', '=', BasicEnum::ACTIVE)->get();

        return view('admin.product.edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->filterAll();

        $result = $this->product->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->product->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
