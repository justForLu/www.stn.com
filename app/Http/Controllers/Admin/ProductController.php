<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\ProductRequest;
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

        $list = $this->product->paginate(Config::get('admin.page_size',10));

        return view('admin.product.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $params = $request->input();
        return view('admin.product.create',compact('params'));
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
        $params = $request->all();
        $params['id'] = $id;

        $data = $this->product->find($id);
        return view('admin.product.edit',compact('data','params'));
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

        //获取分类信息
        $category = $this->product->find($id);

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
        $info = $this->product->find($id);

        $result = $this->product->delete($id);


        return $this->ajaxAuto($result,'删除');
    }

}
