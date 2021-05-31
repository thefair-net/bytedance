<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Douyin\Video;

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



    /**
     * 查询授权账号视频数据
     * Scope：'video.list'需要用户授权需要申请权限
     * 该接口用于分页获取用户所有视频的数据，返回的数据是实时的。该接口适用于抖音。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。

     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param cursor	int64	分页游标, 第一页请求cursor是0, response中会返回下一页请求用到的cursor, 同时response还会返回has_more来表明是否有更多的数据。	0	false
     * @param count	int64	每页数量	10	true
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(array $data = [])
    {
        return $this->httpGet('video/list/', $data);
    }


    /**
     * 查询指定视频数据
     * Scope: `video.data`需要用户授权需要申请权限
     * 该接口 用于查询用户特定视频的数据, 如点赞数, 播放数等，返回的数据是实时的。该接口适用于抖音。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 有两种方式获取item_id(抖音视频id):
     * 
     * 查询视频分享结果和数据
     *  发布抖音视频  
     * 
     * query:
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param data:
     * @param item_ids	[]	item_id数组，仅能查询access_token对应用户上传的视频		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show(array $data = [], array $query = [])
    {
        return $this->httpPostJson('video/data/', $data, $query);
    }


    /**
     * 
     * 获取share-id
     * Scope: `aweme.share`不需要用户授权
     * 该接口用获取share_id；该接口适用于抖音。
     * 
     * share_id 可以用于：
     * 
     * 追踪分享的视频是否成功。
     * 获取分享视频的数据,如点赞数, 评论数等。
     * 接入步骤：
     * 
     * 去http://open.douyin.com/platform/business申请发布视频的能力。
     * 分享前获取标识单次分享的share_id。
     * 调用分享sdk时传入share_id。
     * 基于Webhooks接收分享成功的回调信息
     * 回调信息参数
     * 
     * {
     *     "event": "create_video",
     *     "from_user_id": "",
     *     "client_key": "",
     *     "msg_id": "",
     *     "content": {
     *        "share_id": "",
     *        "item_id": ""
     *     }
     * }
     * item_id可用于查询视频数据。 
     * 
     * 
     * 
     * @param access_token	string	调用/oauth/client_token/生成的token，此token不需要用户授权。	clt.943da17996fb5cebfbc70c044c3fc25a57T54DcjT6HNKGqnUdxzy1KcxFnZ	true
     * @param need_callback	bool	如果需要知道视频分享成功的结果，need_callback设置为true		false
     * @param source_style_id	string	多来源样式id（暂未开放）		false
     * @param default_hashtag	string	追踪分享默认hashtag		false
     * @param link_param	string	分享来源url附加参数（暂未开放）		false
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function shareId(array $data = [])
    {
        return $this->httpGet('share-id/', $data);
    }

    /**
     * 查询POI信息
     * Scope: `poi.search`不需要用户授权需要申请权限
     * 该接口用于poi信息的查询，应用场景为在发布内容时查询并携带该poi信息发布至抖音，该接口当前定向开放给媒体行业第三方；若其他行业有相关诉求，也可发起权限申请，会有相关工作人员尽快给予反馈。
     * 
     * 申请步骤：前往管理中心-应用详情-特殊权限中申请
     * 
     * 查询POI信息：通过用POI的关键词进行条件搜索，获取匹配POI列表，例如：肯德基、朝阳公园等；
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 
     * 
     * @param access_token	string	调用/oauth/client_token/生成的token，此token不需要用户授权。	clt.943da17996fb5cebfbc70c044c3fc25a57T54DcjT6HNKGqnUdxzy1KcxFnZ	true
     * @param cursor	int64	分页游标, 第一页请求cursor是0, response中会返回下一页请求用到的cursor, 同时response还会返回has_more来表明是否有更多的数据。	0	false
     * @param count	int64	每页数量	10	true
     * @param keyword	string	查询关键字，例如美食		true
     * @param city	string	查询城市，例如上海、北京		false
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function poi(array $data = [])
    {
        return $this->httpGet('poi/search/keyword/', $data);
    }


    /**
     * 获取视频基础数据
     * Scope: `data.external.item`需要申请权限需要用户授权
     * 该接口用于获取视频基础数据。
     * 
     * 注意：
     * 
     * 用户首次授权应用后，需要第二天才会产生全部的数据；
     * 注意参数中item_id作为url参数时，必须encode，只对item_id单独进行encode。
     * 三十天内创建的视频，才会返回数据。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param item_id	string	item_id，仅能查询access_token对应用户上传的视频		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function base(array $data = [])
    {
        return $this->httpGet('data/external/item/base/', $data);
    }
    /**
     * 获取视频点赞数据
     * Scope: `data.external.item`需要申请权限需要用户授权
     * 该接口用于获取视频点赞数据。
     * 
     * 注意：
     * 
     * 用户首次授权应用后，需要第二天才会产生全部的数据；
     * 注意参数中item_id作为url参数时，必须encode，只对item_id单独进行encode。
     * 三十天内创建的视频，才会返回数据。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param item_id	string	item_id，仅能查询access_token对应用户上传的视频		true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function like(array $data = [])
    {
        return $this->httpGet('data/external/item/like/', $data);
    }
    /**
     * 获取视频评论数据
     * Scope: `data.external.item`需要申请权限需要用户授权
     * 该接口用于获取视频评论数据。
     * 
     * 注意：
     * 
     * 用户首次授权应用后，需要第二天才会产生全部的数据；
     * 注意参数中item_id作为url参数时，必须encode，只对item_id单独进行encode。
     * 三十天内创建的视频，才会返回数据。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param item_id	string	item_id，仅能查询access_token对应用户上传的视频		true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function comment(array $data = [])
    {
        return $this->httpGet('data/external/item/comment/', $data);
    }
    /**
     * 获取视频播放数据
     * Scope: `data.external.item`需要申请权限需要用户授权
     * 该接口用于获取视频播放数据。
     * 
     * 注意：
     * 
     * 用户首次授权应用后，需要第二天才会产生全部的数据；
     * 注意参数中item_id作为url参数时，必须encode，只对item_id单独进行encode。
     * 三十天内创建的视频，才会返回数据。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param item_id	string	item_id，仅能查询access_token对应用户上传的视频		true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function play(array $data = [])
    {
        return $this->httpGet('data/external/item/play/', $data);
    }
    /**
     * 获取视频分享数据
     * Scope: `data.external.item`需要申请权限需要用户授权
     * 该接口用于获取视频分享数据。
     * 
     * 注意：
     * 
     * 用户首次授权应用后，需要第二天才会产生全部的数据；
     * 注意参数中item_id作为url参数时，必须encode，只对item_id单独进行encode。
     * 三十天内创建的视频，才会返回数据。
     * 
     * @param open_id	string	通过/oauth/access_token/获取，用户唯一标志	ba253642-0590-40bc-9bdf-9a1334b94059	true
     * @param access_token	string	调用/oauth/access_token/生成的token，此token需要用户授权。	act.1d1021d2aee3d41fee2d2add43456badMFZnrhFhfWotu3Ecuiuka27L56lr	true
     * @param item_id	string	item_id，仅能查询access_token对应用户上传的视频		true
     * @param date_type	int64	近7/15天；输入7代表7天、15代表15天		true
     * 
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function share(array $data = [])
    {
        return $this->httpGet('data/external/item/share/', $data);
    }

   
}
