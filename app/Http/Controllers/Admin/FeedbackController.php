<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\FeedbackRequest;
use App\Repositories\Admin\Criteria\FeedbackCriteria;
use App\Repositories\Admin\FeedbackRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class FeedbackController extends BaseController
{
    /**
     * @var FeedbackRepository
     */
    protected $feedback;

    public function __construct(FeedbackRepository $feedback)
    {
        parent::__construct();

        $this->feedback = $feedback;
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

        $this->feedback->pushCriteria(new FeedbackCriteria($params));

        $list = $this->feedback->paginate(Config::get('admin.page_size',10));

        return view('admin.feedback.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
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
        $feedback = $this->feedback->find($id);

        return view('admin.feedback.edit',compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FeedbackRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FeedbackRequest $request, $id)
    {
        $data = $request->filterAll();

        $result = $this->feedback->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.feedback.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $result = $this->feedback->delete($id);

        return $this->ajaxAuto($result,'删除');
    }

}
