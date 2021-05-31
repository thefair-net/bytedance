<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\BasicService;

use Surpaimb\ByteDance\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author surpaimb <surpaimb@126.com>
 *
 * @property \Surpaimb\ByteDance\BasicService\Jssdk\Client           $jssdk
 * @property \Surpaimb\ByteDance\BasicService\Media\Client           $media
 * @property \Surpaimb\ByteDance\BasicService\QrCode\Client          $qrcode
 * @property \Surpaimb\ByteDance\BasicService\Url\Client             $url
 * @property \Surpaimb\ByteDance\BasicService\ContentSecurity\Client $content_security
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
