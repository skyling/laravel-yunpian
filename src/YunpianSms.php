<?php
/**
 *
 * Author: lifuren <frenlee@163.com>
 * Since: 16/9/9 00:02
 */

namespace Skyling\Yunpian;


class YunpianSms extends Yunpian
{
    // 单条发送地址
    const SINGLE_SEND = 'v2/sms/single_send.json';
    // 批量发送
    const BATCH_SEND = 'v2/sms/batch_send.json';
    // 个性化发送
    const MULTI_SEND = 'v2/sms/multi_send.json';

    /**
     * 单条发送
     * @param string $mobile 手机号
     * @param string $text 短信文本内容
     * @param string $callback 回调地址
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function singleSend($mobile, $text, $callback = null)
    {
        return $this->send(self::SINGLE_SEND, compact('mobile', 'text', 'callback'))->getResponse();
    }

    /**
     * 批量发送
     * @param array|string $mobile 群发手机号
     * @param string $text 发送文本内容
     * @param null $callback 回调地址
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function batchSend($mobile, $text, $callback = null)
    {
        $mobile = is_array($mobile) ? implode(',', $mobile) : $mobile;
        return $this->send(self::BATCH_SEND, compact('mobile', 'text', 'callback'))->getResponse();
    }

    /**
     * 个性化发送
     * @param $mobile
     * @param $text
     * @param null $callback
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function multiSend($mobile, $text, $callback = null)
    {
        $mobile = is_array($mobile) ? implode(',', $mobile) : $mobile;
        return $this->send(self::MULTI_SEND, compact('mobile', 'text', 'callback'))->getResponse();
    }
}