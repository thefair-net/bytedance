<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Douyin;

use Surpaimb\ByteDance\BasicService;
use Surpaimb\ByteDance\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author surpaimb <surpaimb@126.com>
 *
 * @property \Surpaimb\ByteDance\Douyin\Auth\Client              $auth
 * @property \Surpaimb\ByteDance\Douyin\Fans\Client                  $fans
 * @property \Surpaimb\ByteDance\Douyin\Video\Client                  $video
 * @property \Surpaimb\ByteDance\Douyin\Micapp\Client                  $micapp
 * @property \Surpaimb\ByteDance\Douyin\User\Client                  $user
 * @property \Surpaimb\ByteDance\Douyin\Hot\Client                  $hot
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        // Append Guide Interface
        Auth\ServiceProvider::class,
        Fans\ServiceProvider::class,
        Comment\ServiceProvider::class,
        Video\ServiceProvider::class,
        Micapp\ServiceProvider::class,
        User\ServiceProvider::class,
        Billboard\ServiceProvider::class,
        Hot\ServiceProvider::class,
      ];
}
