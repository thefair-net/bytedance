<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\MiniProgram\Soter;

use Surpaimb\ByteDance\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author her-cat <hxhsoft@foxmail.com>
 */
class Client extends BaseClient
{
    /**
     * @param string $openid
     * @param string $json
     * @param string $signature
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function verifySignature(string $openid, string $json, string $signature)
    {
        return $this->httpPostJson('cgi-bin/soter/verify_signature', [
            'openid' => $openid,
            'json_string' => $json,
            'json_signature' => $signature,
        ]);
    }
}
