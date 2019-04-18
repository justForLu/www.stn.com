<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\News;
use App\Http\Requests\Admin\NewsRequest;
use App\Repositories\Admin\Criteria\NewsCriteria;
use App\Repositories\Admin\NewsRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class NewsController extends BaseController
{
    /**
     * @var NewsRepository
     */
    protected $news;

    public function __construct(NewsRepository $news)
    {
        parent::__construct();

        $this->news = $news;
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

        $this->news->pushCriteria(new NewsCriteria($params));

        $list = $this->news->paginate(Config::get('admin.page_size',10));

        return view('admin.news.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsRequest $request)
    {
        $data = $request->filterAll();
        //检查图片尺寸是否符合690*284 px的限制
        $image_id = isset($data['image']) ? $data['image'] : 0;
        $image_path = array_values(FileController::getFilePath($image_id));
        if(isset($image_path[0])){
            $image_path = substr($image_path[0],1);
            if(file_exists($image_path)){
                $image_info = getimagesize($image_path);
                if(isset($image_info[0]) && ($image_info[0] != 690)){
                    return $this->ajaxError('请上传宽度为690px的封页图片');
                }elseif(isset($image_info[1]) && ($image_info[1] != 284)){
                    return $this->ajaxError('请上传高度为284px的封页图片');
                }
            }
        }
        //检查图片尺寸是否符合690*284 px的限制   END
        $data['content'] = htmlspecialchars_decode($data['content']);
        //创建时间
        $data['gmt_create'] = get_date();
        //如果是立即发布，将发布时间设为0（为防止gmt_release会有值）
        if($data['release_type'] == 2){
            $data['gmt_release'] = 0;
        }else{
            $data['gmt_create'] = $data['gmt_release'];
        }
        //如果置顶了，把其他的置顶改为0
        if($data['is_top'] == 1){
            $update_data['is_top'] = 0;
            News::where('is_top','=',1)->update($update_data);
        }

        $result = $this->news->create($data);

        if($result){
            return $this->ajaxSuccess(null,'添加成功',route('admin.news.index'));
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
        $news = $this->news->find($id);
        $news->image_path = array_values(FileController::getFilePath($news->image));
        if($news->image_path){
            $news->image = $news->image_path[0];
        }else{
            $news->image = '';
        }
        if($news->release_type == 1){
            $news->release = $news->gmt_create;
        }else{
            $news->release = '立即发布';
        }

        return view('admin.news.show',compact('news'));
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
        $news = $this->news->find($id);
        $news->image_path = array_values(FileController::getFilePath($news->image));
        $news->content = htmlspecialchars_decode($news->content);
        return view('admin.news.edit',compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NewsRequest $request, $id)
    {
        $data = $request->filterAll();
        //检查图片尺寸是否符合690*284 px的限制
        $image_id = isset($data['image']) ? $data['image'] : 0;
        $image_path = array_values(FileController::getFilePath($image_id));
        if(isset($image_path[0])){
            $image_path = substr($image_path[0],1);
            if(file_exists($image_path)){
                $image_info = getimagesize($image_path);
                if(isset($image_info[0]) && ($image_info[0] != 690)){
                    return $this->ajaxError('请上传宽度为690px的封页图片');
                }elseif(isset($image_info[1]) && ($image_info[1] != 284)){
                    return $this->ajaxError('请上传高度为284px的封页图片');
                }
            }
        }
        //检查图片尺寸是否符合690*284 px的限制   END
        $data['content'] = htmlspecialchars_decode($data['content']);
        //修改时间
        $data['gmt_update'] = get_date();
        //如果是立即发布，将发布时间设为0（为防止gmt_release会有值）
        if($data['release_type'] == 2){
            $data['gmt_release'] = 0;
        }else{
            $data['gmt_create'] = $data['gmt_release'];
        }

        //如果置顶了，把其他的置顶改为0
        if($data['is_top'] == 1){
            $update_data['is_top'] = 0;
            News::where('is_top','=',1)->update($update_data);
        }

        $result = $this->news->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        $result = $this->news->delete($id);

        return $this->ajaxAuto($result,'删除');
    }
}
