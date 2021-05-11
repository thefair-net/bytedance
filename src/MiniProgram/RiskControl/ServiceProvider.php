<?php

namespace Surpaimb\ByteDance\MiniProgram\RiskControl;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * 安全风控
 *
 * Class ServiceProvider
 * @package Surpaimb\ByteDance\MiniProgram\RiskControl
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritDoc
     */
    public function register(Container $pimple)
    {
        $app['risk_control'] = function ($app) {
            return new Client($app);
        };
    }
}
