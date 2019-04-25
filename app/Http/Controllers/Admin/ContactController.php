<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BasicEnum;
use App\Models\Admin\Contact;
use App\Http\Requests\Admin\ContactRequest;
use App\Repositories\Admin\Criteria\ContactCriteria;
use App\Repositories\Admin\ContactRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class ContactController extends BaseController
{
    /**
     * @var Contact
     */
    protected $contact;

    public function __construct(ContactRepository $category)
    {
        parent::__construct();

        $this->contact = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::first();
        $contact->content = htmlspecialchars_decode($contact->content);

        return view('admin.contact.index',compact('contact'));
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
     * @param ContactRequest $request
     */
    public function store(ContactRequest $request)
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
        $contact = $this->contact->find($id);
        $contact->content = htmlspecialchars_decode($contact->content);

        return view('admin.contact.edit',compact('contact'));
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
     */
    public function destroy($id)
    {
    }

}
