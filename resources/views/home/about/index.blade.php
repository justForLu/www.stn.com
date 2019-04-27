@extends('home.layout.base')

@section('content')
    <div class="side-html">
        <div class="side-body swiper-lazy" data-background="{{$banner['image_path']}}">
            <section class="met-show animsition">
                <div class="container">
                    <div class="row">
                        <div class="met-editor lazyload clearfix">
                            <div>
                                <?php echo $about->content ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @include('home.public.footer')     <!--引入foot文件-->
        </div>
    </div>
@endsection
