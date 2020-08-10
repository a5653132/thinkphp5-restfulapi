<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018/11/8
 * Time: 下午3:10
 */

namespace app\api\validate;

class TestTokenParam extends BaseValidate
{
    protected $rule = [
        'appid'       =>  'require',
        'token'      =>  'require',
        'uid'       =>  'require',
    ];

    protected $message  =   [
        'appid.require'    => 'appid不能为空',
        'token.require'    => 'token是必须的',
        'uid.require'    => '用户id不能为空',
    ];
}