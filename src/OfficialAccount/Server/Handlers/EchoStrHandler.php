<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount\Server\Handlers;

use Surpaimb\ByteDance\Kernel\Contracts\EventHandlerInterface;
use Surpaimb\ByteDance\Kernel\Decorators\FinallyResult;
use Surpaimb\ByteDance\Kernel\ServiceContainer;

/**
 * Class EchoStrHandler.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class EchoStrHandler implements EventHandlerInterface
{
    /**
     * @var ServiceContainer
     */
    protected $app;

    /**
     * EchoStrHandler constructor.
     *
     * @param ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }

    /**
     * @param mixed $payload
     *
     * @return FinallyResult|null
     */
    public function handle($payload = null)
    {
        if ($str = $this->app['request']->get('echostr')) {
            return new FinallyResult($str);
        }

        return null;
    }
}
