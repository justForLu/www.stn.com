<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Enums\CategoryTypeEnum;
use App\Models\Admin\Category;
use App\Models\Admin\News;
use App\Http\Requests\Admin\NewsRequest;
use App\Repositories\Admin\Criteria\NewsCriteria;
use App\Repositories\Admin\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //新闻类别
        $category = Category::where('type', '=', CategoryTypeEnum::NEWS)->where('status', '=', BasicEnum::ACTIVE)->get();

        $list = $this->news->paginate(Config::get('admin.page_size',10));

        //处理分类名称
        foreach ($list as $key => $value){
            $category_info = Category::find($value['type']);
            $list[$key]['type'] = isset($category_info['name']) ? $category_info['name'] : '';
        }

        return view('admin.news.index',compact('params','list','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //新闻类别
        $category = Category::where('type', '=', CategoryTypeEnum::NEWS)->where('status', '=', BasicEnum::ACTIVE)->get();

        return view('admin.news.create', compact('category'));
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
        //作者
        $data['author'] = Auth::user()->username;
        $data['manager_id'] = Auth::user()->id;

        $data['content'] = htmlspecialchars_decode($data['content']);
        //创建时间
        $data['gmt_create'] = get_date();

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
        //新闻类别
        $category = Category::where('type', '=', CategoryTypeEnum::NEWS)->where('status', '=', BasicEnum::ACTIVE)->get();

        return view('admin.news.edit',compact('news','category'));
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

        $data['content'] = htmlspecialchars_decode($data['content']);

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
