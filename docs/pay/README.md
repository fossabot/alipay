# 支付

你在阅读本文之前确认你已经仔细阅读了：[**支付宝开放平台文档**](https://docs.open.alipay.com/)

## 配置

相关配置如下：

```php
use WannanBigPig\Alipay\Alipay;

// 配置（包含支付宝的公共配置，日志配置，http配置等），下面默认值不建议修改
$config = [
    'payload'        => [
        'app_id'         => '2016092600598145',
        // 'charset'     => 'utf-8', // 默认 utf-8
        // 'sign_type'   => 'RSA2', // 默认 RSA2
        // 'version'     => '1.0',  // 默认 1.0
        'return_url'     => 'http://liuml.com/return.php',
        'notify_url'     => 'http://liuml.com/notify.php',
        // 'app_auth_token' => '', // 服务商帮助子商户调用必填，自调用商户不填
    ],
    // 支付宝公钥，可以是绝对路径（/data/***.pem）或着一行秘钥字符串
    'ali_public_key' => '******',
    // 商户私钥，可以是绝对路径（/data/***.pem）或着一行秘钥字符串
    'private_key'    => '**********',
    'log'            => [
        // optional
        'file'     => '/data/wwwroot/alipay.dev/logs/alipay.log',
        'level'    => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
        'type'     => 'daily', // optional, 可选 single.
        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
    ],
    'http'           => [
        // optional
        'timeout'         => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ],
    'env'            => 'dev', // optional[normal,dev],设置此参数，将进入沙箱模式，不传默认正式环境
    /**
     * 业务返回处理
     * 设置true， 返回码 10000 则正常返回成功数据，其他的则抛出业务异常
     * 捕获 BusinessException 异常 获取 raw 元素查看完整数据并做处理
     * 不设置默认 false
     */
    'business_exception' => false
];

$alipay = Alipay::payment($config);
```

### 单个配置设置、获取\(多维数组用点分隔\)

```php
// 设置子商户
// 子商户 token 为可选项，自调用商户无需填写
$alipay->set('payload.app_auth_token', 'app_auth_token');

// 获取当前请求环境
$alipay->get('env');
```

## 支持的方法

| method | 描述 | 支付宝API文档 |
| :---: | :---: | :---: |
| App | App支付 | alipay.trade.app.pay \(app 支付接口 2.0\) |
| faceInit | 刷脸支付 | zoloz.authentication.customer.smilepay.initialize \(人脸初始化唤起 zim\) |
| pay | pos机支付 | alipay.trade.pay \(统一收单交易支付接口\) |
| precreate | 扫码支付 | alipay.trade.precreate \(统一收单线下交易预创建\) |
| wap | 手机网站支付 | alipay.trade.wap.pay \(手机网站支付接口 2.0\) |
| pagePay | pc网站支付 | alipay.trade.page.pay \(统一收单下单并支付页面接口\) |
| create | 小程序支付 | alipay.trade.create \(统一收单交易创建接口\) |

```php
// 支付方法调用示例（ps:方法里面的参数请根据支付宝api文档传参说明传入数组格式数据）
Alipay::payment($this->config)->{$method}([...]);
```

## 错误

> 如果在调用相关支付宝网关 API 请求时有错误产生，会抛出 InvalidArgumentException错误，可以通过 $e-&gt;getMessage\(\) 查看，同时，也可通过 $e-&gt;raw 查看调用 API 后返回的原始数据，该值为数组格式。
>
> 配置项business\_exception设置为true时，支付宝返回的code只要不是10000，都会返回BusinessException错误，通过 $e-&gt;raw 查看调用 API 后返回的原始数据，该值为数组格式。
>
> 签名错误返回 SignException
>
> 调用不存在的方法返回 ApplicationException

 

## 异常

> `WannanBigPig\Supports\Exceptions\ApplicationException`，应用错误，例如调用应用中不存的方法，非支付宝错误
>
> `WannanBigPig\Supports\Exceptions\InvalidArgumentException`，参数错误， 例如参数中秘钥路径或格式不正确等
>
> `WannanBigPig\Supports\Exceptions\BusinessException`，支付宝返回业务异常或返回数据非正常结果
>
> `WannanBigPig\Alipay\Kernel\Exceptions\SignException` ，签名错误，验签失败等

 

