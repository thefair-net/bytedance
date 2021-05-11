<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount\Server;

use Surpaimb\ByteDance\Kernel\ServerGuard;

/**
 * Class Guard.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class Guard extends ServerGuard
{
    /**
     * @return bool
     */
    protected function shouldReturnRawResponse(): bool
    {
        return !is_null($this->app['request']->get('echostr'));
    }
}
