<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\Mall;

use TheFairLib\ByteDance\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class OrderClient extends BaseClient
{
    /**
     * 导入订单.
     *
     * @param array $params
     * @param bool  $isHistory
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add($params, $isHistory = false)
    {
        return $this->httpPostJson('mall/importorder', $params, ['action' => 'add-order', 'is_history' => (int) $isHistory]);
    }

    /**
     * 导入订单.
     *
     * @param array $params
     * @param bool  $isHistory
     *
     * @return mixed
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update($params, $isHistory = false)
    {
        return $this->httpPostJson('mall/importorder', $params, ['action' => 'update-order', 'is_history' => (int) $isHistory]);
    }

    /**
     * 删除订单.
     *
     * @param string $openid
     * @param string $orderId
     *
     * @return mixed
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($openid, $orderId)
    {
        $params = [
            'user_open_id' => $openid,
            'order_id' => $orderId,
        ];

        return $this->httpPostJson('mall/deleteorder', $params);
    }
}
