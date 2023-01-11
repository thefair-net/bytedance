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

use TheFairLib\ByteDance\Kernel\BaseClient;

/**
 * Class Auth.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Get session info by code.
     *
     * @param string $code
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     */
    public function session(string $code, bool $anonymous = false)
    {
        $params = [
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['secret'],
        ];

        if ($anonymous) {
            $params['anonymous_code'] = $code;
        } else {
            $params['code'] = $code;
        }
    
        return $this->httpGet('api/apps/jscode2session', $params);
    }
}
