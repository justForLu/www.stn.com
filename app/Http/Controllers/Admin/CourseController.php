<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Course;
use App\Http\Requests\Admin\CourseRequest;
use App\Repositories\Admin\Criteria\CourseCriteria;
use App\Repositories\Admin\CourseRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class CourseController extends BaseController
{
    /**
     * @var CourseRepository
     */
    protected $course;

    public function __construct(CourseRepository $course)
    {
        parent::__construct();

        $this->course = $course;
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

        $this->course->pushCriteria(new CourseCriteria($params));

        $list = $this->course->paginate(Config::get('admin.page_size',10));

        return view('admin.course.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CourseRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $data = $request->filterAll();
        //检查图片尺寸是否符合710*305 px的限制
        $image_id = isset($data['image']) ? $data['image'] : 0;
        $image_path = array_values(FileController::getFilePath($image_id));
        if(isset($image_path[0])){
            $image_path = substr($image_path[0],1);
            if(file_exists($image_path)){
                $image_info = getimagesize($image_path);
                if(isset($image_info[0]) && ($image_info[0] != 710)){
                    return $this->ajaxError('请上传宽度为710px的教程封页图片');
                }elseif(isset($image_info[1]) && ($image_info[1] != 305)){
                    return $this->ajaxError('请上传高度为305px的教程封页图片');
                }
            }
        }
        //检查图片尺寸是否符合710*305 px的限制   END
        //创建时间
        $data['gmt_create'] = get_date();

        //如果置顶了，把其他的置顶改为0
        if($data['is_top'] == 1){
            $update_data['is_top'] = 0;
            Course::where('is_top','=',1)->update($update_data);
        }

        $data = $this->course->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.course.index'));
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
        $course = $this->course->find($id);
        $course->image_path = array_values(FileController::getFilePath($course->image));
        if($course->image_path){
            $course->image = $course->image_path[0];
        }else{
            $course->image = '';
        }
        return view('admin.course.show',compact('course'));
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
        $course = $this->course->find($id);
        $course->image_path = array_values(FileController::getFilePath($course->image));
        $course['content'] = html_entity_decode($course['content']);
        return view('admin.course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CourseRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $data = $request->filterAll();
        //检查图片尺寸是否符合710*305 px的限制
        $image_id = isset($data['image']) ? $data['image'] : 0;
        $image_path = array_values(FileController::getFilePath($image_id));
        if(isset($image_path[0])){
            $image_path = substr($image_path[0],1);
            if(file_exists($image_path)){
                $image_info = getimagesize($image_path);
                if(isset($image_info[0]) && ($image_info[0] != 710)){
                    return $this->ajaxError('请上传宽度为710px的教程封页图片');
                }elseif(isset($image_info[1]) && ($image_info[1] != 305)){
                    return $this->ajaxError('请上传高度为305px的教程封页图片');
                }
            }
        }
        //检查图片尺寸是否符合710*305 px的限制   END
        //如果置顶了，把其他的置顶改为0
        if($data['is_top'] == 1){
            $update_data['is_top'] = 0;
            Course::where('is_top','=',1)->update($update_data);
        }

        $result = $this->course->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.course.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $result = $this->course->delete($id);

        return $this->ajaxAuto($result,'删除');
    }
}
