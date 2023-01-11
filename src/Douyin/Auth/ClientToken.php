<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Douyin\Auth;

use TheFairLib\ByteDance\Kernel\AccessToken as BaseAccessToken;
use TheFairLib\ByteDance\Kernel\Exceptions\HttpException;

/**
 * Class ClientToken.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class ClientToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected $endpointToGetToken = 'https://open.douyin.com/oauth/client_token/';

    /**
     * @var string
     */
    protected $cachePrefix = 'surpaimb.bytedance.kernel.client_token.';

    /**
     * {@inheritdoc}
     */
    protected function getCredentials(): array
    {
        return [
            'grant_type' => 'client_credential',
            'client_key' => $this->app['config']['client_key'],
            'client_secret' => $this->app['config']['client_secret'],
        ];
    }

        /**
     * @param array $credentials
     * @param bool  $toArray
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\HttpException
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     */
    public function requestToken(array $credentials, $toArray = false)
    {
        $response = $this->sendRequest($credentials);
        $result = json_decode($response->getBody()->getContents(), true);
    
        if (empty($result['data'][$this->tokenKey])) {
            throw new HttpException('Request access_token fail: '.json_encode($result, JSON_UNESCAPED_UNICODE), $response);
        }
        return  $result['data'];
    }

}
