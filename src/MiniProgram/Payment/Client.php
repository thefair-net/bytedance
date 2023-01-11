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
