<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\Plugin;

use TheFairLib\ByteDance\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param string $appId
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function apply($appId)
    {
        return $this->httpPostJson('wxa/plugin', [
            'action' => 'apply',
            'plugin_appid' => $appId,
        ]);
    }

    /**
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list()
    {
        return $this->httpPostJson('wxa/plugin', [
            'action' => 'list',
        ]);
    }

    /**
     * @param string $appId
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unbind($appId)
    {
        return $this->httpPostJson('wxa/plugin', [
            'action' => 'unbind',
            'plugin_appid' => $appId,
        ]);
    }
}
