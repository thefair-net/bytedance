<?php

namespace Surpaimb\ByteDance\MiniProgram\UrlScheme;

use Surpaimb\ByteDance\Kernel\BaseClient;
use Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException;
use Surpaimb\ByteDance\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

/**
 * Url Scheme
 *
 * Class Client
 * @package Surpaimb\ByteDance\MiniProgram\UrlScheme
 */
class Client extends BaseClient
{
    /**
     * 获取小程序scheme码
     *
     * @param  array  $param
     * @return array|Collection|object|ResponseInterface|string
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     */
    public function generate(array $param = [])
    {
        return $this->httpPostJson('wxa/generatescheme', $param);
    }
}
