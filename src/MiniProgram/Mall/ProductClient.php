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
class ProductClient extends BaseClient
{
    /**
     * 更新或导入物品信息.
     *
     * @param array $params
     * @param bool  $isTest
     *
     * @return mixed
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function import($params, $isTest = false)
    {
        return $this->httpPostJson('mall/importproduct', $params, ['is_test' => (int) $isTest]);
    }

    /**
     * 查询物品信息.
     *
     * @param array $params
     *
     * @return mixed
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function query($params)
    {
        return $this->httpPostJson('mall/queryproduct', $params, ['type' => 'batchquery']);
    }

    /**
     * 小程序的物品是否可被搜索.
     *
     * @param bool $value
     *
     * @return mixed
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setSearchable($value)
    {
        return $this->httpPostJson('mall/brandmanage', ['can_be_search' => $value], ['action' => 'set_biz_can_be_search']);
    }
}
