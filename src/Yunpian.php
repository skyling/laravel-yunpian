<?php
/**
 *
 * Author: lifuren <frenlee@163.com>
 * Since: 16/9/8 23:51
 */

namespace Skyling\Yunpian;


use Ender\YunPianSms\YunPianProvider;
use Laravel\Passport\Client;
use Mockery\CountValidator\Exception;
use Psr\Http\Message\ResponseInterface;

class Yunpian
{
    protected $appKey;
    protected $secretKey;
    protected $http;
    /**
     * @var ResponseInterface
     */
    protected $response;
    protected $params;
    protected $headers;

    protected $baseUri = 'http://yunpian.com/';

    public function sms()
    {
        static $instance = null;
        return $instance ?: $instance = new YunpianSms();
    }

    public function voice()
    {
        static $instance = null;
        return $instance ?: $instance = new YunpianVoice();
    }
    public function __construct($appKey = null, $secretKey = null)
    {
        $this->appKey = $appKey ?: env('YUNPIAN_APP_KEY', null);
        $this->secretKey = $secretKey ?: env('YUNPIAN_SECRET_KEY', null);
        $this->http = new \GuzzleHttp\Client(['http_errors' => false]);
        $this->params['apikey'] = $this->appKey;
        $this->headers = [
            'Accept'=>'application/json; charset=utf-8',
            'Content-Type'=>'application/x-www-form-urlencoded;charset=utf-8'
        ];
    }

    public function setAppKey($appKey)
    {
        $this->appKey = $appKey;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * 发送请求
     * @param string $address 请求地址
     * @param array $params 请求参数
     * @param string $method 请求方法 get post
     * @return $this
     * @throws \Exception
     */
    public function send($address, $params = [], $method = 'post')
    {

        $uri = $this->baseUri.$address;
        $method = strtolower($method);
        $methods = ['post' => 'form_params', 'get' => 'query'];
        if (!array_key_exists($method, $methods)) {
            throw new \Exception('method error', 500);
        }

        $this->setParams($params);
        try{
            $this->response = $this->http->$method($uri, [
                'headers' => $this->headers,
                $methods[$method] => $this->params,
            ]);
        } catch(\Exception $e){
            throw new \Exception('短信发送失败', 400);
        }
        return $this;
    }

    public function setParams(Array $params)
    {
        $this->params = array_merge($params, $this->params);
        $this->params = array_filter($this->params);
        return $this;
    }

    public function isSuccess()
    {
        return $this->response->getStatusCode() == 200;
    }

    public function getErrorInfo()
    {
        return $this->response ? $this->response->getBody() : false;
    }

    public function getResponse()
    {
        return $this->response;
    }
}