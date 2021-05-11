<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount\Goods;

use Surpaimb\ByteDance\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author her-cat <hxhsoft@foxmail.com>
 */
class Client extends BaseClient
{
    /**
     * Add the goods.
     *
     * @param array $data
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(array $data)
    {
        return $this->httpPostJson('scan/product/v2/add', [
            'product' => $data,
        ]);
    }

    /**
     * Update the goods.
     *
     * @param array $data
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(array $data)
    {
        return $this->httpPostJson('scan/product/v2/add', [
            'product' => $data,
        ]);
    }

    /**
     * Get add or update goods results.
     *
     * @param string $ticket
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status(string $ticket)
    {
        return $this->httpPostJson('scan/product/v2/status', [
            'status_ticket' => $ticket,
        ]);
    }

    /**
     * Get goods information.
     *
     * @param string $pid
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $pid)
    {
        return $this->httpPostJson('scan/product/v2/getinfo', [
            'product' => [
                'pid' => $pid,
            ],
        ]);
    }

    /**
     * Get a list of goods.
     *
     * @param string $context
     * @param int    $page
     * @param int    $size
     *
     * @return array|\Surpaimb\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(string $context = '', int $page = 1, int $size = 10)
    {
        return $this->httpPostJson('scan/product/v2/getinfobypage', [
            'page_context' => $context,
            'page_num' => $page,
            'page_size' => $size,
        ]);
    }
}
