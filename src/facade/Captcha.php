<?php
namespace Dysix\Tp6Captcha\facade;

use think\Facade;

class Captcha extends Facade
{
    protected static function getFacadeClass()
    {
        return \Dysix\Tp6Captcha\Captcha::class;
    }
}
