<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\Auth;

use TheFairLib\ByteDance\Kernel\AccessToken as BaseAccessToken;

/**
 * Class AccessToken.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected $endpointToGetToken = 'https://developer.toutiao.com/api/apps/token';

    /**
     * {@inheritdoc}
     */
    protected function getCredentials(): array
    {
        return [
            'grant_type' => 'client_credential',
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['secret'],
        ];
    }
}
