<?php
/**
 *
 * Author: lifuren <frenlee@163.com>
 * Since: 16/9/11 16:03
 */

namespace Skyling\Yunpian;


class YunpianVoice extends Yunpian
{
    const SEND = 'v2/voice/send.json';

    public function voiceSend($mobile, $code, $callback=null)
    {
        return $this->send(self::SEND, compact('mobile', 'code', 'callback'))->getResponse();
    }
}