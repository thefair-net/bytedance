<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Douyin\Comment;

use ReflectionClass;
use Surpaimb\ByteDance\Douyin\BaseClient;
use Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{

    // 默认：item 普通用户，video 企业用户
    protected $preUrl = 'item';

    /**
     * 企业号用户
     */
    public function vip()
    {
        $this->preUrl = 'video';
        return $this;
    }

    /**
     * 评论列表
     * Scope: `item.comment`需要申请权限需要用户授权
     * 该接口用于获取评论列表。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 注意参数中item_id作为url参数时，必须encode，只对item_id单独进行encode
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param cursor	i64	分页游标, 第一页请求cursor是0, response中会返回下一页请求用到的cursor, 同时response还会返回has_more来表明是否有更多的数据。	0	false
     * @param count	i32	每页的数量，最大不超过50，最小不低于1	10	true
     * @param item_id	string	视频id	@8hxdhauTCMppanGnM4ltGM780mDqPP+KPpR0qQOmLVAXb/T060zdRmYqig357zEBq6CZRp4NVe6qLIJW/V/x1w==	true
     * @param sort_type	string	列表排序方式，不传默认按推荐序，可选值：time(时间逆序)、time_asc(时间顺序)	time	false
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * 
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $data = [])
    {
        return $this->httpGet($this->preUrl . '/comment/list/', $data);
    }

    /**
     * 评论回复列表
     * Scope: `item.comment`需要申请权限需要用户授权
     * 该接口用于获取评论回复列表。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 注意参数中item_id作为url参数时，必须encode，只对item_id单独进行encode
     * 注意参数中comment_id作为url参数时，必须encode，只对comment_id单独进行encode
     * 
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param cursor	i64	分页游标, 第一页请求cursor是0, response中会返回下一页请求用到的cursor, 同时response还会返回has_more来表明是否有更多的数据。	0	false
     * @param count	i32	每页的数量，最大不超过50，最小不低于1	10	true
     * @param item_id	string	视频id	@8hxdhauTCMppanGnM4ltGM780mDqPP+KPpR0qQOmLVAXb/T060zdRmYqig357zEBq6CZRp4NVe6qLIJW/V/x1w==	true
     * @param comment_id	string	评论id	@kj5k4hai123d22nGnM4ltGM780mDqPP+KPpR0qQOmLVAXb/T060zdRmYqig357zEBq6CZRp4NVe6qLIJW/V/x1w==	true
     * @param sort_type	string	列表排序方式，不传默认按推荐序，可选值：time(时间逆序)、time_asc(时间顺序)	time	false
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * 
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function replyList(array $data = [])
    {
        $params = $this->formatMessage($data);
        $this->restoreMessage();
        return $this->httpGet($this->preUrl . '/comment/reply/list/', $params);
    }

    /**
     * 回复视频评论
     * Scope: `item.comment`需要申请权限需要用户授权
     * 该接口用于回复视频评论。只能回复授权用户自己发布的视频。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function reply(array $data = [], array $query = [])
    {
        return $this->httpPostJson($this->preUrl . '/comment/reply/', $data, $query);
    }


    /**
     * 置顶视频评论(企业号)
     * Scope: `video.comment`需要申请权限需要用户授权
     * 该接口用于置顶视频评论。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 调用本接口，需要授权的抖音用户是企业号企业号 。
     * 
     * query:
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * data:
     * @param top	bool	true: 置顶, false: 取消置顶		true
     * @param comment_id	string	需要回复的评论id		true
     * @param item_id	string	视频id		true
     * 
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function top(array $data = [], array $query = [])
    {
        return $this->httpPostJson($this->preUrl . '/comment/top/', $data, $query);
    }

}
