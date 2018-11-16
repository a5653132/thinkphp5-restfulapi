<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018/11/8
 * Time: 下午10:57
 */

namespace app\lib\exception;

class BannerMIssException extends BaseException
{
    // miss的错误码
    public $code = 404;
    public $msg = '请求的 banner 不存在';
    public $errorCode = 40000;
}