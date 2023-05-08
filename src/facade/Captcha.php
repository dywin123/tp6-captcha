<?php
namespace dysix\tp6Captcha\facade;

use think\Facade;

/**
 * Class Captcha
 * @package think\captcha\facade
 * @mixin \think\captcha\Captcha
 */
class Captcha extends Facade
{
    protected static function getFacadeClass()
    {
        return \dysix\tp6Captcha\Captcha::class;
    }
}