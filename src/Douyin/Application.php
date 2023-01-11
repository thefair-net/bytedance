<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Douyin;

use TheFairLib\ByteDance\BasicService;
use TheFairLib\ByteDance\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author surpaimb <surpaimb@126.com>
 *
 * @property \TheFairLib\ByteDance\Douyin\Auth\Client              $auth
 * @property \TheFairLib\ByteDance\Douyin\Fans\Client                  $fans
 * @property \TheFairLib\ByteDance\Douyin\Video\Client                  $video
 * @property \TheFairLib\ByteDance\Douyin\Micapp\Client                  $micapp
 * @property \TheFairLib\ByteDance\Douyin\User\Client                  $user
 * @property \TheFairLib\ByteDance\Douyin\Hot\Client                  $hot
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
