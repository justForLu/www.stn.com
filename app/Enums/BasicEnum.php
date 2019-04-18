<?php

namespace App\Enums;

/**
 * @method static BaseEnum ENUM()
 */
class BasicEnum extends BaseEnum {

    const ACTIVE = 1;
    const DELETE = 99;

    static $desc = array(
        'ACTIVE'=>'正常',
        'DELETE'=>'禁用',
    );
}
