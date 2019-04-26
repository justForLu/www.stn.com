<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class BannerPositionEnum extends BaseEnum {

    const INDEX     = 1;
    const ABOUT1     = 2;
    const PRODUCT1   = 3;
    const REVEAL1    = 4;
    const CONTACT1   = 5;
    const NEWS1      = 6;
    const ABOUT     = 7;
    const PRODUCT   = 8;
    const REVEAL    = 9;
    const CONTACT   = 10;
    const NEWS      = 11;

    static $desc = array(
        'INDEX' => '首页',
        'ABOUT1'    => '首页-关于我们',
        'PRODUCT1' => '首页-产品中心',
        'REVEAL1'    => '首页-案例展示',
        'CONTACT1' => '首页-联系我们',
        'NEWS1'    => '首页-新闻资讯',
        'ABOUT'    => '关于我们',
        'PRODUCT' => '产品中心',
        'REVEAL'    => '案例展示',
        'CONTACT' => '联系我们',
        'NEWS'    => '新闻资讯',
    );
}
