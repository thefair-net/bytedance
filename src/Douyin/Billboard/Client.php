<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Douyin\Billboard;

use Surpaimb\ByteDance\Douyin\TokenClient;
/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends TokenClient
{

    /**
     * 
     * 获取热门视频数据
     * Scope: `data.external.billboard_hot_video` 需要申请权限 不需要用户授权
     * 该接口用于获取热门视频榜单数据。该接口适用于抖音。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 该统计数据为离线数据，统计最近24小时；数据产出周期：每天10点前。
     * 
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function hotVideo()
    {
        return $this->httpGet('data/extern/billboard/hot_video/');
    }

    /**
     * 
     * 获取直播榜数据
     * Scope: `data.external.billboard_live`需要申请权限不需要用户授权
     * 该接口用于获取直播榜数据。该接口适用于抖音。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 该统计数据为离线数据；数据产出周期：每天10点前。
     * 
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function live()
    {
        return $this->httpGet('data/extern/billboard/live/');
    }
   
}
