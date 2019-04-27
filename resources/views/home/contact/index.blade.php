@extends('home.layout.base')

@section('content')
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="{{$banner['image_path']}}">
            <section class="met-show animsition">
                <div class="container">
                    <div class="row">
                        <div class="met-editor lazyload clearfix">
                            <div>
                                <div id="map" style="height:410px" coordinate="{{$contact->location}}"></div>
                                <div class="contact-content" style=" margin-top: 30px;">
                                    <?php echo $contact->content ?>
                                </div>
                                <div class="contact-bin">
                                    <h3>
                                        全国统一服务热线：{{$config->phone}}
                                    </h3>
                                    <p>
                                        {{$config->address}}
                                    </p>
                                    <p>
                                        {{$config->phone}} / (+86) {{$config->mobile}}</p>
                                    <p>
                                        {{$config->email}}
                                    </p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="message-subpage">
                                <h4>给我们留言</h4>
                                <form class="met-form met-form-validation" action="{!! url('/home/contact/feedback') !!}" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <input name='name' class='form-control' type='text' placeholder='姓名' data-fv-notempty="true" data-fv-message="姓名不能为空"/>
                                        </div>
                                    </div>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <input name='mobile' class='form-control' type='text' placeholder='联系方式' data-fv-notempty="true" data-fv-message="联系方式不能为空"/>
                                        </div>
                                    </div>
                                    <div class="form-group ftype_input">
                                        <div>
                                            <input name='email' class='form-control' type='text' placeholder='邮箱' data-fv-notempty="true" data-fv-message="邮箱不能为空"/>
                                        </div>
                                    </div>
                                    <div class="form-group ftype_textarea">
                                        <div>
                                            <textarea name='content' class='form-control' data-fv-notempty="true" data-fv-message="内容不能为空" placeholder='内容 ' rows='5'></textarea>
                                        </div>
                                    </div>
                                    <div class="submint">
                                        <button type="submit" class="btn btn-primary btn-block btn-squared more-box">
                                            <span>提 交</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @include('home.public.footer')     <!--引入foot文件-->
        </div>
    </div>
@endsection
