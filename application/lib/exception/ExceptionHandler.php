<?php
/**
 * Created by PhpStorm.
 * User: macbookair
 * Date: 2018/11/8
 * Time: 下午4:21
 */

namespace app\lib\exception;
use think\exception\Handle;
use think\facade\Log;
use think\facade\Env;

class ExceptionHandler extends Handle {

    private $code;  // HTTP 状态码
    private $msg;
    private $errorCode;


    public function render(\Exception $e) {
        //自定义异常
        if($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else {
            // 如果是服务器未处理的异常，将http状态码设置为500，并记录日志
            if(config('app_debug')){
                // 调试状态下需要显示TP默认的异常页面，因为TP的默认页面
                // 很容易看出问题
                return parent::render($e);
            }
            $this->code = 500;
            $this->msg = $e->getMessage();
            $this->errorCode = 999;
            $this->recordErrorLog($e);
        }

        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => request()->url(),
        ];

        return json($result, $this->code);
    }

    /*
    * 将异常写入日志
    */
    private function recordErrorLog($e)
    {
        Log::init([
            'type'  =>  'File',
            'path'  =>  Env::get('app_path').'logs',
            'level' => [],
            'close'       => true,
        ]);
        Log::write($e->getMessage(),'error');
    }
}