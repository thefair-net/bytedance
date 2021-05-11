<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\BasicService\Url;

use Surpaimb\ByteDance\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class Client extends BaseClient
{
    /**
     * @var string
     */
    protected $baseUri = 'https://api.weixin.qq.com/';

    /**
     * Shorten the url.
     *
     * @param string $url
     *
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function shorten(string $url)
    {
        $params = [
            'action' => 'long2short',
            'long_url' => $url,
        ];

        return $this->httpPostJson('cgi-bin/shorturl', $params);
    }
}
