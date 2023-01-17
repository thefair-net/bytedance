<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\Payment;

use TheFairLib\ByteDance\Kernel\BaseClient;
use TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException;
use ReflectionClass;

/**
 * Class Client.
 *
 * @author hugo <rabbitzhang52@gmail.com>
 */
class Client extends BaseClient
{

    public static $orderStatusWaitPay = 0;
    public static $orderStatusPayed = 1;
    public static $orderStatusCancel = 2;
    public static $orderStatusOff = 4;
    public static $orderStatusRefunding = 5;
    public static $orderStatusRefunded = 6;
    public static $orderStatusRefundFail = 8;


    protected $paysecret = '';

    /**
     * {@inheritdoc}.
     */
    protected $message = [
        'out_order_no' => '',
        'total_amount' => '',
        'subject' => '',
        'body' => '',
        'valid_time' => '',
        'sign' => '',
        'cp_extra' => '',
        'notify_url' => '',
        'thirdparty_id' => '',
        'disable_msg' => '',
        'msg_page' => '',
        'store_uid' => '',
    ];

    /**
     * {@inheritdoc}.
     */
    protected $required = ['out_order_no', 'total_amount', 'subject', 'body', 'valid_time'];

    /**
     * Send a template message.
     *
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unify(array $data = [])
    {
        $params = $this->formatMessage($data);

        $this->restoreMessage();

        $params = $this->withAppId($params);

        $params['sign'] = $this->getSign($params);
        // var_dump($params);
        return $this->httpPostJson('api/apps/ecpay/v1/create_order', $params);
    }

    public function push(string $openId,array $orderDetail,int $orderStatus,int $orderUpdateTime,string $extra=""){
        $token = $this->accessToken->getQuery();
        $params = [
            "access_token"=>$token && $token['access_token'] ? $token['access_token'] : '',
            "app_name"=>"douyin",
            "open_id"=>$openId,
            "order_detail" => \json_encode($orderDetail),
            "order_status"=>$orderStatus,
            "order_type"=>0,
            "update_time"=> $orderUpdateTime*1000,
            "extra"=>$extra
        ];
        return $this->httpPostJson('/api/apps/order/v2/push', $params);
    }

    /***
     * @param string $outOrderNo  商户分配支付单号，标识进行退款的订单
     * @param string $outRefundNo 商户分配退款号，保证在商户中唯一
     * @param int $refundAmount 退款金额，单位分
     * @param string $reason
     * @param array $extInfo
     * @param string $notifyUrl
     * @return array|object|\Psr\Http\Message\ResponseInterface|string|\TheFairLib\ByteDance\Kernel\Support\Collection
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     */
    public function refund(string $outOrderNo,string $outRefundNo,int $refundAmount,string $reason="",array $extInfo=[],string $notifyUrl=""){
        $params = [
            "out_order_no"=>$outOrderNo,
            "out_refund_no"=>$outRefundNo,
            "refund_amount"=>$refundAmount,
            "reason"=>$reason,
            "cp_extra"=>\json_encode($extInfo),
            "notify_url"=>$notifyUrl,
        ];

        $params = $this->withAppId($params);
        $params["sign"] = $this->getSign($params);
        return $this->httpPostJson('/api/apps/ecpay/v1/create_refund', $params);
    }

    public function getSign(array $params)
    {
        unset($params["sign"]);
        unset($params["app_id"]);
        unset($params["thirdparty_id"]);
        $paramArray = [];
        foreach ($params as $param) {
            if (trim($param))
                $paramArray[] = trim($param);
        }
        $paramArray[] = trim($this->app['config']['pay_secret']);
        sort($paramArray, 2);
        $signStr = trim(implode('&', $paramArray));
        return md5($signStr);
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     */
    protected function formatMessage(array $data = [])
    {
        $params = array_merge($this->message, $data);
        $rs = [];
        foreach ($params as $key => $value) {
            if (in_array($key, $this->required, true) && empty($value) && empty($this->message[$key])) {
                throw new InvalidArgumentException(sprintf('Attribute "%s" can not be empty!', $key));
            }

            $val = empty($value) ? $this->message[$key] : $value;
            if(!empty($val)){
                $rs[$key] = $val;
            }
        }

        return $rs;
    }

    /**
     * Restore message.
     */
    protected function restoreMessage()
    {
        $this->message = (new ReflectionClass(static::class))->getDefaultProperties()['message'];
    }

    public function getOrderStatus(string $order_no)
    {
        $params = ['out_order_no'=>$order_no];

        $params = $this->withAppId($params);

        $params['sign'] = $this->getSign($params);
        // var_dump($params);
        return $this->httpPostJson('api/apps/ecpay/v1/query_order', $params);
    }
}
