<?php
/*
* This is a new StableErrNoService.php file.
*
* (c) ivar <625079860@qq.com>
* 
* Date: 2020/7/9 下午3:40
* 
* This source file is subject to the MIT license that is bundled with this source code in the file LICENSE.
*/
namespace App\Services;

class StableErrNoService{

    CONST ERR_UN_KNOW                        = 10000001; //  未知错误
    CONST ERR_VALIDATE                       = 11000001; //  未知错误

    // 错误码和错误信息映射
    public static $errMsgMap = array(
        self::ERR_UN_KNOW                            => '未知错误',
        self::ERR_VALIDATE                           => '校验失败',
    );


}