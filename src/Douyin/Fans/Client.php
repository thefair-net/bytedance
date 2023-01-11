<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Douyin\Fans;

use TheFairLib\ByteDance\Douyin\BaseClient;
/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{

    /**
     * 粉丝列表
     * Scope: `fans.list`需要用户授权
     * 获取用户最近的粉丝列表，不保证顺序；目前可查询的粉丝数上限5千。该接口适用于抖音。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param cursor	int64	分页游标, 第一页请求cursor是0, response中会返回下一页请求用到的cursor, 同时response还会返回has_more来表明是否有更多的数据。	0	false
     * @param count	int64	每页数量	10	true

     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $data = [])
    {
        return $this->httpGet('fans/list/', $data);
    }
    /**
     * 获取关注列表
     * Scope: `following.list`需要用户授权
     * 获取用户的关注列表；该接口适用于抖音。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param cursor	int64	分页游标, 第一页请求cursor是0, response中会返回下一页请求用到的cursor, 同时response还会返回has_more来表明是否有更多的数据。	0	false
     * @param count	int64	每页数量	10	true

     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function following(array $data = [])
    {
        return $this->httpGet('following/list/', $data);
    }
    /**
     * 粉丝判断
     * Scope: `fans.check`需要用户授权
     * 开发者应用下授权的抖音账号可根据用户的openid识别其是否关注其账号，并返回关注与否结果；（follower_open_id是否关注了open_id）
     * 如关注：返回是，并返回关注时间
     * 未关注：返回否
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param follower_open_id	string		ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function check(array $data = [])
    {
        return $this->httpGet('fans/check/', $data);
    }

    /**
     * 获取用户粉丝数据
     * Scope: `fans.data`需要申请权限需要用户授权
     * 该接口用于查询用户的粉丝数据，如性别分布，年龄分布，地域分布等。
     * 
     * 注：用户首次授权应用后，需要间隔2天才会产生全部的数据；并只提供粉丝大于100的用户数据。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true

     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function data(array $data = [])
    {
        return $this->httpGet('fans/data/', $data);
    }
    /**
     * 获取用户粉丝来源分布
     * Scope: `data.external.fans_source`需要申请权限需要用户授权
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function source(array $data = [])
    {
        return $this->httpGet('data/extern/fans/source/', $data);
    }
    /**
     * 获取用户粉丝喜好
     * Scope: `data.external.fans_favourite`需要申请权限需要用户授权
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function favourite(array $data = [])
    {
        return $this->httpGet('data/extern/fans/favourite/', $data);
    }
    /**
     * 获取用户粉丝热评
     * Scope: `data.external.fans_favourite`需要申请权限需要用户授权
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function comment(array $data = [])
    {
        return $this->httpGet('data/extern/fans/comment/', $data);
    }
   
}
