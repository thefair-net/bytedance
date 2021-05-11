<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount\ShakeAround;

use Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author surpaimb <surpaimb@126.com>
 *
 * @property \Surpaimb\ByteDance\OfficialAccount\ShakeAround\DeviceClient   $device
 * @property \Surpaimb\ByteDance\OfficialAccount\ShakeAround\GroupClient    $group
 * @property \Surpaimb\ByteDance\OfficialAccount\ShakeAround\MaterialClient $material
 * @property \Surpaimb\ByteDance\OfficialAccount\ShakeAround\RelationClient $relation
 * @property \Surpaimb\ByteDance\OfficialAccount\ShakeAround\StatsClient    $stats
 * @property \Surpaimb\ByteDance\OfficialAccount\ShakeAround\PageClient     $page
 */
class ShakeAround extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["shake_around.{$property}"])) {
            return $this->app["shake_around.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No shake_around service named "%s".', $property));
    }
}
