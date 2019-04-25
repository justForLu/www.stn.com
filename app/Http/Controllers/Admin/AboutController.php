<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Models\Admin\About;
use App\Http\Requests\Admin\AboutRequest;
use App\Repositories\Admin\Criteria\AboutCriteria;
use App\Repositories\Admin\AboutRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class AboutController extends BaseController
{
    /**
     * @var About
     */
    protected $about;

    public function __construct(AboutRepository $about)
    {
        parent::__construct();

        $this->about = $about;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $about = About::first();
        $about->image = FileController::getFilePath($about->image);

        return view('admin.about.index',compact('about'));
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
     * @param AboutRequest $request
     */
    public function store(AboutRequest $request)
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
        $about = $this->about->find($id);
        $about->images = FileController::getFilePath($about->image);
        $about->content = htmlspecialchars_decode($about->content);

        return view('admin.about.edit',compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AboutRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AboutRequest $request, $id)
    {
        $data = $request->filterAll();
        $data['content'] = htmlspecialchars_decode($data['content']);

        $result = $this->about->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.about.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     */
    public function destroy($id)
    {
    }

}
