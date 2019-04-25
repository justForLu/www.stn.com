<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class BannerPositionEnum extends BaseEnum {

    const INDEX     = 1;
    const ABOUT     = 2;
    const PRODUCT   = 3;
    const REVEAL    = 4;
    const CONTACT   = 5;
    const NEWS      = 6;

    static $desc = array(
        'INDEX' => '首页',
        'ABOUT'    => '关于我们',
        'PRODUCT' => '产品中心',
        'REVEAL'    => '案例展示',
        'CONTACT' => '联系我们',
        'NEWS'    => '新闻资讯',
    );
}
