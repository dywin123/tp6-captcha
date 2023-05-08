<?php

use think\captcha\facade\Captcha;
use think\Response;

/**
 * @param string $config
 * @return \think\Response
 */
function captcha($id, $config = null): Response
{
    return Captcha::create($config, $id);
}

/**
 * @param string $value
 * @return bool
 */
function captcha_check($value, $id)
{
    return Captcha::check($value, $id);
}
