@extends('admin.layout.base')

@section('content')
    <section class="container mt20">
        <div class="side-html">
            <div class="side-body swiper-lazy" data-background="skin/images/1500274209.jpg">
                <section class="met-show animsition">
                    <div class="container">
                        <div class="row">
                            <div class="met-editor lazyload clearfix">
                                <div>
                                    <div id="map" style="height:410px" coordinate="116.299049,40.105524"></div>
                                    <p>
                                        &nbsp;</p>
                                    <p class="b">
                                        San tou niu (Beijing) Technology Co., Ltd.</p>
                                    <p class="p">
                                        <em>三头牛</em>（北京）科技有限公司</p>
                                    <p>
                                        三头牛（北京）科技有限公司（San tou niu (Beijing) Technology Co.,
                                        Ltd.）成立于2018年5月，凭借拔尖的团队、优秀的业务能力，三头牛迅速成长为国内SEO的领军者。我们专注网络营销业务，助力您的企业腾飞。同时，我们还拥有一支健全的建站团队，向外界承接APP应用开发/微网站/公众号策划营销等业务。</p>
                                    <div class="contact-bin">
                                        <h3>
                                            全国统一服务热线：010-57121206</h3>
                                        <p>
                                            北京市昌平区北清路珠江摩尔大厦5号楼1单元209</p>
                                        <p>
                                            (010)57121206 / (+86) 13366148085</p>
                                        <p>
                                            stn@stn.bj.cn</p>
                                        <p>
                                            &nbsp;</p>
                                    </div>

                                </div>
                                <div class="message-subpage">
                                    <h4>给我们留言</h4>
                                    <form class="met-form met-form-validation" action="/plus/diy.php"
                                          enctype="multipart/form-data" method="post">
                                        <input type="hidden" name="action" value="post"/>
                                        <input type="hidden" name="diyid" value="1"/>
                                        <input type="hidden" name="do" value="2"/>
                                        <input type="hidden" name="lang" value="cn">
                                        <div class="form-group ftype_input">
                                            <div>
                                                <input name='name' class='form-control' type='text' placeholder='姓名 '
                                                       data-fv-notempty="true" data-fv-message="不能为空"/>
                                            </div>
                                        </div>
                                        <div class="form-group ftype_input">
                                            <div>
                                                <input name='tel' class='form-control' type='text' placeholder='电话 '
                                                       data-fv-notempty="true" data-fv-message="不能为空"/>
                                            </div>
                                        </div>
                                        <div class="form-group ftype_input">
                                            <div>
                                                <input name='email' class='form-control' type='text' placeholder='邮箱 '
                                                       data-fv-notempty="true" data-fv-message="不能为空"/>
                                            </div>
                                        </div>
                                        <div class="form-group ftype_textarea">
                                            <div>
                                            <textarea name='content' class='form-control' data-fv-notempty="true"
                                                      data-fv-message="不能为空" placeholder='内容 ' rows='5'></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name="dede_fields"
                                               value="name,text;tel,text;email,text;content,multitext"/>
                                        <input type="hidden" name="dede_fieldshash"
                                               value="1c08631f19e10f279f177ef8d596b755"/>
                                        <div class="submint">
                                            <button type="submit" class="btn btn-primary btn-block btn-squared more-box">
                                                <span>提 交</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @include('admin.public.footer')     <!--引入foot文件-->
            </div>
        </div>
    </section>
@endsection
