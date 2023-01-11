<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Douyin\Hot;

use TheFairLib\ByteDance\Douyin\TokenClient;
/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends TokenClient
{

    /**
     * 
     * 获取热点词聚合的视频
     * Scope: `hotsearch `需要申请权限不需要用户授权
     * 
     * @param hot_sentence	string	热点词		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function videos(array $data = [])
    {
        return $this->httpGet('hotsearch/videos/', $data);
    }

    /**
     * 
     * 获取实时热点词
     * Scope: `hotsearch `需要申请权限不需要用户授权
     * 该接口用于查询热点榜数据，可以根据热点词搜索相关视频。
     * 
     * 注意： 热点榜约每两个小时刷新一次。
     * 
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sentences()
    {
        return $this->httpGet('hotsearch/sentences/');
    }
    /**
     * 
     * 获取上升词
     * Scope: `hotsearch `需要申请权限不需要用户授权
     * 该接口用于查询上升词。
     * 
     * 注意： 热点榜约每两个小时刷新一次。
     * 
     * @param cursor	int64	分页游标, 第一页请求cursor是0, response中会返回下一页请求用到的cursor, 同时response还会返回has_more来表明是否有更多的数据。	0	false
     * @param count	int64	每页数量	10	true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function trending(array $data = [])
    {
        return $this->httpGet('hotsearch/trending/sentences/', $data);
    }
   
}
