<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\Mall;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \TheFairLib\ByteDance\MiniProgram\Mall\OrderClient   $order
 * @property \TheFairLib\ByteDance\MiniProgram\Mall\CartClient    $cart
 * @property \TheFairLib\ByteDance\MiniProgram\Mall\ProductClient $product
 * @property \TheFairLib\ByteDance\MiniProgram\Mall\MediaClient   $media
 */
class ForwardsMall
{
    /**
     * @var \TheFairLib\ByteDance\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * @param \TheFairLib\ByteDance\Kernel\ServiceContainer $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->app["mall.{$property}"];
    }
}
