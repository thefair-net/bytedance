<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Douyin\Base;

use TheFairLib\ByteDance\Douyin\BaseClient;
/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{

    /**
     * 
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function item(array $data = [])
    {
        return $this->httpGet('data/external/user/item/', $data);
    }
   
}
