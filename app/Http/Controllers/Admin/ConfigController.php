<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Config as ConfigModel;
use App\Http\Requests\Admin\ConfigRequest;
use App\Repositories\Admin\ConfigRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ConfigController extends BaseController
{
    /**
     * @var Config
     */
    protected $config;

    public function __construct(ConfigRepository $config)
    {
        parent::__construct();

        $this->config = $config;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $config = ConfigModel::first();
        $code_path = array_values(FileController::getFilePath($config->code));
        $config->code_path = isset($code_path[0]) ? $code_path[0] : '';

        return view('admin.config.index',compact('config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
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
        $config = $this->config->find($id);
        $config->code_path = array_values(FileController::getFilePath($config->code));

        return view('admin.config.edit',compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConfigRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ConfigRequest $request, $id)
    {
        $data = $request->filterAll();

        $result = $this->config->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.config.index'));

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
