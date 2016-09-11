# laravel 云片网接口

### 配置AppKey 和SecretKey
在.env 文件中
```
	YUNPIAN_APP_KEY:云片网Appkey
	YUNPIAN_SECRET_KEY:云片网SecretKey
```
在config/app.php 配置文件中
在`providers`数组中添加
`Skyling\Yunpian\YunpianServiceProvider::class`

### 在 `aliases` 数组中添加

'Yunpian' => \Skyling\Yunpian\Facade\Yunpian::class,

### 使用:
```
	// 发送单条短信
	Yunpian::sms()->singleSend('手机号', '短信内容文本', '回调地址');
	// 发送多条短信
	Yunpian::sms()->batchSend(['手机号数组'], '短信内容文本', '回调地址');
	// 发送语音验证码
	Yunpian::voice()->voiceSend('手机号', '验证码', '回调地址');
```
