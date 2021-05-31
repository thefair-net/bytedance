<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Douyin\User;

use Surpaimb\ByteDance\Douyin\BaseClient;
/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{

    /**
     * 获取用户视频情况
     * Scope: `data.external.user`需要申请权限需要用户授权
     * 该接口用于获取用户视频情况。
     * 
     * 注：用户首次授权应用后，需要第二天才会产生全部的数据；
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天、30代表30天		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function item(array $data = [])
    {
        return $this->httpGet('data/external/user/item/', $data);
    }
    /**
     * 获取用户粉丝数
     * Scope: `data.external.user`需要申请权限需要用户授权
     * 该接口用于获取用户粉丝数。
     * 
     * 注：用户首次授权应用后，需要第二天才会产生全部的数据；
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天、30代表30天		true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fans(array $data = [])
    {
        return $this->httpGet('data/external/user/fans/', $data);
    }
    /**
     * 获取用户点赞数
     * Scope: `data.external.user`需要申请权限需要用户授权
     * 该接口用于获取用户点赞数。
     * 
     * 注：用户首次授权应用后，需要第二天才会产生全部的数据；
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天、30代表30天		true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function like(array $data = [])
    {
        return $this->httpGet('data/external/user/like/', $data);
    }
    /**
     * 获取用户评论数
     * Scope: `data.external.user`需要申请权限需要用户授权
     * 该接口用于获取用户评论数。
     * 
     * 注：用户首次授权应用后，需要第二天才会产生全部的数据；
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天、30代表30天		true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function comment(array $data = [])
    {
        return $this->httpGet('data/external/user/comment/', $data);
    }
    /**
     * 获取用户分享数
     * Scope: `data.external.user`需要申请权限需要用户授权
     * 该接口用于获取用户分享数。
     * 
     * 注：用户首次授权应用后，需要第二天才会产生全部的数据；
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天、30代表30天		true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function share(array $data = [])
    {
        return $this->httpGet('data/external/user/share/', $data);
    }
    /**
     * 获取用户主页访问数
     * Scope: `data.external.user`需要申请权限需要用户授权
     * 该接口用于获取用户主页访问数。
     * 
     * 注：用户首次授权应用后，需要第二天才会产生全部的数据；
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天、30代表30天		true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function profile(array $data = [])
    {
        return $this->httpGet('data/external/user/profile/', $data);
    }



   
}
