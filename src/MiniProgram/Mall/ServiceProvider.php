<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\MiniProgram\Mall;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        $app['mall'] = function ($app) {
            return new ForwardsMall($app);
        };

        $app['mall.order'] = function ($app) {
            return new OrderClient($app);
        };

        $app['mall.cart'] = function ($app) {
            return new CartClient($app);
        };

        $app['mall.product'] = function ($app) {
            return new ProductClient($app);
        };

        $app['mall.media'] = function ($app) {
            return new MediaClient($app);
        };
    }
}
