<?php
/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) alim <tuple@youshui.ren>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Surpaimb\ByteDance\MiniProgram\Message;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 *
 * @author alim <tuple@youshui.ren>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $app)
    {
        !isset($app['message']) && $app['message'] = function ($app) {
            return new Client($app);
        };
    }
}