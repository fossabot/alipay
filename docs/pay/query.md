# 查询

## 调用示例

```php
$result = $alipay->query->{$method}([
    'out_trade_no'   => 'lml20190412102647828487120',
    // ...
]);

// 返回值 WannanBigPig\Supports\AccessData 实现了接口（IteratorAggregate, ArrayAccess, Serializable, Countable）
// 直接 echo 或者调用$result->toJson()方法则返回json字符串
// echo $result['code']; // 10000
echo $result;

```

### 传入参数说明

所有参数请参考查询方法中的对应支付宝方法，查看「请求参数」一栏。

### 返回参数

与支付宝返回参数一致\(经过签名验证，剔除了支付宝返回的签名，只保留支付宝接口返回的业务数据\)。

## 支持的方法（method）

本sdk已经集成了以下几种查询，支付相关的查询类接口统一调用方法

### trade

alipay.trade.query \([统一收单线下交易查询](https://docs.open.alipay.com/api_1/alipay.trade.query/)\) 

> 该接口提供所有支付宝支付订单的查询，商户可以通过该接口主动查询订单状态，完成下一步的业务逻辑。需要调用查询接口的情况： 当商户后台、网络、服务器等出现异常，商户系统最终未接收到支付通知；调用支付接口后，返回系统错误或未知交易状态情况； 调用 alipay.trade.pay，返回 INPROCESS 的状态；调用 alipay.trade.cancel 之前，需确认支付状态；

### refund

alipay.trade.fastpay.refund.query \([统一收单交易退款查询](https://docs.open.alipay.com/api_1/alipay.trade.fastpay.refund.query/)\)

> 商户可使用该接口查询自已通过 alipay.trade.refund 提交的退款请求是否执行成功。该接口的返回码 10000，仅代表本次查询操作成功，不代表退款成功。如果该接口返回了查询数据，则代表退款成功，如果没有查询到则代表未退款成功，可以调用退款接口进行重试。重试时请务必保证退款请求号一致。



### faceFtoken

zoloz.authentication.customer.ftoken.query \([人脸 ftoken 查询消费接口](https://docs.open.alipay.com/api_46/zoloz.authentication.customer.ftoken.query)\)

> 人脸 ftoken 查询消费接口



### transOrder

alipay.fund.trans.order.query \([查询转账订单接口](https://docs.open.alipay.com/api_28/alipay.fund.trans.order.query)\)

> 商户可通过该接口查询转账订单的状态、支付时间等相关信息，主要应用于 B2C 转账订单查询的场景



### fundAuthOperationQuery

alipay.fund.auth.operation.detail.query \([资金授权操作查询接口](https://docs.open.alipay.com/api_28/alipay.fund.auth.operation.detail.query/)\)

> 通过该接口可以查询单笔明细的详细信息

 

 

 

