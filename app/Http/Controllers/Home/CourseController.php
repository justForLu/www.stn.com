<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Admin\FileController;
use App\Http\Requests\Home\CourseRequest;
use App\Repositories\Home\Criteria\CourseCriteria;
use App\Repositories\Home\CourseRepository AS Course;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class CourseController extends BaseController
{
    /**
     * @var Course
     */
    protected $course;

    public function __construct(Course $course)
    {
        parent::__construct();

        $this->course = $course;
    }

    /**
     * 教程列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();

        $this->course->pushCriteria(new CourseCriteria($params));

        $list = $this->course->paginate(Config::get('home.page_size',10));

        //处理图片
        foreach($list as $key => $value){
            $list[$key]['image_path'] = array_values(FileController::getFilePath($value['image']));
            if(count($list[$key]['image_path'])){
                $list[$key]['image_path'] = $list[$key]['image_path'][0];
            }else{
                $list[$key]['image_path'] = '';
            }
        }

        return view('home.course.index',compact('list'));
    }

    /**
     * 教程详情
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id,Request $request){
        $course = $this->course->find($id);
        return view('home.course.details',compact('course'));
    }

}




