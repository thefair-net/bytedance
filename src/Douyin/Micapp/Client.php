<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Douyin\Micapp;

use ReflectionClass;
use Surpaimb\ByteDance\Douyin\TokenClient;
use Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends TokenClient
{


    /**
     * 提供一个接口给开发者校验小程序appid是否可挂载到短视频
     * Scope: `micapp.is_legal`需要申请权限不需要用户授权
     * 注意：调用/oauth/client_token/生成的token，此token不需要用户授权
     * 
     * @param micapp_id	string	输入小程序的micapp_id	tt5daf2b12c2857910	true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function isLegal(array $data = [])
    {
        return $this->httpGet('devtool/micapp/is_legal/', $data);
    }


   
}
