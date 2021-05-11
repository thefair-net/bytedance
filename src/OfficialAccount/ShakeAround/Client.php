<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount\ShakeAround;

use Surpaimb\ByteDance\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class Client extends BaseClient
{
    /**
     * @param array $data
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register($data)
    {
        return $this->httpPostJson('shakearound/account/register', $data);
    }

    /**
     * Get audit status.
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     */
    public function status()
    {
        return $this->httpGet('shakearound/account/auditstatus');
    }

    /**
     * Get shake info.
     *
     * @param string $ticket
     * @param bool   $needPoi
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function user(string $ticket, bool $needPoi = false)
    {
        $params = [
            'ticket' => $ticket,
        ];

        if ($needPoi) {
            $params['need_poi'] = 1;
        }

        return $this->httpPostJson('shakearound/user/getshakeinfo', $params);
    }

    /**
     * @param string $ticket
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function userWithPoi(string $ticket)
    {
        return $this->user($ticket, true);
    }
}
