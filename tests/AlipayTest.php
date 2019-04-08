<?php

namespace WannanBigPig\Alipay\Tests;

use PHPUnit\Framework\TestCase;
use WannanBigPig\Alipay\Alipay;

class AlipayTest extends TestCase
{
    public function testAppclication()
    {

        $alipay = Alipay::payment([
            'app_id'         => '2016082000295641',
            'notify_url'     => 'http://wannanbigpig.cn/notify.php',
            'return_url'     => 'http://wannanbigpig.cn/return.php',
            'ali_public_key' => '/data/wwwroot/alipay.packages.com/tests/certificate/rsa_public_key.pem',
            // 加密方式： **RSA2**
            'private_key'    => '/data/wwwroot/alipay.packages.com/tests/certificate/rsa_private_key.pem',
            'log'            => [
                // optional
                'file'     => './logs/alipay.log',
                'level'    => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
                'type'     => 'single', // optional, 可选 daily.
                'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
            ],
            'http'           => [
                // optional
                'timeout'         => 5.0,
                'connect_timeout' => 5.0,
            ],
            'mode'           => 'dev', // optional,设置此参数，将进入沙箱模式
        ])->app(['price' => 100]);
        var_dump($alipay);
        $this->assertNotEmpty($alipay);
    }

    public function testWechatGateway()
    {
        $wechat = Pay::wechat(['foo' => 'bar']);

        $this->assertInstanceOf(GatewaysInterface::class, $wechat);
    }

    /**
     * @expectedException GatewayException
     * @expectedExceptionMessage Gateway [foo] Not Exists
     */
    public function testFooGateway()
    {
        $this->expectException(GatewayException::class);
        $this->expectExceptionMessage('Gateway [foo] Not Exists');

        Pay::foo([]);
    }
}
