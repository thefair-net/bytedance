<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount;

use Surpaimb\ByteDance\BasicService;
use Surpaimb\ByteDance\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @author surpaimb <surpaimb@126.com>
 *
 * @property \Surpaimb\ByteDance\BasicService\Media\Client                     $media
 * @property \Surpaimb\ByteDance\BasicService\Url\Client                       $url
 * @property \Surpaimb\ByteDance\BasicService\QrCode\Client                    $qrcode
 * @property \Surpaimb\ByteDance\BasicService\Jssdk\Client                     $jssdk
 * @property \Surpaimb\ByteDance\OfficialAccount\Auth\AccessToken              $access_token
 * @property \Surpaimb\ByteDance\OfficialAccount\Server\Guard                  $server
 * @property \Surpaimb\ByteDance\OfficialAccount\User\UserClient               $user
 * @property \Surpaimb\ByteDance\OfficialAccount\User\TagClient                $user_tag
 * @property \Surpaimb\ByteDance\OfficialAccount\Menu\Client                   $menu
 * @property \Surpaimb\ByteDance\OfficialAccount\TemplateMessage\Client        $template_message
 * @property \Surpaimb\ByteDance\OfficialAccount\Material\Client               $material
 * @property \Surpaimb\ByteDance\OfficialAccount\CustomerService\Client        $customer_service
 * @property \Surpaimb\ByteDance\OfficialAccount\CustomerService\SessionClient $customer_service_session
 * @property \Surpaimb\ByteDance\OfficialAccount\Semantic\Client               $semantic
 * @property \Surpaimb\ByteDance\OfficialAccount\DataCube\Client               $data_cube
 * @property \Surpaimb\ByteDance\OfficialAccount\AutoReply\Client              $auto_reply
 * @property \Surpaimb\ByteDance\OfficialAccount\Broadcasting\Client           $broadcasting
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\Card                     $card
 * @property \Surpaimb\ByteDance\OfficialAccount\Device\Client                 $device
 * @property \Surpaimb\ByteDance\OfficialAccount\ShakeAround\ShakeAround       $shake_around
 * @property \Surpaimb\ByteDance\OfficialAccount\POI\Client                    $poi
 * @property \Surpaimb\ByteDance\OfficialAccount\Store\Client                  $store
 * @property \Surpaimb\ByteDance\OfficialAccount\Base\Client                   $base
 * @property \Surpaimb\ByteDance\OfficialAccount\Comment\Client                $comment
 * @property \Surpaimb\ByteDance\OfficialAccount\OCR\Client                    $ocr
 * @property \Surpaimb\ByteDance\OfficialAccount\Goods\Client                  $goods
 * @property \Overtrue\Socialite\Providers\WeChat                      $oauth
 * @property \Surpaimb\ByteDance\OfficialAccount\WiFi\Client                   $wifi
 * @property \Surpaimb\ByteDance\OfficialAccount\WiFi\CardClient               $wifi_card
 * @property \Surpaimb\ByteDance\OfficialAccount\WiFi\DeviceClient             $wifi_device
 * @property \Surpaimb\ByteDance\OfficialAccount\WiFi\ShopClient               $wifi_shop
 * @property \Surpaimb\ByteDance\OfficialAccount\Guide\Client                  $guide
 */
class Application extends ServiceContainer
{
    /**
     * @var array
     */
    protected $providers = [
        Auth\ServiceProvider::class,
        Server\ServiceProvider::class,
        User\ServiceProvider::class,
        OAuth\ServiceProvider::class,
        Menu\ServiceProvider::class,
        TemplateMessage\ServiceProvider::class,
        Material\ServiceProvider::class,
        CustomerService\ServiceProvider::class,
        Semantic\ServiceProvider::class,
        DataCube\ServiceProvider::class,
        POI\ServiceProvider::class,
        AutoReply\ServiceProvider::class,
        Broadcasting\ServiceProvider::class,
        Card\ServiceProvider::class,
        Device\ServiceProvider::class,
        ShakeAround\ServiceProvider::class,
        Store\ServiceProvider::class,
        Comment\ServiceProvider::class,
        Base\ServiceProvider::class,
        OCR\ServiceProvider::class,
        Goods\ServiceProvider::class,
        WiFi\ServiceProvider::class,
        // Base services
        BasicService\QrCode\ServiceProvider::class,
        BasicService\Media\ServiceProvider::class,
        BasicService\Url\ServiceProvider::class,
        BasicService\Jssdk\ServiceProvider::class,
        // Append Guide Interface
        Guide\ServiceProvider::class,
    ];
}
