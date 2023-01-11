<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\BasicService;

use TheFairLib\ByteDance\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author surpaimb <surpaimb@126.com>
 *
 * @property \TheFairLib\ByteDance\BasicService\Jssdk\Client           $jssdk
 * @property \TheFairLib\ByteDance\BasicService\Media\Client           $media
 * @property \TheFairLib\ByteDance\BasicService\QrCode\Client          $qrcode
 * @property \TheFairLib\ByteDance\BasicService\Url\Client             $url
 * @property \TheFairLib\ByteDance\BasicService\ContentSecurity\Client $content_security
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Jssdk\ServiceProvider::class,
        QrCode\ServiceProvider::class,
        Media\ServiceProvider::class,
        Url\ServiceProvider::class,
        ContentSecurity\ServiceProvider::class,
    ];
}
