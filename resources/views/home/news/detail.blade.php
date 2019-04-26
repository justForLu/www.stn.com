@extends('admin.layout.base')

@section('content')
    <section class="container mt20">
        <div class="side-html">
            <div class="side-body swiper-lazy" data-background="skin/images/1500274209.jpg">
                <section class="met-shownews animsition">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 met-shownews-body">
                                <div class="row">
                                    <div class="met-shownews-header">
                                        <h1>支付宝是如何在分布式环境下完爆数据库压力的</h1>
                                        <div class="info"><span> <i class="fa fa-clock-o"></i> 2018-04-22 14:52:38 </span>
                                            <span> <i class="fa fa-user-plus"></i> admin </span> <span> <i
                                                        class="icon wb-eye margin-right-5" aria-hidden="true"></i><script
                                                        src="/plus/count.php?view=yes&aid=160&mid=1" type='text/javascript'
                                                        language="javascript"></script> </span></div>
                                    </div>
                                    <div class="met-editor lazyload clearfix">
                                        <div><p>
                                                Zdal是支付宝自主研发的数据中间件产品，采用标准的JDBC规范，可以在分布式环境下看上去像传统数据库一样提供海量数据服务，是一种通用的分库分表数据库访问框架，解决单库单表数据库访问压力，Zdal主要提供分库分表，结果集合并，sql解析，数据库failover动态切换等功能，提供互联网金融行业的数据访问层统一解决方案，目前已经在支付宝的交易，支付，会员，金融等大部分关键应用上使用，并且在2013年双11大促中运行稳定。</p>
                                            <p>
                                                &nbsp;</p>
                                            <p>
                                                ▲系统目标</p>
                                            <p>
                                                1.数据访问路由，将针对数据的读写请求发送到最合适的地方。</p>
                                            <p>
                                                2.数据存储的自由扩展，不再受限于单台机器的容量瓶颈和速度瓶颈，平滑迁移。</p>
                                            <p>
                                                3.使用zdal组件进行数据库的拆分，搭建分布式环境下的海量数据访问平台。</p>
                                            <p>
                                                4.实现mysql，oracle，DB2数据库访问能力。</p>
                                            <p>
                                                &nbsp;</p>
                                            <p>
                                                【系统架构和领域模型】</p>
                                            <p>
                                                ▲系统整体架构</p>
                                            <p>
                                                &nbsp;</p>
                                            <p>
                                                &nbsp;</p>
                                            <p>
                                                zdal组件主要有5部分组成：</p>
                                            <p>
                                                1.
                                                Zdal-client：开发编程接口，实现jdbc的Datasource，Connection，Statement，PreparedStatement，ResultSet等接口，实现通用的jdbc-sql访问，内部还实现读库重试，group数据源的选择器，表名替换，sql执行器等功能。</p>
                                            <p>
                                                2.
                                                Zdal-parser：支持oracle/mysql/db2等数据库的sql语句解析，并且缓存。根据规则引擎提供的参数列表，在指定的sql中查找到需要的参数，然后返回拆分字段。</p>
                                            <p>
                                                3. Zdal-rule：根据zdal-parser解析后的拆分字段值来确定逻辑库和物理表名。</p>
                                            <p>
                                                4. Zdal-datasource：数据库连接的管理，支持mysql，oracle，db2数据库的连接管理。</p>
                                            <p>
                                                5. Zdal-common：zdal组件所使用的一些公共组件类。</p>


                                        </div>
                                    </div>
                                    <div class="met-shownews-footer">
                                        <ul class="pager pager-round">
                                            <li class="previous "><a disabled="true"
                                                                     href='/a/xinwenzixun/gongsixinwen/2018/0422/159.html'>上一篇：如何成为一个优秀的工程师？</a>
                                            </li>
                                            <li class="next "><a disabled="true"
                                                                 href='/a/xinwenzixun/gongsixinwen/2018/0422/161.html'>下一篇：ECMAScript
                                                    8都发布了，你还没有用上ECMAScript 6？</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="met-news-bar">
                                        <!--string(4) "news"
                      -->
                                        <div class="sidenews-lists">
                                            <h3><span>为您推荐</span></h3>
                                            <ul>

                                            </ul>
                                        </div>
                                    </div>
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
