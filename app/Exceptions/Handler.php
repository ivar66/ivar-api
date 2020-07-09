<?php

namespace App\Exceptions;

use App\Services\StableErrNoService;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // 添加laravel validate校验失败接口的api返回
        if($request->is(['api/*','admin/*'])){
            //如果抛出的异常是 ValidationException 的实例，我们就可以确定该异常是表单验证异常
            if($exception instanceof ValidationException){
                //下面是你需要包装的数据
                return api_response([],StableErrNoService::ERR_VALIDATE,$exception->validator->errors()->first());
            }
        }

        return parent::render($request, $exception);
    }
}
