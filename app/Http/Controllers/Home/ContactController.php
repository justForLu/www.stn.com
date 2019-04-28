<?php
namespace App\Http\Controllers\Home;

use App\Enums\BannerPositionEnum;
use App\Enums\BasicEnum;
use App\Enums\FeedbackStatusEnum;
use App\Http\Controllers\Admin\FileController;
use App\Models\Home\Banner;
use App\Models\Home\Contact;
use App\Http\Requests\Home\ContactRequest;
use App\Models\Home\Feedback;

class ContactController extends BaseController
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 联系我们
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $contact = Contact::first();
        $contact->content = htmlspecialchars_decode($contact->content);
        //联系我们的banner
        $banner = Banner::where('status','=',BasicEnum::ACTIVE)
            ->where('position','=',BannerPositionEnum::CONTACT)
            ->orderBy('sort','ASC')
            ->first();
        if($banner){
            $banner->toArray();
            $banner_image = array_values(FileController::getFilePath($banner['image']));
            $banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';
        }else{
            $banner = array();
            $banner['image_path'] = '';
        }

        return view('home.contact.index',compact('contact','banner'));
    }

    /**
     * 联系我们提交反馈或意见
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function feedback(ContactRequest $request){
        $data = $request->only('name','mobile','email','content');
        $data['status'] = FeedbackStatusEnum::PENDING;

        $result = Feedback::create($data);

        if($result){
            return view('home.public.message');
        }else{
            return view('home.public.message');
        }

    }
}




