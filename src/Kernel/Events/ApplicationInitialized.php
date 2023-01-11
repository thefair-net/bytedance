<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Kernel\Events;

use TheFairLib\ByteDance\Kernel\ServiceContainer;

/**
 * Class ApplicationInitialized.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class ApplicationInitialized
{
    /**
     * @var \TheFairLib\ByteDance\Kernel\ServiceContainer
     */
    public $app;

    /**
     * @param \TheFairLib\ByteDance\Kernel\ServiceContainer $app
     */
    public function __construct(ServiceContainer $app)
    {
        $this->app = $app;
    }
}
