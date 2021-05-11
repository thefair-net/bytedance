<?php

namespace Surpaimb\ByteDance\MiniProgram\RiskControl;

use Surpaimb\ByteDance\Kernel\BaseClient;
use Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException;
use Surpaimb\ByteDance\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * 安全风控
 *
 * Class Client
 * @package Surpaimb\ByteDance\MiniProgram\RiskControl
 */
class Client extends BaseClient
{
    /**
     * 获取用户的安全等级
     *
     * @param  array  $params
     * @return array|Collection|object|ResponseInterface|string
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function getUserRiskRank(array $params)
    {
        return $this->httpPost('wxa/getuserriskrank', $params);
    }
}
