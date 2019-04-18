<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Http\Requests\Admin\ContactRequest;
use App\Repositories\Admin\Criteria\ContactCriteria;
use App\Repositories\Admin\ContactRepository as Contact;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class ContactController extends BaseController
{
    /**
     * @var Contact
     */
    protected $contact;

    public function __construct(Contact $check_category)
    {
        parent::__construct();

        $this->contact = $check_category;
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

        $this->contact->pushCriteria(new ContactCriteria($params));

        $list = $this->contact->paginate(Config::get('admin.page_size',10));

        return view('admin.contact.index',compact('params','list'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $params = $request->input();
        return view('admin.contact.create',compact('params'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContactRequest $request)
    {
        $data = $request->filterAll();

        $data = $this->contact->create($data);

        if($data){
            return $this->ajaxSuccess(null,'添加成功',route('admin.contact.index'));
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
        return view('admin.contact.show');
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

        $data = $this->contact->find($id);
        return view('admin.contact.edit',compact('data','params'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ContactRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @param ContactRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ContactRequest $request, $id)
    {
        $data = $request->filterAll();

        $result = $this->contact->update($data,$id);

        return $this->ajaxAuto($result,'修改',route('admin.contact.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $info = $this->contact->find($id);

        $result = $this->contact->delete($id);


        return $this->ajaxAuto($result,'删除');
    }

}
