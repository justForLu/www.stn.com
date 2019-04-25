<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\RevealRequest;
use App\Repositories\Admin\Criteria\RevealCriteria;
use App\Repositories\Admin\RevealRepository as Reveal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class RevealController extends BaseController
{
    /**
     * @var Reveal
     */
    protected $reveal;

    public function __construct(Reveal $reveal)
    {
        parent::__construct();

        $this->reveal = $reveal;
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

        $this->reveal->pushCriteria(new RevealCriteria($params));

        $list = $this->reveal->paginate(Config::get('admin.page_size',10));

        return view('admin.reveal.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.reveal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RevealRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RevealRequest $request)
    {
        $data = $request->filterAll();
        //作者
        $data['author'] = Auth::user()->username;
        $data['manager_id'] = Auth::user()->id;

        $data = $this->reveal->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.reveal.index'));
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
        return view('admin.reveal.show');
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
        $reveal = $this->reveal->find($id);
        $reveal->images = FileController::getFilePath($reveal->image);

        return view('admin.reveal.edit',compact('reveal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RevealRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RevealRequest $request, $id)
    {
        $data = $request->filterAll();

        $result = $this->reveal->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.reveal.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $result = $this->reveal->delete($id);

        return $this->ajaxAuto($result,'删除');
    }
    
}
