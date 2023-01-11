<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\Mall;

use TheFairLib\ByteDance\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class MediaClient extends BaseClient
{
    /**
     * 更新或导入媒体信息.
     *
     * @param array $params
     *
     * @return mixed
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function import($params)
    {
        return $this->httpPostJson('mall/importmedia', $params);
    }
}
