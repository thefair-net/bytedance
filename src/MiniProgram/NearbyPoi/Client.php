<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\NearbyPoi;

use TheFairLib\ByteDance\Kernel\BaseClient;
use TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 *
 * @author joyeekk <xygao2420@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Add nearby poi.
     *
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function add(array $params)
    {
        $params = array_merge([
            'is_comm_nearby' => '1',
            'poi_id' => '',
        ], $params);

        return $this->httpPostJson('wxa/addnearbypoi', $params);
    }

    /**
     * Update nearby poi.
     *
     * @param string $poiId
     * @param array  $params
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(string $poiId, array $params)
    {
        $params = array_merge([
            'is_comm_nearby' => '1',
            'poi_id' => $poiId,
        ], $params);

        return $this->httpPostJson('wxa/addnearbypoi', $params);
    }

    /**
     * Delete nearby poi.
     *
     * @param string $poiId
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $poiId)
    {
        return $this->httpPostJson('wxa/delnearbypoi', [
            'poi_id' => $poiId,
        ]);
    }

    /**
     * Get nearby poi list.
     *
     * @param int $page
     * @param int $pageRows
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     */
    public function list(int $page, int $pageRows)
    {
        return $this->httpGet('wxa/getnearbypoilist', [
            'page' => $page,
            'page_rows' => $pageRows,
        ]);
    }

    /**
     * Set nearby poi show status.
     *
     * @param string $poiId
     * @param int    $status
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setVisibility(string $poiId, int $status)
    {
        if (!in_array($status, [0, 1], true)) {
            throw new InvalidArgumentException('status should be 0 or 1.');
        }

        return $this->httpPostJson('wxa/setnearbypoishowstatus', [
            'poi_id' => $poiId,
            'status' => $status,
        ]);
    }
}
