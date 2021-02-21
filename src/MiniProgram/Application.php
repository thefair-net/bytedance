<?php
/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\MiniProgram;

use Surpaimb\ByteDance\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \Surpaimb\ByteDance\MiniProgram\Auth\AccessToken $access_token
 * @property \Surpaimb\ByteDance\MiniProgram\Auth\Client $auth
 * @property \Surpaimb\ByteDance\MiniProgram\KVData\Client $kv
 * * @property \Surpaimb\ByteDance\MiniProgram\Encryptor $encryptor
 * @property \Surpaimb\ByteDance\MiniProgram\QRCode\Client $qrcode
 * @property \Surpaimb\ByteDance\MiniProgram\Message\Client $message
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        KVData\ServiceProvider::class,
        QRCode\ServiceProvider::class,
        Message\ServiceProvider::class,
    ];
}
