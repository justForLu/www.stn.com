<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class FeedbackStatusEnum extends BaseEnum {

    const PENDING   = 1;
    const DOING     = 2;
    const HANDLED   = 3;

    static $desc = array(
        'PENDING'   => '待处理',
        'DOING'     => '处理中',
        'HANDLED'   => '已处理',
    );
}
