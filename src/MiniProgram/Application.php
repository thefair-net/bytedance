<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram;

use TheFairLib\ByteDance\BasicService;
use TheFairLib\ByteDance\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \TheFairLib\ByteDance\MiniProgram\Auth\AccessToken           $access_token
 * @property \TheFairLib\ByteDance\MiniProgram\DataCube\Client            $data_cube
 * @property \TheFairLib\ByteDance\MiniProgram\AppCode\Client             $app_code
 * @property \TheFairLib\ByteDance\MiniProgram\Auth\Client                $auth
 * @property \TheFairLib\ByteDance\Douyin\Server\Guard           $server
 * @property \TheFairLib\ByteDance\MiniProgram\Encryptor                  $encryptor
 * @property \TheFairLib\ByteDance\MiniProgram\TemplateMessage\Client     $template_message
 * @property \TheFairLib\ByteDance\Douyin\CustomerService\Client $customer_service
 * @property \TheFairLib\ByteDance\MiniProgram\Plugin\Client              $plugin
 * @property \TheFairLib\ByteDance\MiniProgram\Plugin\DevClient           $plugin_dev
 * @property \TheFairLib\ByteDance\MiniProgram\UniformMessage\Client      $uniform_message
 * @property \TheFairLib\ByteDance\MiniProgram\ActivityMessage\Client     $activity_message
 * @property \TheFairLib\ByteDance\MiniProgram\Express\Client             $logistics
 * @property \TheFairLib\ByteDance\MiniProgram\NearbyPoi\Client           $nearby_poi
 * @property \TheFairLib\ByteDance\MiniProgram\OCR\Client                 $ocr
 * @property \TheFairLib\ByteDance\MiniProgram\Soter\Client               $soter
 * @property \TheFairLib\ByteDance\BasicService\Media\Client              $media
 * @property \TheFairLib\ByteDance\BasicService\ContentSecurity\Client    $content_security
 * @property \TheFairLib\ByteDance\MiniProgram\Mall\ForwardsMall          $mall
 * @property \TheFairLib\ByteDance\MiniProgram\SubscribeMessage\Client    $subscribe_message
 * @property \TheFairLib\ByteDance\MiniProgram\RealtimeLog\Client         $realtime_log
 * @property \TheFairLib\ByteDance\MiniProgram\Search\Client              $search
 * @property \TheFairLib\ByteDance\MiniProgram\Live\Client                $live
 * @property \TheFairLib\ByteDance\MiniProgram\Broadcast\Client           $broadcast
 * @property \TheFairLib\ByteDance\MiniProgram\UrlScheme\Client           $url_scheme
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Server\ServiceProvider::class,
        Plugin\ServiceProvider::class,
        Base\ServiceProvider::class,
        NearbyPoi\ServiceProvider::class,
        Mall\ServiceProvider::class,
        Live\ServiceProvider::class,
        // Base services
        BasicService\Media\ServiceProvider::class,
        BasicService\ContentSecurity\ServiceProvider::class,
        // for mine
        SubscribeMessage\ServiceProvider::class,
        Payment\ServiceProvider::class,
        Content\ServiceProvider::class,
        QrCode\ServiceProvider::class,
    ];

    /**
     * Handle dynamic calls.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->base->$method(...$args);
    }
}
